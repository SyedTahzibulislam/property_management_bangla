<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Areacode;
use App\Models\project;
use App\Models\plot;  
use App\Models\plotsell;
use App\Models\cashtransition;
use Illuminate\Support\Facades\Hash;
use App\Models\user;
use DataTables;
use Validator;
use DB;
use PDF;
class CustomerEntryController extends Controller
{
    
    public function index(Request $request)
    {

	  $Customer=  Customer::with('Areacode')->where('softdelete',0)
	    ->orderBy(Areacode::select('code')->whereColumn('areacodes.id','customers.Areacode_id' ))->get();
	
	  
	        if ($request->ajax()) {
					
					  $Customer=  Customer::with('Areacode')->where('softdelete',0)
	    ->orderBy(Areacode::select('code')->whereColumn('areacodes.id','customers.Areacode_id' ))->get();
	

		   //$medicine =  medicine::latest()->get();
            return Datatables::of($Customer)
                   ->addIndexColumn()
				   

                    ->addColumn('action', function( Customer $data){ 
   
                        //   $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                        // $button .= '&nbsp;&nbsp;';
                        $button = '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    })  
                      ->addColumn('areacode', function (Customer $Customer) {
						  
						  $areacode = Areacode::findOrFail($Customer->Areacode_id)->code;
                    return $areacode;
					
					//return "c";
                })
					
					
                    ->rawColumns(['action'])
                    ->make(true);
        }
		

		return view('customer.customer', compact('Customer'));   
	
	}


public function drodownlist(){
   
    $data = Areacode::orderBy('code')->get(); 

    $project = project::where('softdelete',0)->orderBy('name')->get();
    return response()->json(['data' => $data, 'project'=> $project ]);

}


public function store(Request $request)
{

    $rules = array(
        'name'    =>  'required',
        'areacode'     =>  'required',
        'customercode',
        'mobile'   =>  'required',
            'address'   =>  'required',
        
        'openingbalance'   =>  'required',
        'project_name','plot','amount','description', 'gross_amount', 'paid', 'Date_of_Transition',

        
        
    );



    $error = Validator::make($request->all(), $rules);

    $request->openingbalance =  convertToEnglish($request->openingbalance);
    $request->amount =  convertToEnglish($request->amount);
    $request->gross_amount =  convertToEnglish($request->gross_amount);
    $request->paid =  convertToEnglish($request->paid);


    if($error->fails())
    {
        return response()->json(['errors' => $error->errors()->all()]);
    }

  try{
    DB::beginTransaction();
    // create customer
    $form_data = array(
        'name'        =>  $request->name,
        'Areacode_id'         =>  $request->areacode,
       'customercode' =>$request->name,
       'mobile' =>$request->mobile,
                  'address' =>$request->address,
                          'duelimit' =>100000000,
                                  'openingbalance' =>convertToEnglish($request->openingbalance) ,
                            'presentduebalance' =>convertToEnglish($request->openingbalance) ,   
                                        'balance_of_business_id' => Auth()->user()->balance_of_business_id,
                               
    );

 $k=   Customer::create($form_data);


// register customer as a user
$user = new user();
$user->name = $request->name;
$user->customer_id = $k->id;

$user->email  = $request->email;
$user->mobile = $request->mobile;
$user->role = 6;
$user->password = Hash::make($request->password);
$user->save();



$due = $request->gross_amount- $request->paid;

// create plot
$plot = new plot();
$plot->name = $request->plot;
$plot->project_id = $request->project_name;
$plot->customer_id = $k->id;
$plot->user_id = Auth()->user()->id;
$plot->description = $request->description;
$plot->amount = $request->amount;
if ($due > 0 )
{
    $plot->status = 1;   
}
if ($due == 0 )
{
    $plot->status = 2;   
}

$plot->save();	


// plot sell transaction
$plotsell = new plotsell();
$plotsell->customer_id =  $k->id;
$plotsell->project_id = $request->project_name;
$plotsell->user_id = Auth()->user()->id;
$plotsell->plot_id = $plot->id;
$plotsell->amount = $request->gross_amount;
$plotsell->discount =0;
$plotsell->paid = $request->paid;
$plotsell->due = $due;
$plotsell->due_first = $due;
$plotsell->amountafterdiscount = $request->gross_amount;
$plotsell->comment = $request->comment;

$plotsell->adjusttype = 1; // owner's fund
$plotsell->created_at = $request->Date_of_Transition;
$plotsell->type = 1;
$plotsell->save();

// cash transaction 
$project_name = project::findOrFail($request->project_name)->name;
$plot_name = $request->plot;
$customer = $request->name;

$present_balance = $request->openingbalance + $due;

$cashtransition = new cashtransition();
$cashtransition->balance_of_business_id = Auth()->user()->balance_of_business_id;
$cashtransition->project_id = $request->project_name;
$cashtransition->User_id = Auth()->user()->id;
$cashtransition->plotsell_id = $plotsell->id;
$cashtransition->customer_id = $k->id;
$cashtransition->amount = $request->paid;
$cashtransition->deposit = $request->paid;	
$cashtransition->type = 1;
$cashtransition->transtype = 17;
$cashtransition->description = "Plot Sell project Name:- " .$project_name. "Plot Name: " .$plot_name. " Customer Name: " .$request->name ;
$cashtransition->created_at = $request->Date_of_Transition;	
$cashtransition->save();



customer::where('id', $k->id )
       ->update([
           'presentduebalance' => $present_balance
        ]);

        DB::commit();
        return response()->json(['success' => 'Data Added successfully.']);
    } 
    catch (\Exception $e) {
        DB::rollback();
        return response()->json(['success' => 'Data Added failed.']);
       
    }







}


public function edit ($id){
    if(request()->ajax())
    {
        $shopid = Auth()->user()->id;

        $data = Customer::where('balance_of_business_id',$shopid)->findOrFail($id);
        $areacode = Areacode::where('balance_of_business_id',$shopid)->orderBy('code')->get(); 

        return response()->json(['data' => $data , 'areacode' => $areacode ]);
    }

}


public function update(Request $request){


        
    $rules = array(
        'name'    =>  'required',
        'areacode'     =>  'required',
        'customercode',
        'mobile'   =>  'required',
            'address'   =>  'required',
        'duelimit',
        'openingbalance'   =>  'required',
        
        
    );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
   

    $form_data = array(
        'name'        =>  $request->name,
        'Areacode_id'         =>  $request->areacode,
       'customercode' => $request->name,
       'mobile' =>$request->mobile,
                  'address' =>$request->address,
                          'duelimit' =>  10000000000,
                                  'openingbalance' =>$request->openingbalance,
                            'presentduebalance' =>$request->openingbalance,   
                               
    );
Customer::whereId($request->hidden_id)->update($form_data);


if( ($request->email != null ) and ($request->password != null)){
user::where( 'customer_id', $request->hidden_id )
->update(['email' => $request->email,
'password'=> Hash::make($request->password)  ]);
}

}




public function fulllist(){

$customer = Customer::where('softdelete',0)->orderBy('name')->get();

$pdf = PDF::loadView('customer.voucher', compact('customer' ),
[], [
'mode'                     => '',
 'format'                   => 'A4',
 'default_font_size'        => '7',
 'default_font'             => 'Times-New-Roman',
 'margin_left'              => 7,
 'margin_right'             => 7,
 'margin_top'               => 7,
 'margin_bottom'            => 7,
 'title'                    => 'Customer_List'
]


);
 
 
  return $pdf->stream('Customer_List.pdf');
 









}







public function delete($id)
{  
    
    
     try{
        DB::beginTransaction();



plotsell::where('customer_id', $id)->delete();

cashtransition::where('customer_id', $id)->delete();



user::where('customer_id', $id)->delete();

Customer::where('id', $id)->delete();

plot::where('customer_id', $id )
->update([
    'status' => 0,
    'customer_id'=>null,
 ]);



 Customer::where('id', $id )
 ->update([
     'softdelete' => 1,
  ]);


DB::commit();
return response()->json(['success' => 'Data Deleted.']);
 } 
catch (\Exception $e) {

     DB::rollback();
     return response()->json(['success' => 'Data Deleted Failed.']);

 }






}



}

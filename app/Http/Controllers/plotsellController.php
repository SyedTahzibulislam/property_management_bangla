<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;





use DataTables;
use Validator;
use App\Models\balance_of_business; 
use App\Models\project; 
use App\Models\cashtransition; 
use App\Models\go_down_stock; 

use App\Models\Customer;
use App\Models\Product;  
use App\Models\productorder;
use App\Models\producttransition;
use App\Models\User;
use App\Models\plot;


use App\Models\projectstock;
use App\Models\plotsell;
use App\Models\unitcoversion;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Redirect;
use App\Models\productpriceaccunit;



use PDF;











class plotsellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	       public function index(Request $request)
    {
      $plotsell=  plotsell::with('plot','Customer','user')->where('type', 1)->orderBy('id','DESC')->get();
	  
	
	  
	        if ($request->ajax()) {
$plotsell=  plotsell::with('plot','Customer','user')->where('type', 1)->orderBy('id','DESC')->get();
            return Datatables::of($plotsell)
                   ->addIndexColumn()
                    ->addColumn('action', function( plotsell $data){ 
   
                          $button = '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        $button .= '&nbsp;&nbsp;';
                        //$button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    })  
                              


							  ->addColumn('projectname', function (plotsell $plotsell) {
                    return $plotsell->project->name;
                })
				
		
                ->addColumn('id', function (plotsell $plotsell) {
                    return ($plotsell->id);
                }) 



			    ->addColumn('plotname', function (plotsell $plotsell) {
                    return $plotsell->plot->name;
                })
				
				
			    ->addColumn('customer', function (plotsell $plotsell) {
                    return $plotsell->customer->name;
                })				
				
			    ->addColumn('amount', function (plotsell $plotsell) {
                    return convertToBangla($plotsell->amount);
                })					
				
                ->addColumn('discount', function (plotsell $plotsell) {
                    return convertToBangla($plotsell->discount);
                })	
                
                
			    ->addColumn('amountafterdiscount', function (plotsell $plotsell) {
                    return convertToBangla($plotsell->amountafterdiscount);
                })	

			    ->addColumn('paid', function (plotsell $plotsell) {
                    return convertToBangla($plotsell->paid);
                })	





				
									  ->addColumn('entryby', function (plotsell $plotsell) {
                    return $plotsell->user->name;
                })
					

                 ->editColumn('created', function(plotsell $data) {
					
					 return convertToBangla(date('d/m/y h:i A', strtotime($data->created_at) ));
                    
                })
				
             ->editColumn('pdf', function ($plotsell) {
                return '<a   target="_blank"      href="'.route('plotsell.pdf', $plotsell->id).'">Print</a>';
            })
				

					
					
                    ->rawColumns(['action','pdf','created' ])

                    ->make(true);
					
					

        }
      
        return view('plotsell.plot', compact('plotsell'));   

    }



public function dropdownlist()
{
	
$customer= Customer::orderBy('name')->where('softdelete',0)->get();

$project = project::where('softdelete',0)->get();	


$accountant = user::where('role',4)->orderBy('name')->get();	
return response()->json(['customer'=> $customer, 'project'=>$project, 'accountant'=>$accountant   ]);	


}


public function dropdownlist_fetch($id)
{
    
	$plot= plot::where('project_id', $id )->where('status',0)->where('softdelete',0)->orderBy('name')->get();
	
	return response()->json(['plot'=> $plot]);	

}








    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function store(Request $request)
    {
		
		
		
$role = Auth()->user()->role;

if ($role == 5)
{

$user_supervisor_id = 	Auth()->user()->superviser_id;

if ( $user_supervisor_id != $request->supervisor )	
{
	//dd('1');
abort (404);

}	

if ( $request->adjusttype != 3  )
{
	//dd('2');
abort (404);	
	
}

if ( $request->accountant != 99999999999  )
{
	//dd('3');
abort (404);	
	
}	




$project =  project_supervisor::where('superviser_id', $user_supervisor_id  )->where('project_id', $request->project_id )->first();


if ($project == null )
{
	//dd('4');
abort (404);
}	


if ($project != null )
{

if ($project->project_id != $request->project_id)
{
	//dd($project);
abort (404);	
	
}


}


	
}


if ( $request->supervisor == 99999999999  )
{
$request->supervisor = null;	
	
}

if ( $request->accountant == 99999999999  )
{
$request->accountant = null;	
	
}


		
		
		
		
		
		
		
		
		
 	
		
  
	$validated = $request->validate([
	
'project_name','customer','plot_name','accountant','adjusttype','grossamount','discount','receiveableamount','paid',
		
    ]);




    $request->grossamount =  convertToEnglish($request->grossamount);
    $request->discount =  convertToEnglish($request->discount);
    $request->receiveableamount =  convertToEnglish($request->receiveableamount);
    $request->paid =  convertToEnglish($request->paid);








    try{
        DB::beginTransaction();

$due = $request->receiveableamount- $request->paid;

$plotsell = new plotsell();
$plotsell->customer_id = $request->customer;
$plotsell->project_id = $request->project_name;
$plotsell->user_id = Auth()->user()->id;
$plotsell->plot_id = $request->plot_name;
$plotsell->amount = $request->grossamount;
$plotsell->discount = $request->discount;
$plotsell->paid = $request->paid;
$plotsell->due = $due;
$plotsell->due_first = $due;
$plotsell->amountafterdiscount = $request->receiveableamount;
$plotsell->comment = $request->comment;
$plotsell->account_id = $request->accountant;
$plotsell->adjusttype = $request->adjusttype;
$plotsell->created_at = $request->Date_of_Transition;
$plotsell->type = 1;
$plotsell->save();


$project_name = project::findOrFail($request->project_name)->name;
$plot_name = plot::findOrFail($request->plot_name)->name;
$customer = customer::findOrFail($request->customer);

$present_balance = $customer->presentduebalance + $due;

	$cashtransition = new cashtransition();
$cashtransition->balance_of_business_id = Auth()->user()->balance_of_business_id;
$cashtransition->project_id = $request->project_name;
$cashtransition->User_id = Auth()->user()->id;
$cashtransition->plotsell_id = $plotsell->id;
$cashtransition->customer_id = $request->customer;
$cashtransition->amount = $request->paid;
$cashtransition->deposit = $request->paid;	
$cashtransition->type = 1;
$cashtransition->transtype = 17;
$cashtransition->description = "প্লট বিক্রি, প্রজেক্ট :- " .$project_name. "প্লট নং : " .$plot_name. " কাস্টমার : " .$customer->name ;
$cashtransition->created_at = $request->Date_of_Transition;	
$cashtransition->save();



customer::where('id', $request->customer )
       ->update([
           'presentduebalance' => $present_balance
        ]);


if ($due > 0 )
{
plot::where('id', $request->plot_name )
       ->update([
           'status' => 1,
           'customer_id'=>$request->customer,
           
        ]);
}else{
	
plot::where('id', $request->plot_name )
       ->update([
           'status' => 2,
           'customer_id'=>$request->customer,
        ]);	
	
}


DB::commit();
return response()->json([ 'success'=> "Data Added Successfully "]);

	
}
catch (\Exception $e) {
    DB::rollback();
    return response()->json(['success' => 'Data Added failed.']);
   
}
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		DB::transaction(function () use ($id) {
		
		$plotsell = plotsell::findOrFail($id);
		
		
		$customer = customer::findOrFail($plotsell->customer_id);
		
		
		$present_balance = $customer->presentduebalance -   $plotsell->due_first;
		
		
		customer::where('id', $plotsell->customer_id )
       ->update([
           'presentduebalance' => $present_balance
        ]);
		
		$cashtransition = cashtransition::where('plotsell_id', $id )->first();
		
		
		
		plot::where('id', $plotsell->plot_id )
       ->update([
           'status' => 0,
           'customer_id'=>null,
        ]);

		
		$plotsell->delete();
		
		$cashtransition->delete();
		
		});
		
		
		
        
    }
}

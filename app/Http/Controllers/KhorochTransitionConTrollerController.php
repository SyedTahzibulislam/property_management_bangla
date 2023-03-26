<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\khorocer_khad; 
use App\Models\supplier; 
use App\Models\User; 
use App\Models\khoroch_transition;

use App\Models\cashtransition;
use App\Models\project;
use App\Models\project_supervisor;


use App\Models\superviser;



use PDF;
use DateTime;
use DataTables;
use Validator;
use App\Models\balance_of_business; 
use DB;
class KhorochTransitionConTrollerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
     
	   $shopid = Auth()->user()->balance_of_business_id;
	
	  $khoroch_transition=  khoroch_transition::with('khorocer_khad','supplier','User')->where('balance_of_business_id',   $shopid )->orderBy('id','DESC')->get();
	


	

	        if ($request->ajax()) {
					  $khoroch_transition=  khoroch_transition::with('khorocer_khad','supplier','User')->where('balance_of_business_id',   $shopid )->orderBy('id','DESC')->get();
           
            return Datatables::of($khoroch_transition)
                   ->addIndexColumn()
				   

                    ->addColumn('action', function( khoroch_transition $data){ 
   
                     
                          $button = '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-info btn-sm">Edit</button>';
                        return $button;
          
						
						
                        

					   return $button;
                    })


					
                   ->addColumn('khorocer_name', function (khoroch_transition $khoroch_transition) {
                    return $khoroch_transition->khorocer_khad->name;
                })
				  
                      ->addColumn('supplier_name', function (khoroch_transition $khoroch_transition) {
                    return $khoroch_transition->supplier->name;
                })
				  
				  
				  
				  
			                      ->addColumn('project_name', function (khoroch_transition $khoroch_transition) {
                    return $khoroch_transition->project->name;
                })	  
				  
	 		  
				  


							  ->addColumn('adjustby', function (khoroch_transition $khoroch_transition) {
                     if ( $khoroch_transition->adjusttype == 1 )
					 {
						 
					return "Owner's fund";	 
					 }
					 else if ( $khoroch_transition->adjusttype == 2 )
					 {
						return "Accountant's fund";	  
						 
					 }
					 else if ( $khoroch_transition->adjusttype == 3 )
					 {
						return "Project's fund";	   
						 
					 }
					 else if ( $khoroch_transition->adjusttype == null )
					 {
						return "NA";	   
						 
					 }
					 
	 
					 
                })
				
				
				
				
				
				->addColumn('accountant', function (khoroch_transition $khoroch_transition) {
                   
if ($khoroch_transition->account_id)
{
				   return $khoroch_transition->account->name;
}else{
	
	return "NA";
}
                })				
				
				
					->addColumn('superviser', function (khoroch_transition $khoroch_transition) {
                   
if ($khoroch_transition->superviser_id)
{
				   return $khoroch_transition->superviser->name;
}else{
	
	return "NA";
}
                })				
				
				
				
                ->addColumn('amount', function (khoroch_transition $khoroch_transition) {
                  return convertToBangla($khoroch_transition->amount);
              })			  
				  
              ->addColumn('due', function (khoroch_transition $khoroch_transition) {
                return convertToBangla($khoroch_transition->due);
            })


				       ->addColumn('entryby', function (khoroch_transition $khoroch_transition) {
                    return $khoroch_transition->User->name;
                })
				
                 ->editColumn('created_at', function(khoroch_transition $data) {
					
					 return convertToBangla(date('d/m/y', strtotime($data->created_at) ));
                    
                })
				

					
					
                    ->rawColumns(['action'])
                    ->make(true);
        }
		

		return view('khoroch_transition.khoroch_transition', compact('khoroch_transition'));   
	
	}











		    public function dropdown_list()
    {
		

     $project_supervisor = superviser::where('softdelete',0)->orderBy('name')->get();
     $accountant = user::where('role',4)->orderBy('name')->get();




       $khorocer_khad = khorocer_khad::where('softdelete', '!', '1' )->get(); 
	   
 $supplier = supplier::where('softdelete', '!', '1' )->get(); 
	
$project = project::where('softdelete',0)->get();	

            return response()->json(['khorocer_khad' => $khorocer_khad , 'supplier' => $supplier, 'project'=> $project,  'accountant'=> $accountant, 'project_supervisor'=>$project_supervisor                 ]);
	 
 
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
		
         $rules = array(
            'parentid'    =>  'required',
            'supplier'     =>  'required',
              
            'Date_of_Transition'=>  'required',
                'amount' =>  'required',  
            'due' ,  				
			'advance', 
			'project',
			'adjusttype',
			'accountant',
			'supervisor',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

       	
        $request->amount = convertToEnglish($request->amount);
        $request->due = convertToEnglish($request->due);
        $request->advance = convertToEnglish($request->advance);

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

			
   	DB::beginTransaction();    		

$khoroch_transition = new khoroch_transition();

$khoroch_transition->khorocer_khad_id = $request->parentid;
$khoroch_transition->supplier_id = $request->supplier;
$khoroch_transition->unit = 1;
$khoroch_transition->unit_price = $request->amount;
$khoroch_transition->amount = $request->amount;
$khoroch_transition->due = $request->due;
$khoroch_transition->advance = 0;
$khoroch_transition->balance_of_business_id = Auth()->User()->balance_of_business_id;
$khoroch_transition->user_id = Auth()->User()->id;



$khoroch_transition->created_at = $request->Date_of_Transition;
$khoroch_transition->project_id = $request->project;
$khoroch_transition->superviser_id  = $request->supervisor;	
$khoroch_transition->account_id  = $request->accountant;
$khoroch_transition->adjusttype  = $request->adjusttype;

$khoroch_transition->save();

		

		
		$supplier = supplier::findOrFail($request->supplier );
		$present_due = $supplier->due + $request->due;
		$present_advance = $supplier->advance + $request->advance;
   
   
   supplier::where('id', $request->supplier)
  ->update(['due' =>$present_due , 'advance' => $present_advance ]);
   
     	 			     /////////////update balance use  	
  
  
 			 $shopid = Auth()->user()->balance_of_business_id;
  
  $balance =  balance_of_business::findOrFail($shopid);

 
   if ($request->advance == 0)
   {
   $present_balance = $balance->balance - ($request->amount - $request->due) ;
   }
      if ($request->advance > 0)
   {
   $present_balance = $balance->balance - $request->advance  ;
   }
    balance_of_business::where('id',  $shopid) 
  ->update(['balance' =>$present_balance  ]);
   
   
   
   $khorocname = khorocer_khad::findOrFail($request->parentid)->name;
   
   
  	$cashtransition = new  cashtransition();
$cashtransition->balance_of_business_id = Auth()->user()->balance_of_business_id;
$cashtransition->description = " খরচঃ  "  .$khorocname;
$cashtransition->User_id = Auth()->user()->id;
$cashtransition->project_id = $request->project;
$cashtransition->khoroch_transition_id = $khoroch_transition->id;
$cashtransition->amount = $request->amount - $request->due;
$cashtransition->withdrwal = $request->amount - $request->due;	
$cashtransition->type = 2;
$cashtransition->adjusttype = $request->adjusttype;
$cashtransition->account_id = $request->accountant;
$cashtransition->superviser_id  = $request->supervisor;
$cashtransition->created_at = $request->Date_of_Transition;
$cashtransition->transtype = 2;
$cashtransition->created_at = $request->Date_of_Transition;
$cashtransition->save(); 
   
   
   
   
   
   
   
   
   
      DB::commit(); 

   
   
       

        return response()->json(['success' => 'Data Added successfully.']);
    }


 public function selectkhoroch()
 {

$khorocer_khad = khorocer_khad::where('softdelete',0)->orderBy('name')->get();
$project = project::where('softdelete',0)->orderBy('name')->get();


	return view('khoroch_transition.khoroch', compact('khorocer_khad','project' ));    
 }
 
 
 
 





public function fetchkhoroch(Request $request)
{
	
	
	        $validator = Validator::make($request->all(), [
            'startdate' => 'required|date|size:10',
        'enddate' => 'date|size:10',
		'parentid',
	
        ]);
	
		        $start = date("Y-m-d",strtotime($request->input('startdate')));
        $end = date("Y-m-d",strtotime($request->input('enddate')));
		$datethatsentasenddatefromcust =  date("Y-m-d",strtotime($request->input('enddate')));
	
	 $shopid = Auth()->user()->balance_of_business_id;
	 
	 
if (($request->khorocer_khad == 1.1) and ($request->project == 1.1))
		 
		 {


$khoroch = khoroch_transition::with('supplier','User','khorocer_khad','project')->whereBetween('created_at',[$start,$end])->latest()->get();


$expensesname="NA";

		   $pdf = PDF::loadView('khoroch_transition.voucher', compact('khoroch','expensesname','datethatsentasenddatefromcust','start' ),
   [], [
 'mode'                     => '',
	'format'                   => 'A4',
	'default_font_size'        => '8',
	'default_font'             => 'Times-New-Roman',
	'margin_left'              => 7,
	'margin_right'             => 7,
	'margin_top'               => 7,
	'margin_bottom'            => 7,
]
   
   
   );


	 return $pdf->stream('document.pdf');
	



		 }			 
		 
if (($request->khorocer_khad == 1.1) and ($request->project != 1.1))	 
		 {


$khoroch = khoroch_transition::with('supplier','User','khorocer_khad','project')->whereBetween('created_at',[$start,$end])->where('project_id', $request->project )->latest()->get();


$expensesname="NA";

		   $pdf = PDF::loadView('khoroch_transition.voucher', compact('khoroch','expensesname','datethatsentasenddatefromcust','start' ),
   [], [
 'mode'                     => '',
	'format'                   => 'A4',
	'default_font_size'        => '8',
	'default_font'             => 'Times-New-Roman',
	'margin_left'              => 7,
	'margin_right'             => 7,
	'margin_top'               => 7,
	'margin_bottom'            => 7,
]
   
   
   );


	 return $pdf->stream('document.pdf');
	



		 }			 
if (($request->khorocer_khad != 1.1) and ($request->project == 1.1))	 
		 {


$khoroch = khoroch_transition::with('supplier','User','khorocer_khad','project')->whereBetween('created_at',[$start,$end])->where('khorocer_khad_id', $request->khorocer_khad )->latest()->get();


$expensesname="NA";

		   $pdf = PDF::loadView('khoroch_transition.voucher', compact('khoroch','expensesname','datethatsentasenddatefromcust','start' ),
   [], [
 'mode'                     => '',
	'format'                   => 'A4',
	'default_font_size'        => '8',
	'default_font'             => 'Times-New-Roman',
	'margin_left'              => 7,
	'margin_right'             => 7,
	'margin_top'               => 7,
	'margin_bottom'            => 7,
]
   
   
   );


	 return $pdf->stream('document.pdf');
	



		 }					 
if (($request->khorocer_khad != 1.1) and ($request->project != 1.1))	 
		 {


$khoroch = khoroch_transition::with('supplier','User','khorocer_khad','project')->whereBetween('created_at',[$start,$end])->where('khorocer_khad_id', $request->khorocer_khad )->where('project_id', $request->project )->latest()->get();


$expensesname="NA";

		   $pdf = PDF::loadView('khoroch_transition.voucher', compact('khoroch','expensesname','datethatsentasenddatefromcust','start' ),
   [], [
 'mode'                     => '',
	'format'                   => 'A4',
	'default_font_size'        => '8',
	'default_font'             => 'Times-New-Roman',
	'margin_left'              => 7,
	'margin_right'             => 7,
	'margin_top'               => 7,
	'margin_bottom'            => 7,
]
   
   
   );


	 return $pdf->stream('document.pdf');
	



		 }

	
	
	
	
	
}












    /**
     * Display the specified resource.
     *
     * @param  \App\Models\khoroch_transition_conTroller  $khoroch_transition_conTroller
     * @return \Illuminate\Http\Response
     */
    public function show(khoroch_transition_conTroller $khoroch_transition_conTroller)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\khoroch_transition_conTroller  $khoroch_transition_conTroller
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
	   
	   	   $shopid = Auth()->user()->balance_of_business_id;
	
	  $khoroch_transition=  khoroch_transition::where('balance_of_business_id',   $shopid )->where('id', $id )->first();
	



       $khorocer_khad = khorocer_khad::where('softdelete', '!', '1' )->get(); 
	   
 $supplier = supplier::where('balance_of_business_id',  $shopid  )->where('softdelete', '!', '1' )->get(); 
	
$project = project::where('softdelete',0)->get();	

            return response()->json(['khorocer_khad' => $khorocer_khad , 'supplier' => $supplier , 'khoroch_transition' => $khoroch_transition , 'project'=> $project ]);
	 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\khoroch_transition_conTroller  $khoroch_transition_conTroller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
    

       $rules = array(
            'parentid'    =>  'required',
            'supplier'     =>  'required',
              
            'Date_of_Transition'=>  'required',
                'amount' =>  'required',  
            'due' ,  				
			'advance', 
			'project',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

       		
        $request->amount = convertToEnglish($request->amount);
        $request->due = convertToEnglish($request->due);
        $request->advance = convertToEnglish($request->advance);


		$supervisor_id = Auth()->user()->superviser_id;

if ($supervisor_id != 1)		
{

$find_project_for_the_supervisor = project_supervisor::where('project_id', $request->project)->where('superviser_id', $supervisor_id)->get();

if (count($find_project_for_the_supervisor) == 0)
{
	abort(404);
	
}}














        $form_data = array(
            'khorocer_khad_id' =>  $request->parentid,
			'supplier_id' => $request->supplier,
		
			'unit_price' =>  $request->amount,
			'amount' =>  $request->amount,
			'due' =>  $request->due,
			'created_at'  =>  $request->Date_of_Transition,
             'user_id' => Auth()->User()->id, 
			 'balance_of_business_id' => Auth()->user()->balance_of_business_id, 
			 
			 
			 
 	 
        );
		
		
		DB::beginTransaction();
		
	$k= khoroch_transition::findOrFail($request->hidden_id );
	
	
	 	$supplier = supplier::findOrFail($k->supplier_id );
		
	
		$present_due = $supplier->due - $k->due;
		$present_advance = $supplier->advance - $k->advance;
   
   
   supplier::where('id', $k->supplier_id)
  ->update(['due' =>$present_due , 'advance' => $present_advance ]);
   












	 
	

khoroch_transition::where('id', $request->hidden_id )->update($form_data);
	
		$supplier = supplier::findOrFail($request->supplier );
		$present_due = $supplier->due + $request->due;
		$present_advance = $supplier->advance + $request->advance;
   
   
   supplier::where('id', $request->supplier)
  ->update(['due' =>$present_due , 'advance' => $present_advance ]);
   
     	 			     /////////////update balance use  	
  

  
  
 			 $shopid = Auth()->user()->balance_of_business_id;
  
  $balance =  balance_of_business::findOrFail($shopid);


   
   if ($request->advance == 0)
   {
   $present_balance = $balance->balance + ($k->amount - $k->due) - ($request->amount - $request->due) ;
   }
      if ($request->advance > 0)
   {
   $present_balance = $balance->balance - $request->advance  ;
   }
   balance_of_business::where('id',  $shopid) 
  ->update(['balance' =>$present_balance  ]);
   
   
   
   $khorocname = khorocer_khad::findOrFail($request->parentid)->name;
   
    
   
    cashtransition::where('khoroch_transition_id',  $request->hidden_id   ) 
  ->update([
  
  
'description' => "Paying for "  .$khorocname,

'User_id' => Auth()->user()->id,

'amount' => $request->amount - $request->due,
'withdrwal' => $request->amount - $request->due,	
'type' => 2,
'created_at'  =>  $request->Date_of_Transition,
'transtype' => 2,


  ]);  
   
   
   
   
   
   
   
      DB::commit(); 

   
   
       

        return response()->json(['success' => 'Data Added successfully.']);





















    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\khoroch_transition_conTroller  $khoroch_transition_conTroller
     * @return \Illuminate\Http\Response
     */
   public function destroy($id)
    {
		
		
		
		
			$supervisor_id = Auth()->user()->superviser_id;

if ($supervisor_id != 1)		
{

$find_project_for_the_supervisor = project_supervisor::where('project_id', $request->project)->where('superviser_id', $supervisor_id)->get();

if (count($find_project_for_the_supervisor) == 0)
{
	abort(404);
	
}}	
		
		
		
		
		
		
		
		
		
		
        $data = khoroch_transition::findOrFail($id);
		
		
				$supplier = supplier::findOrFail($data->supplier_id );
		$present_due = $supplier->due - $data->due;
		$present_advance = $supplier->advance - $data->advance;
   
   
   supplier::where('id', $data->supplier_id)
  ->update(['due' =>$present_due , 'advance' => $present_advance ]);
   

		/////////////update balance 
  DB::beginTransaction();
  
 			 $shopid = Auth()->user()->balance_of_business_id;
  
  $balance =  balance_of_business::findOrFail($shopid); 
 if ($data->advance == 0)
 {	 
   $present_balance = $balance->balance + ($data->amount - $data->due) ;    
		
 }	
 
  if ($data->advance > 0)
 {	 
   $present_balance = $balance->balance + $data->advance  ;    
		
 }
		
	   balance_of_business::where('id', $shopid)
  ->update(['balance' =>$present_balance  ]);	
		
	

cashtransition::where('khoroch_transition_id', $data->id  )->delete();



	
        $data->delete();
    
	 DB::commit();	
	
	}
}

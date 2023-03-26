<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\supplier; 
use App\Models\user; 
use App\Models\dhar_shod_othoba_advance_er_mal_buje_pawa; 
use DataTables;
use Validator;
use App\Models\balance_of_business;
use DB;
use App\Models\cashtransition;
use App\Models\project;
use App\Models\project_supervisor;
use App\Models\superviser;
 





class supplierduepaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function index(Request $request)
    {
		
		$shopid = Auth()->user()->balance_of_business_id;
		
                  $dhar_shod_othoba_advance_er_mal_buje_pawa =  dhar_shod_othoba_advance_er_mal_buje_pawa::where('balance_of_business_id',   $shopid )
	
			  ->latest()->get();
	  
	
	  
	        if ($request->ajax()) {
				
            $dhar_shod_othoba_advance_er_mal_buje_pawa =  dhar_shod_othoba_advance_er_mal_buje_pawa::where('balance_of_business_id',   $shopid )

->latest()->get();
            
			
			
			
			return Datatables::of($dhar_shod_othoba_advance_er_mal_buje_pawa)
                   ->addIndexColumn()
                    ->addColumn('action', function( dhar_shod_othoba_advance_er_mal_buje_pawa $data){ 
   
                          $button = '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        $button .= '&nbsp;&nbsp;';
                        //$button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    }) 
	
				
	 ->addColumn('supplier', function (dhar_shod_othoba_advance_er_mal_buje_pawa $dhar_shod_othoba_advance_er_mal_buje_pawa) {


$supplier = supplier::findOrFail($dhar_shod_othoba_advance_er_mal_buje_pawa->supplier_id)->name;
return $supplier;

				 
                }) 
				
				
					 ->addColumn('entryby', function (dhar_shod_othoba_advance_er_mal_buje_pawa $dhar_shod_othoba_advance_er_mal_buje_pawa) {


$user = user::findOrFail($dhar_shod_othoba_advance_er_mal_buje_pawa->user_id)->name;
return $user;

				 
                }) 
				




							  ->addColumn('adjustby', function (dhar_shod_othoba_advance_er_mal_buje_pawa $dhar_shod_othoba_advance_er_mal_buje_pawa) {
                     if ( $dhar_shod_othoba_advance_er_mal_buje_pawa->adjusttype == 1 )
					 {
						 
					return "Owner's fund";	 
					 }
					 else if ( $dhar_shod_othoba_advance_er_mal_buje_pawa->adjusttype == 2 )
					 {
						return "Accountant's fund";	  
						 
					 }
					 else if ( $dhar_shod_othoba_advance_er_mal_buje_pawa->adjusttype == 3 )
					 {
						return "Project's fund";	   
						 
					 }
					 else if ( $dhar_shod_othoba_advance_er_mal_buje_pawa->adjusttype == null )
					 {
						return "NA";	   
						 
					 }
					 
	 
					 
                })


				->addColumn('accountant', function (dhar_shod_othoba_advance_er_mal_buje_pawa $dhar_shod_othoba_advance_er_mal_buje_pawa) {
                   
if ($dhar_shod_othoba_advance_er_mal_buje_pawa->account_id)
{
				   return $dhar_shod_othoba_advance_er_mal_buje_pawa->account->name;
}else{
	
	return "NA";
}
                })



					->addColumn('superviser', function (dhar_shod_othoba_advance_er_mal_buje_pawa $dhar_shod_othoba_advance_er_mal_buje_pawa) {
                   
if ($dhar_shod_othoba_advance_er_mal_buje_pawa->superviser_id)
{
				   return $dhar_shod_othoba_advance_er_mal_buje_pawa->superviser->name;
}else{
	
	return "NA";
}
                })	










                 ->editColumn('created', function(dhar_shod_othoba_advance_er_mal_buje_pawa $dhar_shod_othoba_advance_er_mal_buje_pawa) {
					
					 return date('d/m/y h:i A', strtotime($dhar_shod_othoba_advance_er_mal_buje_pawa->created_at) );
                    
                })









					
					
                    ->rawColumns(['action','created'])
                    ->make(true);
					
					

        }
      
        return view('dhar_advance_shod.duepayment', compact('dhar_shod_othoba_advance_er_mal_buje_pawa'));   

    }
	
	
	
	
	
	    public function  dropdownlist()
    {
		
	     $project_supervisor = superviser::where('softdelete',0)->orderBy('name')->get();
     $accountant = user::where('role',4)->orderBy('name')->get();	
	
		$shopid = Auth()->user()->balance_of_business_id;
	
                  $supplier =  supplier::where('balance_of_business_id',   $shopid )->where('softdelete', 0)
	
	
	
	
			  ->latest()->get();
	   
	  
		 $project = project::where('softdelete',0)->orderBy('name')->get();
	
			
            return response()->json(['supplier' => $supplier, 'project'=> $project,'accountant'=> $accountant, 'project_supervisor'=>$project_supervisor ]);

	   
	   
	   
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
   public function store (Request $request)
    {
      
            $rules = array(
               
                'amount'     =>  'required',
				'supplier_id' => 'required',
				'comment',
				'transitiontype' => 'required',
				'Date_of_Transition',
				'project',
							'adjusttype',
			'accountant',
			'supervisor',
            );




            $request->amount = convertToEnglish($request->amount);
            $error = Validator::make($request->all(), $rules);

            if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }
			
			
			
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
	   $supplier=  supplier::findOrFail($request->supplier_id);
	  
//////////////////////// jodi dhar shod hoy 	  
	   If ( $request->transitiontype == 1 )
	   {
	   $amount_of_current_due = $supplier->due - $request->amount ; 
	          $form_data = array(
            
            'due'        =>   $amount_of_current_due,
            
        );
        supplier::whereId($request->supplier_id)->update($form_data);

	  
	 	 			     /////////////update balance 
						 
	 $shopid = Auth()->user()->balance_of_business_id;					 
						 
						 
  
  $balance =  balance_of_business::findOrFail($shopid); 
   $present_balance = $balance->balance - $request->amount ;	    
     balance_of_business::where('id',  $shopid)
  ->update(['balance' =>$present_balance  ]);
		 
	/////////////////////////update complete    

 











	 }
	  //////////////////////// jodi advance shod hoy 
	    If ( $request->transitiontype == 2 ){
		  $amount_of_current_advance = $supplier->advance - $request->amount ;   
	   	          $form_data = array(
            
            'advance'        =>   $amount_of_current_advance,
            
        );
        supplier::whereId($request->hidden_id)->update($form_data);
	   
 
	   }
	   	   If ( $request->transitiontype == 3 )
	   {
		  $amount_of_current_advance = $supplier->advance - $request->amount ;   
	   	          $form_data = array(
            
            'advance'        =>   $amount_of_current_advance,
            
        );
        supplier::whereId($request->supplier_id)->update($form_data);

	  
	 	 			     /////////////update balance 
	 $shopid = Auth()->user()->balance_of_business_id;					 
						 
						 
  
  $balance =  balance_of_business::findOrFail($shopid);   
   $present_balance = $balance->balance + $request->amount ;	    
  balance_of_business::where('id',  $shopid)
  ->update(['balance' =>$present_balance  ]);
		 
	/////////////////////////update complete    

	  }


		
		$dhar_shod_othoba_advance_er_mal_buje_pawa = new dhar_shod_othoba_advance_er_mal_buje_pawa();
		$dhar_shod_othoba_advance_er_mal_buje_pawa->supplier_id	= $request->supplier_id;
		$dhar_shod_othoba_advance_er_mal_buje_pawa->balance_of_business_id	= Auth()->user()->balance_of_business_id;
		$dhar_shod_othoba_advance_er_mal_buje_pawa->project_id	= $request->project;	
		$dhar_shod_othoba_advance_er_mal_buje_pawa->user_id	= Auth()->User()->id;
		$dhar_shod_othoba_advance_er_mal_buje_pawa->amount	= $request->amount;
		$dhar_shod_othoba_advance_er_mal_buje_pawa->transitiontype	= $request->transitiontype;
		$dhar_shod_othoba_advance_er_mal_buje_pawa->comment	= $request->comment;
	    $dhar_shod_othoba_advance_er_mal_buje_pawa->created_at	= $request->Date_of_Transition;		
		
		
		
		$dhar_shod_othoba_advance_er_mal_buje_pawa->superviser_id  = $request->supervisor;	
$dhar_shod_othoba_advance_er_mal_buje_pawa->account_id  = $request->accountant;
$dhar_shod_othoba_advance_er_mal_buje_pawa->adjusttype  = $request->adjusttype;
		
		
		
		
		
		
		$dhar_shod_othoba_advance_er_mal_buje_pawa->save();
		
		
		
		
		  	$cashtransition = new  cashtransition();
$cashtransition->balance_of_business_id = Auth()->user()->balance_of_business_id;
$cashtransition->description = "বাকি পরিষোধ , সাপ্লাইয়ারঃ"  .$supplier->name;
$cashtransition->User_id = Auth()->user()->id;
$cashtransition->project_id = $request->project;
$cashtransition->dhar_shod_othoba_advance_er_mal_buje_pawa_id = $dhar_shod_othoba_advance_er_mal_buje_pawa->id;
$cashtransition->amount = $request->amount;
$cashtransition->withdrwal = $request->amount ;	
$cashtransition->adjusttype = $request->adjusttype;
$cashtransition->account_id = $request->accountant;
$cashtransition->superviser_id  = $request->supervisor;
$cashtransition->type = 2;
$cashtransition->created_at	= $request->Date_of_Transition;		
$cashtransition->transtype = 3;

$cashtransition->save(); 	
		
		
		
		
		
		
		
		
       DB::commit();
        return response()->json(['success' => 'Data is successfully updated']);
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
	
DB::beginTransaction(); 
$data = dhar_shod_othoba_advance_er_mal_buje_pawa::findOrFail($id);

	 $shopid = Auth()->user()->balance_of_business_id;					 
	$supplier = supplier::findOrFail($data->supplier_id);				 
						 
  if ($data->transitiontype ==1 )
  {
  $balance =  balance_of_business::findOrFail($shopid);   
   $present_balance = $balance->balance + $data->amount ;	    
  balance_of_business::where('id',  $shopid)
  ->update(['balance' =>$present_balance  ]);
  
 $presentdue = $supplier->due + $data->amount;


   supplier::where('id',  $data->supplier_id)
  ->update(['due' =>$presentdue  ]);
  
  
  
  
  
  }



cashtransition::where('dhar_shod_othoba_advance_er_mal_buje_pawa_id', $id)->delete();
$data->delete();

 DB::commit();

return response()->json(['success' => 'Data Deleted successfully. ' ]);	

	
	
	
}




}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\externalincomeprovider; 
use App\Models\user; 
use App\Models\duecollectionfromincomeprovider; 
use DataTables;
use Validator;
use App\Models\balance_of_business;
use DB;
use App\Models\cashtransition;
use App\Models\project;
use App\Models\project_supervisor;

use App\Models\superviser;









class duecollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function index(Request $request)
    {
		

		
                  $duecollectionfromincomeprovider =  duecollectionfromincomeprovider::latest()->get();
	  
	
	  
	        if ($request->ajax()) {
				
                  $duecollectionfromincomeprovider =  duecollectionfromincomeprovider::latest()->get();
            
			
			
			
			return Datatables::of($duecollectionfromincomeprovider)
                   ->addIndexColumn()
                    ->addColumn('action', function( duecollectionfromincomeprovider $data){ 
   
                          $button = '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        $button .= '&nbsp;&nbsp;';
                        //$button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    }) 
	
				
	 ->addColumn('income_provider', function (duecollectionfromincomeprovider $duecollectionfromincomeprovider) {


$income_provider = $duecollectionfromincomeprovider->externalincomeprovider->name;



return $income_provider;

				 
                }) 
				
				
	->addColumn('entryby', function (duecollectionfromincomeprovider $duecollectionfromincomeprovider) {



$user = $duecollectionfromincomeprovider->user->name;


return $user;

				 
                }) 
				




							  ->addColumn('adjustby', function (duecollectionfromincomeprovider $duecollectionfromincomeprovider) {
                     if ( $duecollectionfromincomeprovider->adjusttype == 1 )
					 {
						 
					return "Owner's fund";	 
					 }
					 else if ( $duecollectionfromincomeprovider->adjusttype == 2 )
					 {
						return "Accountant's fund";	  
						 
					 }
					 else if ( $duecollectionfromincomeprovider->adjusttype == 3 )
					 {
						return "Project's fund";	   
						 
					 }
					 else if ( $duecollectionfromincomeprovider->adjusttype == null )
					 {
						return "NA";	   
						 
					 }
					 
	 
					 
                })
				
				
			
			
				
				->addColumn('accountant', function (duecollectionfromincomeprovider $duecollectionfromincomeprovider) {
                   
if ($duecollectionfromincomeprovider->account_id)
{
				   return $duecollectionfromincomeprovider->account->name;
}else{
	
	return "NA";
}
                })					
				
				
					->addColumn('superviser', function (duecollectionfromincomeprovider $duecollectionfromincomeprovider) {
                   
if ($duecollectionfromincomeprovider->superviser_id)
{
				   return $duecollectionfromincomeprovider->superviser->name;
}else{
	
	return "NA";
}
                })	





                 ->editColumn('created', function(duecollectionfromincomeprovider $duecollectionfromincomeprovider) {
					
					 return date('d/m/y', strtotime($duecollectionfromincomeprovider->created_at) );
                    
                })









					
					
                    ->rawColumns(['action','created'])
                    ->make(true);
					
					

        }
      
        return view('duecollection.duepayment', compact('duecollectionfromincomeprovider'));   

    }





	    public function  dropdownlist()
    {
		
		
     $project_supervisor = superviser::where('softdelete',0)->orderBy('name')->get();
     $accountant = user::where('role',4)->orderBy('name')->get();
	
                  $income_provider =  externalincomeprovider::where('softdelete', 0)->latest()->get();
	   
	  
		 $project = project::where('softdelete',0)->orderBy('name')->get();
	
			
            return response()->json(['income_provider' => $income_provider, 'project'=> $project,

'accountant'=> $accountant, 'project_supervisor'=>$project_supervisor

			]);

	   
	   
	   
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
               'project',
                'amount'     =>  'required',
				'provider' => 'required',
				'comment',
				'transitiontype' => 'required',
				'Date_of_Transition',
				
			'adjusttype',
			'accountant',
			'supervisor',
				
				
				
				
				
            );  
			

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
			
		$externalincomeprovider = externalincomeprovider::findOrFail($request->provider);

$externalincomeprovider_due = $externalincomeprovider->ownererkachebaki;


$upadated_baki = $externalincomeprovider_due - 	$request->amount;	
			
			
	     externalincomeprovider::where('id',  $request->provider)
  ->update(['ownererkachebaki' =>$upadated_baki  ]);



$duecollectionfromincomeprovider = new duecollectionfromincomeprovider();

$duecollectionfromincomeprovider->externalincomeprovider_id = $request->provider;
$duecollectionfromincomeprovider->project_id = $request->project;
$duecollectionfromincomeprovider->user_id = Auth()->user()->id;
$duecollectionfromincomeprovider->amount = $request->amount;
$duecollectionfromincomeprovider->comment = $request->comment;
$duecollectionfromincomeprovider->transitiontype = 1;



$duecollectionfromincomeprovider->superviser_id  = $request->supervisor;	
$duecollectionfromincomeprovider->account_id  = $request->accountant;
$duecollectionfromincomeprovider->adjusttype  = $request->adjusttype;

$duecollectionfromincomeprovider->created_at = $request->Date_of_Transition;
$duecollectionfromincomeprovider->save();

  


		  	$cashtransition = new  cashtransition();
$cashtransition->balance_of_business_id = Auth()->user()->balance_of_business_id;
$cashtransition->description = "Due collection from the Provider:  "  .$externalincomeprovider->name;
$cashtransition->User_id = Auth()->user()->id;
$cashtransition->project_id = $request->project;
$cashtransition->duecollectionfromincomeprovider_id = $duecollectionfromincomeprovider->id;
$cashtransition->amount = $request->amount;
$cashtransition->deposit = $request->amount ;	
$cashtransition->type = 1;


$cashtransition->adjusttype = $request->adjusttype;
$cashtransition->account_id = $request->accountant;
$cashtransition->superviser_id  = $request->supervisor;
$cashtransition->created_at	= $request->Date_of_Transition;		
$cashtransition->transtype = 15;

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
        $data = duecollectionfromincomeprovider::findOrFail($id);
		
		
		
			$externalincomeprovider = externalincomeprovider::findOrFail($data->externalincomeprovider_id	);

$externalincomeprovider_due = $externalincomeprovider->ownererkachebaki;


$upadated_baki = $externalincomeprovider_due + 	$data->amount;	
			
			
	     externalincomeprovider::where('id',  $data->externalincomeprovider_id)
  ->update(['ownererkachebaki' =>$upadated_baki  ]);	
		
		
	cashtransition::where('duecollectionfromincomeprovider_id', $id)->delete();
$data->delete();	
		
	      DB::commit();	
return response()->json(['success' => 'Data Deleted successfully. ' ]);			
		
		
		
		
		
		
		
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\moneyexchange; 
use DataTables;
use Validator;
use App\Models\project;
use App\Models\project_supervisor;
use App\Models\user;
use App\Models\cashtransition;
use App\Models\moneyexchangeaccount;

use DB;
class moneyexchangeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		
		
		
                  $moneyexchange =  moneyexchange::latest()->get();
	  
	
	  
	        if ($request->ajax()) {
				
           $moneyexchange =  moneyexchange::latest()->get();
            
			
			
			
			return Datatables::of($moneyexchange)
                   ->addIndexColumn()
                    ->addColumn('action', function( moneyexchange $data){ 
   
                          $button = '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        $button .= '&nbsp;&nbsp;';
                        //$button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    }) 
	
				
	 ->addColumn('type', function (moneyexchange $moneyexchange) {


if ($moneyexchange->type == 1)
{
return "Money Given to Project";
}
else{
return "Money return back from Project";	
}
				 
                }) 
				
				
	 ->addColumn('project', function (moneyexchange $moneyexchange) {



return $moneyexchange->project->name;

				 
                })



->addColumn('amount', function (moneyexchange $moneyexchange) {
 return convertToBangla($moneyexchange->amount);                                    
 })

->addColumn('id', function (moneyexchange $moneyexchange) {
 return convertToBangla($moneyexchange->id);                                    
 })



                

	 ->addColumn('supervisor', function (moneyexchange $moneyexchange) {



return $moneyexchange->superviser->name;

				 
                })








                 ->editColumn('created', function(moneyexchange $moneyexchange) {
					
					 return date('d/m/y h:i A', strtotime($moneyexchange->created_at) );
                    
                })









					
					
                    ->rawColumns(['action','created'])
                    ->make(true);
					
					

        }
      
        return view('moneyexchange.moneyexchange', compact('moneyexchange'));   

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



public function dropdownlist()
{
	
$account = user::where('role',4)->orderBy('name')->get();	
$project = project::where('softdelete',0)->orderBy('name')->get();
 return response()->json(['account' => $account,  'project'=> $project ]);

	
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
				'project' => 'required',
				'comment',
				'MOney_given_taken' => 'required',
				'Date_of_Transition'=> 'required',
            );

            $error = Validator::make($request->all(), $rules);

            if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }
			
			
			
			
			$role = Auth()->user()->role;
			

			
			if ($role != 1)
			{
			
			$account_id = Auth()->user()->id;

if ($account_id != $request->account )		
{

abort(404);

}

		
			}		
			
			
				if ($request->account == 999999999999999999999999  )
			{
			$request->account = null;	
				
			}		
			
			
			
	 DB::beginTransaction();		
			
	if ($request->account != null )		
	{		
	$moneyexcahnge = new moneyexchangeaccount();
$moneyexcahnge->accountant_id= $request->account; 

if ($request->MOney_given_taken == 1)
{
$moneyexcahnge->type= 2;
}
else{
	
$moneyexcahnge->type= 1;	
}
$moneyexcahnge->amount= $request->amount;
$moneyexcahnge->user_id = Auth()->user()->id;


$moneyexcahnge->created_at= $request->Date_of_Transition;	
	
$moneyexcahnge->save();			
	}			
			
			
			
			
        



		
$moneyexcahnge = new moneyexchange();
$moneyexcahnge->project_id= $request->project;
$moneyexcahnge->type= $request->MOney_given_taken;
$moneyexcahnge->amount= $request->amount;
$moneyexcahnge->user_id = Auth()->user()->id;

$moneyexcahnge->superviser_id= Auth()->user()->superviser_id;
$moneyexcahnge->created_at= $request->Date_of_Transition;	
	
$moneyexcahnge->save();		
	

if ( $request->MOney_given_taken == 1 )
{
$project_name = project::findOrFail($request->project)->name;	
		
		  	$cashtransition = new  cashtransition();
$cashtransition->balance_of_business_id = Auth()->user()->balance_of_business_id;
$cashtransition->description = "Money is given to the project  "  .$project_name;
$cashtransition->User_id = Auth()->user()->id;

$cashtransition->moneyexchange_id = $moneyexcahnge->id;
$cashtransition->superviser_id = Auth()->user()->superviser_id;
$cashtransition->account_id = $request->account;

$cashtransition->amount = $request->amount;
$cashtransition->withdrwal = $request->amount ;	
$cashtransition->type = 2;
$cashtransition->created_at= $request->Date_of_Transition;
$cashtransition->transtype = 14;

$cashtransition->save(); 	
		
		  	$cashtransition = new  cashtransition();
$cashtransition->balance_of_business_id = Auth()->user()->balance_of_business_id;
$cashtransition->description = "Money is taken by the project  "  .$project_name;
$cashtransition->User_id = Auth()->user()->id;
$cashtransition->project_id = $request->project;
$cashtransition->moneyexchange_id = $moneyexcahnge->id;
$cashtransition->superviser_id = Auth()->user()->superviser_id;
$cashtransition->amount = $request->amount;
$cashtransition->deposit = $request->amount ;	
$cashtransition->type = 1;
$cashtransition->created_at= $request->Date_of_Transition;
$cashtransition->transtype = 14;

$cashtransition->save(); 		
		
}
else{	
		
$project_name = project::findOrFail($request->project)->name;	
		
		  	$cashtransition = new  cashtransition();
$cashtransition->balance_of_business_id = Auth()->user()->balance_of_business_id;
$cashtransition->description = "Money is taken from the project  "  .$project_name;
$cashtransition->User_id = Auth()->user()->id;
$cashtransition->account_id = $request->account;
$cashtransition->moneyexchange_id = $moneyexcahnge->id;
$cashtransition->superviser_id = Auth()->user()->superviser_id;
$cashtransition->amount = $request->amount;
$cashtransition->deposit = $request->amount ;	
$cashtransition->type = 1;
$cashtransition->created_at= $request->Date_of_Transition;
$cashtransition->transtype = 14;

$cashtransition->save(); 	
		
		  	$cashtransition = new  cashtransition();
$cashtransition->balance_of_business_id = Auth()->user()->balance_of_business_id;
$cashtransition->description = "Money is Given by the project  "  .$project_name;
$cashtransition->User_id = Auth()->user()->id;
$cashtransition->project_id = $request->project;
$cashtransition->moneyexchange_id = $moneyexcahnge->id;
$cashtransition->superviser_id = Auth()->user()->superviser_id;
$cashtransition->amount = $request->amount;
$cashtransition->created_at= $request->Date_of_Transition;	
$cashtransition->withdrwal = $request->amount ;	
$cashtransition->type = 2;

$cashtransition->transtype = 14;

$cashtransition->save(); 
}		
		
		
       DB::commit();
        return response()->json(['success' => 'Data is successfully Added']);
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
        $data = moneyexchange::findOrFail($id);
		cashtransition::where('moneyexchange_id', $id)->delete();
		
		
		
		$data->delete();
    }
}

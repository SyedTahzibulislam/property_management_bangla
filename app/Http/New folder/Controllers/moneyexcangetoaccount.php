<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;




use DataTables;
use Validator;
use App\Models\moneyexchangeaccount;
use App\Models\user;

use App\Models\cashtransition;

use DB;









class moneyexcangetoaccount extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		
		
		
                  $moneyexchange =  moneyexchangeaccount::latest()->get();
	  
	
	  
	        if ($request->ajax()) {
				
           $moneyexchange =  moneyexchangeaccount::latest()->get();
            
			
			
			
			return Datatables::of($moneyexchange)
                   ->addIndexColumn()
                    ->addColumn('action', function( moneyexchangeaccount $data){ 
   
                          $button = '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        $button .= '&nbsp;&nbsp;';
                        //$button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    }) 
	
				
	 ->addColumn('type', function (moneyexchangeaccount $moneyexchange) {


if ($moneyexchange->type == 1)
{
return "Money Given to Account";
}
else{
return "Money return back from Account";	
}
				 
                }) 
				
				
	 ->addColumn('account', function (moneyexchangeaccount $moneyexchange) {


if ($moneyexchange->accountant_id)
{
return $moneyexchange->accountant->name;
}
else{
	
return "NA";	
}
				 
                })











                 ->editColumn('created', function(moneyexchangeaccount $moneyexchange) {
					
					 return date('d/m/y h:i A', strtotime($moneyexchange->created_at) );
                    
                })









					
					
                    ->rawColumns(['action','created'])
                    ->make(true);
					
					

        }
      
        return view('moneyexchange.moneyexchangeaccount', compact('moneyexchange'));   

    }



public function dropdownlist()
{
	
$account = user::where('role',4)->orderBy('name')->get();	

 return response()->json(['account' => $account ]);

	
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
				
				'comment',
				'MOney_given_taken' => 'required',
				'Date_of_Transition'=> 'required',
            );

            $error = Validator::make($request->all(), $rules);

            if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }
			
			
			

		
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
         DB::beginTransaction();

	$accountant = user::findOrFail($request->accountant);

$role = Auth()->user()->role;

if ($role != 1)
{
if ($request->MOney_given_taken == 1)
{
$acc = $accountant->id;

}	
else{
	
$x = Auth()->user()->id ;	

if ( $x != $accountant->id)
{
abort(404);	
	
}
	
}}
$moneyexcahnge = new moneyexchangeaccount();
$moneyexcahnge->accountant_id= $accountant->id; 
$moneyexcahnge->type= $request->MOney_given_taken;
$moneyexcahnge->amount= $request->amount;
$moneyexcahnge->user_id = Auth()->user()->id;


$moneyexcahnge->created_at= $request->Date_of_Transition;	
	
$moneyexcahnge->save();		


if ( $request->MOney_given_taken == 1 )
{

		
		
		
		  	$cashtransition = new  cashtransition();
$cashtransition->balance_of_business_id = Auth()->user()->balance_of_business_id;
$cashtransition->description = "Money is given to the Accountant  "  .$accountant->name;
$cashtransition->User_id = Auth()->user()->id;

$cashtransition->moneyexchangeaccount_id = $moneyexcahnge->id;

$cashtransition->amount = $request->amount;
$cashtransition->withdrwal = $request->amount ;	
$cashtransition->type = 2;
$cashtransition->created_at= $request->Date_of_Transition;
$cashtransition->transtype = 16;

$cashtransition->save(); 	
		
		  	$cashtransition = new  cashtransition();
$cashtransition->balance_of_business_id = Auth()->user()->balance_of_business_id;
$cashtransition->description = "Money is taken by the Accountant  "  .$accountant->name;
$cashtransition->User_id = Auth()->user()->id;
$cashtransition->account_id = $accountant->id;
$cashtransition->moneyexchangeaccount_id = $moneyexcahnge->id;

$cashtransition->amount = $request->amount;
$cashtransition->deposit = $request->amount ;	
$cashtransition->type = 1;
$cashtransition->created_at= $request->Date_of_Transition;
$cashtransition->transtype = 16;

$cashtransition->save(); 		
		
}
else{	
		

		
		  	$cashtransition = new  cashtransition();
$cashtransition->balance_of_business_id = Auth()->user()->balance_of_business_id;
$cashtransition->description = "Money is taken from the Accountant  "   .$accountant->name;
$cashtransition->User_id = Auth()->user()->id;

$cashtransition->moneyexchangeaccount_id = $moneyexcahnge->id;

$cashtransition->amount = $request->amount;
$cashtransition->deposit = $request->amount ;	
$cashtransition->type = 1;
$cashtransition->created_at= $request->Date_of_Transition;
$cashtransition->transtype = 16;

$cashtransition->save(); 	
		
		  	$cashtransition = new  cashtransition();
$cashtransition->balance_of_business_id = Auth()->user()->balance_of_business_id;
$cashtransition->description = "Money is Given by the Accountant  "   .$accountant->name;
$cashtransition->User_id = Auth()->user()->id;
$cashtransition->account_id = $accountant->id;
$cashtransition->moneyexchangeaccount_id = $moneyexcahnge->id;

$cashtransition->amount = $request->amount;
$cashtransition->created_at= $request->Date_of_Transition;	
$cashtransition->withdrwal = $request->amount ;	
$cashtransition->type = 2;

$cashtransition->transtype = 16;

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
        $data = moneyexchangeaccount::findOrFail($id);
		cashtransition::where('moneyexchangeaccount_id', $id)->delete();
		
		
		
		$data->delete();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\externalincomesource; 
use App\Models\externalincomeprovider; 
use App\Models\User; 
use App\Models\externalincometransition;
use App\Models\superviser;

use App\Models\project_supervisor;

use App\Models\cashtransition;
use PDF;
use DateTime;
use DataTables;
use Validator;
use App\Models\balance_of_business; 
use DB;
use App\Models\project;














class incometranstaionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
	   $shopid = Auth()->user()->balance_of_business_id; 
	
	  $externalincometransition=  externalincometransition::with('externalincomesource','externalincomeprovider','User')->where('balance_of_business_id',   $shopid )->orderBy('id', 'DESC')->get();
	


	

	        if ($request->ajax()) {
					  $externalincometransition=  externalincometransition::with('externalincomesource','externalincomeprovider','User')->where('balance_of_business_id',   $shopid )->orderBy('id', 'DESC')->get();
	
           
            return Datatables::of($externalincometransition)
                   ->addIndexColumn()
				   

                    ->addColumn('action', function( externalincometransition $data){ 
   
                     
                          $button = '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        $button .= '&nbsp;&nbsp;';
                       // $button .= '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-info btn-sm">Edit</button>';
                        return $button;
          
						
						
                        

					   return $button;
                    })


					
                   ->addColumn('incomer_name', function (externalincometransition $externalincometransition) {
                    return $externalincometransition->externalincomesource->name;
                })
				  
                      ->addColumn('incomer_provider', function (externalincometransition $externalincometransition) {
                    return $externalincometransition->externalincomeprovider->name;
                })
				
				
				  
				       ->addColumn('entryby', function (externalincometransition $externalincometransition) {
                    return $externalincometransition->User->name;
                })
				
				
				
							  ->addColumn('adjustby', function (externalincometransition $externalincometransition) {
                     if ( $externalincometransition->adjusttype == 1 )
					 {
						 
					return "Owner's fund";	 
					 }
					 else if ( $externalincometransition->adjusttype == 2 )
					 {
						return "Accountant's fund";	  
						 
					 }
					 else if ( $externalincometransition->adjusttype == 3 )
					 {
						return "Project's fund";	   
						 
					 }
					 else if ( $externalincometransition->adjusttype == null )
					 {
						return "NA";	   
						 
					 }
					 
	 
					 
                })				
				
				
				
				->addColumn('accountant', function (externalincometransition $externalincometransition) {
                   
if ($externalincometransition->account_id)
{
				   return $externalincometransition->account->name;
}else{
	
	return "NA";
}
                })				
				
				
					->addColumn('superviser', function (externalincometransition $externalincometransition) {
                   
if ($externalincometransition->superviser_id)
{
				   return $externalincometransition->superviser->name;
}else{
	
	return "NA";
}
                })




				->addColumn('project', function (externalincometransition $externalincometransition) {
                   
if ($externalincometransition->project_id)
{
				   return $externalincometransition->project->name;
}else{
	
	return "NA";
}
                })					
				
				
				
				
				
				
				
				
				
				
				
                 ->editColumn('created_at', function(externalincometransition $data) {
					
					 return date('d/m/y', strtotime($data->created_at) );
                    
                })
				

					
					
                    ->rawColumns(['action'])
                    ->make(true);
        }
		

		return view('incometransition.incometransation', compact('externalincometransition'));   
	
	}







		    public function dropdown_list()
    {
		

     $project_supervisor = superviser::where('softdelete',0)->orderBy('name')->get();
     $accountant = user::where('role',4)->orderBy('name')->get();



      
	   
 $income_provider = externalincomeprovider::where('softdelete', '!', '1' )->get(); 
	         
	$incomesource =  externalincomesource::OrderBy('name')->where('softdelete',0 )->get();
	$project = project::where('softdelete',0)->get();
            return response()->json([ 'income_provider' => $income_provider, 'income_source'=> $incomesource, 'project'=>$project, 'accountant'=> $accountant, 'project_supervisor'=>$project_supervisor       ]);
	 
 
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
            'income_source'    =>  'required',
            'income_provider'     =>  'required',
              
            'Date_of_Transition'=>  'required',
                'amount' =>  'required',  
            'due' ,  				
			'advance', 
			'accountant',
'supervisor',
'adjusttype',
			
	
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


















        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

       		

   	DB::beginTransaction();    		

$externalincometransition = new externalincometransition();

$externalincometransition->externalincomesource_id = $request->income_source;
$externalincometransition->externalincomeprovider_id	 = $request->income_provider;
$externalincometransition->project_id	 = $request->project;
$externalincometransition->amount = $request->amount;
$externalincometransition->due = $request->due;

$externalincometransition->balance_of_business_id = Auth()->User()->balance_of_business_id;
$externalincometransition->user_id = Auth()->User()->id;
$externalincometransition->created_at = $request->Date_of_Transition;
$externalincometransition->superviser_id  = $request->supervisor;	
$externalincometransition->account_id  = $request->accountant;
$externalincometransition->adjusttype  = $request->adjusttype;	

$externalincometransition->save();










		

		
		$externalincomeprovider = externalincomeprovider::findOrFail($request->income_provider );
		$present_due = $externalincomeprovider->ownererkachebaki + $request->due;
		
   
   
   externalincomeprovider::where('id', $request->income_provider)
  ->update(['ownererkachebaki' =>$present_due ]);
   
     	 			     /////////////update balance use  	
  
  
 			 $shopid = Auth()->user()->balance_of_business_id;
  
  $balance =  balance_of_business::findOrFail($shopid);

 

   $present_balance = $balance->balance + ($request->amount - $request->due) ;
   

    balance_of_business::where('id',  $shopid) 
  ->update(['balance' =>$present_balance  ]);
   
   
   
   $Income_source_name = externalincomesource::findOrFail($request->income_source)->name;
   
   
  	$cashtransition = new  cashtransition();
$cashtransition->balance_of_business_id = Auth()->user()->balance_of_business_id;
$cashtransition->description = "Earning from  "  .$Income_source_name;
$cashtransition->User_id = Auth()->user()->id;
$cashtransition->externalincometransition_id = $externalincometransition->id;
$cashtransition->amount = $request->amount ;
$cashtransition->deposit = $request->amount ;	
$cashtransition->type = 1;
$cashtransition->created_at = $request->Date_of_Transition;
$cashtransition->transtype = 12;
$cashtransition->adjusttype = $request->adjusttype;
$cashtransition->account_id = $request->accountant;
$cashtransition->superviser_id  = $request->supervisor;	
$cashtransition->project_id	 = $request->project;
$cashtransition->save(); 
   
   
   
   
   
   
   
   
   
      DB::commit(); 

   
   
       

        return response()->json(['success' => 'Data Added successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	 
	  public function selectincome()
 {
	 $firstlevel = externalincomesource::where('parent_id', null )->orderby('name')->get();
	  $secondlevel = externalincomesource::where('secondparent_id', null )->where('parent_id', '!=', null )->orderby('name')->get();
	 	  $thirdlevel = externalincomesource::where('thirdparent_id', null )->where('secondparent_id','!=', null )->where('parent_id', '!=', null )->orderby('name')->get();
		  	  $fourthlevel = externalincomesource::where('thirdparent_id', '!=', null )->where('secondparent_id','!=', null )->where('parent_id', '!=', null )->orderby('name')->get();
	return view('incometransition.income_search', compact('firstlevel','secondlevel','thirdlevel','fourthlevel' ));    
 }
 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 public function secondlevel($id)
 {
	 $secondlevel = externalincomesource::where('parent_id', $id )->orderby('name')->get(); 
	return response()->json(['secondlevel' => $secondlevel  ]); 
	 
 }





 public function thirdlevel($id)
 {
	 $thirdlevel = externalincomesource::where('parent_id', $id )->orderby('name')->get(); 
	return response()->json(['thirdlevel' => $thirdlevel  ]); 
	 
 }




 public function fourthlevel($id)
 {
	 $fourthlevel = externalincomesource::where('parent_id', $id )->orderby('name')->get(); 
	return response()->json(['fourthlevel' => $fourthlevel  ]); 
	 
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
	 
	 
	 if($request->fourthlevel != null )
	 {
		$t= $request->fourthlevel; 
		 
	 }
	 
	 if (($request->thirdlevel != null ) and  ($request->fourthlevel == null ) )
	 {
		$t= $request->thirdlevel;  
			
		 
	 }
	 if (($request->secondlevel != null ) and  ($request->thirdlevel == null ) )
		 
		 {
			$t= $request->secondlevel;   
		 }
 
		 if (($request->firstlevel != null ) and  ($request->secondlevel == null ) )
		 
		 {
			$t= $request->firstlevel;   
		 }	 
		 
		 
		 
		 
	 
	 		 $income =  externalincometransition::with('externalincomeprovider','User','externalincomesource')					 
		  ->orderBy(externalincomesource::select('path')->whereColumn('externalincomesources.id','externalincometransitions.externalincomesource_id' ))
		 	->whereBetween('created_at',[$start,$end])    
			->where('balance_of_business_id',   $shopid )
		->get();
		
		
	
	
	$incomename = externalincomesource::findOrFail($t)->name;
	

		   $pdf = PDF::loadView('incometransition.voucher', compact('income','t','incomename','datethatsentasenddatefromcust','start' ),
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
        $data = externalincometransition::findOrFail($id);
	
		$externalincomeprovider = externalincomeprovider::findOrFail($data->externalincomeprovider_id );
		
				
		$present_due = $externalincomeprovider->ownererkachebaki - $data->due;
		
   
   
   externalincomeprovider::where('id', $data->externalincomeprovider_id)
  ->update(['ownererkachebaki' =>$present_due  ]);
   

		/////////////update balance 
  DB::beginTransaction();
  
 			 $shopid = Auth()->user()->balance_of_business_id;
  
  $balance =  balance_of_business::findOrFail($shopid); 
 
   $present_balance = $balance->balance + ($data->amount - $data->due) ;    
		
 	
 

		
	   balance_of_business::where('id', $shopid)
  ->update(['balance' =>$present_balance  ]);	
		
	

cashtransition::where('externalincometransition_id', $data->id  )->delete();



	
        $data->delete();
    
	 DB::commit();	
	
	}
}

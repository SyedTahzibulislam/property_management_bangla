<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



use App\Models\employeedetails;    
use App\Models\employeesalarytransaction;
use DataTables;
use Validator;
use Carbon\Carbon;
use App\Models\balance_of_business;
use DB;
use App\Models\cashtransition;
use App\Models\project_supervisor;
use App\Models\superviser;
 
 use App\Models\project;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use PDF;



class employeetransactioncontroller extends Controller
{
    /**
     * Display a listing of the employeesalarymonth.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $employeesalarytransaction =  employeesalarytransaction::with('employeedetails')
		->orderBy('id','DESC')->get();
	
	  
	        if ($request->ajax()) {
					  $employeesalarytransaction=  employeesalarytransaction::with('employeedetails')->orderBy('id','DESC')->get();
            //$medicine =  medicine::latest()->get();
            return Datatables::of($employeesalarytransaction)
                   ->addIndexColumn() 
				   

                    ->addColumn('action', function( employeesalarytransaction $data){ 
   
                          $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    })  
    
                      ->addColumn('employee_name', function (employeesalarytransaction $employeesalarytransaction) {
                    return $employeesalarytransaction->employeedetails->name;
                })
				
                      ->addColumn('totalsalary', function (employeesalarytransaction $employeesalarytransaction) {
                    return convertToBangla($employeesalarytransaction->totalsalary);
                })				
				

				->editColumn('created_at', function(employeesalarytransaction $data) {
					
					 return convertToBangla(date('d/m/y H:i A', strtotime($data->created_at)));
                    
                })	
					
                    ->rawColumns(['action'])
                    ->make(true);
        }
		
	return view('employeesalarytransaction.employeesalarytransaction', compact('employeesalarytransaction'));   
   

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
	
	
		    public function dropdown_list()
    {
		     $project_supervisor = superviser::where('softdelete',0)->orderBy('name')->get();
     $accountant = user::where('role',4)->orderBy('name')->get();

       $employeedetails = employeedetails::where('softdelete','0' )->orderBy('name')->get(); 
	   
$project = project::where('softdelete',0)->orderBy('name')->get();
	         

            return response()->json(['employeedetails' => $employeedetails,

'accountant'=> $accountant, 'project_supervisor'=>$project_supervisor, 'project'=> $project

			]);
	 
 
    }



public function employeeshow()
{
	       $employeedetails = employeedetails::where('softdelete','0' )->orderBy('name')->get(); 
	
	return view('employeesalarytransaction.list', compact('employeedetails'));   
   

	
	
}






public function datepick()
{
	       
	
	return view('employeesalarytransaction.datepick');   
   

	
	
}

public function month_year_pick()
{
	       
	
	return view('employeesalarytransaction.month_year_pick');   
   

	
	
}





public function month_year_pick_fetch(Request $request)
{
	       
	
	       $validator = Validator::make($request->all(), [
            'month',
        'year',
        ]); 
   

	$employee_salary = employeesalarytransaction::with('employeedetails')
			    ->where('month',$request->month)
				 ->where('year',$request->year)
                ->orderBy('employeedetails_id')
                ->get();	
	

	
	
	if ($request->month == 1)
{
$month = "JAN";	
	
}
else if ($request->month == 2)
{
$month = "FEB";	
	
}
else if ($request->month == 3)
{
$month = "MARCH";	
	
}
else if ($request->month == 4)
{
$month = "April";	
	
}
else if ($request->month == 5)
{
$month = "MAY";	
	
}
else if ($request->month == 6)
{
$month = "JUNE";	
	
}
else if ($request->month == 7)
{
$month = "JULY";	
	
}
else if ($request->month == 8)
{
$month = "AUG";	
	
}
else if ($request->month == 9)
{
$month = "SEP";	
	
}
else if ($request->month == 10)
{
$month = "OCT";	
	
}
else if ($request->month == 11)
{
$month = "NOV";	
	
}
else if ($request->month == 12)
{
$month = "DEC";	
	
}
	
	
	$year = $request->year;
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
		   $pdf = PDF::loadView('employeesalarytransaction.month_year_pick_fetch',

		compact('employee_salary','month','year',
		
		),
		


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







public function employeesalarymonth(Request $request)

{
	
	

        $validator = Validator::make($request->all(), [
            'startdate' => 'required|date|size:10',
        'enddate' => 'date|size:10',
        ]);
		
		
		
		if ($validator->fails()) {
            return redirect('picktwodate')
                        ->withErrors($validator)
                        ->withInput();
        }
		
		$e= $request->input('enddate');
		
		        $start = date("Y-m-d",strtotime($request->input('startdate')));
        $end = date("Y-m-d",strtotime($request->input('enddate')."+1 day"));
      
	      $end1 = date("Y-m-d",strtotime($request->input('enddate')));









	$employee_salary = employeesalarytransaction::with('employeedetails')
			    ->whereBetween('starting',[$start,$end1])
                ->orderBy('employeedetails_id')
                ->get();	
	

	
	
		   $pdf = PDF::loadView('employeesalarytransaction.monthlywage',

		compact('employee_salary','start','e',
		
		),
		


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








public function employeesalaryfetch(Request $request ) 

{
	
$employeesalarytransaction =  employeesalarytransaction::with('employeedetails')->where('employeedetails_id',$request->employee)->orderBy('starting')->get();	
$employeedetails = employeedetails::findOrFail($request->employee);




	   $pdf = PDF::loadView('employeesalarytransaction.reportbill', compact('employeesalarytransaction','employeedetails' ),
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




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
                $rules = array(
            'employeelist'    =>  'required',
            'salary'     =>  'required',
            'Startdate' =>  'required', 
		              'year' =>  'required',  
          'month' =>  'required', 					  
			
        );



$request->salary =  convertToEnglish($request->salary);

DB::beginTransaction(); 
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


















if ($request->month == 1)
{
$month = "JAN";	
	
}
else if ($request->month == 2)
{
$month = "FEB";	
	
}
else if ($request->month == 3)
{
$month = "MARCH";	
	
}
else if ($request->month == 4)
{
$month = "April";	
	
}
else if ($request->month == 5)
{
$month = "MAY";	
	
}
else if ($request->month == 6)
{
$month = "JUNE";	
	
}
else if ($request->month == 7)
{
$month = "JULY";	
	
}
else if ($request->month == 8)
{
$month = "AUG";	
	
}
else if ($request->month == 9)
{
$month = "SEP";	
	
}
else if ($request->month == 10)
{
$month = "OCT";	
	
}
else if ($request->month == 11)
{
$month = "NOV";	
	
}
else if ($request->month == 12)
{
$month = "DEC";	
	
}
        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

       	 $Month_year = $month. "-" .$request->year;	


		
		
$employeesalarytransaction = new employeesalarytransaction();

$employeesalarytransaction->employeedetails_id = $request->employeelist;
$employeesalarytransaction->balance_of_business_id = 1;


$employeesalarytransaction->starting = $request->Startdate;

$employeesalarytransaction->month_year = $Month_year;
$employeesalarytransaction->month = $request->month;
$employeesalarytransaction->year = $request->year;
$employeesalarytransaction->totalsalary = $request->salary;
$employeesalarytransaction->project_id = $request->project;

$employeesalarytransaction->superviser_id  = $request->supervisor;	
$employeesalarytransaction->account_id  = $request->accountant;
$employeesalarytransaction->adjusttype  = $request->adjusttype;
$employeesalarytransaction->created_at = $request->Startdate;
$employeesalarytransaction->save();

 
   

   
   
 
   	 			     /////////////update balance    	
  
   $balance = balance_of_business::first();  
   $present_balance = $balance->balance - $request->salary ;	    
   balance_of_business::where('id', 1)
  ->update(['balance' =>$present_balance  ]);
	////////////////////////////////////banlce update complete 
 

		
		
		
	$employee = 	employeedetails::findOrFail($request->employeelist)->name;
		
		$user_name = User::findOrFail(auth()->user()->id)->name;

		
		
		
		
			$cashtransition = new cashtransition();
$cashtransition->balance_of_business_id = Auth()->user()->balance_of_business_id;

$cashtransition->User_id = Auth()->user()->id;
$cashtransition->employeesalarytransaction_id = $employeesalarytransaction->id;
$cashtransition->amount = $request->salary;
$cashtransition->withdrwal = $request->salary;	

$cashtransition->description = "Expenditure for salary to the employee:- " .$employee;	
$cashtransition->created_at = $request->Startdate;
$cashtransition->transtype = 4;
$cashtransition->type = 2;
$cashtransition->project_id = $request->project;
$cashtransition->adjusttype = $request->adjusttype;
$cashtransition->account_id = $request->accountant;
$cashtransition->superviser_id  = $request->supervisor;
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
                       if(request()->ajax())
        {
			//$data=  medicine::with('medicine_category')->findOrFail($id);
            $data = employeesalarytransaction::with('employeedetails')->findOrFail($id);
			
			$employeedetails = employeedetails::where('softdelete','0' )->orderBy('name')->get(); 

			
			
			
			 
            return response()->json(['data' => $data , 'employeedetails' => $employeedetails  ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
                      $rules = array(
            'employeelist'    =>  'required',
            'salary'     =>  'required',
            'Startdate' =>  'required',       
	
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

       	$request->salary =  convertToEnglish($request->salary);
	

        $form_data = array(
            'employeedetails_id'        =>  $request->employeelist,
            'totalsalary'         =>  $request->salary,
			
	 'starting' =>$request->Startdate,
		
 	 
        );
		
		

    
	/// update balance 
	DB::beginTransaction();


 	$data = employeesalarytransaction::findOrFail($request->hidden_id);	
		
    $balance = balance_of_business::first();  
   $present_balance = $balance->balance + $data->totalsalary ;
   $present_balance = $present_balance - $request->salary ;
   balance_of_business::where('id', 1)
  ->update(['balance' => $present_balance  ]);
    
	 employeesalarytransaction::whereId($request->hidden_id)->update($form_data);
	 
	 
	 
	 
   balance_of_business::where('id', 1)
  ->update(['balance' => $present_balance  ]);	 
	 
	 
	



	$employee = 	employeedetails::findOrFail($request->employeelist)->name;
		
		$user_name = User::findOrFail(auth()->user()->id)->name;




	
	 
	 

	 
	 
	 
	 
	 
	 
	 
	 
   cashtransition::where('employeesalarytransaction_id', $request->hidden_id )
  ->update(['gorssamount' => $request->salary ,

'amount_after_discount' =>$request->salary,

'withdrwal' =>$request->salary,


'description' => 	"Money Withdrawl for Paying Salary to the Employee: " .$employee. " Employee Salary Transitions ID : " 
.$request->hidden_id.  " Data Entry By: " .$user_name , 



  ]);		 
	 
	 
	 
	 
	 
	DB::commit();
	 
	  return response()->json(['success' => 'Data is successfully updated']);
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
			   $data = employeesalarytransaction::findOrFail($id);
				
				
					 			     /////////////update balance    	
  
   $balance = balance_of_business::first();  
   $present_balance = $balance->balance + $data->totalsalary ;	    
   balance_of_business::where('id', 1)
  ->update(['balance' =>$present_balance  ]);
		/////// upade completee 
	


$cashtransition = cashtransition::where('employeesalarytransaction_id', $id )->delete();
	
		////delete 
        $data->delete();
    
	DB::commit();
    }
}

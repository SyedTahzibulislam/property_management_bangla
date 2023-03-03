<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;  
use App\Models\khorocer_khad; 
use App\Models\supplier; 
use App\Models\User; 
use App\Models\khoroch_transition;  
use App\Models\employeesalarytransaction;
use App\Models\employeedetails;
use App\Models\agentdetail;  
use App\Models\surgerytransaction;
use App\Models\surgerylist; 


use App\Models\doctor; 
use App\Models\order;
use App\Models\medicinetransition; 
use App\Models\agenttransaction;
use App\Models\dhar_shod_othoba_advance_er_mal_buje_pawa;
use App\Models\doctorCommissionTransition; 
use App\Models\reporttransaction;  
 use App\Models\reportorder;   
 use App\Models\duetransition;
 use App\Models\cabinelist;
 use App\Models\cabinetransaction; 
  use App\Models\duecollectionfromincomeprovider; 
use App\Models\externalincometransition;  
 use App\Models\moneyexchange; 
  use App\Models\bankchalan; 
 use App\Models\plotsell;  
  
 use PDF; 
 use App\Models\productcompanyorder; 
 
 

  use App\Models\project;
  use App\Models\taka_uttolon_transition; 
 
 
 use App\Models\doctorappointmenttransaction;
use DataTables;
use App\Models\medicineCompanyTransition;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Validator;
class incomestatemnetController extends Controller
{
    Public function todaystatment()
	{
		//$todays_external_cost = khoroch_transition::whereDate('created_at', Carbon::today())->get();
		 
	
				
				
			    $externalcost = khoroch_transition::with('khorocer_khad')
                ->select( 'khorocer_khad_id', \DB::raw( 'SUM(amount) as total_amount ,   SUM(due) as total_due , SUM(advance) as total_advance , SUM(unit) as total_unit'  ))
			     ->whereDate('created_at', Carbon::today())
                ->groupBy('khorocer_khad_id')
                
                ->get();				
				
				
				
				
			    $employee_salary = employeesalarytransaction::with('employeedetails')
                ->select( 'employeedetails_id', \DB::raw( 'SUM(totalsalary) as total_given_salary_of_a_employee'  ))
			     ->whereDate('created_at', Carbon::today())
                ->groupBy('employeedetails_id')
                
                ->get();
		 
		 
		 

			    $agent_commision = agenttransaction::with('agentdetail')
                ->select( 'agentdetail_id', \DB::raw( 'SUM(paidamount) as total_given_paidamount_of_a_agents'  ))
				->where('paidorunpaid', 1 )
			     ->whereDate('created_at', Carbon::today())
                ->groupBy('agentdetail_id')
                
                ->get();		 
				
				
			    $dharshod = dhar_shod_othoba_advance_er_mal_buje_pawa::with('supplier')
                ->select( 'supplier_id',\DB::raw( 'SUM(amount) as total_baki_shod'  ))
				->where('transitiontype', 1)
				
			     ->whereDate('created_at', Carbon::today())
                ->groupBy('supplier_id')
                
                ->get();	
				
				
			    $doctorcommission = doctorCommissionTransition::with('doctor')
                ->select( 'doctor_id', \DB::raw( 'SUM(amount) as total_deya_commission'  ))

				
				->where(function ($query) {
    $query->where('transitiontype', 1)
        ->orWhere('transitiontype', 3)
		->orWhere('transitiontype', 4)
		->orWhere('transitiontype', 5)
		->orWhere('transitiontype', 6)
		->orWhere('transitiontype', 7);
})

				->where('paidorunpaid', 1 )
			     ->whereDate('created_at', Carbon::today())
                ->groupBy('doctor_id')
                
                ->get();	

                $doctor_er_sharer_taka = doctorCommissionTransition::with('doctor')
                ->select( 'doctor_id', \DB::raw( 'SUM(amount) as deya_share'  ))
				->where('transitiontype', 2)
				->where('paidorunpaid', 1 )
			     ->whereDate('created_at', Carbon::today())
                ->groupBy('doctor_id')
                
                ->get();
				
				
				
				$medicineCompanyTransition = medicineCompanyTransition::with('medicine')
                ->select( 'medicine_id', \DB::raw( 'SUM(pay_in_cash) as pay_in_cash , SUM(Quantity) as Quantity, SUM(amount) as amount, SUM(due) as due'  ))
				->where('transitiontype', 1)
			     ->whereDate('created_at', Carbon::today())
                ->groupBy('medicine_id')
                
                ->get();




				

////////////////////// expenditure

                  $income_from_pathology_test = reporttransaction::with('reportlist')
                ->select( 'reportlist_id', \DB::raw( 'SUM(adjust) as amount , SUM(totalvat) as vat , SUM(totaldiscount) as discount'  ))
			     
				->whereDate('created_at', Carbon::today())
                
				->groupBy('reportlist_id')
                
                ->get();	



                  $medicinetransition = medicinetransition::with('order')
                ->select( 'medicine_id', \DB::raw( 'SUM(adjust) as amount , SUM(totalvat) as vat , SUM(unit) as quantity ,   SUM(totaldiscount) as discount'  ))
			     
				->whereDate('created_at', Carbon::today())
                
				->groupBy('medicine_id')
                
                ->get();
				
				

                  $surgerytransaction = surgerytransaction::with( 'surgerylist')
                ->select( 'surgerylist_id', \DB::raw('count(*) as total') , \DB::raw( 'SUM(total_cost_after_initial_vat_and_discount) as amount ,     SUM(totaldiscount) as discount'  ))
			     
				->whereDate('created_at', Carbon::today())
                
				->groupBy( 'surgerylist_id')
                
                ->get();				
				
                 /* $cabinetransaction = cabinetransaction::with('cabinelist')
                ->select( 'cabinelist_id',  \DB::raw("DATE_FORMAT(ending, '%d-%m-%Y') as day"),      \DB::raw('count(*) as total') , \DB::raw( 'SUM(total_after_adjustment) as amount ,     SUM(discount) as discount'  ))
			     
				->whereDate('ending', Carbon::today())
                
				
                
				->groupBy('ending','cabinelist_id')
				
                ->get();								
*/


                  $income_from_due_payment = duetransition::with('patient')
                ->select( 'patient_id', \DB::raw( 'SUM(amount) as amount_of_due_paid , SUM(discountondue) as duediscount'  ))
			     
				->whereDate('created_at', Carbon::today())
                
				->groupBy('patient_id')
                
                ->get();
				


                  $income_from_doctor =doctorappointmenttransaction::whereDate('created_at', Carbon::today())->sum('nogod');


				
		 		// $total_due_cabine = cabinetransaction::whereDate('ending', Carbon::today())->sum('due');
		 $total_due_patho = reportorder::whereDate('created_at', Carbon::today())->sum('due');
		 $total_due_medicine = order::whereDate('created_at', Carbon::today())->sum('due');
		  $total_due_surgery = surgerytransaction::whereDate('created_at', Carbon::today())->sum('due');
		  $doctorcalldue = doctorappointmenttransaction::whereDate('created_at', Carbon::today())->sum('due');
		 return view ('incomestatement.incomestatementtoday')
		 ->with(compact('externalcost','medicineCompanyTransition','income_from_doctor','doctorcalldue','total_due_surgery','medicinetransition','surgerytransaction','total_due_medicine','income_from_due_payment','total_due_patho','doctorcommission', 'doctor_er_sharer_taka', 'employee_salary','agent_commision', 'dharshod', 'income_from_pathology_test'));
		 
		 
	
	}

//////////////////////////////////////////////////////// yesterday

 	   Public function yesterdaystatment()
	{
		//$todays_external_cost = khoroch_transition::whereDate('created_at', Carbon::today())->get();yesterday()
		 
	
				
				
			    $externalcost = khoroch_transition::with('khorocer_khad')
                ->select( 'khorocer_khad_id', \DB::raw( 'SUM(amount) as total_amount ,   SUM(due) as total_due , SUM(advance) as total_advance , SUM(unit) as total_unit'  ))
			     ->whereDate('created_at', Carbon::yesterday())
                ->groupBy('khorocer_khad_id')
                
                ->get();				
				
				
				
				
			    $employee_salary = employeesalarytransaction::with('employeedetails')
                ->select( 'employeedetails_id', \DB::raw( 'SUM(totalsalary) as total_given_salary_of_a_employee'  ))
			     ->whereDate('created_at', Carbon::yesterday())
                ->groupBy('employeedetails_id')
                
                ->get();
		 
		 
		 

			    $agent_commision = agenttransaction::with('agentdetail')
                ->select( 'agentdetail_id', \DB::raw( 'SUM(paidamount) as total_given_paidamount_of_a_agents'  ))
				->where('paidorunpaid', 1 )
			     ->whereDate('created_at', Carbon::yesterday())
                ->groupBy('agentdetail_id')
                
                ->get();		 
				
				
			    $dharshod = dhar_shod_othoba_advance_er_mal_buje_pawa::with('supplier')
                ->select( 'supplier_id',\DB::raw( 'SUM(amount) as total_baki_shod'  ))
				->where('transitiontype', 1)
				
			     ->whereDate('created_at', Carbon::yesterday())
                ->groupBy('supplier_id')
                
                ->get();	
				
				
			    $doctorcommission = doctorCommissionTransition::with('doctor')
                ->select( 'doctor_id', \DB::raw( 'SUM(amount) as total_deya_commission'  ))

				
				->where(function ($query) {
    $query->where('transitiontype', 1)
        ->orWhere('transitiontype', 3)
		->orWhere('transitiontype', 4)
		->orWhere('transitiontype', 5)
		->orWhere('transitiontype', 6)
		->orWhere('transitiontype', 7);
})

				->where('paidorunpaid', 1 )
			     ->whereDate('created_at', Carbon::yesterday())
                ->groupBy('doctor_id')
                
                ->get();	

                $doctor_er_sharer_taka = doctorCommissionTransition::with('doctor')
                ->select( 'doctor_id', \DB::raw( 'SUM(amount) as deya_share'  ))
				->where('transitiontype', 2)
				->where('paidorunpaid', 1 )
			     ->whereDate('created_at', Carbon::yesterday())
                ->groupBy('doctor_id')
                
                ->get();
				
				
				
				$medicineCompanyTransition = medicineCompanyTransition::with('medicine')
                ->select( 'medicine_id', \DB::raw( 'SUM(pay_in_cash) as pay_in_cash , SUM(Quantity) as Quantity, SUM(amount) as amount, SUM(due) as due'  ))
				->where('transitiontype', 1)
			     ->whereDate('created_at', Carbon::yesterday())
                ->groupBy('medicine_id')
                
                ->get();




				

////////////////////// expenditure

                  $income_from_pathology_test = reporttransaction::with('reportlist')
                ->select( 'reportlist_id', \DB::raw( 'SUM(adjust) as amount , SUM(totalvat) as vat , SUM(totaldiscount) as discount'  ))
			     
				->whereDate('created_at', Carbon::yesterday())
                
				->groupBy('reportlist_id')
                
                ->get();	



                  $medicinetransition = medicinetransition::with('order')
                ->select( 'medicine_id', \DB::raw( 'SUM(adjust) as amount , SUM(totalvat) as vat , SUM(unit) as quantity ,   SUM(totaldiscount) as discount'  ))
			     
				->whereDate('created_at', Carbon::yesterday())
                
				->groupBy('medicine_id')
                
                ->get();
				
				

                  $surgerytransaction = surgerytransaction::with( 'surgerylist')
                ->select( 'surgerylist_id', \DB::raw('count(*) as total') , \DB::raw( 'SUM(total_cost_after_initial_vat_and_discount) as amount ,     SUM(totaldiscount) as discount'  ))
			     
				->whereDate('created_at', Carbon::yesterday())
                
				->groupBy( 'surgerylist_id')
                
                ->get();				
				
                 /* $cabinetransaction = cabinetransaction::with('cabinelist')
                ->select( 'cabinelist_id',  \DB::raw("DATE_FORMAT(ending, '%d-%m-%Y') as day"),      \DB::raw('count(*) as total') , \DB::raw( 'SUM(total_after_adjustment) as amount ,     SUM(discount) as discount'  ))
			     
				->whereDate('ending', Carbon::today())
                
				
                
				->groupBy('ending','cabinelist_id')
				
                ->get();								
*/


                  $income_from_due_payment = duetransition::with('patient')
                ->select( 'patient_id', \DB::raw( 'SUM(amount) as amount_of_due_paid , SUM(discountondue) as duediscount'  ))
			     
				->whereDate('created_at', Carbon::yesterday())
                
				->groupBy('patient_id')
                
                ->get();
				


                  $income_from_doctor =doctorappointmenttransaction::whereDate('created_at', Carbon::yesterday())->sum('nogod');


				
		 		// $total_due_cabine = cabinetransaction::whereDate('ending', Carbon::today())->sum('due');
		 $total_due_patho = reportorder::whereDate('created_at', Carbon::yesterday())->sum('due');
		 $total_due_medicine = order::whereDate('created_at', Carbon::yesterday())->sum('due');
		  $total_due_surgery = surgerytransaction::whereDate('created_at', Carbon::yesterday())->sum('due');
		  $doctorcalldue = doctorappointmenttransaction::whereDate('created_at', Carbon::yesterday())->sum('due');
		 return view ('incomestatement.yesterday')
		 ->with(compact('externalcost','medicineCompanyTransition','income_from_doctor','doctorcalldue','total_due_surgery','medicinetransition','surgerytransaction','total_due_medicine','income_from_due_payment','total_due_patho','doctorcommission', 'doctor_er_sharer_taka', 'employee_salary','agent_commision', 'dharshod', 'income_from_pathology_test'));
		 
		 
	
	}
	


/////////////////////////////////////////////////////////////// month 
    Public function thismonthstatment()
	{
		//$todays_external_cost = khoroch_transition::whereDate('created_at', Carbon::today())->get();
		 
	
				
				
			    $externalcost = khoroch_transition::with('khorocer_khad')
                ->select( 'khorocer_khad_id', DB::raw( 'SUM(amount) as total_amount ,   SUM(due) as total_due , SUM(advance) as total_advance , SUM(unit) as total_unit'  ))
			    ->whereMonth('created_at', Carbon::now()->month)
                ->groupBy('khorocer_khad_id')
                
                ->get();				
				
				
				
				
			    $employee_salary = employeesalarytransaction::with('employeedetails')
                ->select( 'employeedetails_id', DB::raw( 'SUM(totalsalary) as total_given_salary_of_a_employee'  ))
			     ->whereMonth('created_at', Carbon::now()->month)
                ->groupBy('employeedetails_id')
                
                ->get();
		 
		 
		 

			    $agent_commision = agenttransaction::with('agentdetail')
                ->select( 'agentdetail_id', DB::raw( 'SUM(paidamount) as total_given_paidamount_of_a_agents'  ))
			     ->whereMonth('created_at', Carbon::now()->month)
                ->groupBy('agentdetail_id')
                
                ->get();		 
				
				
			    $dharshod = dhar_shod_othoba_advance_er_mal_buje_pawa::with('supplier')
                ->select( 'supplier_id', DB::raw( 'SUM(amount) as total_baki_shod'  ))
				->where('transitiontype', 1)
			    ->whereMonth('created_at', Carbon::now()->month)
                ->groupBy('supplier_id')
                
                ->get();	
				
				
			    $doctorcommission = doctorCommissionTransition::with('doctor')
                ->select( 'doctor_id', DB::raw( 'SUM(amount) as total_deya_commission'  ))
				->where('transitiontype', 1)
			    ->whereMonth('created_at', Carbon::now()->month)
                ->groupBy('doctor_id')
                
                ->get();	

                $doctor_er_sharer_taka = doctorCommissionTransition::with('doctor')
                ->select( 'doctor_id', DB::raw( 'SUM(amount) as deya_share'  ))
				->where('transitiontype', 2)
			     ->whereMonth('created_at', Carbon::now()->month)
                ->groupBy('doctor_id')
                
                ->get();	

////////////////////// expenditure

                  $income_from_pathology_test = reporttransaction::with('reportlist')
                ->select( 'reportlist_id', DB::raw( 'SUM(adjust) as amount , SUM(totalvat) as vat , SUM(totaldiscount) as discount'  ))
			     
				 ->whereMonth('created_at', Carbon::now()->month)
                
				->groupBy('reportlist_id')
                
                ->get();	





                  $income_from_due_payment = duetransition::with('patient')
                ->select( 'patient_id', DB::raw( 'SUM(amount) as amount_of_due_paid '  ))
			     
				 ->whereMonth('created_at', Carbon::now()->month)
                
				->groupBy('patient_id')
                
                ->get();	

				
		 
		 $total_due_patho = reportorder::whereMonth('created_at', Carbon::now()->month)->sum('due');
		
		 
		 return view ('incomestatement.month')
		 ->with(compact('externalcost','income_from_due_payment','total_due_patho','doctorcommission', 'doctor_er_sharer_taka', 'employee_salary','agent_commision', 'dharshod', 'income_from_pathology_test'));
		 
		 
	
	}
	
	
	
	




/////////////////////////////////////////////// year 	
	
	
	
	
	    Public function thisyearstatment()
	{
		//$todays_external_cost = khoroch_transition::whereDate('created_at', Carbon::today())->get();
		 
	
				
				
			    $externalcost = khoroch_transition::with('khorocer_khad')
                ->select( 'khorocer_khad_id', DB::raw( 'SUM(amount) as total_amount ,   SUM(due) as total_due , SUM(advance) as total_advance , SUM(unit) as total_unit'  ))
			     ->whereYear('created_at', Carbon::now()->year)
                ->groupBy('khorocer_khad_id')
                
                ->get();				
				
				
				
				
			    $employee_salary = employeesalarytransaction::with('employeedetails')
                ->select( 'employeedetails_id', DB::raw( 'SUM(totalsalary) as total_given_salary_of_a_employee'  ))
			    ->whereYear('created_at', Carbon::now()->year)
                ->groupBy('employeedetails_id')
                
                ->get();
		 
		 
		 

			    $agent_commision = agenttransaction::with('agentdetail')
                ->select( 'agentdetail_id', DB::raw( 'SUM(paidamount) as total_given_paidamount_of_a_agents'  ))
			      ->whereYear('created_at', Carbon::now()->year)
                ->groupBy('agentdetail_id')
                
                ->get();		 
				
				
			    $dharshod = dhar_shod_othoba_advance_er_mal_buje_pawa::with('supplier')
                ->select( 'supplier_id', DB::raw( 'SUM(amount) as total_baki_shod'  ))
				->where('transitiontype', 1)
			    ->whereYear('created_at', Carbon::now()->year)
                ->groupBy('supplier_id')
                
                ->get();	
				
				
			    $doctorcommission = doctorCommissionTransition::with('doctor')
                ->select( 'doctor_id', DB::raw( 'SUM(amount) as total_deya_commission'  ))
				->where('transitiontype', 1)
			    ->whereYear('created_at', Carbon::now()->year)
                ->groupBy('doctor_id')
                
                ->get();	

                $doctor_er_sharer_taka = doctorCommissionTransition::with('doctor')
                ->select( 'doctor_id', DB::raw( 'SUM(amount) as deya_share'  ))
				->where('transitiontype', 2)
			     ->whereYear('created_at', Carbon::now()->year)
                ->groupBy('doctor_id')
                
                ->get();	

////////////////////// expenditure

                  $income_from_pathology_test = reporttransaction::with('reportlist')
                ->select( 'reportlist_id', DB::raw( 'SUM(adjust) as amount , SUM(totalvat) as vat , SUM(totaldiscount) as discount'  ))
			     
				  ->whereYear('created_at', Carbon::now()->year)
                
				->groupBy('reportlist_id')
                
                ->get();	





                  $income_from_due_payment = duetransition::with('patient')
                ->select( 'patient_id', DB::raw( 'SUM(amount) as amount_of_due_paid '  ))
			     
               ->whereYear('created_at', Carbon::now()->year)
                
				->groupBy('patient_id')
                
                ->get();	

				
		 
		 $total_due_patho = reportorder::whereYear('created_at', Carbon::now()->year)->sum('due');
		
		 
		 return view ('incomestatement.year')
		 ->with(compact('externalcost','income_from_due_payment','total_due_patho','doctorcommission', 'doctor_er_sharer_taka', 'employee_salary','agent_commision', 'dharshod', 'income_from_pathology_test'));
		 
		 
	
	}
	
	
	
	
	
	
	
	
	
	/////////////////////////////////////////////// Lastmonth 	
	
	   Public function lastmonthstatment()
	{
		//$todays_external_cost = khoroch_transition::whereDate('created_at', Carbon::today())->get();
		 
	
				
				
			    $externalcost = khoroch_transition::with('khorocer_khad')
                ->select( 'khorocer_khad_id', DB::raw( 'SUM(amount) as total_amount ,   SUM(due) as total_due , SUM(advance) as total_advance , SUM(unit) as total_unit'  ))
			    ->whereMonth('created_at', Carbon::now()->subMonth()->month)
                ->groupBy('khorocer_khad_id')
                
                ->get();				
				
				
				
				
			    $employee_salary = employeesalarytransaction::with('employeedetails')
                ->select( 'employeedetails_id', DB::raw( 'SUM(totalsalary) as total_given_salary_of_a_employee'  ))
			     ->whereMonth('created_at', Carbon::now()->subMonth()->month)
                ->groupBy('employeedetails_id')
                
                ->get();
		 
		 
		 

			    $agent_commision = agenttransaction::with('agentdetail')
                ->select( 'agentdetail_id', DB::raw( 'SUM(paidamount) as total_given_paidamount_of_a_agents'  ))
			     ->whereMonth('created_at', Carbon::now()->subMonth()->month)
                ->groupBy('agentdetail_id')
                
                ->get();		 
				
				
			    $dharshod = dhar_shod_othoba_advance_er_mal_buje_pawa::with('supplier')
                ->select( 'supplier_id', DB::raw( 'SUM(amount) as total_baki_shod'  ))
				->where('transitiontype', 1)
			    ->whereMonth('created_at', Carbon::now()->subMonth()->month)
                ->groupBy('supplier_id')
                
                ->get();	
				
				
			    $doctorcommission = doctorCommissionTransition::with('doctor')
                ->select( 'doctor_id', DB::raw( 'SUM(amount) as total_deya_commission'  ))
				->where('transitiontype', 1)
			    ->whereMonth('created_at', Carbon::now()->subMonth()->month)
                ->groupBy('doctor_id')
                
                ->get();	

                $doctor_er_sharer_taka = doctorCommissionTransition::with('doctor')
                ->select( 'doctor_id', DB::raw( 'SUM(amount) as deya_share'  ))
				->where('transitiontype', 2)
			     ->whereMonth('created_at', Carbon::now()->subMonth()->month)
                ->groupBy('doctor_id')
                
                ->get();	

////////////////////// expenditure

                  $income_from_pathology_test = reporttransaction::with('reportlist')
                ->select( 'reportlist_id', DB::raw( 'SUM(adjust) as amount , SUM(totalvat) as vat , SUM(totaldiscount) as discount'  ))
			     
				 ->whereMonth('created_at', Carbon::now()->subMonth()->month)
                
				->groupBy('reportlist_id')
                
                ->get();	





                  $income_from_due_payment = duetransition::with('patient')
                ->select( 'patient_id', DB::raw( 'SUM(amount) as amount_of_due_paid '  ))
			     
				 ->whereMonth('created_at', Carbon::now()->subMonth()->month)
                
				->groupBy('patient_id')
                
                ->get();	

				
		 
		 $total_due_patho = reportorder::whereMonth('created_at', Carbon::now()->subMonth()->month)->sum('due');
		
		 
		 return view ('incomestatement.lastmonth')
		 ->with(compact('externalcost','income_from_due_payment','total_due_patho','doctorcommission', 'doctor_er_sharer_taka', 'employee_salary','agent_commision', 'dharshod', 'income_from_pathology_test'));
		 
		 
	
	}
	
	
	
	public function picktwodate()
	{
		
		$project = project::orderBy('name')->get();
		 return view('incomestatement.picktwodate',compact('project'));
		
	}
	
	
	public function picktwodatedetails()
	{
		
		$project = project::orderBy('name')->get();
		 return view('incomestatement.picktwodatedetails',compact('project'));
		
	}	
	
	
	////////////////////////////////// fetch data  between two dates 
	
	
	
	public function recordbetweentwodate(Request $request){
		

		// money_deposit
		

        $validator = Validator::make($request->all(), [
            'startdate' => 'required|date|size:10',
        'enddate' => 'date|size:10',
		'project',
        ]);
		
		
		
		if ($validator->fails()) {
            return redirect('picktwodate')
                        ->withErrors($validator)
                        ->withInput();
        }
		
		
		        $start = date("Y-m-d",strtotime($request->input('startdate')));
        $end = date("Y-m-d",strtotime($request->input('enddate')));
      
		$datethatsentasenddatefromcust =  date("Y-m-d",strtotime($request->input('enddate')));
		
			
		
		
		if ($request->project== 9999999999999999 )
		{
		
		// expenses
			
			    $externalcost = khoroch_transition::with('khorocer_khad')
                ->select( 'khorocer_khad_id', DB::raw( 'SUM(amount) as total_amount ,   SUM(due) as total_due , SUM(advance) as total_advance , SUM(unit) as total_unit'  ))
			    ->whereBetween('created_at',[$start,$end])
                ->groupBy('khorocer_khad_id')
                
                ->get();				
				
				
			    $company_cost = productcompanyorder::with('productcompanytransition')
                ->select( 'productcompany_id','project_id', DB::raw( 'SUM(amountafterdiscount) as total_amount,   SUM(debit) as total_due , SUM(credit) as paid'   ))
			    ->whereBetween('created_at',[$start,$end])
				->where('type',1)
                ->groupBy('productcompany_id','project_id')
                
                ->get();				
		

			    $company_due_payment = productcompanyorder::with('productcompanytransition')
                ->select( 'productcompany_id','project_id', DB::raw( 'SUM(amountafterdiscount) as total_amount,   SUM(debit) as total_due , SUM(credit) as paid'   ))
			    ->whereBetween('created_at',[$start,$end])
				->where('type',2)
                ->groupBy('productcompany_id','project_id')
                
                ->get();






		
			    $employee_salary = employeesalarytransaction::with('employeedetails')
                ->select( 'employeedetails_id', DB::raw( 'SUM(totalsalary) as total_salary'  ))
			     ->whereBetween('created_at',[$start,$end])
                ->groupBy('employeedetails_id')
                
                ->get();
		 
		 
		 

			    $agent_commision = agenttransaction::with('agentdetail')
                ->select( 'agentdetail_id', DB::raw( 'SUM(paidamount) as paidamount'  ))
			     ->whereBetween('created_at',[$start,$end])
				 ->where('paidorunpaid',1)
                ->groupBy('agentdetail_id')
                
                ->get();
				
				






		 
				
				
			    $dharshod = dhar_shod_othoba_advance_er_mal_buje_pawa::with('supplier')
                ->select( 'supplier_id', DB::raw( 'SUM(amount) as total_baki_shod'  ))
				->where('transitiontype', 1)
			    ->whereBetween('created_at',[$start,$end])
                ->groupBy('supplier_id')
                
                ->get();	
				
				
		




			    $money_withdrawl = taka_uttolon_transition::with('sharepartner')
                ->select( 'sharepartner_id', DB::raw( 'SUM(amount) as total'  ))
				->where('transitiontype', 1)
			    ->whereBetween('created_at',[$start,$end])
                ->groupBy('sharepartner_id')
                
                ->get();

$money_given_to_project = moneyexchange::with('project')
                ->select( 'project_id', DB::raw( 'SUM(amount) as total'  ))
				->where('type', 1)
			    ->whereBetween('created_at',[$start,$end])
                ->groupBy('project_id')
                
                ->get();

	
$money_given_to_bank = bankchalan::with('Bankname')
                ->select( 'Bankname_id', DB::raw( 'SUM(amount) as total'  ))
				->where('type', 0)
				->where('whom', 0)
			    ->whereBetween('transdate',[$start,$end])
                ->groupBy('Bankname_id')
                
                ->get();












// income 



$plotsell = plotsell::with('project','customer','plot')
->select( 'project_id','customer_id','plot_id', DB::raw( 'SUM(paid) as paid' ))
			    ->whereBetween('created_at',[$start,$end])
				->where('type',1)
                ->groupBy('customer_id','project_id','plot_id')
                
                ->get();
				
				
				
				
$customer_due_payment = plotsell::with('project','customer','plot')
->select( 'project_id','customer_id','plot_id', DB::raw( 'SUM(paid) as paid' ))
			    ->whereBetween('created_at',[$start,$end])
				->where('type',2)
                ->groupBy('customer_id','project_id','plot_id')
                
                ->get();				
				
				
				
$customer_refund = plotsell::with('project','customer','plot')
->select( 'project_id','customer_id','plot_id', DB::raw( 'SUM(paid) as paid' ))
			    ->whereBetween('created_at',[$start,$end])
				->where('type',3)
                ->groupBy('customer_id','project_id','plot_id')
                
                ->get();				
				
			
				
				
				
				
				


			    $money_back_from_company = productcompanyorder::with('productcompanytransition')
                ->select( 'productcompany_id','project_id', DB::raw( 'SUM(debit) as total_amount' ))
			    ->whereBetween('created_at',[$start,$end])
				->where('type',4)
                ->groupBy('productcompany_id','project_id')
                
                ->get();











			    $income = externalincometransition::with('externalincomesource','project')
                ->select( 'externalincomeprovider_id','project_id', DB::raw( 'SUM(amount) as income_in_cash ,   SUM(due) as total_due'  ))
			    ->whereBetween('created_at',[$start,$end])
                ->groupBy('externalincomeprovider_id','project_id')
                
                ->get();

			    $money_deposit = taka_uttolon_transition::with('sharepartner')
                ->select( 'sharepartner_id', DB::raw( 'SUM(amount) as total'  ))
				->where('transitiontype', 2)
			    ->whereBetween('created_at',[$start,$end])
                ->groupBy('sharepartner_id')
                
                ->get();
$money_taken_from_project = moneyexchange::with('project')
                ->select( 'project_id', DB::raw( 'SUM(amount) as total'  ))
				->where('type', 2)
			    ->whereBetween('created_at',[$start,$end])
                ->groupBy('project_id')
                
                ->get();

$money_come_from_bank = bankchalan::with('Bankname')
                ->select( 'Bankname_id', DB::raw( 'SUM(amount) as total'  ))
				->where('type', 1)
				->where('whom', 0)
			    ->whereBetween('transdate',[$start,$end])
                ->groupBy('Bankname_id')
                
                ->get();



$due_collection = 
duecollectionfromincomeprovider::with('externalincomeprovider','project')
                ->select( 'externalincomeprovider_id', DB::raw( 'SUM(amount) as total_due_collection'  ))
				->where('transitiontype', 1)
			    ->whereBetween('created_at',[$start,$end])
                ->groupBy('externalincomeprovider_id','project_id')
                
                ->get();	


	
		   $pdf = PDF::loadView('incomestatement.databetweentwodata',

		compact('externalcost','start','dharshod','money_withdrawl','money_given_to_project','money_given_to_bank', 'income', 'employee_salary','money_deposit', 'money_taken_from_project', 'money_come_from_bank','due_collection','end','company_cost','company_due_payment','money_back_from_company','plotsell','customer_due_payment','customer_refund','agent_commision',
		
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
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		}else{
				    $company_cost = productcompanyorder::with('productcompanytransition')
                ->select( 'productcompany_id','project_id', DB::raw( 'SUM(amountafterdiscount) as total_amount,   SUM(debit) as total_due , SUM(credit) as paid'   ))
			    ->whereBetween('created_at',[$start,$end])
				->where('type',1)
				->where('project_id', $request->project )
                ->groupBy('productcompany_id','project_id')
                
                ->get();				
		

			    $company_due_payment = productcompanyorder::with('productcompanytransition')
                ->select( 'productcompany_id','project_id', DB::raw( 'SUM(amountafterdiscount) as total_amount,   SUM(debit) as total_due , SUM(credit) as paid'   ))
			    ->whereBetween('created_at',[$start,$end])
				->where('type',2)
				->where('project_id', $request->project )
                ->groupBy('productcompany_id','project_id')
                
                ->get();
			
			
			
						    $agent_commision = agenttransaction::with('agentdetail')
                ->select( 'agentdetail_id', DB::raw( 'SUM(paidamount) as paidamount'  ))
			     ->whereBetween('created_at',[$start,$end])
				 ->where('paidorunpaid',1)
				->where('project_id', $request->project )				 
                ->groupBy('agentdetail_id')
                
                ->get();
			
			
			
			
			
			
		
				    $externalcost = khoroch_transition::with('khorocer_khad')
                ->select( 'khorocer_khad_id', DB::raw( 'SUM(amount) as total_amount ,   SUM(due) as total_due , SUM(advance) as total_advance , SUM(unit) as total_unit'  ))
			    ->whereBetween('created_at',[$start,$end])
				->where('project_id', $request->project )
                ->groupBy('khorocer_khad_id')
                
                ->get();				
				
				
				
				
			    $employee_salary = employeesalarytransaction::with('employeedetails')
                ->select( 'employeedetails_id', DB::raw( 'SUM(totalsalary) as total_salary'  ))
			     ->whereBetween('created_at',[$start,$end])
				 ->where('project_id', $request->project )
                ->groupBy('employeedetails_id')
                
                ->get();
		 
		 
		 

		 
				
				
			    $dharshod = dhar_shod_othoba_advance_er_mal_buje_pawa::with('supplier')
                ->select( 'supplier_id', DB::raw( 'SUM(amount) as total_baki_shod'  ))
				->where('transitiontype', 1)
			    ->whereBetween('created_at',[$start,$end])
				->where('project_id', $request->project )
                ->groupBy('supplier_id')
                
                ->get();	
				
				
		




			

$money_return_back_to_owner = moneyexchange::with('project')
                ->select( 'project_id', DB::raw( 'SUM(amount) as total'  ))
				->where('type', 2)
			    ->whereBetween('created_at',[$start,$end])
				->where('project_id', $request->project )
                ->groupBy('project_id')
                
                ->get();

	



// income dd

			    $money_back_from_company = productcompanyorder::with('productcompanytransition')
                ->select( 'productcompany_id','project_id', DB::raw( 'SUM(debit) as total_amount' ))
			    ->whereBetween('created_at',[$start,$end])
				->where('type',4)
				->where('project_id', $request->project )
                ->groupBy('productcompany_id','project_id')
                
                ->get();






			    $money_deposit = taka_uttolon_transition::with('sharepartner')
                ->select( 'sharepartner_id', DB::raw( 'SUM(amount) as total'  ))
				->where('transitiontype', 2)
				->where('project_id', $request->project )
			    ->whereBetween('created_at',[$start,$end])
                ->groupBy('sharepartner_id')
                ->get();



			    $money_withdrawl = taka_uttolon_transition::with('sharepartner')
                ->select( 'sharepartner_id', DB::raw( 'SUM(amount) as total'  ))
				->where('transitiontype', 1)
				->where('project_id', $request->project )
			    ->whereBetween('created_at',[$start,$end])
                ->groupBy('sharepartner_id')
                
                ->get();






$plotsell = plotsell::with('project','customer','plot')
->select( 'project_id','customer_id','plot_id', DB::raw( 'SUM(paid) as paid' ))
			    ->whereBetween('created_at',[$start,$end])
				->where('type',1)
				->where('project_id', $request->project )
                ->groupBy('customer_id','project_id','plot_id')
                
                ->get();
				
				
				
				
$customer_due_payment = plotsell::with('project','customer','plot')
->select( 'project_id','customer_id','plot_id', DB::raw( 'SUM(paid) as paid' ))
			    ->whereBetween('created_at',[$start,$end])
				->where('type',2)
				->where('project_id', $request->project )
                ->groupBy('customer_id','project_id','plot_id')
                
                ->get();				
				
				
				
$customer_refund = plotsell::with('project','customer','plot')
->select( 'project_id','customer_id','plot_id', DB::raw( 'SUM(paid) as paid' ))
			    ->whereBetween('created_at',[$start,$end])
				->where('type',3)
				->where('project_id', $request->project )
                ->groupBy('customer_id','project_id','plot_id')
                
                ->get();






			    $income = externalincometransition::with('externalincomesource','project')
                ->select( 'externalincomeprovider_id','project_id', DB::raw( 'SUM(amount) as income_in_cash ,   SUM(due) as total_due'  ))
			    ->whereBetween('created_at',[$start,$end])
				->where('project_id', $request->project )
                ->groupBy('externalincomeprovider_id','project_id')
                
                ->get();

	
      
$money_come_from_owner = moneyexchange::with('project')
                ->select( 'project_id', DB::raw( 'SUM(amount) as total'  ))
				->where('type', 1)
			    ->whereBetween('created_at',[$start,$end])
				->where('project_id', $request->project )
                ->groupBy('project_id')
                
                ->get();





$due_collection = 
duecollectionfromincomeprovider::with('externalincomeprovider','project')
                ->select( 'externalincomeprovider_id', DB::raw( 'SUM(amount) as total_due_collection'  ))
				->where('transitiontype', 1)
			    ->whereBetween('created_at',[$start,$end])
				->where('project_id', $request->project )
                ->groupBy('externalincomeprovider_id','project_id')
                
                ->get();		
		
			
	

		$project_name = project::findOrFail($request->project)->name;



		   $pdf = PDF::loadView('incomestatement.databetweentwodata_project',



		compact('start','end','externalcost','employee_salary','dharshod','money_return_back_to_owner',
		'income','money_come_from_owner','due_collection','project_name','money_back_from_company','company_cost','company_due_payment','plotsell','customer_due_payment','customer_refund','money_deposit','money_withdrawl','agent_commision',
		
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



















		
		 

		 
		
	

	}
	




	public function recordbetweentwodatedetails(Request $request){
		

		
		

        $validator = Validator::make($request->all(), [
            'startdate' => 'required|date|size:10',
        'enddate' => 'date|size:10',
		'project',
        ]);
		
		
		
		if ($validator->fails()) {
            return redirect('picktwodate')
                        ->withErrors($validator)
                        ->withInput();
        }
		
		
		        $start = date("Y-m-d",strtotime($request->input('startdate')));
        $end = date("Y-m-d",strtotime($request->input('enddate')));
      
		$datethatsentasenddatefromcust =  date("Y-m-d",strtotime($request->input('enddate')));
		
			
		
		
		if ($request->project== 9999999999999999 )
		{
		
		// expenses
			
			
			
						    $company_cost = productcompanyorder::with('productcompanytransition')
              
			    ->whereBetween('created_at',[$start,$end])
				->where('type',1)
            
                
                ->get();				
		

			    $company_due_payment = productcompanyorder::with('productcompanytransition')
               
			    ->whereBetween('created_at',[$start,$end])
				->where('type',2)
        
                
                ->get();
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			    $externalcost = khoroch_transition::with('khorocer_khad','project')
				->whereBetween('created_at',[$start,$end])
                ->get();				
				
				
				
				
			    $employee_salary = employeesalarytransaction::with('employeedetails')
               
			     ->whereBetween('created_at',[$start,$end])
               
                
                ->get();
		 
		 
		 

		 
				
				
			    $dharshod = dhar_shod_othoba_advance_er_mal_buje_pawa::with('supplier')
               
				->where('transitiontype', 1)
			    ->whereBetween('created_at',[$start,$end])
               
                
                ->get();	
				
				
		




			    $money_withdrawl = taka_uttolon_transition::with('sharepartner')
               
				->where('transitiontype', 1)
			    ->whereBetween('created_at',[$start,$end])
                
                
                ->get();

$money_given_to_project = moneyexchange::with('project')
               
				->where('type', 1)
			    ->whereBetween('created_at',[$start,$end])
                
                
                ->get();

	
$money_given_to_bank = bankchalan::with('Bankname')
                
				->where('type', 0)
				->where('whom', 0)
			    ->whereBetween('transdate',[$start,$end])
               
                
                ->get();



// income 

			    $money_back_from_company = productcompanyorder::with('productcompanytransition')
              
			    ->whereBetween('created_at',[$start,$end])
				->where('type',4)
              
                
                ->get();



$plotsell = plotsell::with('project','customer','plot')

			    ->whereBetween('created_at',[$start,$end])
				->where('type',1)
				
                
                
                ->get();
				
				
				
				
$customer_due_payment = plotsell::with('project','customer','plot')

			    ->whereBetween('created_at',[$start,$end])
				->where('type',2)
				
                
                ->get();				
				
				
				
$customer_refund = plotsell::with('project','customer','plot')

			    ->whereBetween('created_at',[$start,$end])
				->where('type',3)

                
                ->get();












			    $income = externalincometransition::with('externalincomesource','project')
               
			    ->whereBetween('created_at',[$start,$end])
                
                
                ->get();

			    $money_deposit = taka_uttolon_transition::with('sharepartner')
                
				->where('transitiontype', 2)
			    ->whereBetween('created_at',[$start,$end])
                
                
                ->get();
$money_taken_from_project = moneyexchange::with('project')
                
				->where('type', 2)
			    ->whereBetween('created_at',[$start,$end])
                
                
                ->get();

$money_come_from_bank = bankchalan::with('Bankname')
                
				->where('type', 1)
				->where('whom', 0)
			    ->whereBetween('transdate',[$start,$end])
                
                
                ->get();



$due_collection = 
duecollectionfromincomeprovider::with('externalincomeprovider','project')
               
				->where('transitiontype', 1)
			    ->whereBetween('created_at',[$start,$end])
                
                
                ->get();	

		
	
		   $pdf = PDF::loadView('incomestatement.databetweentwodatadetails',

		compact('externalcost','start','dharshod','money_withdrawl','money_given_to_project','money_given_to_bank', 'income', 'employee_salary','money_deposit', 'money_taken_from_project', 'money_come_from_bank','due_collection','end','company_cost','company_due_payment','money_back_from_company','plotsell','customer_due_payment','customer_refund',
		
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
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		}else{
			
		
				$company_cost = productcompanyorder::with('productcompanytransition')
              
			    ->whereBetween('created_at',[$start,$end])
				->where('type',1)
            ->where('project_id', $request->project )
                
                ->get();				
		

			    $company_due_payment = productcompanyorder::with('productcompanytransition')
               
			    ->whereBetween('created_at',[$start,$end])
				->where('type',2)
        ->where('project_id', $request->project )
                
                ->get();
		
		
		
					    $money_withdrawl = taka_uttolon_transition::with('sharepartner')
               
				->where('transitiontype', 1)
			    ->whereBetween('created_at',[$start,$end])
                ->where('project_id', $request->project )
                
                ->get();
		
		
		
		
		
				    $externalcost = khoroch_transition::with('khorocer_khad')

			    ->whereBetween('created_at',[$start,$end])
				->where('project_id', $request->project )
        
                
                ->get();				
				
				
				
				
			    $employee_salary = employeesalarytransaction::with('employeedetails')
           
			     ->whereBetween('created_at',[$start,$end])
				 ->where('project_id', $request->project )
           
                
                ->get();
		 
		 
		 

		 
				
				
			    $dharshod = dhar_shod_othoba_advance_er_mal_buje_pawa::with('supplier')
        
				->where('transitiontype', 1)
			    ->whereBetween('created_at',[$start,$end])
				->where('project_id', $request->project )
      
                
                ->get();	
				
				
		




			

$money_return_back_to_owner = moneyexchange::with('project')
       
				->where('type', 2)
			    ->whereBetween('created_at',[$start,$end])
				->where('project_id', $request->project )
          
                
                ->get();

	



// income dd



			    $money_deposit = taka_uttolon_transition::with('sharepartner')
                 ->where('project_id', $request->project )
				->where('transitiontype', 2)
			    ->whereBetween('created_at',[$start,$end])
                
                
                ->get();













			    $money_back_from_company = productcompanyorder::with('productcompanytransition')
              
			    ->whereBetween('created_at',[$start,$end])
				->where('type',4)
              ->where('project_id', $request->project )
                
                ->get();


$plotsell = plotsell::with('project','customer','plot')

			    ->whereBetween('created_at',[$start,$end])
				->where('type',1)
				->where('project_id', $request->project )
                
                
                ->get();
				
				
				
				
$customer_due_payment = plotsell::with('project','customer','plot')

			    ->whereBetween('created_at',[$start,$end])
				->where('type',2)
				->where('project_id', $request->project )
                
                ->get();				
				
				
				
$customer_refund = plotsell::with('project','customer','plot')

			    ->whereBetween('created_at',[$start,$end])
				->where('type',3)
->where('project_id', $request->project )
                
                ->get();



			    $income = externalincometransition::with('externalincomesource','project')
         
			    ->whereBetween('created_at',[$start,$end])
				->where('project_id', $request->project )
             
                
                ->get();

	
      
$money_come_from_owner = moneyexchange::with('project')
          
				->where('type', 1)
			    ->whereBetween('created_at',[$start,$end])
				->where('project_id', $request->project )
           
                
                ->get();





$due_collection = 
duecollectionfromincomeprovider::with('externalincomeprovider','project')
        
				->where('transitiontype', 1)
			    ->whereBetween('created_at',[$start,$end])
				->where('project_id', $request->project )
          
                
                ->get();		
		
			
	

		$project_name = project::findOrFail($request->project)->name;



		   $pdf = PDF::loadView('incomestatement.databetweentwodata_project_details',

		compact('start','end','externalcost','employee_salary','dharshod','money_return_back_to_owner',
		'income','money_come_from_owner','due_collection','project_name','money_back_from_company','company_cost','company_due_payment','plotsell','customer_due_payment','customer_refund','money_withdrawl','money_deposit',
		
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



















		
		 

		 
		
	

	}
	


























}






/*
incomestatementthismonth
   ->whereYear('created_at', Carbon::now()->year)
                    ->whereMonth('created_at', Carbon::now()->month)

'created_at', '=', Carbon::now()->subMonth()->month // last month




*/
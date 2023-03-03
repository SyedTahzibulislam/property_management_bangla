<?php

use Illuminate\Support\Facades\Route;  
use App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Admincontroller;    
use App\Http\Controllers\UserController;  
use App\Http\Controllers\patientcontroller;            
use App\Http\Controllers\projectsuperviserloginController;  
use App\Http\Controllers\custommerdashboardController; 
use App\Http\Controllers\SelfBalanceSheetController; 
use App\Http\Controllers\CustomerEntryController; 

 
                  
use App\Http\Controllers\categorylist;     
 
use App\Http\Controllers\cabinetransactioncontroller;   
use App\Http\Controllers\employeedetailscontroller;
 
use App\Http\Controllers\employeetransactioncontroller; 
           
    

use App\Http\Controllers\AccountController;        
use App\Http\Controllers\phermacyController;  
 use App\Http\Controllers\employeerolecangecontroller;      
use App\Http\Controllers\deletedusercontroller;  
 
       
  
use Dompdf\Dompdf; 
      
use App\Http\Controllers\surgeryaddlistcontroller;    
use App\Http\Controllers\indexController;        
use App\Http\Controllers\surgerytransitionController;  
use App\Http\Controllers\finalreporttransitionController;   
use App\Http\Controllers\Create_khorocer_khad_Controller;                
use App\Http\Controllers\CreaterSupplierController;      
use App\Http\Controllers\KhorochTransitionConTrollerController; 

use App\Http\Controllers\incomestatemnetController;  

use App\Http\Controllers\outdoordoctortranstion;  

use App\Http\Controllers\dhar_shod_advance_get_Controller;
use App\Http\Controllers\DoctorCommissionController; 
use App\Http\Controllers\medicineCompanyController;                                
use App\Http\Controllers\TakaUttolonTransitionController;  
use App\Http\Controllers\CreatePartnerController; 
use App\Http\Controllers\joma_uttolon_report_statement_Controller; 
use App\Http\Controllers\Pathology_test_Component_Controller;  
use App\Http\Controllers\medicine_comapny_transition_Controller; 
use App\Http\Controllers\medicineComapnyrDenaPawnaShodController; 
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\show_booking_patient_and_release; 
use App\Http\Controllers\servicelisthospitalController;  
use App\Http\Controllers\prescriptionController;  
use App\Http\Controllers\servicetranstionController;  
use App\Http\Controllers\dueshowtranstionController;



















use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\ProductCompanyController;
use App\Http\Controllers\productCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\producttransitionController;
use App\Http\Controllers\customerduetransitionController;
use App\Http\Controllers\balancesheetforCustomer;
use App\Http\Controllers\productcompanytransitionController;
use App\Http\Controllers\companyduepaymentController;
use App\Http\Controllers\returnproductfromcustomerController;
use App\Http\Controllers\compnanybalncecontroller;
use App\Http\Controllers\unitconvertercontroller;
use App\Http\Controllers\BanaknameController;
use App\Http\Controllers\balancesheetforBank;
use App\Http\Controllers\supplierduepaymentController;
use App\Http\Controllers\incomeproviderduetransitionController;


use App\Http\Controllers\incometranstaionController;


use App\Http\Controllers\basicunitController;



use App\Http\Controllers\balanceofbusinessController;


use App\Http\Controllers\balancesheetforCashtransform;


use App\Http\Controllers\expensesController;



 use App\Http\Controllers\agentdetailcontroller;   
use App\Http\Controllers\AgenttransactionControllerController;
use App\Http\Controllers\externalcostcontroller; 
use App\Http\Controllers\exteralincomeproviderController;

use App\Http\Controllers\externalincomesourceController;

//--------------------- project---------------------
use App\Http\Controllers\projectcontroller;
use App\Http\Controllers\supervisorController;
use App\Http\Controllers\projectsupervisorController;

use App\Http\Controllers\moneyexchangeController;

use App\Http\Controllers\moneyexcangetoaccount;

use App\Http\Controllers\banktransitionController;
use App\Http\Controllers\duecollectionController;
use App\Http\Controllers\userproductController;
use App\Http\Controllers\userdashboardController;
use App\Http\Controllers\plotController;
use App\Http\Controllers\plotsellController;

use App\Http\Controllers\plotsellduepaymentController;




/* medicinecontroller "{{ route('logout') }}" logout
|--------------------------------------------------------------------------   
| Web Routes business Productstock supplierduepayemnt picktwodate businessforcashtrasition
|--------------------------------------------------------------------------
|  showuserlist user.dashboard convertstock
| Here is where you can register web routes for your application. These balancesheetforcompany
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', [indexController::class, 'index']);





Route::middleware(['middleware'=>'PreventBackHistory'])->group(function () {
    Auth::routes();
});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group([ 'middleware'=>['auth','isdeleteduser','PreventBackHistory']], function(){
        Route::get('deleteduserdashboard',[deletedusercontroller::class,'index'])->name('deleteduser.dashboard');
});


Route::group([ 'middleware'=>['auth','isAdmin','PreventBackHistory']], function(){
	




Route::get('plotsellduepayment/dropdownlist_fetch/{id}/{id1}', [plotsellduepaymentController::class, 'dropdownlist_fetch'])->name('plotsellduepayment.dropdownlist');

Route::get('plotsellduepayment/dropdownlistgeneral', [plotsellduepaymentController::class, 'dropdownlist'])->name('plotsellduepayment.dropdownlistgeneral');

		

Route::get('plotsellduepayment/pdf/{id}', [plotsellduepaymentController::class, 'printvoucher'])->name('plotsellduepayment.pdf');


Route::resource('plotsellduepayment',  plotsellduepaymentController::class);
Route::post('plotsellduepayment/updateduepayment', [ plotsellduepaymentController::class,'update'])->name('plotsellduepayment.updateduepayment');

Route::get('plotsellduepayment/destroy/{id}', [ plotsellduepaymentController::class,'destroy']);



















Route::get('plotsell/dropdownlist_fetch/{id}', [plotsellController::class, 'dropdownlist_fetch'])->name('plotsell.dropdownlist');

Route::get('plotsell/dropdownlistforplotsell', [plotsellController::class, 'dropdownlist'])->name('plotsell.dropdownlistforplotsell');

		

Route::get('plotsell/pdf/{id}', [plotsellController::class, 'printvoucher'])->name('plotsell.pdf');


Route::resource('plotsell',  plotsellController::class);
Route::post('plotsell/updateplotsell', [ plotsellController::class,'update'])->name('plotsell.updateplotsell');

Route::get('plotsell/destroy/{id}', [ plotsellController::class,'destroy']);
















// money give to take from Account

Route::get('moneyexchangeacc/dropdownlist', [moneyexcangetoaccount::class, 'dropdownlist'])->name('moneyexchangeacc.dropdownlist');
Route::resource('moneyexchangeacc',  moneyexcangetoaccount::class);


Route::post('moneyexchangeacc/update', [ moneyexcangetoaccount::class,'update'])->name('moneyexchangeacc.update');


Route::get('moneyexchangeacc/destroy/{id}', [ moneyexcangetoaccount::class,'destroy']);






Route::get('allocateplot/dropdownlist', [ plotController::class,'dropdownlist'])->name('allocateplot.dropdownlist');

Route::resource('allocateplot',  plotController::class);
Route::post('allocateplot/update', [ plotController::class,'update'])->name('allocateplot.update');

Route::get('allocateplot/destroy/{id}', [ plotController::class,'destroy']);









// project 






Route::get('duecollection/dropdownlist', [ duecollectionController::class,'dropdownlist'])->name('duecollection.dropdownlist');

Route::resource('duecollection',  duecollectionController::class);
Route::post('duecollection/update', [ duecollectionController::class,'update'])->name('duecollection.update');

Route::get('duecollection/destroy/{id}', [ duecollectionController::class,'destroy']);













Route::get('projectsupervisor/dropdownlist', [projectsupervisorController::class, 'dropdownlist'])->name('projectsupervisor.dropdownlist');
Route::resource('projectsupervisor',  projectsupervisorController::class);


Route::post('projectsupervisor/update', [ projectsupervisorController::class,'update'])->name('projectsupervisor.update');


Route::get('projectsupervisor/destroy/{id}', [ projectsupervisorController::class,'destroy']);






Route::resource('project',  projectcontroller::class);
Route::post('project/update', [ projectcontroller::class,'update'])->name('project.update');

Route::get('project/destroy/{id}', [ projectcontroller::class,'destroy']);



Route::resource('supervisor',  supervisorController::class);
Route::post('supervisor/update', [ supervisorController::class,'update'])->name('supervisor.update');

Route::get('supervisor/destroy/{id}', [ supervisorController::class,'destroy']);













	
//// poltury	






Route::get('balancesheetforcompany/pdf/{id}', [compnanybalncecontroller::class, 'printvoucher'])->name('balancesheetforcompany.pdf');

Route::resource('balancesheetforcompany',  compnanybalncecontroller::class);
Route::post('balancesheetforcompany/update', [ compnanybalncecontroller::class,'update'])->name('balancesheetforcompany.update');

Route::get('balancesheetforcompany/destroy/{id}', [ compnanybalncecontroller::class,'destroy']);






Route::get('balancesheetforBank/pdf/{id}', [balancesheetforBank::class, 'printvoucher'])->name('balancesheetforBank.pdf');

Route::resource('balancesheetforBank',  balancesheetforBank::class);
Route::post('balancesheetforBank/update', [ balancesheetforBank::class,'update'])->name('balancesheetforBank.update');

Route::get('balancesheetforBank/destroy/{id}', [ balancesheetforBank::class,'destroy']);


// external Income source 

Route::get('externalincomesource/dropdownlistforchild/{id}', [externalincomesourceController::class, 'dropdownlistforchild'])->name('externalincomesource.dropdownlistforchild');

Route::get('externalincomesource/dropdownlist', [externalincomesourceController::class, 'dropdownlist'])->name('externalincomesource.dropdownlist');



Route::resource('externalincomesource',  externalincomesourceController::class);
Route::post('externalincomesource/update', [ externalincomesourceController::class,'update'])->name('externalincomesource.update');

Route::get('externalincomesource/destroy/{id}', [ externalincomesourceController::class,'destroy']);




////////// khorocher khad exteralincomeprovider

Route::get('khorocer_khad/dropdownlistforchild/{id}', [Create_khorocer_khad_Controller::class, 'dropdownlistforchild'])->name('khorocer_khad.dropdownlistforchild');

Route::get('khorocer_khad/dropdownlist', [Create_khorocer_khad_Controller::class, 'dropdownlist'])->name('khorocer_khad.dropdownlist');



Route::resource('khorocer_khad',  Create_khorocer_khad_Controller::class);
Route::post('khorocer_khad/update', [ Create_khorocer_khad_Controller::class,'update'])->name('khorocer_khad.update');

Route::get('khorocer_khad/destroy/{id}', [ Create_khorocer_khad_Controller::class,'destroy']);
















///////////// income transaction   



Route::get('externalincometransition/fourthlevel/{id}', [incometranstaionController::class, 'fourthlevel'])->name('externalincometransition.fourthlevel');


Route::get('externalincometransition/thirdlevel/{id}', [incometranstaionController::class, 'thirdlevel'])->name('externalincometransition.thirdlevel');


Route::get('externalincometransition/secondlevel/{id}', [incometranstaionController::class, 'secondlevel'])->name('externalincometransition.secondlevel');


Route::get('externalincometransition/selectincome', [incometranstaionController::class, 'selectincome'])->name('externalincometransition.selectincome');

Route::post('externalincometransition/fetchkhoroch', [incometranstaionController::class, 'fetchkhoroch'])->name('externalincometransition.fetchkhoroch');



Route::get('externalincometransition/dropdown_list', [incometranstaionController::class, 'dropdown_list'])->name('externalincometransition.dropdown_list');

Route::resource('externalincometransition',  incometranstaionController::class);
Route::post('externalincometransition/update', [ incometranstaionController::class,'update'])->name('externalincometransition.update');

Route::get('externalincometransition/destroy/{id}', [ incometranstaionController::class,'destroy']);













///////////// khoroch transaction   



Route::get('khorochtransition/fourthlevel/{id}', [KhorochTransitionConTrollerController::class, 'fourthlevel'])->name('khorochtransition.fourthlevel');


Route::get('khorochtransition/thirdlevel/{id}', [KhorochTransitionConTrollerController::class, 'thirdlevel'])->name('khorochtransition.thirdlevel');


Route::get('khorochtransition/secondlevel/{id}', [KhorochTransitionConTrollerController::class, 'secondlevel'])->name('khorochtransition.secondlevel');


Route::get('khorochtransition/selectkhoroch', [KhorochTransitionConTrollerController::class, 'selectkhoroch'])->name('khorochtransition.selectkhoroch');

Route::post('khorochtransition/fetchkhoroch', [KhorochTransitionConTrollerController::class, 'fetchkhoroch'])->name('khorochtransition.fetchkhoroch');



Route::get('khorochtransition/dropdown_list', [KhorochTransitionConTrollerController::class, 'dropdown_list'])->name('khorochtransition.dropdown_list');

Route::resource('khorochtransition',  KhorochTransitionConTrollerController::class);
Route::post('khorochtransition/update', [ KhorochTransitionConTrollerController::class,'update'])->name('khorochtransition.update');

Route::get('khorochtransition/destroy/{id}', [ KhorochTransitionConTrollerController::class,'destroy']);














/////////incomprovider 
Route::resource('exteralincomeprovider',  exteralincomeproviderController::class);
Route::post('exteralincomeprovider/update', [ exteralincomeproviderController::class,'update'])->name('exteralincomeprovider.update');

Route::get('exteralincomeprovider/destroy/{id}', [ exteralincomeproviderController::class,'destroy']);







/////////Supplier 
Route::resource('supplier',  CreaterSupplierController::class);
Route::post('supplier/update', [ CreaterSupplierController::class,'update'])->name('supplier.update');

Route::get('supplier/destroy/{id}', [ CreaterSupplierController::class,'destroy']);











Route::get('businessforcashtrasition/pdf/{id}', [balancesheetforCashtransform::class, 'printvoucher'])->name('businessforcashtrasition.pdf');

Route::resource('businessforcashtrasition',  balancesheetforCashtransform::class);
Route::post('businessforcashtrasition/update', [ balancesheetforCashtransform::class,'update'])->name('businessforcashtrasition.update');

Route::get('businessforcashtrasition/destroy/{id}', [ balancesheetforCashtransform::class,'destroy']);


Route::get('business/dropdown_list', [balanceofbusinessController::class, 'dropdown_list'])->name('business.dropdown_list');


Route::get('business/pdf/{id}', [balanceofbusinessController::class, 'printvoucher'])->name('business.pdf');

Route::resource('business',  balanceofbusinessController::class);
Route::post('business/update', [ balanceofbusinessController::class,'update'])->name('business.update');

Route::get('business/destroy/{id}', [ balanceofbusinessController::class,'destroy']);





Route::get('balancesheetforCustomer/pdf/{id}', [balancesheetforCustomer::class, 'printvoucher'])->name('balancesheetforCustomer.pdf');

Route::resource('balancesheetforCustomer',  balancesheetforCustomer::class);
Route::post('balancesheetforCustomer/update', [ balancesheetforCustomer::class,'update'])->name('balancesheetforCustomer.update');

Route::get('balancesheetforCustomer/destroy/{id}', [ balancesheetforCustomer::class,'destroy']);





Route::resource('basicunit', basicunitController::class);
Route::post('basicunit/update', [basicunitController::class,'update'])->name('basicunit.update');

Route::get('basicunit/destroy/{id}', [basicunitController::class,'destroy']);
	




Route::get('unitconversion/dropdownlist', [unitconvertercontroller::class, 'dropdownlist'])->name('unitconversion.dropdownlist');


Route::resource('unitconversion', unitconvertercontroller::class);
Route::post('unitconversion/update', [unitconvertercontroller::class,'update'])->name('unitconversion.update');

Route::get('unitconversion/destroy/{id}', [unitconvertercontroller::class,'destroy']);
	


Route::get('expenses/dropdownlistforchild/{id}', [expensesController::class, 'dropdownlistforchild'])->name('expenses.dropdownlistforchild');

Route::get('expenses/dropdownlist', [expensesController::class, 'dropdownlist'])->name('expenses.dropdownlist');

Route::resource('expenses', expensesController::class);
Route::post('expenses/update', [expensesController::class,'update'])->name('expenses.update');

Route::get('expenses/destroy/{id}', [expensesController::class,'destroy']);





Route::resource('bank', BanaknameController::class);
Route::post('bank/update', [BanaknameController::class,'update'])->name('bank.update');

Route::get('bank/destroy/{id}', [BanaknameController::class,'destroy']);
	




Route::get('banktransition/dropdownlist', [banktransitionController::class, 'dropdownlist'])->name('banktransition.dropdownlist');
		
Route::get('banktransition/pdf/{id}', [banktransitionController::class, 'printvoucher'])->name('banktransition.pdf');

Route::resource('banktransition',  banktransitionController::class);
Route::post('banktransition/update', [ banktransitionController::class,'update'])->name('banktransition.update');

Route::get('banktransition/destroy/{id}', [ banktransitionController::class,'destroy']);




Route::get('customerduetransition/dropdownlist', [customerduetransitionController::class, 'dropdownlist'])->name('customerduetransition.dropdownlist');
		
Route::get('customerduetransition/pdf/{id}', [customerduetransitionController::class, 'printvoucher'])->name('customerduetransition.pdf');

Route::resource('customerduetransition',  customerduetransitionController::class);
Route::post('customerduetransition/update', [ customerduetransitionController::class,'update'])->name('customerduetransition.update');

Route::get('customerduetransition/destroy/{id}', [ customerduetransitionController::class,'destroy']);




Route::get('productcompanduetra/dropdownlist', [companyduepaymentController::class, 'dropdownlist'])->name('productcompanduetra.dropdownlist');

Route::resource('productcompanduetra',  companyduepaymentController::class);
Route::post('productcompanduetra/update', [ companyduepaymentController::class,'update'])->name('productcompanduetra.update');

Route::get('productcompanduetra/destroy/{id}', [ companyduepaymentController::class,'destroy']);




Route::get('productcompanytrans/purchase', [productcompanytransitionController::class, 'purchase'])->name('productcompanytrans.purchase');


Route::post('productcompanytrans/purchasefetch', [productcompanytransitionController::class, 'purchasefetch'])->name('productcompanytrans.purchasefetch');



Route::get('productcompanytrans/dropdownlist', [productcompanytransitionController::class, 'dropdownlist'])->name('productcompanytrans.dropdownlist');

Route::resource('productcompanytrans',  productcompanytransitionController::class);
Route::post('productcompanytrans/update', [ productcompanytransitionController::class,'update'])->name('productcompanytrans.update');

Route::get('productcompanytrans/destroy/{id}', [ productcompanytransitionController::class,'destroy']);


// return product from customer balancesheetforCustomer


Route::get('returnproduct/dropdownlist', [returnproductfromcustomerController::class, 'dropdownlist'])->name('returnproduct.dropdownlist');

		

Route::get('returnproduct/pdf/{id}', [returnproductfromcustomerController::class, 'printvoucher'])->name('returnproduct.pdf');


Route::resource('returnproduct',  returnproductfromcustomerController::class);
Route::post('returnproduct/update', [ returnproductfromcustomerController::class,'update'])->name('returnproduct.update');

Route::get('returnproduct/destroy/{id}', [ returnproductfromcustomerController::class,'destroy']);













//product transition convertstock


Route::post('producttransition/change_sale_to_godown', [producttransitionController::class, 'change_sale_to_godown'])->name('producttransition.change_sale_to_godown');



Route::post('producttransition/changegodowntosalepoint', [producttransitionController::class, 'changegodowntosalepoint'])->name('producttransition.changegodowntosalepoint');


Route::post('producttransition/stock_sale_to_godown', [producttransitionController::class, 'sale_to_godown'])->name('producttransition.stock_sale_to_godown');


Route::get('producttransition/successmsg', [producttransitionController::class, 'successmsg'])->name('producttransition.successmsg');


Route::get('producttransition/failmsg', [producttransitionController::class, 'failmsg'])->name('producttransition.failmsg');

Route::get('producttransition/changeprojectstock', [producttransitionController::class, 'changeprojectstock'])->name('producttransition.changeprojectstock');


Route::post('producttransition/transferstock', [producttransitionController::class, 'transferstock'])->name('producttransition.transferstock');









Route::get('producttransition/stock_sale_to_godown', [producttransitionController::class, 'stock_sale_to_godown'])->name('producttransition.stock_sale_to_godown');


Route::get('producttransition/convertstock', [producttransitionController::class, 'convertstock'])->name('producttransition.convertstock');

Route::post('producttransition/convertstockfetch', [producttransitionController::class, 'convertstockfetch'])->name('producttransition.convertstockfetch');

Route::post('producttransition/saveconverted', [producttransitionController::class, 'saveconverted'])->name('producttransition.saveconverted');



Route::get('producttransition/saleproduct', [producttransitionController::class, 'producttransfetch'])->name('producttransition.producttransfetch');


Route::post('producttransition/salereportfetch', [producttransitionController::class, 'salereportfetch'])->name('producttransition.salereportfetch');


Route::get('producttransition/dropdowndynamic/{id1}/{id2}', [producttransitionController::class, 'dropdowndynamic'])->name('producttransition.dropdowndynamic');

Route::get('producttransition/fetchunit/{id1}', [producttransitionController::class, 'fetchunit'])->name('producttransition.fetchunit');

Route::get('producttransition/dropdownlist', [producttransitionController::class, 'dropdownlist'])->name('producttransition.dropdownlist');

		

Route::get('producttransition/pdf/{id}', [producttransitionController::class, 'printvoucher'])->name('producttransition.pdf');


Route::resource('producttransition',  producttransitionController::class);
Route::post('producttransition/update', [ producttransitionController::class,'update'])->name('producttransition.update');

Route::get('producttransition/destroy/{id}', [ producttransitionController::class,'destroy']);









Route::post('useproduct/fetch', [userproductController::class, 'fetch'])->name('useproduct.fetch');

Route::get('useproduct/datefetch', [userproductController::class, 'datefetch'])->name('useproduct.datefetch');
Route::resource('useproduct',  userproductController::class);
Route::post('useproduct/update', [ userproductController::class,'update'])->name('useproduct.update');

Route::get('useproduct/destroy/{id}', [ userproductController::class,'destroy']);





Route::get('Productstock', [ProductController::class, 'stock'])->name('Product.stock');

Route::post('fetch_Productstock', [ProductController::class, 'fetch_Productstock'])->name('Product.fetch_Productstock');


Route::get('Product/editdproduct/{id}', [ProductController::class, 'editdproduct'])->name('Product.editdproduct');


Route::get('dropdownlist', [ProductController::class, 'dropdownlist'])->name('Product.dropdownlist');
		
Route::resource('Product', ProductController::class);
Route::post('Product/update', [ProductController::class,'update'])->name('Product.update');

Route::get('Product/destroy/{id}', [ProductController::class,'destroy']);	


Route::resource('productcaategory', productCategoryController::class);
Route::post('productcaategory/update', [productCategoryController::class,'update'])->name('productcaategory.update');

Route::get('productcaategory/destroy/{id}', [productCategoryController::class,'destroy']);
	


Route::resource('productcompany', ProductCompanyController::class);
Route::post('productcompany/update', [ProductCompanyController::class,'update'])->name('productcompany.update');

Route::get('productcompany/destroy/{id}', [ProductCompanyController::class,'destroy']);

	
	
	
Route::resource('areacode', AreaController::class);
Route::post('areacode/update', [AreaController::class,'update'])->name('areacode.update');

Route::get('areacode/destroy/{id}', [AreaController::class,'destroy']);
	
	

	

Route::get('customer/entry/fulllist', [CustomerEntryController::class, 'fulllist'])->name('customer.entry.fulllist');
Route::get('customer/entry/entrylist', [CustomerEntryController::class, 'drodownlist'])->name('customer.entry.entrylist');
Route::get('customer/entry/delete/{id}', [CustomerEntryController::class, 'delete'])->name('customer.entry.delete');
Route::get('customer/entry/edit/{id}', [CustomerEntryController::class, 'edit'])->name('customer.entry.edit');
Route::get('customer/entry/index', [CustomerEntryController::class, 'index'])->name('customer.entry.index');
Route::post('customer/entry/update', [CustomerEntryController::class, 'update'])->name('customer.entry.update');
Route::post('customer/entry/store', [CustomerEntryController::class, 'store'])->name('customer.entry.store');
	
// agent details 


Route::resource('agentlist',  agentdetailcontroller::class);
Route::post('agentlist/update', [ agentdetailcontroller::class,'update'])->name('agentlist.update');


Route::get('agentlist/destroy/{id}', [ agentdetailcontroller::class,'destroy']);
	
	




// agent transaction 

// agent transaction 

Route::get('agenttransaction/selectagent', [AgenttransactionControllerController::class, 'selectagent'])->name('agenttransaction.selectagent');

Route::post('agentfetch', [AgenttransactionControllerController::class, 'agentfetch'])->name('agenttransaction.agentfetch');

Route::get('agenttransaction/pdf/{id}', [AgenttransactionControllerController::class, 'printpdf'])->name('agenttransaction.pdf');

 //Route::post('agenttransaction/paid/{id}', [AgenttransactionControllerController::class, 'paid'])->name('agenttransaction.paid');

Route::post('agenttransaction/paid', [AgenttransactionControllerController::class, 'paid'])->name('agenttransaction.paid');

Route::get('agenttransaction/paidsenddata/{id}', [AgenttransactionControllerController::class, 'paidsenddata'])->name('agenttransaction.paidsenddata');


Route::get('agenttransaction/dropdown_list', [AgenttransactionControllerController::class, 'dropdown_list'])->name('agenttransaction.dropdown_list');
Route::resource('agenttransaction',  AgenttransactionControllerController::class);
Route::post('agenttransaction/update', [ AgenttransactionControllerController::class,'update'])->name('agenttransaction.update');















	
	
	
	
	
	
        Route::get('admindashboard',[Admincontroller::class,'index'])->name('admin.dashboard');
   


			
Route::resource('showuserlist', employeerolecangecontroller::class);
Route::post('showuserlist/update', [employeerolecangecontroller::class,'update'])->name('showuserlist.update');

Route::get('showuserlist/destroy/{id}', [employeerolecangecontroller::class,'destroy']);
	


// employee list 


Route::resource('employeelist',  employeedetailscontroller::class);
Route::post('employeelist/update', [ employeedetailscontroller::class,'update'])->name('employeelist.update');


Route::get('employeelist/destroy/{id}', [ employeedetailscontroller::class,'destroy']);








//hospital service 

Route::get('servicelist/dropdown_list', [ servicelisthospitalController::class,'dropdown_list'])->name('servicelist.dropdown_list');
Route::resource('servicelist',  servicelisthospitalController::class);
Route::post('servicelist/update', [ servicelisthospitalController::class,'update'])->name('servicelist.update');


Route::get('servicelist/destroy/{id}', [ servicelisthospitalController::class,'destroy']);

// service transtion controller servicetranstionController

Route::resource('servicetranstion',  servicetranstionController::class);







 
// employee transaction delete 

Route::get('employeetransactioncon/destroy/{id}', [ employeetransactioncontroller::class,'destroy']);


///////////////  external cost transaction delete 
Route::get('externalcost/destroy/{id}', [ externalcostcontroller::class,'destroy']);




 
////////////////////////////////////////prothisthaner khoroch///////////////////////////////


// report transaction 
//Route::get('reporttransaction/mlist', [reporttransactionController::class, 'mlist'])->name('reporttransaction.mlist');
//Route::get('reporttransaction/fetch', [reporttransactionController::class, 'fetch'])->name('reporttransaction.fetch');







// income provider due payemnt

Route::get('incomeproviderduetrans/dropdownlist', [ incomeproviderduetransitionController::class,'dropdownlist'])->name('incomeproviderduetrans.dropdownlist');

Route::resource('incomeproviderduetrans',  incomeproviderduetransitionController::class);
Route::post('incomeproviderduetrans/update', [ incomeproviderduetransitionController::class,'update'])->name('incomeproviderduetrans.update');

Route::get('incomeproviderduetrans/destroy/{id}', [ incomeproviderduetransitionController::class,'destroy']);








//////////   dhar shod korun othoba advance bujhe pan 





Route::get('supplierduepayemnt/dropdownlist', [ supplierduepaymentController::class,'dropdownlist'])->name('supplierduepayemnt.dropdownlist');

Route::resource('supplierduepayemnt',  supplierduepaymentController::class);
Route::post('supplierduepayemnt/update', [ supplierduepaymentController::class,'update'])->name('supplierduepayemnt.update');

Route::get('supplierduepayemnt/destroy/{id}', [ supplierduepaymentController::class,'destroy']);













///////////// Taka uttolon o joma  transaction   


Route::get('takauttolon/balancesheet', [TakaUttolonTransitionController::class, 'balancesheet'])->name('takauttolon.balancesheet');


Route::post('takauttolon/balanceprocess', [TakaUttolonTransitionController::class, 'balanceprocess'])->name('takauttolon.balanceprocess');


Route::get('takauttolon/dropdown_list', [TakaUttolonTransitionController::class, 'dropdown_list'])->name('takauttolon.dropdown_list');

Route::resource('takauttolon',  TakaUttolonTransitionController::class);
//Route::post('khorochtransition/update', [ KhorochTransitionConTrollerController::class,'update'])->name('khorochtransition.update');

Route::get('takauttolon/destroy/{id}', [ TakaUttolonTransitionController::class,'destroy']);








///////////// business Partner   


Route::resource('businesspartner',  CreatePartnerController::class);
Route::post('businesspartner/update', [ CreatePartnerController::class,'update'])->name('businesspartner.update');

Route::get('businesspartner/destroy/{id}', [ CreatePartnerController::class,'destroy']);


///////////////////////// Taka uttolon o joma report ////////////////////////////////



 Route::get('joma_uttolon_statement_today', [joma_uttolon_report_statement_Controller::class, 'todaystatement'])->name('joma_uttolon_statement_today');


 Route::get('joma_uttolon_statement_yesterday', [joma_uttolon_report_statement_Controller::class, 'yesterdaystatment'])->name('joma_uttolon_statement_yesterday');


 Route::get('joma_uttolon_statement_month', [joma_uttolon_report_statement_Controller::class, 'thismonthstatment'])->name('joma_uttolon_statement_month');

 Route::get('joma_uttolon_statement_year', [joma_uttolon_report_statement_Controller::class, 'thisyear'])->name('joma_uttolon_statement_year');

 Route::get('joma_uttolon_statement_lastmonth', [joma_uttolon_report_statement_Controller::class, 'lastmonth'])->name('joma_uttolon_statement_lastmonth');

// Route::post('incomestatbtwtwodate', [incomestatemnetController::class, 'recordbetweentwodate'])->name('incomestatbtwtwodate');

//Route::get('/picktwodate', function () {
//    return view('incomestatement.picktwodate');
//});










Route::get('/picktwodatefordoctortransition', function () {
    return view('incomefromdoctoroutdoor.picktwodate');
});






////////////////////////////// Income Statement 

 Route::get('incomestatementtoday', [incomestatemnetController::class, 'todaystatment'])->name('incomestatementtoday.todaystatment');


 Route::get('incomestatementyesterday', [incomestatemnetController::class, 'yesterdaystatment'])->name('incomestatementyesterday.incomestatementyesterday');


 Route::get('incomestatementthismonth', [incomestatemnetController::class, 'thismonthstatment'])->name('thismonthstatment.thismonthstatment');

 Route::get('incomestatementthisyear', [incomestatemnetController::class, 'thisyearstatment'])->name('thisyearstatment.thisyearstatment');

 Route::get('incomestatementlastmonth', [incomestatemnetController::class, 'lastmonthstatment'])->name('incomestatementlastmonth.incomestatementlastmonth');

 Route::post('incomestatbtwtwodate', [incomestatemnetController::class, 'recordbetweentwodate'])->name('incomestatbtwtwodate');

 Route::post('incomestatbtwtwodatedetails', [incomestatemnetController::class, 'recordbetweentwodatedetails'])->name('incomestatbtwtwodatedetails');



 Route::get('picktwodate', [incomestatemnetController::class, 'picktwodate'])->name('incomestatementlastmonth.picktwodate');

 Route::get('picktwodatedetails', [incomestatemnetController::class, 'picktwodatedetails'])->name('incomestatementlastmonth.picktwodatedetails');

//Route::get('/picktwodate', function () {
  //  return view('incomestatement.picktwodate');
//});



















//////// check balance 
 Route::get('balance', [BalanceController::class, 'index'])->name('balance');

















});

 
 
 
 
 
 ////////////////////////////////////////////// Phermacy Section 
Route::group([ 'middleware'=>['auth','isPhermachy','PreventBackHistory']], function(){
        Route::get('Phermachydepdashboard',[phermacyController::class,'index'])->name('phermachy.dashboard');
       
		
		



		


       
}); 


 /////////////////////////////////////////////// Account  Section productcompanytransitionController
 
 Route::group([ 'middleware'=>['auth','isAccount','PreventBackHistory']], function(){
        Route::get('accountdashboard',[AccountController::class,'index'])->name('account.dashboard');
        



Route::get('productcompanytrans/purchase', [productcompanytransitionController::class, 'purchase'])->name('productcompanytrans.purchase');


Route::post('productcompanytrans/purchasefetch', [productcompanytransitionController::class, 'purchasefetch'])->name('productcompanytrans.purchasefetch');



Route::get('productcompanytrans/dropdownlist', [productcompanytransitionController::class, 'dropdownlist'])->name('productcompanytrans.dropdownlist');

Route::resource('productcompanytrans',  productcompanytransitionController::class);
Route::post('productcompanytrans/update', [ productcompanytransitionController::class,'update'])->name('productcompanytrans.update');

Route::get('productcompanytrans/destroy/{id}', [ productcompanytransitionController::class,'destroy']);
















		
		
		
// project 






Route::get('duecollection/dropdownlist', [ duecollectionController::class,'dropdownlist'])->name('duecollection.dropdownlist');

Route::resource('duecollection',  duecollectionController::class);
Route::post('duecollection/update', [ duecollectionController::class,'update'])->name('duecollection.update');

Route::get('duecollection/destroy/{id}', [ duecollectionController::class,'destroy']);











//projectsupervisor

Route::get('projectsupervisor/dropdownlist', [projectsupervisorController::class, 'dropdownlist'])->name('projectsupervisor.dropdownlist');
Route::resource('projectsupervisor',  projectsupervisorController::class);


Route::post('projectsupervisor/update', [ projectsupervisorController::class,'update'])->name('projectsupervisor.update');


Route::get('projectsupervisor/destroy/{id}', [ projectsupervisorController::class,'destroy']);




//project

Route::resource('project',  projectcontroller::class);
Route::post('project/update', [ projectcontroller::class,'update'])->name('project.update');

Route::get('project/destroy/{id}', [ projectcontroller::class,'destroy']);


// supervisor
Route::resource('supervisor',  supervisorController::class);
Route::post('supervisor/update', [ supervisorController::class,'update'])->name('supervisor.update');

Route::get('supervisor/destroy/{id}', [ supervisorController::class,'destroy']);













	
	



// compnanybalncesheet


Route::get('balancesheetforcompany/pdf/{id}', [compnanybalncecontroller::class, 'printvoucher'])->name('balancesheetforcompany.pdf');

Route::resource('balancesheetforcompany',  compnanybalncecontroller::class);
Route::post('balancesheetforcompany/update', [ compnanybalncecontroller::class,'update'])->name('balancesheetforcompany.update');

Route::get('balancesheetforcompany/destroy/{id}', [ compnanybalncecontroller::class,'destroy']);




// Bank Balancesheet 

Route::get('balancesheetforBank/pdf/{id}', [balancesheetforBank::class, 'printvoucher'])->name('balancesheetforBank.pdf');

Route::resource('balancesheetforBank',  balancesheetforBank::class);
Route::post('balancesheetforBank/update', [ balancesheetforBank::class,'update'])->name('balancesheetforBank.update');

Route::get('balancesheetforBank/destroy/{id}', [ balancesheetforBank::class,'destroy']);


// external Income source 

Route::get('externalincomesource/dropdownlistforchild/{id}', [externalincomesourceController::class, 'dropdownlistforchild'])->name('externalincomesource.dropdownlistforchild');

Route::get('externalincomesource/dropdownlist', [externalincomesourceController::class, 'dropdownlist'])->name('externalincomesource.dropdownlist');



Route::resource('externalincomesource',  externalincomesourceController::class);
Route::post('externalincomesource/update', [ externalincomesourceController::class,'update'])->name('externalincomesource.update');

Route::get('externalincomesource/destroy/{id}', [ externalincomesourceController::class,'destroy']);




////////// khorocher khad exteralincomeprovider

Route::get('khorocer_khad/dropdownlistforchild/{id}', [Create_khorocer_khad_Controller::class, 'dropdownlistforchild'])->name('khorocer_khad.dropdownlistforchild');

Route::get('khorocer_khad/dropdownlist', [Create_khorocer_khad_Controller::class, 'dropdownlist'])->name('khorocer_khad.dropdownlist');



Route::resource('khorocer_khad',  Create_khorocer_khad_Controller::class);
Route::post('khorocer_khad/update', [ Create_khorocer_khad_Controller::class,'update'])->name('khorocer_khad.update');

Route::get('khorocer_khad/destroy/{id}', [ Create_khorocer_khad_Controller::class,'destroy']);
















///////////// income transaction   



Route::get('externalincometransition/fourthlevel/{id}', [incometranstaionController::class, 'fourthlevel'])->name('externalincometransition.fourthlevel');


Route::get('externalincometransition/thirdlevel/{id}', [incometranstaionController::class, 'thirdlevel'])->name('externalincometransition.thirdlevel');


Route::get('externalincometransition/secondlevel/{id}', [incometranstaionController::class, 'secondlevel'])->name('externalincometransition.secondlevel');


Route::get('externalincometransition/selectincome', [incometranstaionController::class, 'selectincome'])->name('externalincometransition.selectincome');

Route::post('externalincometransition/fetchkhoroch', [incometranstaionController::class, 'fetchkhoroch'])->name('externalincometransition.fetchkhoroch');



Route::get('externalincometransition/dropdown_list', [incometranstaionController::class, 'dropdown_list'])->name('externalincometransition.dropdown_list');

Route::resource('externalincometransition',  incometranstaionController::class);
Route::post('externalincometransition/update', [ incometranstaionController::class,'update'])->name('externalincometransition.update');

Route::get('externalincometransition/destroy/{id}', [ incometranstaionController::class,'destroy']);













///////////// khoroch transaction   



Route::get('khorochtransition/fourthlevel/{id}', [KhorochTransitionConTrollerController::class, 'fourthlevel'])->name('khorochtransition.fourthlevel');


Route::get('khorochtransition/thirdlevel/{id}', [KhorochTransitionConTrollerController::class, 'thirdlevel'])->name('khorochtransition.thirdlevel');


Route::get('khorochtransition/secondlevel/{id}', [KhorochTransitionConTrollerController::class, 'secondlevel'])->name('khorochtransition.secondlevel');


Route::get('khorochtransition/selectkhoroch', [KhorochTransitionConTrollerController::class, 'selectkhoroch'])->name('khorochtransition.selectkhoroch');

Route::post('khorochtransition/fetchkhoroch', [KhorochTransitionConTrollerController::class, 'fetchkhoroch'])->name('khorochtransition.fetchkhoroch');



Route::get('khorochtransition/dropdown_list', [KhorochTransitionConTrollerController::class, 'dropdown_list'])->name('khorochtransition.dropdown_list');

Route::resource('khorochtransition',  KhorochTransitionConTrollerController::class);
Route::post('khorochtransition/update', [ KhorochTransitionConTrollerController::class,'update'])->name('khorochtransition.update');

Route::get('khorochtransition/destroy/{id}', [ KhorochTransitionConTrollerController::class,'destroy']);














/////////incomprovider 
Route::resource('exteralincomeprovider',  exteralincomeproviderController::class);
Route::post('exteralincomeprovider/update', [ exteralincomeproviderController::class,'update'])->name('exteralincomeprovider.update');

Route::get('exteralincomeprovider/destroy/{id}', [ exteralincomeproviderController::class,'destroy']);







/////////Supplier 
Route::resource('supplier',  CreaterSupplierController::class);











// cash flow for business 

Route::get('businessforcashtrasition/pdf/{id}', [balancesheetforCashtransform::class, 'printvoucher'])->name('businessforcashtrasition.pdf');

Route::resource('businessforcashtrasition',  balancesheetforCashtransform::class);
Route::post('businessforcashtrasition/update', [ balancesheetforCashtransform::class,'update'])->name('businessforcashtrasition.update');

Route::get('businessforcashtrasition/destroy/{id}', [ balancesheetforCashtransform::class,'destroy']);



// opening businesss 
Route::get('business/dropdown_list', [balanceofbusinessController::class, 'dropdown_list'])->name('business.dropdown_list');


Route::get('business/pdf/{id}', [balanceofbusinessController::class, 'printvoucher'])->name('business.pdf');

Route::resource('business',  balanceofbusinessController::class);




// customer balance sheet

Route::get('balancesheetcustomerself', [balancesheetforCustomer::class, 'customerbalanceforself'])->name('balancesheetforCustomer.customerbalanceforself');

Route::get('balancesheetforCustomer/pdf/{id}', [balancesheetforCustomer::class, 'printvoucher'])->name('balancesheetforCustomer.pdf');

Route::resource('balancesheetforCustomer',  balancesheetforCustomer::class);
Route::post('balancesheetforCustomer/update', [ balancesheetforCustomer::class,'update'])->name('balancesheetforCustomer.update');

Route::get('balancesheetforCustomer/destroy/{id}', [ balancesheetforCustomer::class,'destroy']);




// basic unit
Route::resource('basicunit', basicunitController::class);
Route::post('basicunit/update', [basicunitController::class,'update'])->name('basicunit.update');

Route::get('basicunit/destroy/{id}', [basicunitController::class,'destroy']);
	



// unit conversion 
Route::get('unitconversion/dropdownlist', [unitconvertercontroller::class, 'dropdownlist'])->name('unitconversion.dropdownlist');


Route::resource('unitconversion', unitconvertercontroller::class);
Route::post('unitconversion/update', [unitconvertercontroller::class,'update'])->name('unitconversion.update');

Route::get('unitconversion/destroy/{id}', [unitconvertercontroller::class,'destroy']);
	

// expenses
Route::get('expenses/dropdownlistforchild/{id}', [expensesController::class, 'dropdownlistforchild'])->name('expenses.dropdownlistforchild');

Route::get('expenses/dropdownlist', [expensesController::class, 'dropdownlist'])->name('expenses.dropdownlist');

Route::resource('expenses', expensesController::class);
Route::post('expenses/update', [expensesController::class,'update'])->name('expenses.update');

Route::get('expenses/destroy/{id}', [expensesController::class,'destroy']);




// bank 
/*
Route::resource('bank', BanaknameController::class);
Route::post('bank/update', [BanaknameController::class,'update'])->name('bank.update');

Route::get('bank/destroy/{id}', [BanaknameController::class,'destroy']);
	
*/



Route::get('banktransition/dropdownlist', [banktransitionController::class, 'dropdownlist'])->name('banktransition.dropdownlist');
		
Route::get('banktransition/pdf/{id}', [banktransitionController::class, 'printvoucher'])->name('banktransition.pdf');

Route::resource('banktransition',  banktransitionController::class);
Route::post('banktransition/update', [ banktransitionController::class,'update'])->name('banktransition.update');

Route::get('banktransition/destroy/{id}', [ banktransitionController::class,'destroy']);




Route::get('customerduetransition/dropdownlist', [customerduetransitionController::class, 'dropdownlist'])->name('customerduetransition.dropdownlist');
		
Route::get('customerduetransition/pdf/{id}', [customerduetransitionController::class, 'printvoucher'])->name('customerduetransition.pdf');

Route::resource('customerduetransition',  customerduetransitionController::class);
Route::post('customerduetransition/update', [ customerduetransitionController::class,'update'])->name('customerduetransition.update');

Route::get('customerduetransition/destroy/{id}', [ customerduetransitionController::class,'destroy']);




Route::get('productcompanduetra/dropdownlist', [companyduepaymentController::class, 'dropdownlist'])->name('productcompanduetra.dropdownlist');

Route::resource('productcompanduetra',  companyduepaymentController::class);
Route::post('productcompanduetra/update', [ companyduepaymentController::class,'update'])->name('productcompanduetra.update');

Route::get('productcompanduetra/destroy/{id}', [ companyduepaymentController::class,'destroy']);






// return product from customer balancesheetforCustomer


Route::get('returnproduct/dropdownlist', [returnproductfromcustomerController::class, 'dropdownlist'])->name('returnproduct.dropdownlist');

		

Route::get('returnproduct/pdf/{id}', [returnproductfromcustomerController::class, 'printvoucher'])->name('returnproduct.pdf');


Route::resource('returnproduct',  returnproductfromcustomerController::class);
Route::post('returnproduct/update', [ returnproductfromcustomerController::class,'update'])->name('returnproduct.update');

Route::get('returnproduct/destroy/{id}', [ returnproductfromcustomerController::class,'destroy']);













//product transition convertstock


Route::post('producttransition/change_sale_to_godown', [producttransitionController::class, 'change_sale_to_godown'])->name('producttransition.change_sale_to_godown');



Route::post('producttransition/changegodowntosalepoint', [producttransitionController::class, 'changegodowntosalepoint'])->name('producttransition.changegodowntosalepoint');


Route::post('producttransition/stock_sale_to_godown', [producttransitionController::class, 'sale_to_godown'])->name('producttransition.stock_sale_to_godown');



Route::get('producttransition/stock_sale_to_godown', [producttransitionController::class, 'stock_sale_to_godown'])->name('producttransition.stock_sale_to_godown');


Route::get('producttransition/convertstock', [producttransitionController::class, 'convertstock'])->name('producttransition.convertstock');

Route::post('producttransition/convertstockfetch', [producttransitionController::class, 'convertstockfetch'])->name('producttransition.convertstockfetch');

Route::post('producttransition/saveconverted', [producttransitionController::class, 'saveconverted'])->name('producttransition.saveconverted');



Route::get('producttransition/saleproduct', [producttransitionController::class, 'producttransfetch'])->name('producttransition.producttransfetch');


Route::post('producttransition/salereportfetch', [producttransitionController::class, 'salereportfetch'])->name('producttransition.salereportfetch');


Route::get('producttransition/dropdowndynamic/{id1}/{id2}', [producttransitionController::class, 'dropdowndynamic'])->name('producttransition.dropdowndynamic');

Route::get('producttransition/fetchunit/{id1}', [producttransitionController::class, 'fetchunit'])->name('producttransition.fetchunit');

Route::get('producttransition/dropdownlist', [producttransitionController::class, 'dropdownlist'])->name('producttransition.dropdownlist');

		

Route::get('producttransition/pdf/{id}', [producttransitionController::class, 'printvoucher'])->name('producttransition.pdf');


Route::resource('producttransition',  producttransitionController::class);
Route::post('producttransition/update', [ producttransitionController::class,'update'])->name('producttransition.update');

Route::get('producttransition/destroy/{id}', [ producttransitionController::class,'destroy']);









Route::post('useproduct/fetch', [userproductController::class, 'fetch'])->name('useproduct.fetch');

Route::get('useproduct/datefetch', [userproductController::class, 'datefetch'])->name('useproduct.datefetch');
Route::resource('useproduct',  userproductController::class);
Route::post('useproduct/update', [ userproductController::class,'update'])->name('useproduct.update');

Route::get('useproduct/destroy/{id}', [ userproductController::class,'destroy']);





Route::get('Productstock', [ProductController::class, 'stock'])->name('Product.stock');

Route::post('fetch_Productstock', [ProductController::class, 'fetch_Productstock'])->name('Product.fetch_Productstock');


Route::get('Product/editdproduct/{id}', [ProductController::class, 'editdproduct'])->name('Product.editdproduct');


Route::get('dropdownlist', [ProductController::class, 'dropdownlist'])->name('Product.dropdownlist');
		
Route::resource('Product', ProductController::class);
Route::post('Product/update', [ProductController::class,'update'])->name('Product.update');

Route::get('Product/destroy/{id}', [ProductController::class,'destroy']);	


Route::resource('productcaategory', productCategoryController::class);
Route::post('productcaategory/update', [productCategoryController::class,'update'])->name('productcaategory.update');

Route::get('productcaategory/destroy/{id}', [productCategoryController::class,'destroy']);
	


Route::resource('productcompany', ProductCompanyController::class);


	
	
	
Route::resource('areacode', AreaController::class);
Route::post('areacode/update', [AreaController::class,'update'])->name('areacode.update');

Route::get('areacode/destroy/{id}', [AreaController::class,'destroy']);
	
	
	
	
Route::get('customer/areacode', [CustomerController::class, 'areacode'])->name('customer.areacode');
		
Route::resource('customer', CustomerController::class);

	
	
	
// agent details 


Route::resource('agentlist',  agentdetailcontroller::class);
Route::post('agentlist/update', [ agentdetailcontroller::class,'update'])->name('agentlist.update');


Route::get('agentlist/destroy/{id}', [ agentdetailcontroller::class,'destroy']);
	
	




// agent transaction 

// agent transaction 

Route::get('agenttransaction/selectagent', [AgenttransactionControllerController::class, 'selectagent'])->name('agenttransaction.selectagent');

Route::post('agentfetch', [AgenttransactionControllerController::class, 'agentfetch'])->name('agenttransaction.agentfetch');

Route::get('agenttransaction/pdf/{id}', [AgenttransactionControllerController::class, 'printpdf'])->name('agenttransaction.pdf');

 //Route::post('agenttransaction/paid/{id}', [AgenttransactionControllerController::class, 'paid'])->name('agenttransaction.paid');

Route::post('agenttransaction/paid', [AgenttransactionControllerController::class, 'paid'])->name('agenttransaction.paid');

Route::get('agenttransaction/paidsenddata/{id}', [AgenttransactionControllerController::class, 'paidsenddata'])->name('agenttransaction.paidsenddata');


Route::get('agenttransaction/dropdown_list', [AgenttransactionControllerController::class, 'dropdown_list'])->name('agenttransaction.dropdown_list');
Route::resource('agenttransaction',  AgenttransactionControllerController::class);
Route::post('agenttransaction/update', [ AgenttransactionControllerController::class,'update'])->name('agenttransaction.update');


	
// employee list 


Route::resource('employeelist',  employeedetailscontroller::class);
Route::post('employeelist/update', [ employeedetailscontroller::class,'update'])->name('employeelist.update');


Route::get('employeelist/destroy/{id}', [ employeedetailscontroller::class,'destroy']);








//hospital service 

Route::get('servicelist/dropdown_list', [ servicelisthospitalController::class,'dropdown_list'])->name('servicelist.dropdown_list');
Route::resource('servicelist',  servicelisthospitalController::class);
Route::post('servicelist/update', [ servicelisthospitalController::class,'update'])->name('servicelist.update');


Route::get('servicelist/destroy/{id}', [ servicelisthospitalController::class,'destroy']);

// service transtion controller servicetranstionController

Route::resource('servicetranstion',  servicetranstionController::class);







 
// employee transaction delete 

Route::get('employeetransactioncon/destroy/{id}', [ employeetransactioncontroller::class,'destroy']);


///////////////  external cost transaction delete 
Route::get('externalcost/destroy/{id}', [ externalcostcontroller::class,'destroy']);










// income provider due payemnt

Route::get('incomeproviderduetrans/dropdownlist', [ incomeproviderduetransitionController::class,'dropdownlist'])->name('incomeproviderduetrans.dropdownlist');

Route::resource('incomeproviderduetrans',  incomeproviderduetransitionController::class);
Route::post('incomeproviderduetrans/update', [ incomeproviderduetransitionController::class,'update'])->name('incomeproviderduetrans.update');

Route::get('incomeproviderduetrans/destroy/{id}', [ incomeproviderduetransitionController::class,'destroy']);








//////////   dhar shod korun othoba advance bujhe pan 





Route::get('supplierduepayemnt/dropdownlist', [ supplierduepaymentController::class,'dropdownlist'])->name('supplierduepayemnt.dropdownlist');

Route::resource('supplierduepayemnt',  supplierduepaymentController::class);
Route::post('supplierduepayemnt/update', [ supplierduepaymentController::class,'update'])->name('supplierduepayemnt.update');

Route::get('supplierduepayemnt/destroy/{id}', [ supplierduepaymentController::class,'destroy']);













///////////// Taka uttolon o joma  transaction   

Route::get('takauttolon/dropdown_list', [TakaUttolonTransitionController::class, 'dropdown_list'])->name('takauttolon.dropdown_list');

Route::resource('takauttolon',  TakaUttolonTransitionController::class);
//Route::post('khorochtransition/update', [ KhorochTransitionConTrollerController::class,'update'])->name('khorochtransition.update');

Route::get('takauttolon/destroy/{id}', [ TakaUttolonTransitionController::class,'destroy']);








///////////// business Partner   


Route::resource('businesspartner',  CreatePartnerController::class);
Route::post('businesspartner/update', [ CreatePartnerController::class,'update'])->name('businesspartner.update');

Route::get('businesspartner/destroy/{id}', [ CreatePartnerController::class,'destroy']);


///////////////////////// Taka uttolon o joma report ////////////////////////////////



 Route::get('joma_uttolon_statement_today', [joma_uttolon_report_statement_Controller::class, 'todaystatement'])->name('joma_uttolon_statement_today');


 Route::get('joma_uttolon_statement_yesterday', [joma_uttolon_report_statement_Controller::class, 'yesterdaystatment'])->name('joma_uttolon_statement_yesterday');


 Route::get('joma_uttolon_statement_month', [joma_uttolon_report_statement_Controller::class, 'thismonthstatment'])->name('joma_uttolon_statement_month');

 Route::get('joma_uttolon_statement_year', [joma_uttolon_report_statement_Controller::class, 'thisyear'])->name('joma_uttolon_statement_year');

 Route::get('joma_uttolon_statement_lastmonth', [joma_uttolon_report_statement_Controller::class, 'lastmonth'])->name('joma_uttolon_statement_lastmonth');

// Route::post('incomestatbtwtwodate', [incomestatemnetController::class, 'recordbetweentwodate'])->name('incomestatbtwtwodate');

//Route::get('/picktwodate', function () {
//    return view('incomestatement.picktwodate');
//});










Route::get('/picktwodatefordoctortransition', function () {
    return view('incomefromdoctoroutdoor.picktwodate');
});
//// show due transition 




























//////// check balance 
 Route::get('balance', [BalanceController::class, 'index'])->name('balance');
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
// khoroch 



Route::get('khorocer_khad/dropdownlistforchild/{id}', [Create_khorocer_khad_Controller::class, 'dropdownlistforchild'])->name('khorocer_khad.dropdownlistforchild');

Route::get('khorocer_khad/dropdownlist', [Create_khorocer_khad_Controller::class, 'dropdownlist'])->name('khorocer_khad.dropdownlist');







Route::get('khorochtransition/fourthlevel/{id}', [KhorochTransitionConTrollerController::class, 'fourthlevel'])->name('khorochtransition.fourthlevel');


Route::get('khorochtransition/thirdlevel/{id}', [KhorochTransitionConTrollerController::class, 'thirdlevel'])->name('khorochtransition.thirdlevel');


Route::get('khorochtransition/secondlevel/{id}', [KhorochTransitionConTrollerController::class, 'secondlevel'])->name('khorochtransition.secondlevel');






Route::get('khorochtransition/dropdown_list', [KhorochTransitionConTrollerController::class, 'dropdown_list'])->name('khorochtransition.dropdown_list');
Route::resource('khorochtransition',  KhorochTransitionConTrollerController::class);





// money give to take from project

Route::get('moneyexchange/dropdownlist', [moneyexchangeController::class, 'dropdownlist'])->name('moneyexchange.dropdownlist');
Route::resource('moneyexchange',  moneyexchangeController::class);


Route::post('moneyexchange/update', [ moneyexchangeController::class,'update'])->name('moneyexchange.update');


Route::get('moneyexchange/destroy/{id}', [ moneyexchangeController::class,'destroy']);









		
		






/// employee transaction 


 


 Route::get('month_year_pick', [employeetransactioncontroller::class, 'month_year_pick'])->name('employeetransactioncon.month_year_pick');

 Route::post('month_year_pick_fetch', [employeetransactioncontroller::class, 'month_year_pick_fetch'])->name('employeetransactioncon.month_year_pick_fetch');

 Route::get('datepic', [employeetransactioncontroller::class, 'datepick'])->name('employeetransactioncon.datepick');

 Route::post('employeesalarymonth', [employeetransactioncontroller::class, 'employeesalarymonth'])->name('employeetransactioncon.employeesalarymonth');



 Route::get('employeeshow', [employeetransactioncontroller::class, 'employeeshow'])->name('employeetransactioncon.employeeshow');

 Route::post('employeesalaryfetch', [employeetransactioncontroller::class, 'employeesalaryfetch'])->name('employeetransactioncon.employeesalaryfetch');



Route::get('employeetransactioncon/dropdown_list', [employeetransactioncontroller::class, 'dropdown_list'])->name('employeetransactioncon.dropdown_list');
Route::resource('employeetransactioncon',  employeetransactioncontroller::class);
Route::post('employeetransactioncon/update', [ employeetransactioncontroller::class,'update'])->name('employeetransactioncon.update');






// external cost 

Route::resource('externalcost',  externalcostcontroller::class);
Route::post('externalcost/update', [ externalcostcontroller::class,'update'])->name('externalcost.update');


















		
		


       
});
 
 
 ///////////////////////////////////////////////////
 



Route::group([ 'middleware'=>['auth','PreventBackHistory','isUser']], function(){
   // Route::get('dashboard',[UserController::class,'index'])->name('user.mdashboard');
  
         Route::get('userdashboard',[userdashboardController::class,'index'])->name('userdashboard.dashboard'); 

  
  

});  







Route::group([ 'middleware'=>['auth','customer','PreventBackHistory']], function(){


 Route::get('customerdashboard',[custommerdashboardController::class,'index'])->name('customer.dashboard');

Route::get('balancesheetcustomerself', [balancesheetforCustomer::class, 'customerbalanceforself'])->name('balancesheetforCustomer.customerbalanceforself');
Route::get('self_balance', [SelfBalanceSheetController::class, 'index'])->name('selfbalance.index');
Route::post('self_balance/fetch', [SelfBalanceSheetController::class, 'fetch'])->name('selfbalance.fetch');

Route::post('balancesheetself', [balancesheetforCustomer::class, 'balancesheetself'])->name('balancesheetforCustomer.customerbalanceself');

Route::get('balancesheetforCustomer/pdf/{id}', [balancesheetforCustomer::class, 'printvoucher'])->name('balancesheetforCustomer.pdf');

Route::resource('balancesheetforCustomer',  balancesheetforCustomer::class);
Route::post('balancesheetforCustomer/update', [ balancesheetforCustomer::class,'update'])->name('balancesheetforCustomer.update');

Route::get('balancesheetforCustomer/destroy/{id}', [ balancesheetforCustomer::class,'destroy']);






       
});

















 



Route::group([ 'middleware'=>['auth','isProjectsupervisors','PreventBackHistory']], function(){


 Route::get('dashboard',[projectsuperviserloginController::class,'index'])->name('projectmanager.dashboard');



Route::get('productcompanytrans/purchase', [productcompanytransitionController::class, 'purchase'])->name('productcompanytrans.purchase');


Route::post('productcompanytrans/purchasefetch', [productcompanytransitionController::class, 'purchasefetch'])->name('productcompanytrans.purchasefetch');



Route::get('productcompanytrans/dropdownlist', [productcompanytransitionController::class, 'dropdownlist'])->name('productcompanytrans.dropdownlist');

Route::resource('productcompanytrans',  productcompanytransitionController::class);










Route::get('productcompanduetra/dropdownlist', [companyduepaymentController::class, 'dropdownlist'])->name('productcompanduetra.dropdownlist');

Route::resource('productcompanduetra',  companyduepaymentController::class);









       
});










<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use DataTables;
use Validator;
use App\Models\balance_of_business; 

use App\Models\cashtransition; 

use App\Models\project;
use App\Models\Productcompany;
use App\Models\Product;  
use App\Models\productcompanyorder;
use App\Models\productcompanytransition;
use App\Models\User;

use App\Models\superviser;
use App\Models\project_supervisor;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Redirect;
use PDF;

$status=0;
class companyduepaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	       public function index(Request $request)
    {
     
	 $productcompanyorder=  productcompanyorder::with('productcompanytransition','Productcompany','user')->where('type',2)->OrWhere('type',4)->orderBy('id','DESC')->get();
	  
	
	  
	        if ($request->ajax()) {
              $productcompanyorder=  productcompanyorder::with('productcompanytransition','Productcompany','user')->where('type',2)->OrWhere('type',4)->orderBy('id','DESC')->get();
            return Datatables::of($productcompanyorder)
                   ->addIndexColumn()
                    ->addColumn('action', function( productcompanyorder $data){ 
   
  
                          $button = '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        $button .= '&nbsp;&nbsp;';
                        //$button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
   

 
   
                    })  
                              


							  ->addColumn('adjustby', function (productcompanyorder $productcompanyorder) {
                     if ( $productcompanyorder->adjusttype == 1 )
					 {
						 
					return "Owner's fund";	 
					 }
					 else if ( $productcompanyorder->adjusttype == 2 )
					 {
						return "Accountant's fund";	  
						 
					 }
					 else if ( $productcompanyorder->adjusttype == 3 )
					 {
						return "Project's fund";	   
						 
					 }
					 else if ( $productcompanyorder->adjusttype == null )
					 {
						return "NA";	   
						 
					 }
					 
	 
					 
                })


				->addColumn('accountant', function (productcompanyorder $productcompanyorder) {
                   
if ($productcompanyorder->account_id)
{
				   return $productcompanyorder->account->name;
}else{
	
	return "NA";
}
                })

				->addColumn('superviser', function (productcompanyorder $productcompanyorder) {
                   
if ($productcompanyorder->superviser_id)
{
				   return $productcompanyorder->superviser->name;
}else{
	
	return "NA";
}
                })


				->addColumn('project', function (productcompanyorder $productcompanyorder) {
                   
if ($productcompanyorder->project_id)
{
				   return $productcompanyorder->project->name;
}else{
	
	return "NA";
}
                })







							  ->addColumn('companyname', function (productcompanyorder $productcompanyorder) {
                    return $productcompanyorder->Productcompany->name;
                })
				
									  ->addColumn('entryby', function (productcompanyorder $productcompanyorder) {
                    return $productcompanyorder->user->name;
                })
					

                 ->editColumn('created', function(productcompanyorder $data) {
					
					 return convertToBangla(date('d/m/y', strtotime($data->created_at) ));
                    
                })
				
->addColumn('amount', function (productcompanyorder $productcompanyorder) {
return convertToBangla($productcompanyorder->amount);
})
->addColumn('credit', function (productcompanyorder $productcompanyorder) {
return convertToBangla($productcompanyorder->credit);
})				
->addColumn('debit', function (productcompanyorder $productcompanyorder) {
return convertToBangla($productcompanyorder->debit);
})
->addColumn('id', function (productcompanyorder $productcompanyorder) {
return convertToBangla($productcompanyorder->id);
})					
					
                    ->rawColumns(['action','created' ])

                    ->make(true);
					
					

        }
      
        return view('companyduepayment.duepayment', compact('productcompanyorder'));   

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



	    public function  dropdownlist()
    {
		
		$project = project::where('softdelete',0)->orderBy('name')->get();
	
     			 $shopid = Auth()->user()->balance_of_business_id;
     
	   $productdata = Product::where('balance_of_business_id',$shopid)->where('softdelete', 0)->orderBy('name')->get(); 
	   
	   
	  
		 
		 $Productcompany = Productcompany::where('balance_of_business_id',$shopid)->where('softdelete', 0)->orderBy('name')->get();

			
			
 $accountant = user::where('role',4)->orderBy('name')->get();
     $project_supervisor = superviser::where('softdelete',0)->orderBy('name')->get();			
			
			
			
			
			
			
            return response()->json(['Productcompany' => $Productcompany , 'productdata' => $productdata,'project'=>$project,
'accountant'=> $accountant, 'project_supervisor'=>$project_supervisor ,


			]);

	   
	   
	   
    } 


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      DB::transaction(function () use ($request) {
		
		
  
	$validated = $request->validate([
	
	 	'company_Id',
		'unit_price',
		'quantity',
		'stock',
		'vat',
		'vattk',
		'discount',
		'totaldiscount',
		'amount',
		'adjust',
		'percentofdicountontaotal',
		'grossamount',
		'discountatend',
		'paid',
		'due',
		'totalamount',
'statusvalue',
'medicine_name',
'type',
'accountant',
'supervisor',
'adjusttype',		
		
    ]);
	
	
$request->grossamount = convertToEnglish($request->grossamount);
$request->percentofdicountontaotal = convertToEnglish($request->percentofdicountontaotal);	
$request->discountatend = convertToEnglish($request->discountatend);	
$request->balance = convertToEnglish($request->balance);	
	

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














	$company = Productcompany::findOrFail($request->company_Id);	

	 
		if ($request->type == 2)
		{
				
		$s = $company->due -  $request->grossamount;
		
		// if ($s  < 0)
		// {
		// 	global $status; 
		// 	$status=1;
		// 	goto flag;
		
		
		// }
		// else{
		//////////////////////////////////////////////////// insert shuru ///////////////////////
		
		
		 $serialno = productcompanyorder::where('productcompany_id',$request->company_Id)->orderBy('id', 'desc')->first();

 if ($serialno== '')
 {
	 $serial=1;
 }
 else{
$serial= $serialno->serialno+1;
 }		
		
		
		
		
		
	$productorder = new productcompanyorder(); 
		$productorder->user_id  = auth()->user()->id ; //$request->sellerid;
	$productorder->productcompany_id  = $request->company_Id;
	$productorder->project_id  = $request->project_id;
	$productorder->created_at  = $request->Date_of_Transition;	
	
	
	
	
	$productorder->serialno  = $serial;
	$productorder->amount  = $request->grossamount; 
	$productorder->discount  = $request->discountatend; 
	$productorder->amountafterdiscount	  = $request->paid; 
	
	$productorder->balance_of_business_id = Auth()->user()->balance_of_business_id;
	
	$productorder->comment  =$request->comment; 
	$productorder->debit  = 0;
	$productorder->credit  = $request->grossamount;
	$productorder->balance  =   $company->due -  $request->grossamount;
	$productorder->type  = 2;
	
	
	$productorder->superviser_id  = $request->supervisor;	
$productorder->account_id  = $request->accountant;
$productorder->adjusttype  = $request->adjusttype;	

	
	
	
	$due = $request->due;
	$id= $request->company_Id;
	

	$dueamount = $company->due - $request->grossamount;


//// update company due 
Productcompany::where('id', $request->company_Id )
       ->update([
           'due' => $dueamount
        ]);

/////////// update company balance 
  
			 $shopid = Auth()->user()->balance_of_business_id;
  
  $balance =  balance_of_business::findOrFail($shopid);

   balance_of_business::where('id',  $shopid)
  ->update(['balance' =>(   $balance->balance - $request->paid )  ]);	


	$productorder->save();
	
	
		
	$cashtransition = new cashtransition();
$cashtransition->balance_of_business_id = Auth()->user()->balance_of_business_id;
$cashtransition->productcompany_id = $request->company_Id;
$cashtransition->User_id = Auth()->user()->id;
$cashtransition->productcompanyorder_id = $productorder->id;
$cashtransition->amount = $request->paid;
$cashtransition->withdrwal = $request->paid;	
$cashtransition->type = 2;
$cashtransition->transtype = 10;
$cashtransition->project_id = $request->project_id;
	$cashtransition->created_at  = $request->Date_of_Transition;	
$cashtransition->superviser_id  = $request->supervisor;	
$cashtransition->adjusttype = $request->adjusttype;
$cashtransition->account_id = $request->accountant;


$cashtransition->description = " সাপ্লাইয়ারকে ডিউ/এডভান্স বাবদ টাকা প্রদান : "  .$company->name ;
$cashtransition->save();		
		
		
		
		
		
		
		
		
		
		
		
		
		//}
		
		
		
		
		
		}
if ($request->type == 4)
{
 
 
 $t=  $company->due +  $request->grossamount;

		if ($t  > 0)
		{
			global $status; 
			$status=2;
			goto flag;
		
		
		}
		else{ 
		//////////////////////////////////////////////////// insert shuru ///////////////////////
		
		
		 $serialno = productcompanyorder::where('productcompany_id',$request->company_Id)->orderBy('id', 'desc')->first();

 if ($serialno== '')
 {
	 $serial=1;
 }
 else{
$serial= $serialno->serialno+1;
 }		
		
		
		
		
		
		
		$productorder = new productcompanyorder(); 
		$productorder->user_id  = auth()->user()->id ; //$request->sellerid;
	$productorder->productcompany_id  = $request->company_Id;
	$productorder->serialno  = $serial;
	$productorder->amount  = $request->grossamount; 
	$productorder->discount  = $request->discountatend; 
		$productorder->amountafterdiscount	  = $request->paid; 
		$productorder->balance_of_business_id = Auth()->user()->balance_of_business_id;
	
	$productorder->comment  =$request->comment; 
	$productorder->debit  = $request->grossamount;
	$productorder->credit  = 0;
	$productorder->balance  =   $company->due +  $request->grossamount;
	$productorder->type  = 4;
	
		$productorder->project_id  = $request->project_id;
	$productorder->created_at  = $request->Date_of_Transition;	

	
	
	
	$due = $request->due;
	$id= $request->company_Id;
	

	$dueamount = $company->due +  $request->grossamount; 


//// update company due 
Productcompany::where('id', $request->company_Id )
       ->update([
           'due' => $dueamount
        ]);

/////////// update company balance 
  
			 $shopid = Auth()->user()->balance_of_business_id;
  
  $balance =  balance_of_business::findOrFail($shopid);

   balance_of_business::where('id',  $shopid)
  ->update(['balance' =>(   $balance->balance + $request->paid )  ]);	


	$productorder->save();
	
	
	
	
	
		$cashtransition = new cashtransition();
$cashtransition->balance_of_business_id = Auth()->user()->balance_of_business_id;
$cashtransition->productcompany_id = $request->company_Id;
$cashtransition->User_id = Auth()->user()->id;
$cashtransition->productcompanyorder_id = $productorder->id;
$cashtransition->amount = $request->paid;
$cashtransition->deposit = $request->paid;
$cashtransition->project_id = $request->project_id;	
$cashtransition->type = 1;
$cashtransition->description = "সাপ্লাইয়ার থেকে টাকা ফেরত পাওয়া : "  .$company->name  ;
	$cashtransition->created_at  = $request->Date_of_Transition;
$cashtransition->transtype = 11;

$cashtransition->save();
	
	
	
	
	
	
	
	
	
	
	
	
		}














}	
	



flag:		

});	
global $status;
if ($status == 1)
{
 return response()->json(['success' => 'ভুল হচ্ছে। কোম্পানি কে আপনি আপনার বাকি থেকে বেশি টাকা দিয়ে ফেলেছেন  ']);	
}
elseif ($status == 2)
 
{

return response()->json(['success' => 'ভুল হচ্ছে। কোম্পানি আপনার কাছে বকেয়া টাকা পায়।  ']);	

}	
else{
	
return response()->json(['success' => ' Data Added successfully ']);	
	
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
		
		DB::transaction(function () use ($id ) {
                 $data = productcompanyorder::with('productcompanytransition','Productcompany','user')->findOrFail($id);

if ($data->type == 2)
{ 
	  $i = $data->productcompany_id;
$presentdue = Productcompany::findOrFail($data->productcompany_id)->due;

 Productcompany::where('id', $i )
  ->update(['due' =>(   $presentdue + $data->amount )  ]);	

/////////// update company balance 
  
  
  			 $shopid = Auth()->user()->balance_of_business_id;
  
  $balance =  balance_of_business::findOrFail($shopid);

   balance_of_business::where('id',  $shopid)

  ->update(['balance' =>(   $balance->balance + $data->amountafterdiscount	 )  ]);	

 cashtransition::where('productcompanyorder_id', $id )->delete();
	$data->delete();			 
	
}



if ($data->type == 4)
{
	  $i = $data->productcompany_id;
$presentdue = Productcompany::findOrFail($data->productcompany_id)->due;

 Productcompany::where('id', $i )
  ->update(['due' =>(   $presentdue - $data->debit )  ]);	

/////////// update company balance 
  
  			 $shopid = Auth()->user()->balance_of_business_id;
  
  $balance =  balance_of_business::findOrFail($shopid);

   balance_of_business::where('id',  $shopid)
  ->update(['balance' =>(   $balance->balance - $data->debit )  ]);	


 cashtransition::where('productcompanyorder_id', $id )->delete();
	$data->delete();


	
	
}





});

	 
		 

	   
	  return response()->json(['success' => 'Reverse entry added successfully .']);   
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;










use DataTables;
use Validator;
use App\Models\balance_of_business; 
use App\Models\project; 
use App\Models\cashtransition; 
use App\Models\go_down_stock; 



use App\Models\Customer;
use App\Models\Product;  
use App\Models\productorder;
use App\Models\producttransition;
use App\Models\User;

use App\Models\projectstock;

use App\Models\unitcoversion;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Redirect;
use App\Models\productpriceaccunit;



use PDF;
$jsonmessage=0;
$status=0;



class producttransitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	       public function index(Request $request)
    {
      $productorder=  productorder::with('producttransition','Customer','user')->where('type', 1)->latest()->get();
	  
	
	  
	        if ($request->ajax()) {
                $productorder=  productorder::with('producttransition','Customer','user')->where('type', 1)->latest()->get();
            return Datatables::of($productorder)
                   ->addIndexColumn()
                    ->addColumn('action', function( productorder $data){ 
   
                          $button = '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        $button .= '&nbsp;&nbsp;';
                        //$button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    })  
                              


							  ->addColumn('projectname', function (productorder $productorder) {
                    return $productorder->project->name;
                })
				
									  ->addColumn('entryby', function (productorder $productorder) {
                    return $productorder->user->name;
                })
					

                 ->editColumn('created', function(productorder $data) {
					
					 return date('d/m/y h:i A', strtotime($data->created_at) );
                    
                })
				
             ->editColumn('pdf', function ($productorder) {
                return '<a   target="_blank"      href="'.route('producttransition.pdf', $productorder->id).'">Print</a>';
            })
				

					
					
                    ->rawColumns(['action','pdf','created' ])

                    ->make(true);
					
					

        }
      
        return view('producttransition.producttransition', compact('productorder'));   

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
	    public function  dropdownlist()
    {
		
		
				 $shopid = Auth()->user()->balance_of_business_id;
     
      // $patientdata = patient::where('booking_status', 0)->orWhere('booking_status', 1)->get(); 
	   $productdata = Product::where('softdelete', 0)->orderBy('name')->get(); 
	   
	   
	  $project = project::where('softdelete',0)->orderBy('name')->get();
		 
		 $customer = Customer::where('balance_of_business_id',$shopid)->where('softdelete', 0)->orderBy('name')->get();
$unit = unitcoversion::where('softdelete', 0)->orderBy('name')->get();
			
            return response()->json(['customer' => $customer ,'project'=>$project, 'unit'=>$unit, 'productdata' => $productdata]);

	   
	   
	   
    } 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
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
		
			
	DB::transaction(function () use ($request) {
		
		
  
	$validated = $request->validate([
	
	 	'customer_id',
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
'unit',
		
		
    ]);
	
	$variable_for_product="";
$project = project::findOrFail($request->project_id)->name;

		global $status;
	    for ($product_id = 0; $product_id < count($request->medicine_name); $product_id++ ) 

	{
			
	$p =    productpriceaccunit::where('unitcoversion_id',  $request->unit[$product_id])->where('product_id',  $request->medicine_name[$product_id] )->first() ;

 $unitconverter= unitcoversion::findOrFail($p->unitcoversion_id)->coversionamount;
  	
		
$diff =	  $p->stock - $request->quantity[$product_id] ;	
	
	if (  $diff < 0 )
	{

		$status = 2;	
		break;		
	}
	
		
		
		
	}



	if (  $status == 2 )
	{
		
		goto flag;
			
	}





		
		
		//////////////////////////////////////////////////// insert shuru ///////////////////////
		
	
///// transition serial 	
		 $serialno = productorder::where('customer_id',$request->customer_id)->orderBy('id', 'desc')->first();

 if ($serialno== '')
 {
	 $serial=1;
 }
 else{
$serial= $serialno->serialno+1;
 }
	
		
		
		
		
		
		$productorder = new productorder; 
		$productorder->user_id  = auth()->user()->id ; //$request->sellerid;
	$productorder->project_id  = $request->project_id;
	$productorder->serialno  = $serial;
	$productorder->balance_of_business_id  = auth()->user()->balance_of_business_id ;
	$productorder->amount  = $request->grossamount; 
	$productorder->discount  = $request->discountatend;
	$productorder->amountafterdiscount	  = $request->totalamount;
	$productorder->comment  =$request->comment; 
	$productorder->debit  = $request->due;
	$productorder->credit  = $request->paid;

	$productorder->	type  = 1;
	
		$productorder->save();
	
	











	
		

	
	
	
	
	
	
	
	

    $order_id = $productorder->id;
	
	

	
	
	
	
	
	
	
	
	
	
	
	

    for ($product_id = 0; $product_id < count($request->medicine_name); $product_id++ ) 

	{

		
		
	// update stock 


$p =    productpriceaccunit::where('unitcoversion_id',  $request->unit[$product_id])->where('product_id',  $request->medicine_name[$product_id] )->first() ;

 $unitconverter= unitcoversion::findOrFail($p->unitcoversion_id)->coversionamount;
  

   productpriceaccunit::where('unitcoversion_id',  $request->unit[$product_id])->where('product_id',  $request->medicine_name[$product_id] )->where('balance_of_business_id',  Auth()->user()->balance_of_business_id)
  ->update(['stock' =>(   $p->stock - $request->quantity[$product_id] )  ]);	











	
	$projectstock = projectstock::where('product_id', $request->medicine_name[$product_id]  )->where('unitcoversion_id',  $request->unit[$product_id])->first();
	
	if($projectstock  != null )
	{
		
	   projectstock::where('id',  $projectstock->id )
  ->update(['stock' =>(   $projectstock->stock + $request->quantity[$product_id] )  ]);		
		
		
	}
	else{
		
	$projectstock = new projectstock();
$projectstock->product_id =	$request->medicine_name[$product_id];
$projectstock->unitcoversion_id =	$request->unit[$product_id];	
$projectstock->project_id = $request->project_id;
$projectstock->user_id =	Auth()->user()->id;	
$projectstock->stock = $request->quantity[$product_id];
$projectstock->unitprice = $request->unit_price[$product_id];
$projectstock->save(); 

	
	
	
	
	
	
	
	
	
}





















///////////////////	
		       
		
		
		
       $producttransition = new producttransition; 
	   $producttransition->productorder_id = $order_id;
	    $producttransition->project_id =$request->project_id;
	 $producttransition->user_id =  auth()->user()->id ;
	 
	$producttransition->balance_of_business_id  = auth()->user()->balance_of_business_id ; 
	 
	 $producttransition->product_id = $request->medicine_name[$product_id];
	$producttransition->unitcoversion_id = $request->unit[$product_id];  
	  // asole medicine_name[] er vetore id neya hoyeche. form bananor somoy name lekha hoyechecilo pore ar change kora hoy nai 
	

	$producttransition->type  = 1;
    
  $producttransition->unirprice =  $request->unit_price[$product_id]; 
  
 $unitconverter= unitcoversion::findOrFail($request->unit[$product_id])->coversionamount;
  
  $quantity = $unitconverter * $request->quantity[$product_id];
		$producttransition->quantity =  $request->quantity[$product_id];
	//	 product::where('id',$request->medicine_name[$product_id] )->decrement('stock', $quantity );
		 
		 $unitname=unitcoversion::findOrFail($request->unit[$product_id])->name;
		

// 

$product_name=	product::findOrFail($request->medicine_name[$product_id])->name;
	
		 $variable_for_product = $variable_for_product. " product Name: " .$product_name. " product Unit: " .$unitname;
		 
		 
 $producttransition->unitname =  $unitname;
 $producttransition->quantityinbase =  $quantity;	 
 $producttransition->sellingunit = $request->unit[$product_id];	
		 
		 $qun= $request->quantity[$product_id];
		 
		 		 if ($request->percentofdicountontaotal > 0)
		 {
			 
			 $discount_amount =   $request->grossamount - $request->totalamount;
			 
			 $percentage =      (   $discount_amount * 100)/ $request->grossamount   ; 
			 
			 
			 
			  
			 $discount = (($request->unit_price[$product_id] * $qun)* ($percentage/100) ) ; 
			
		
             $amount = ($request->unit_price[$product_id] * $qun) - $discount; 
			 
			 $producttransition->discountpercentage = $percentage;
			 $producttransition->discount	 = $discount;
			
			
		     $producttransition->amount = $request->amount[$product_id];
		 $producttransition->finalamountafterdiscount = $amount;
		 
			 
		}
		 else {
				 
		 $producttransition->discountpercentage = $request->discount[$product_id];
		 $producttransition->discount	 = $request->totaldiscount[$product_id];
		 $producttransition->amount = $request->amount[$product_id];
		  $producttransition->finalamountafterdiscount	 = $request->adjust[$product_id];
		 }
		 
 

		  $producttransition->save(); 
		 
	


	}		



	$cashtransition = new cashtransition();
$cashtransition->balance_of_business_id = Auth()->user()->balance_of_business_id;
$cashtransition->project_id = $request->project_id;
$cashtransition->User_id = Auth()->user()->id;
$cashtransition->productorder_id = $productorder->id;
$cashtransition->amount = $request->paid;
$cashtransition->deposit = $request->paid;	
$cashtransition->type = 1;
$cashtransition->transtype = 7;
$cashtransition->description = "Product Sell to the project:- " .$project. " Description: " .$variable_for_product. " Due Amount: " .$request->due ;
$cashtransition->save();		
				
		
flag:
});	
     

global $status; 



if($status ==2   )
{
        return response()->json(['success' => 'Products are not avilable in Stock']);
}

else{


return response()->json(['success' => 'Products are given to Projects']);	
}



    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	 
	 
	 
	 
public function producttransfetch()
{

   $customer = customer::where('softdelete', 0)->orderBy('name')->get();
	return view('product.datepick', compact('customer'));   



}	
	 
	
public function convertstock()
{
$product = product::where('softdelete', 0)->orderBy('name')->get();
$message="";
	return view('product.selectproduct', compact('product','message')); 
}	





public function changeprojectstock()
{
		
$product = product::where('softdelete', 0)->orderBy('name')->get();

	$project = project::where('softdelete', 0)->orderBy('name')->get();
	
	
	$unitcoversion = unitcoversion::where('softdelete', 0)->orderBy('name')->get();
	
$message="";
	return view('product.transferproduct', compact('product','message','project','unitcoversion',)); 	
}

public function transferstock(Request $request)
{

$projectstock = projectstock::where('product_id',  $request->product )->where('project_id', $request->fromproject)->where('unitcoversion_id', $request->unitcoversion  )->first();


if($projectstock == null )
{
	$message="Products are not avilable";
//return view('product.messageshow', compact('message'));		


return redirect()->route('producttransition.failmsg');	
	
	
}


if ($request->conversionamount > $projectstock->stock  )
{
	
$message="Products are not avilable";
	// return view('product.messageshow', compact('message'));	


return redirect()->route('producttransition.failmsg');	
	
}

else{
	DB::beginTransaction(); 
	
	$currentstockproject = 	$projectstock->stock - $request->conversionamount;
	
		  projectstock::where('product_id',  $request->product )->where('project_id', $request->fromproject)->where('unitcoversion_id', $request->unitcoversion  )->first()->
  update(['stock' =>(   $currentstockproject )  ]);	
  
  
  
  
 $toprojectstock = projectstock::where('product_id',  $request->product )->where('project_id', $request->toproject)->where('unitcoversion_id', $request->unitcoversion  )->first(); 
  
  if ($toprojectstock == null ){
	  
	 $toprojectstock = new projectstock();

$toprojectstock->product_id = $request->product;
$toprojectstock->project_id = $request->toproject;
$toprojectstock->user_id = Auth()->user()->id;
$toprojectstock->unitcoversion_id	 = $request->unitcoversion;
$toprojectstock->stock = $request->conversionamount;
$toprojectstock->unitprice = $projectstock->unitprice;
$toprojectstock->save(); 
 	  
  }
  else{
	  
	   $presentstock = $toprojectstock->stock + $request->conversionamount;
		  projectstock::where('product_id',  $request->product )->where('project_id', $request->toproject)->where('unitcoversion_id', $request->unitcoversion  )->first()
		  
		 
		  
  ->update(['stock' =>(   $presentstock )  ]);		  
	  
  }
   DB::commit();

$message="Products transfered Successfully.";
	// return view('product.messageshow', compact('message'));		
	
return redirect()->route('producttransition.successmsg');	
	
	
}






}



public function successmsg(){
	
return view ('product.successmsg')	;
	
}

public function failmsg(){
	
return view ('product.failmsg')	;	
}





// successmsg






public function convertstockfetch(Request $request)
{

	DB::transaction(function () use ($request) {
$product= product::findOrFail($request->product);
  $productpriceaccunit_sell  = productpriceaccunit::with('unitcoversion')->where('product_id', $product->id)

->where('balance_of_business_id', Auth()->user()->balance_of_business_id )

->get();



$productpriceaccunit = go_down_stock::with('unitcoversion')->where('product_id', $product->id)

->where('balance_of_business_id', Auth()->user()->balance_of_business_id )

->get();

});


	return view('product.fetchforconvertstock', compact('product','productpriceaccunit','productpriceaccunit_sell'));   



}	




public function stock_sale_to_godown()
{
$product = product::where('softdelete', 0)->orderBy('name')->get();
$message="";
	return view('product.stock_sale_to_godown', compact('product','message')); 
}


public function sale_to_godown(Request $request)
{
DB::transaction(function () use ($request) {

$product= product::findOrFail($request->product);
  $productpriceaccunit_sell  = productpriceaccunit::with('unitcoversion')->where('product_id', $product->id)

->where('balance_of_business_id', Auth()->user()->balance_of_business_id )

->get();



$productpriceaccunit = go_down_stock::with('unitcoversion')->where('product_id', $product->id)

->where('balance_of_business_id', Auth()->user()->balance_of_business_id )

->get();

});


	return view('product.sale_godown', compact('product','productpriceaccunit','productpriceaccunit_sell'));   



}	
































public function changegodowntosalepoint ( Request $request)
{
	DB::transaction(function () use ($request) {
	

	
	    for ($i = 0; $i < count($request->unit); $i++ ) 

	{



$go_down_stock = go_down_stock::where('product_id', $request->productid )->where('unitcoversion_id',  $request->unit[$i])->where('balance_of_business_id',  Auth()->user()->balance_of_business_id )->first();

if ($go_down_stock->stock < $request->quan[$i] )
{
	

	
	
		$product = product::where('softdelete',0)->orderBy('name')->get();
$message = "Products are not avilable in Purshing Unit. Please give Correct Input";

		return view('product.selectproduct', compact('product','message')); 
	
	
}
else{
	
	$request->tounit[$i];
	
 $unitconverter_from = unitcoversion::findOrFail($request->unit[$i])->coversionamount;
  
 $unitconverter_to = unitcoversion::findOrFail($request->tounit[$i])->coversionamount;  
  
  $quantity = $unitconverter_from * $request->quan[$i];	// convert into unique unit (kg/piece)
	
	$Reamaing_qun_go_sale_pont = $quantity % $unitconverter_to;
	
	
	$qun_go_to_sale_point = ( $quantity - $Reamaing_qun_go_sale_pont) / $unitconverter_to;

	$p =    productpriceaccunit::where('unitcoversion_id',  $request->tounit[$i])->where('product_id',  $request->productid )
->where('balance_of_business_id',  Auth()->user()->balance_of_business_id )->first();
	
     productpriceaccunit::where('id',  $p->id)
  ->update(['stock' =>(   $p->stock + $qun_go_to_sale_point )  ]);			
	

$qun_go_back_go_down = ( $quantity - $Reamaing_qun_go_sale_pont) / $unitconverter_from;
	
		$curretnt_stock_godown = $go_down_stock->stock - $request->quan[$i];
	
	  go_down_stock::where('id',  $go_down_stock->id )
  ->update(['stock' =>(   $curretnt_stock_godown )  ]);	


$basicunit_id = unitcoversion::findOrFail($go_down_stock->unitcoversion_id)->basicunit_id;

$baseid = unitcoversion::where('basicunit_id',$basicunit_id )->where('coversionamount',1 )->first();






$go_down_stock_new = go_down_stock::where('product_id', $request->productid )->where('unitcoversion_id',  $baseid->id)->where('balance_of_business_id',  Auth()->user()->balance_of_business_id )->first();

if ($go_down_stock_new == null )
{
	

$go_down_stock = new go_down_stock();	
	
		
$go_down_stock->product_id = $request->productid;	
$go_down_stock->unitcoversion_id  = $baseid->id;	
$go_down_stock->balance_of_business_id = Auth()->user()->balance_of_business_id;	
$go_down_stock->user_id = Auth()->user()->id;
$go_down_stock->stock = $Reamaing_qun_go_sale_pont;	
$go_down_stock->save();		
	
	
	
	
	
}else{
		$curretnt_stock_godown_new = $go_down_stock_new->stock + $Reamaing_qun_go_sale_pont;
	
	  go_down_stock::where('id',  $go_down_stock_new->id )
  ->update(['stock' =>(   $curretnt_stock_godown_new )  ]);		
	
	
}


	
		$product = product::where('softdelete',0)->orderBy('name')->get();
$message = "Products Transfered";

		
	
	
}


	
}


});


return view('product.selectproduct', compact('product','message'));		
}









public function change_sale_to_godown ( Request $request)
{
	DB::beginTransaction(); 
	
// 
	
	    for ($i = 0; $i < count($request->unit); $i++ ) 

	{



$productpriceaccunit = productpriceaccunit::where('product_id', $request->productid )->where('unitcoversion_id',  $request->unit[$i])->where('balance_of_business_id',  Auth()->user()->balance_of_business_id )->first();

if ($productpriceaccunit->stock < $request->quan[$i] )
{
		$product = product::where('softdelete',0)->orderBy('name')->get();
$message = "Products are not avilable in Purshing Unit. Please give Correct Input";

		return view('product.stock_sale_to_godown', compact('product','message')); 
	
	
}
else{
	
	$request->tounit[$i];
	
 $unitconverter_from = unitcoversion::findOrFail($request->unit[$i])->coversionamount;
  
 $unitconverter_to = unitcoversion::findOrFail($request->tounit[$i])->coversionamount;  
  
  $quantity = $unitconverter_from * $request->quan[$i];	// convert into unique unit (kg/piece)
	
	$Reamaing_qun_go_sale_pont = $quantity % $unitconverter_to;
	
	
	$qun_go_to_godown = ( $quantity - $Reamaing_qun_go_sale_pont) / $unitconverter_to;

	$p =    go_down_stock::where('unitcoversion_id',  $request->tounit[$i])->where('product_id',  $request->productid )
->where('balance_of_business_id',  Auth()->user()->balance_of_business_id )->first();
	
     go_down_stock::where('id',  $p->id)
  ->update(['stock' =>(   $p->stock + $qun_go_to_godown )  ]);			
	

$qun_redued_from_sale_point = ( $quantity - $Reamaing_qun_go_sale_pont) / $unitconverter_from;
	
		$current_stock_in_sale_point = $productpriceaccunit->stock - $request->quan[$i];
	
	  productpriceaccunit::where('id',  $productpriceaccunit->id )
  ->update(['stock' =>(   $current_stock_in_sale_point )  ]);	


$basicunit_id = unitcoversion::findOrFail($productpriceaccunit->unitcoversion_id)->basicunit_id;

$baseid = unitcoversion::where('basicunit_id',$basicunit_id )->where('coversionamount',1 )->first();






$productpriceaccunit_new = productpriceaccunit::where('product_id', $request->productid )->where('unitcoversion_id',  $baseid->id)->where('balance_of_business_id',  Auth()->user()->balance_of_business_id )->first();

if ($productpriceaccunit_new == null )
{
	

$productpriceaccunit = new productpriceaccunit();	
	
		
$productpriceaccunit->product_id = $request->productid;	
$productpriceaccunit->unitcoversion_id  = $baseid->id;	
$productpriceaccunit->balance_of_business_id = Auth()->user()->balance_of_business_id;	
$productpriceaccunit->user_id = Auth()->user()->id;
$productpriceaccunit->stock = $Reamaing_qun_go_sale_pont;	
$productpriceaccunit->save();		
	
	
	
	
	
}else{
		$curretnt_stock_sale_point = $productpriceaccunit_new->stock + $Reamaing_qun_go_sale_pont;
	
	  productpriceaccunit::where('id',  $productpriceaccunit_new->id )
  ->update(['stock' =>(   $curretnt_stock_sale_point )  ]);		
	
	
}


	
		$product = product::where('softdelete',0)->orderBy('name')->get();
$message = "Products Transfered";

		
	
	
}

	
	
}
  DB::commit();

return view('product.stock_sale_to_godown', compact('product','message'));	


}














public function salereportfetch(Request $request)
{
	
	DB::beginTransaction(); 
	
			        $start = date("Y-m-d",strtotime($request->input('startdate')));
        $end = date("Y-m-d",strtotime($request->input('enddate')."+1 day"));
	 $e = date("Y-m-d",strtotime($request->input('enddate')));


if ($request->customer == 99999999999999   )
{

$producttransition = producttransition::with('Product','unitcoversion')	
	 ->select( 'product_id','unitcoversion_id',   \DB::raw( 'SUM(quantity) as quantity'  ) , \DB::raw( 'SUM(quantityinbase) as quantityinbase'  ) , \DB::raw( 'SUM(amount) as 	amount'  )  ,

\DB::raw( 'SUM(discount) as 	discount'),\DB::raw( 'SUM(finalamountafterdiscount	) as 	finalamountafterdiscount'),



	 )
->whereBetween('created_at',[$start,$end])	
->where('type', 1)
->where('balance_of_business_id', Auth()->user()->balance_of_business_id )
->groupBy('product_id','unitcoversion_id')
				
 ->get();	
 
 
 
 
 
 $returnproduct = producttransition::with('Product','unitcoversion')	
	 ->select( 'product_id','unitcoversion_id',   \DB::raw( 'SUM(quantity) as quantity'  ) , \DB::raw( 'SUM(quantityinbase) as quantityinbase'  ) , \DB::raw( 'SUM(amount) as 	amount'  )  ,

\DB::raw( 'SUM(discount) as 	discount'),\DB::raw( 'SUM(finalamountafterdiscount	) as 	finalamountafterdiscount'),



	 )
->whereBetween('created_at',[$start,$end])	
->where('type', 3)
->where('balance_of_business_id', Auth()->user()->balance_of_business_id )
->groupBy('product_id','unitcoversion_id')
				
 ->get();
 
 

$product = product::with('productpriceaccunit')->orderBy('name')->get();	

$customer= "All";

	 $pdf = PDF::loadView('product.bill', compact('producttransition','start','e','product','returnproduct','customer' ),
   [], [
 'mode'                     => '',
	'format'                   => 'A5',
	'default_font_size'        => '7',
	'default_font'             => 'Times-New-Roman',
	'margin_left'              => 7,
	'margin_right'             => 7,
	'margin_top'               => 7,
	'margin_bottom'            => 7,
]
   
   
   );
	
	
	 return $pdf->stream('document.pdf');

}

else{
	
	
$producttransition = producttransition::with('Product','unitcoversion')	
	 ->select( 'product_id','unitcoversion_id',   \DB::raw( 'SUM(quantity) as quantity'  ) , \DB::raw( 'SUM(quantityinbase) as quantityinbase'  ) , \DB::raw( 'SUM(amount) as 	amount'  )  ,

\DB::raw( 'SUM(discount) as 	discount'),\DB::raw( 'SUM(finalamountafterdiscount	) as 	finalamountafterdiscount'),



	 )
->whereBetween('created_at',[$start,$end])	
->where('type', 1)
->where('customer_id', $request->customer )
->where('balance_of_business_id', Auth()->user()->balance_of_business_id )
->groupBy('product_id','unitcoversion_id')
				
 ->get();	
 
 
 
 
 
 $returnproduct = producttransition::with('Product','unitcoversion')	
	 ->select( 'product_id','unitcoversion_id',   \DB::raw( 'SUM(quantity) as quantity'  ) , \DB::raw( 'SUM(quantityinbase) as quantityinbase'  ) , \DB::raw( 'SUM(amount) as 	amount'  )  ,

\DB::raw( 'SUM(discount) as 	discount'),\DB::raw( 'SUM(finalamountafterdiscount	) as 	finalamountafterdiscount'),



	 )
->whereBetween('created_at',[$start,$end])	
->where('type', 3)
->where('customer_id', $request->customer )
->where('balance_of_business_id', Auth()->user()->balance_of_business_id )
->groupBy('product_id','unitcoversion_id')
				
 ->get();
 
 

$product = product::with('productpriceaccunit')->orderBy('name')->get();	

$customer = customer::findOrFail($request->customer)->name;

	 $pdf = PDF::loadView('product.bill', compact('producttransition','start','e','product','returnproduct','customer' ),
   [], [
 'mode'                     => '',
	'format'                   => 'A5',
	'default_font_size'        => '7',
	'default_font'             => 'Times-New-Roman',
	'margin_left'              => 7,
	'margin_right'             => 7,
	'margin_top'               => 7,
	'margin_bottom'            => 7,
]
   
   
   );
	
	
	 return $pdf->stream('document.pdf');
	
	
	
}
DB::commit();
	
}

	
	 
	 
	 
	 public function dropdowndynamic($id, $mid)
	 {
		 
	$productpriceaccunit	= productpriceaccunit::where('unitcoversion_id', $id)->where('product_id', $mid)->first(); 
	$unitprice = $productpriceaccunit->unitprice;	 
	  return response()->json(['unitprice' => $unitprice ]);	 
		 
	 }
	 
	 
		 public function fetchunit($id)
	 {
		 
	$unit	= productpriceaccunit::with('unitcoversion')->where('product_id', $id)->get(); 
	 
	  return response()->json(['unit' => $unit ]);	 
		 
	 } 
	 
	 
	 
	public function printvoucher($id)
{
	$order= productorder::findOrFail($id);
		
	$data= customer::findOrFail($order->customer_id);
					
	//	$pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('medicinetransition.medicinebill', compact('data','order' ))->setPaper('a4', 'landscape')->setWarnings(false)->save('invoice.pdf');
   // return $pdf->stream('invoice.pdf');
	
	
	
	
	
	 $pdf = PDF::loadView('producttransition.voucher', compact('data','order' ),
   [], [
 'mode'                     => '',
	'format'                   => 'A5',
	'default_font_size'        => '7',
	'default_font'             => 'Times-New-Roman',
	'margin_left'              => 7,
	'margin_right'             => 7,
	'margin_top'               => 7,
	'margin_bottom'            => 7,
]
   
   
   );
	
	
	 return $pdf->stream('document.pdf');
	
	
	
	
	
}
 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
    public function duepayment()
    {
         return view('producttransition.duepayment'); 
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
     * @param  int  $id  producttransfetch
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		
		DB::beginTransaction(); 
		
                 $data = productorder::with('producttransition')->findOrFail($id);



  
			 $shopid = Auth()->user()->balance_of_business_id;
  
	

				
				 foreach ($data->producttransition as $d)
				 {
					 
					 
					 
		productpriceaccunit::where('product_id',$d->product_id )->where('unitcoversion_id',  $d->unitcoversion_id )			 
					 
	->increment('stock',$d->quantity );				 
					 
			
	   projectstock::where('id',  $d->project_id )->where('product_id',$d->product_id )->where('unitcoversion_id',  $d->unitcoversion_id )
 ->decrement('stock',$d->quantity );		





			}
				 
				
		 
		//$producttransition= 
		
		producttransition::where('productorder_id', $id )->delete();
			 cashtransition::where('productorder_id', $id )->delete();
		     
		//$producttransition->delete();		 
        $data->delete();
		
		DB::commit();
    }
}

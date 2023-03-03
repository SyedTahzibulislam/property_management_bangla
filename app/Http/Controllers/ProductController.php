<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\productcategory;
use App\Models\Productcompany;
use App\Models\productpriceaccunit;
use PDF;
use App\Models\go_down_stock;
use App\Models\balance_of_business;
use App\Models\project;

use DataTables;
use Validator;

use App\Models\unitcoversion;
class ProductController extends Controller
{
    /** stock
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  	  public function index(Request $request)
    {
    
	  
	
	  $Product=  Product::with('productcategory','Productcompany')->where('softdelete',0)->orderBy('productcategory_id')->latest()->get();
	    
	
	  
	        if ($request->ajax()) {
					
		  $Product=  Product::with('productcategory','Productcompany')->where('softdelete',0)->orderBy('productcategory_id')->latest()->get();

		   //$medicine =  medicine::latest()->get();
            return Datatables::of($Product)
                   ->addIndexColumn()
				   

                    ->addColumn('action', function( Product $data){ 
   


                        $button = '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                      


   $button .= '<button> <a type="button"  target="_blank"  class=" btn btn-success btn-sm"     href="'.route('Product.editdproduct', $data->id).'">EDIT Detail</a></button>';
   



					  return $button;
                    })  
                      ->addColumn('productcategory', function (Product $Product) {
						  
						  $productcategory = productcategory::find($Product->productcategory_id)->name;
						  if($productcategory)
						  {
                    return $productcategory;
						  }
						  else{
							  
							 return "Not Applicable";  
						  }
		
                })
				
				
				
	
				
				
				                      ->addColumn('productcompany', function (Product $Product) {
						  
						  $Productcompany = Productcompany::find($Product->Productcompany_id)->name;
						  if($Productcompany)
						  {
                    return $Productcompany;
						  }
						  else{
							  return "Not Applicable";  
						  }
		
                })
					
					
                    ->rawColumns(['action'])
                    ->make(true);
        }
		

		return view('product.product', compact('Product'));   
	
	}
	
	
	
	
	
	public function editdproduct( $id )
	{
	

	  
	  $product=  Product::with('productcategory','Productcompany','productpriceaccunit')->findOrFail($id);
	  
$category = productcategory::where('softdelete',0)->where('balance_of_business_id', Auth()->user()->id)->orderBy('name')->get();
$productcompany = Productcompany::where('softdelete',0)->where('balance_of_business_id', Auth()->user()->id)->orderBy('name')->get();
$selectedcomapny = Productcompany::where('softdelete',0)->findOrFail($product->Productcompany_id)->name;

		return view('product.productedit', compact('product','category','productcompany','selectedcomapny'));   
		
		
		
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	    public function dropdownlist()
    {
		
				$shopid= Auth()->user()->balance_of_business_id;	
	
     
       $data = productcategory::where('softdelete',0)->where('balance_of_business_id',$shopid)->orderBy('name')->get(); 
	    $Productcompany = Productcompany::where('softdelete',0)->where('balance_of_business_id',$shopid)->orderBy('name')->get(); 
$unit = unitcoversion::latest()->get();
			
            return response()->json(['data' => $data , 'unit'=> $unit, 'Productcompany' => $Productcompany ]);

	   
	   
	   
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




public function stock()
    {
		
$project = project::where('softdelete',0)->orderBy('name')->get();		
		


        return view('product.subdealerstock', compact('project'));   
    }











public function fetch_Productstock(Request $request)
{
	if($request->business=="99999999999999")
	{
$bid = $request->business;

$dealer_id = Auth()->user()->balance_of_business_id;
	if ( ( $dealer_id != $bid ))
	{
		if ($dealer_id != 1 )
		{
		abort(404);
		}
	
		
	}
$product = product::with('productpriceaccunit')->with('go_down_stock', function ($query) use($bid) {
        $query->where('balance_of_business_id','=',  $bid);
    })->with('productpriceaccunit', function ($query) use($bid) {
        $query->where('balance_of_business_id','=',  $bid);
    })
	
	->where('softdelete',0)->orderBy('name')->get();	
	 $pdf = PDF::loadView('product.productstock', compact('product' ),
   [], [
 'mode'                     => '',
	'format'                   => 'A4',
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


$bid = $request->business;

$project_name = project::findOrFail($bid)->name;


$product = product::with('projectstock')->with('projectstock', function ($query) use($bid) {
        $query->where('project_id','=',  $bid);
    })
	
	->where('softdelete',0)->orderBy('name')->get();











	 $pdf = PDF::loadView('product.project_stock', compact('product','project_name', ),

   [], [
 'mode'                     => '',
	'format'                   => 'A4',
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
            'category'    =>  'required',
            'company'     =>  'required',
            'name'         =>  'required',
			'productcode',
				'stock',
			'unitprice',
			'sellingunit',

'unit',
'unitprice',
'qun',

			
			
        );
	

        $error = Validator::make($request->all(), $rules);

	
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

       $converrate = unitcoversion::findOrFail($request->sellingunit)->coversionamount; // sellingunit holo godownstock unit
$quantity = $request->stock * $converrate;
	   

        $form_data = array(
            'productcategory_id'        =>  $request->category,
            'Productcompany_id'         =>  $request->company,
           'name' =>$request->name,
		   'productcode' =>$request->name,
		   		   'stock' =>$quantity,
				   		   'unitprice' =>$request->unitprice,

  'stockunit' =>$request->stockunit,
		'buyingunit' =>$request->purchasingunit,
		'sellingunit' =>$request->sellingunit,
					'balance_of_business_id' => Auth()->user()->balance_of_business_id,
		
		
		);
	
     $productiid =   Product::create($form_data);
	


$product = go_down_stock::where('product_id',$productiid->id )->where('unitcoversion_id',$request->stockunit)->where('balance_of_business_id',Auth()->user()->balance_of_business_id)
->where('user_id',  Auth()->user()->id )->first();

if (  $product == null  )
{
	
	
$go_down_stock = new go_down_stock();

$go_down_stock->product_id = $productiid->id;
$go_down_stock->unitcoversion_id = $request->sellingunit;
$go_down_stock->balance_of_business_id = Auth()->user()->balance_of_business_id;
$go_down_stock->user_id = Auth()->user()->id;

$go_down_stock->stock =$request->stock;
$go_down_stock->save();
}
else{
	       

$stock = $product->stock + $request->stock;
		   go_down_stock::whereId($product->id)
  ->update(['stock' => $stock ]);
	
	
	
}





  
	  for ($i = 0; $i < 1; $i++ ) 

	{

				
		
       $productpriceaccunit = new productpriceaccunit; 
	   $productpriceaccunit->product_id = $productiid->id;
 $productpriceaccunit->unitcoversion_id =  $request->sellingunit;
	 $productpriceaccunit->user_id =  auth()->user()->id ;
	// $productpriceaccunit->stock =  $request->qun[$i];  ;
	
	$productpriceaccunit->stock =  0  ;
	$productpriceaccunit->balance_of_business_id  = auth()->user()->balance_of_business_id ; 
	 

	 
	  // asole medicine_name[] er vetore id neya hoyeche. form bananor somoy name lekha hoyechecilo pore ar change kora hoy nai 
	    
  $productpriceaccunit->unitprice =  $request->	unitprice; 
	 

		  $productpriceaccunit->save(); 
		 
	}	
	
	
	
	
	
	
	

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

            $data = Product::findOrFail($id);
			$Productcompany = Productcompany::where('softdelete',0)->orderBy('name')->get(); 
	$productcategory = productcategory::where('softdelete',0)->orderBy('name')->get();
 $converrate = unitcoversion::findOrFail($data->stockunit)->coversionamount;
 $stock= $data->stock / $converrate;

$unit= unitcoversion::where('softdelete',0)->latest()->get();	
            return response()->json(['data' => $data ,  'stock'=>$stock,  'unit'=> $unit, 'Productcompany' => $Productcompany, 'productcategory' => $productcategory ]);
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
            'category'    =>  'required',
            'company'     =>  'required',
            'name'         =>  'required',
			'productcode'   =>  'required',
				'productid'   =>  'required',
			'productpriceaccunitid'   =>  'required',
			'unitcoversion_id' =>  'required',
'unitprice' =>  'required',
'stock' =>  'required',
			
			
        );

            $error = Validator::make($request->all(), $rules);

            if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }
       
      


       
	  

	  $form_data = array(
            'productcategory_id'        =>  $request->category,
            'Productcompany_id'         =>  $request->company,
           'name' =>$request->name,
		   'productcode' =>$request->productcode,
'stock'  =>$request->godownstock,
		
		
		
		);
        Product::whereId($request->productid)->update($form_data);


    for ( $i = 0; $i < count($request->productpriceaccunitid); $i++ ) 

	{

		


   productpriceaccunit::where('unitcoversion_id',  $request->unitcoversion_id[$i])->where('product_id',  $request->productid )
  ->update(['stock' => $request->stock[$i] , 'unitprice' =>  $request->unitprice[$i] ]);	

	}










		return view('product.product');   


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
              	   	Product::whereId($id)
  ->update(['softdelete' => '1']);
 


go_down_stock::where('product_id', $id )
  ->update(['softdelete' => '1']);




 
}
}

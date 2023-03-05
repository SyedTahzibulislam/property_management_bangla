<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;




use DataTables;
use Validator;
use App\Models\balance_of_business; 
use App\Models\project; 
use App\Models\cashtransition; 
use App\Models\go_down_stock; 
use App\Models\useproducttransition; 
use App\Models\useproduct; 

use App\Models\Customer;
use App\Models\Product;  
use App\Models\productorder;
use App\Models\producttransition;
use App\Models\User;

use App\Models\projectstock;

use App\Models\project_supervisor;

use App\Models\unitcoversion;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Redirect;
use App\Models\productpriceaccunit;



use PDF;
$jsonmessage=0;
$status=0;















class userproductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	       public function index(Request $request)
    {
      $useproduct=  useproduct::orderBy('id', 'DESC')->get();
	  
	
	  
	        if ($request->ajax()) {
      $useproduct=  useproduct::orderBy('id', 'DESC')->get();
            return Datatables::of($useproduct)
                   ->addIndexColumn()
                    ->addColumn('action', function( useproduct $data){ 
   
                          $button = '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        $button .= '&nbsp;&nbsp;';
                        //$button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    })  
                              


							  ->addColumn('projectname', function (useproduct $useproduct) {
                    return $useproduct->project->name;
                })
				
									  ->addColumn('entryby', function (useproduct $useproduct) {
                    return $useproduct->user->name;
                })
					


									  ->addColumn('amount', function (useproduct $useproduct) {
                    return convertToBangla($useproduct->amount);
                })

                 ->editColumn('created', function(useproduct $data) {
					
					 return convertToBangla(date('d/m/y', strtotime($data->created_at) ));
                    
                })
				
             ->editColumn('pdf', function ($useproduct) {
                return '<a   target="_blank"      href="'.route('producttransition.pdf', $useproduct->id).'">Print</a>';
            })
				

					
					
                    ->rawColumns(['action','pdf','created' ])

                    ->make(true);
					
					

        }
      
        return view('producttransition.useproduct', compact('useproduct'));   

    }



public function datefetch()
{
	
$project = project::where('softdelete',0)->orderBy('name')->get();	
return view('producttransition.datefetch', compact('project'));  	
}









public function fetch(Request $request)
{


 $validator = Validator::make($request->all(), [
            'startdate' => 'required|date|size:10',
        'enddate' => 'date|size:10',
		'company'=> 'required',
        ]);
		
	
		

		
		
		        $start = date("Y-m-d",strtotime($request->input('startdate')));
				  $end = date("Y-m-d",strtotime($request->input('enddate')));









$project_name = project::findOrFail($request->project)->name;

	
$useproduct=  useproduct::with('useproducttransition')->where('project_id', $request->project)
 ->whereBetween('created_at',[$start,$end])->orderBy('created_at')->get();	
	




			 $pdf = PDF::loadView('producttransition.voucherforusages', compact('useproduct','start','end','project_name', ),
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
	
		
$request->quantity = convertToEnglish($request->quantity);

		$supervisor_id = Auth()->user()->superviser_id;

if ($supervisor_id != 1)		
{

$find_project_for_the_supervisor = project_supervisor::where('project_id', $request->project)->where('superviser_id', $supervisor_id)->get();

if (count($find_project_for_the_supervisor) == 0)
{
	abort(404);
	
}}
	
	
	
	
	
	
	
	
	$variable_for_product="";
$project = project::findOrFail($request->project_id)->name;

		global $status;
	    for ($product_id = 0; $product_id < count($request->medicine_name); $product_id++ ) 

	{
			
	$p =    projectstock::where('project_id', $request->project_id)->where('unitcoversion_id',  $request->unit[$product_id])->where('product_id',  $request->medicine_name[$product_id] )->first() ;

if ($p == null )
{
	$status = 2;	
		break;		
}

  	
		
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
		
	

		
		
		
		
		
		$useproduct = new useproduct; 
		$useproduct->user_id  = auth()->user()->id ; //$request->sellerid;
	$useproduct->project_id  = $request->project_id;
	
	
	$useproduct->amount  = $request->grossamount; 
	
	$useproduct->comment  =$request->comment; 
$useproduct->created_at  =$request->Date_of_Transition; 	

	
	
		$useproduct->save();
	
	











	
		

	
	
	
	
	
	
	
	

    $order_id = $useproduct->id;
	
	

	
	
	
	
	
	
	
	
	
	
	
	

    for ($product_id = 0; $product_id < count($request->medicine_name); $product_id++ ) 

	{

		
		
	// update stock 




	
	$projectstock = projectstock::where('product_id', $request->medicine_name[$product_id]  )->where('unitcoversion_id',  $request->unit[$product_id])->first();
	
	if($projectstock  != null )
	{
		
	   projectstock::where('id',  $projectstock->id )
  ->update(['stock' =>(   $projectstock->stock - $request->quantity[$product_id] )  ]);		
		
		
	}


		
		
		
       $useproducttransition = new useproducttransition; 
	   $useproducttransition->useproduct_id = $order_id;
	    $useproducttransition->project_id =$request->project_id;
	 $useproducttransition->user_id =  auth()->user()->id ;
	 
	
	 
	 $useproducttransition->product_id = $request->medicine_name[$product_id];
	$useproducttransition->unitcoversion_id = $request->unit[$product_id];  
	  // asole medicine_name[] er vetore id neya hoyeche. form bananor somoy name lekha hoyechecilo pore ar change kora hoy nai 
	

    
  $useproducttransition->unirprice =  $request->unit_price[$product_id]; 
  
 $unitconverter= unitcoversion::findOrFail($request->unit[$product_id])->coversionamount;
  
  $quantity = $unitconverter * $request->quantity[$product_id];
		$useproducttransition->quantity =  $request->quantity[$product_id];
	//	 product::where('id',$request->medicine_name[$product_id] )->decrement('stock', $quantity );
		 
		 $unitname=unitcoversion::findOrFail($request->unit[$product_id])->name;
		

// 

$product_name=	product::findOrFail($request->medicine_name[$product_id])->name;
	
		 $variable_for_product = $variable_for_product. " product Name: " .$product_name. " product Unit: " .$unitname;
		 
		 
 $useproducttransition->unitname =  $unitname;
 $useproducttransition->quantityinbase =  $quantity;	 
 $useproducttransition->sellingunit = $request->unit[$product_id];	
 $qun= $request->quantity[$product_id];
 $useproducttransition->amount = $request->amount[$product_id];
 
 $useproducttransition->created_at  =$request->Date_of_Transition;
 $useproducttransition->save(); 
		 
	


	}		



				
		
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
		
				$supervisor_id = Auth()->user()->superviser_id;

if ($supervisor_id != 1)		
{

$find_project_for_the_supervisor = project_supervisor::where('project_id', $request->project)->where('superviser_id', $supervisor_id)->get();

if (count($find_project_for_the_supervisor) == 0)
{
	abort(404);
	
}}
		
		
		
		
		
		
		
		
		
		

                 $data = useproduct::with('useproducttransition')->findOrFail($id);



  
		
	

				
				 foreach ($data->useproducttransition as $d)
				 {
					 
					 
					 
			 
					 
			
	   projectstock::where('project_id',  $d->project_id )->where('product_id',$d->product_id )->where('unitcoversion_id',  $d->unitcoversion_id )
 ->increment('stock',$d->quantity );		





			}
				 
				
		 
		//$producttransition= 
		
		useproducttransition::where('useproduct_id', $id )->delete();
			 
		     
		//$producttransition->delete();		 
        $data->delete();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DataTables;
use Validator;
use App\Models\balance_of_business; 

use App\Models\Customer;
use App\Models\Product;  
use App\Models\plotsell;

use App\Models\productorder;
use App\Models\producttransition;
use App\Models\User;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Redirect;
use PDF;

class balancesheetforCustomer extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
		$dealer_id = Auth()->user()->balance_of_business_id;
		
		if($dealer_id == 1 )
		{
$customer = Customer::with('balance_of_business')->where('softdelete',0)->get();
		}
		
		else{
$customer = Customer::with('balance_of_business')->where('balance_of_business_id', $dealer_id )->where('softdelete',0)->get();			
			
		}
        return view('customerbalacesheet.customerbalacesheet', compact('customer'));   
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
		
		
		
 $validator = Validator::make($request->all(), [
            'startdate' => 'required|date|size:10',
        'enddate' => 'date|size:10',
		'customer_id'=> 'required',
        ]);
		
		
		
		if ($validator->fails()) {
             return redirect()->back();
                     
        }
		
	
		
	$dealer_id = Auth()->user()->balance_of_business_id; 	
		
		$customer_owner_id = customer::findOrFail($request->customer_id)->balance_of_business_id;
		
		
		if ($dealer_id !=  $customer_owner_id )
		{
			
			if ($dealer_id != 1)
			{
				abort(404);
				
			}
			
		}
		
		
		
		
		        $start = date("Y-m-d",strtotime($request->input('startdate')));
				$lastday = date("Y-m-d",strtotime($request->input('enddate')));
      //  $end = date("Y-m-d",strtotime($request->input('enddate')."+1 day"));
      $end = date("Y-m-d",strtotime($request->input('enddate')));
		$datethatsentasenddatefromcust =  date("Y-m-d",strtotime($request->input('enddate')));
		
		
					$data = customer::findOrFail($request->customer_id);
				$obtillfirstdate= $data->openingbalance;
				
		
		
		$firstdate  = date("Y-m-d",strtotime($data->created_at));
		
		
		

		
		
		if ($firstdate < $start )
		{
			
		$lastdatetofindoutopeningbalance = date("Y-m-d",strtotime($request->input('startdate')));
		$ordertillfirstdate =	plotsell::with('Customer','user')->where('customer_id', $request->customer_id )
				  ->whereBetween('created_at',[$firstdate,$lastdatetofindoutopeningbalance])->orderBy('created_at')->get();

		
		foreach ($ordertillfirstdate as $o)
		{
		if ($o->type == 1)
{
$obtillfirstdate = $obtillfirstdate+ $o->due_first;

}	

if ($o->type == 2)

{
	$obtillfirstdate = $obtillfirstdate- $o->amount;

}


		
		
		
		}
		
		
		
		}

		
	$order=	plotsell::with('project','Customer','user')->where('customer_id', $request->customer_id )

		  ->whereBetween('created_at',[$start,$end])->orderBy('created_at')->get();
	
			
		
			 $pdf = PDF::loadView('customerbalacesheet.voucher', compact('data','start','lastday','order','obtillfirstdate' ),
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

public function balance(Request $request){

dd();


}








    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

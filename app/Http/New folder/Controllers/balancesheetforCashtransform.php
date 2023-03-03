<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Validator;
use App\Models\balance_of_business; 
use App\Models\cashtransition; 
use App\Models\project; 
use App\Models\user;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Redirect;
use PDF;
class balancesheetforCashtransform extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
		
	$project = project::where('softdelete',0)->get();	
$accountant = user::where('role',4)->orderBy('name')->get();

        return view('subdealerbalancesheet.subdealerbalancesheet', compact('project','accountant'));   
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
		'business',
		'accountant',
        ]);
		
		
				if ($validator->fails()) {
             return redirect()->back();
                       
        }
		
	



	if ($request->accountant != null  )	
	{

		        $start = date("Y-m-d",strtotime($request->input('startdate')));
        $end = date("Y-m-d",strtotime($request->input('enddate')));
 

        $endcom = date("Y-m-d",strtotime($request->input('enddate')."+1 day"));


 
	  $c = date("Y-m-d",strtotime($request->input('startdate')));
	  
		$datethatsentasenddatefromcust =  date("Y-m-d",strtotime($request->input('enddate')));
		
		
					$data = user::findOrFail($request->accountant);
				$obtillfirstdate= $data->ob;
				$opening_balance=$data->ob;
			
		
		$firstdate  = date("Y-m-d",strtotime($data->created_at));
	
	
	
	$lastdatetofindoutopeningbalance =	$start;
	
		if ($firstdate < $start )
		{
		


$firstdate = date_create($firstdate);

$d = date_create($start);

$lastdatetofindoutopeningbalance =		date_sub($d,date_interval_create_from_date_string("1 days"));
		
	
		
		$business =	cashtransition::
		where('account_id', $request->accountant )->where('adjusttype', 2)
				  ->whereBetween('created_at',[$firstdate,$lastdatetofindoutopeningbalance])->orderBy('created_at')->get();


		
		foreach ($business as $o)
		{
		if ($o->type == 1)
{
$obtillfirstdate = $obtillfirstdate+ $o->deposit;

}	

if ($o->type == 2)
{
$obtillfirstdate = $obtillfirstdate- $o->withdrwal;

}


		
		
		
		}
		
		
		
		}

		
	$order=	
	cashtransition::
		where('account_id', $request->accountant )->where('adjusttype', 2)
		
	->where('created_at',  '>=',  $start )	->where('created_at',  '<', $endcom )->orderBy('created_at')->orderBy('id','ASC')->get();
		
		
			 $pdf = PDF::loadView('subdealerbalancesheet.voucher', compact('data','c','lastdatetofindoutopeningbalance','end','start','order','obtillfirstdate','opening_balance', ),
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


	

		
	if ($request->business == "999999999999999"  )	
	{	
		

		        $start = date("Y-m-d",strtotime($request->input('startdate')));
        $end = date("Y-m-d",strtotime($request->input('enddate')));
 

        $endcom = date("Y-m-d",strtotime($request->input('enddate')."+1 day"));


 
	  $c = date("Y-m-d",strtotime($request->input('startdate')));
	  
		$datethatsentasenddatefromcust =  date("Y-m-d",strtotime($request->input('enddate')));
		
		
					$data = balance_of_business::findOrFail(1);
				$obtillfirstdate= $data->openingbalance;
				$opening_balance= $data->openingbalance;
			
		
		$firstdate  = date("Y-m-d",strtotime($data->created_at));
	
	
	
	$lastdatetofindoutopeningbalance =	$start;
	
		if ($firstdate < $start )
		{
		


$firstdate = date_create($firstdate);

$d = date_create($start);

$lastdatetofindoutopeningbalance =		date_sub($d,date_interval_create_from_date_string("1 days"));
		
	
		
		$business =	cashtransition::whereBetween('created_at',[$firstdate,$lastdatetofindoutopeningbalance])->orderBy('created_at')->get();


		
		foreach ($business as $o)
		{
		if ($o->type == 1)
{
$obtillfirstdate = $obtillfirstdate+ $o->deposit;

}	

if ($o->type == 2)
{
$obtillfirstdate = $obtillfirstdate- $o->withdrwal;

}


		
		
		
		}
		
		
		
		}

		
	$order=	
	cashtransition::where('created_at',  '>=',  $start )->where('created_at',  '<', $endcom )->orderBy('created_at')->get();
		
		
			 $pdf = PDF::loadView('subdealerbalancesheet.voucher', compact('data','c','lastdatetofindoutopeningbalance','end','start','order','obtillfirstdate','opening_balance', ),
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
	
		

		
	} else{



		        $start = date("Y-m-d",strtotime($request->input('startdate')));
        $end = date("Y-m-d",strtotime($request->input('enddate')));
 

        $endcom = date("Y-m-d",strtotime($request->input('enddate')."+1 day"));


 
	  $c = date("Y-m-d",strtotime($request->input('startdate')));
	  
		$datethatsentasenddatefromcust =  date("Y-m-d",strtotime($request->input('enddate')));
		
		
					$data = project::findOrFail($request->business);
				$obtillfirstdate= $data->ob;
				$opening_balance=$data->ob;
			
		
		$firstdate  = date("Y-m-d",strtotime($data->created_at));
	
	
	
	$lastdatetofindoutopeningbalance =	$start;
	
		if ($firstdate < $start )
		{
		


$firstdate = date_create($firstdate);

$d = date_create($start);

$lastdatetofindoutopeningbalance =		date_sub($d,date_interval_create_from_date_string("1 days"));
		
	
		
		$business =	cashtransition::
		where('project_id', $request->business )->where('adjusttype', 3)
				  ->whereBetween('created_at',[$firstdate,$lastdatetofindoutopeningbalance])->orderBy('created_at')->get();


		
		foreach ($business as $o)
		{
		if ($o->type == 1)
{
$obtillfirstdate = $obtillfirstdate+ $o->deposit;

}	

if ($o->type == 2)
{
$obtillfirstdate = $obtillfirstdate- $o->withdrwal;

}


		
		
		
		}
		
		
		
		}

		
	$order=	
	cashtransition::
		where('project_id', $request->business )->where('adjusttype', 3)
	->where('created_at',  '>=',  $start )	->where('created_at',  '<', $endcom )->orderBy('created_at')->orderBy('id','ASC')->get();
		
		
			 $pdf = PDF::loadView('subdealerbalancesheet.voucher', compact('data','c','lastdatetofindoutopeningbalance','end','start','order','obtillfirstdate','opening_balance', ),
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
        //
    }
}

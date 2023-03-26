<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Taka_uttolon_transition; 
use App\Models\sharepartner; 
use App\Models\cashtransition; 
use App\Models\project;
use Illuminate\Support\Facades\Redirect;
use DataTables;
use Validator;
use DB;
use PDF;
use App\Models\balance_of_business;
class TakaUttolonTransitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
    {
        $Taka_uttolon_transition =  Taka_uttolon_transition::with('sharepartner')
		->orderBy('id','DESC')->get();
	//1-> touttolon
	  
	        if ($request->ajax()) {
					  $Taka_uttolon_transition =  Taka_uttolon_transition::with('sharepartner')->orderBy('id','DESC')->get();
        
            return Datatables::of($Taka_uttolon_transition)
                   ->addIndexColumn() 
				   

                    ->addColumn('action', function( Taka_uttolon_transition $data){ 
   
                          $button = '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        $button .= '&nbsp;&nbsp;';
                        
						
						
						return $button;
                    })  
    
                      ->addColumn('partner_name', function (Taka_uttolon_transition $Taka_uttolon_transition) {
                    return $Taka_uttolon_transition->sharepartner->name;
                })
				
				
				    ->addColumn('transitino_type', function (Taka_uttolon_transition $Taka_uttolon_transition) {
                    
					if ($Taka_uttolon_transition->transitiontype == 1)
					{
						$type= "টাকা উত্তোলন ";
					return $type;	
					}
					
					else
					{
						$type= "টাকা জমা  ";
					return $type;	
					}
					
					
                })				
				
				
				
                      ->addColumn('amount', function (Taka_uttolon_transition $Taka_uttolon_transition) {
                    return convertToBangla($Taka_uttolon_transition->amount);
                })				
				
				
				
				
					->editColumn('created_at', function(Taka_uttolon_transition $data) {
					
					 return convertToBangla(date('d/m/y', strtotime($data->created_at)));
                    
                })
					
                    ->rawColumns(['action'])
                    ->make(true);
        }
		

		return view('Taka_uttolon_transition.Taka_uttolon_transition', compact('Taka_uttolon_transition'));   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
	 


public function balancesheet()
{
	
       $sharepartner = sharepartner::where('softdelete','0' )->orderBy('name', 'ASC')->get();	
	   
	return view('taka_uttolon_joma_report_transition.balancesheet', compact('sharepartner'));      
	   
	
}


public function balanceprocess (Request $request)
{
	
	
$validator = Validator::make($request->all(), [
            'startdate' => 'required|date|size:10',
        'enddate' => 'date|size:10',
		'company'=> 'required',
        ]);
		
	
		
	/*	if ($validator->fails()) {
             return redirect()
                        ->withErrors($validator)
                        ->withInput();
        }
		*/
		
		
		        $start = date("Y-m-d",strtotime($request->input('startdate')));
				  $lastday = date("Y-m-d",strtotime($request->input('enddate')));
        $end = date("Y-m-d",strtotime($request->input('enddate')));
      
		$datethatsentasenddatefromcust =  date("Y-m-d",strtotime($request->input('enddate')));
		
		
					$data = sharepartner::findOrFail($request->partner);
				
		
		
		$firstdate  = date("Y-m-d",strtotime($data->created_at));
		
		
		
	


		$obtillfirstdate=0;
				$taka_transition =Taka_uttolon_transition::with('sharepartner','project','user')->where('sharepartner_id', $request->partner )
				  ->whereBetween('created_at',[$start,$end])->orderBy('created_at')->get();

		
		

				
		
			 $pdf = PDF::loadView('taka_uttolon_joma_report_transition.voucher', compact('data','start','lastday','taka_transition','obtillfirstdate','end' ),
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


	
	 
	 
	 	    public function dropdown_list()
    {
		
		 $shopid = Auth()->user()->balance_of_business_id;
       $sharepartner = sharepartner::where('balance_of_business_id', $shopid )->where('softdelete','0' )->orderBy('name', 'ASC')->get(); 
	   
$project = project::where('softdelete', 0)->orderBy('name')->get();
	        

            return response()->json(['sharepartner' => $sharepartner , 'project'=> $project ]);
	 
 
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
                $rules = array(
            'partner_name'    =>  'required',
            'amount'     =>  'required',
			'comment',
           'transitiontype' =>  'required',
		   'Date_of_Transition',
        );

        $error = Validator::make($request->all(), $rules);



$request->amount = convertToEnglish($request->amount);


        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

       		


		
		
		  DB::beginTransaction();
		  
		  
 
		  
  
		  
		$Taka_uttolon_transition  = new Taka_uttolon_transition();
		
		$Taka_uttolon_transition->sharepartner_id =  $request->partner_name;
		$Taka_uttolon_transition->amount =  $request->amount;		
		$Taka_uttolon_transition->project_id =  $request->project_name;			 
		$Taka_uttolon_transition->comment =  $request->comment;		  
		$Taka_uttolon_transition->transitiontype =  $request->transitiontype;		  
		$Taka_uttolon_transition->balance_of_business_id =  Auth()->user()->balance_of_business_id;		
		$Taka_uttolon_transition->user_id= Auth()->user()->id;
		$Taka_uttolon_transition->created_at =  $request->Date_of_Transition;		  
		 $Taka_uttolon_transition->save(); 
		  
		  
		  
		  
		  
		  
		$partner = sharepartner::findOrFail($request->partner_name); 
		
		
		//////////////////////// jodi Taka uttolon hoy 	 
	   If ( $request->transitiontype == 1 )
	   {
	   $amount_of_current_uttholon = $partner->uttholon + $request->amount ; 
	          $form_data_for_update_uttolon_joma = array(
            
            'uttholon'        =>   $amount_of_current_uttholon,
            
        );
        sharepartner::whereId($request->partner_name)->update($form_data_for_update_uttolon_joma);

	  
	  
	  
	     /////////////update balance  
   $balance = balance_of_business::first();  
   $present_balance = $balance->balance - $request->amount ;	    
   balance_of_business::where('id', 1)
  ->update(['balance' =>$present_balance  ]);
	  
	  
	  
	  
	  }
	  //////////////////////// jodi Taka Joma hoy 
	   else{
	   $amount_of_current_joma = $partner->joma + $request->amount ; 
	          $form_data_for_update_uttolon_joma = array(
            
            'joma'        =>   $amount_of_current_joma,
            
        );
        sharepartner::whereId($request->partner_name)->update($form_data_for_update_uttolon_joma);
 
   
   
   
   /////////////update balance 
   $balance = balance_of_business::first();  
   $present_balance = $balance->balance + $request->amount ;	    
   balance_of_business::where('id', 1)
  ->update(['balance' =>$present_balance  ]);
	   
   
	   }

   
 
   
   

 
 
 	   If ( $request->transitiontype == 1 )
	   {
		  	$cashtransition = new cashtransition();
$cashtransition->balance_of_business_id = Auth()->user()->balance_of_business_id;
$cashtransition->sharepartner_id = $request->partner_name;
$cashtransition->project_id = $request->project_name;


$cashtransition->User_id = Auth()->user()->id;
$cashtransition->Taka_uttolon_transition_id = $Taka_uttolon_transition->id;
$cashtransition->amount = $request->amount;
$cashtransition->withdrwal = $request->amount;	
$cashtransition->description = "টাকা উত্তোলন ,  পার্টনার :"  .$partner->name ;	
$cashtransition->created_at = $request->Date_of_Transition;
$cashtransition->transtype = 5;
$cashtransition->type = 2;
$cashtransition->save(); 
		   
	   }
 else{
	 
		  	$cashtransition = new cashtransition();
$cashtransition->balance_of_business_id = Auth()->user()->balance_of_business_id;
$cashtransition->sharepartner_id = $request->partner_name;
$cashtransition->project_id = $request->project_name;
$cashtransition->User_id = Auth()->user()->id;
$cashtransition->Taka_uttolon_transition_id = $Taka_uttolon_transition->id;
$cashtransition->amount = $request->amount;
$cashtransition->deposit = $request->amount;	
$cashtransition->description = "টাকা জমা,  পার্টনার :"  .$partner->name ;	
$cashtransition->transtype = 5;
$cashtransition->created_at = $request->Date_of_Transition;
$cashtransition->type = 1;
$cashtransition->save(); 	 
	 
 }
 
 
 
 
 
 
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
        $data = Taka_uttolon_transition::findOrFail($id);
		
		  DB::beginTransaction();
				$sharepartner = sharepartner::findOrFail($data->sharepartner_id );
			
				if ($data->transitiontype == 1)
				{
					/////////update personal balance of partner 
   $present_uttholon = $sharepartner->uttholon - $data->amount;
   sharepartner::where('id', $data->sharepartner_id)
  ->update(['uttholon' =>$present_uttholon  ]);
  ///////////////update comany balance 
    
   $balance = balance_of_business::first();  
   $present_balance = $balance->balance + $data->amount ;	    
   balance_of_business::where('id', 1)
  ->update(['balance' =>$present_balance  ]);
  
  
  
  
  
  
  
	}
  
  else {
	  
	  
	////////// update sharepartner balance			
  $present_joma = $sharepartner->joma - $data->amount;

   sharepartner::where('id', $data->sharepartner_id)
  ->update(['joma' =>$present_joma  ]);		
		

////////////////////// update company balance 

	    
   $balance = balance_of_business::first();  
   $present_balance = $balance->balance - $data->amount ;	    
   balance_of_business::where('id', 1)
  ->update(['balance' =>$present_balance  ]);

}
			 cashtransition::where('Taka_uttolon_transition_id', $id )->delete();
		
		
        $data->delete();
		DB::commit();
		
    }
}
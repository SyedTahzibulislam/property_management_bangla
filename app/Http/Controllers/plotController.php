<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\externalincomeprovider; 
use App\Models\user; 
use App\Models\duecollectionfromincomeprovider; 
use DataTables;
use Validator;
use App\Models\balance_of_business;
use DB;
use App\Models\cashtransition;
use App\Models\project;
use App\Models\project_supervisor;


use App\Models\plot;








class plotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function index(Request $request)
    {
		

		
                  $plot =  plot::where('softdelete',0)->orderByDesc('id')->get();
	  

	  
	        if ($request->ajax()) {
				
                  $plot =  plot::where('softdelete',0)->orderByDesc('id')->get();
            
			
			
			
			return Datatables::of($plot)
                   ->addIndexColumn()
                    ->addColumn('action', function( plot $data){ 
   
                          $button = '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        $button .= '&nbsp;&nbsp;';
                        //$button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    }) 
	
				

				
				
	->addColumn('entryby', function (plot $plot) {



$user = $plot->user->name;


return $user;

				 
                }) 
				
                ->addColumn('amount', function (plot $plot) {



                    $amount =  convertToBangla($plot->amount); 
                    
                    
                    return $amount;
                    
                                     
                                    }) 




   			
                                    ->addColumn('id', function (plot $plot) {



                                        $id =  ($plot->id); 
                                        
                                        
                                        return $id;
                                        
                                                         
                                                        })                                  



							  ->addColumn('status', function (plot $plot) {
                     if ( $plot->status == 0 )
					 {
						 
					return "খালি";	 
					 }
					 else if ( $plot->status == 1 )
					 {
						return "বুকড";	  
						 
					 }
					 else if ( $plot->status == 2 )
					 {
						return "বিক্রি";	   
						 
					 }

					 
	 
					 
                })
				
				
			
			
				
->addColumn('project_id', function (plot $plot) {
                   
if ($plot->project_id)
{
				   return $plot->project->name;
}else{
	
	return "NA";
}
                })					
				
				
->addColumn('customer_id', function (plot $plot) {
                   
if ($plot->customer_id)
{
				   return $plot->customer->name;
}else{
	
	return "NA";
}
                })





                 ->editColumn('created', function(plot $plot) {
					
					 return convertToBangla( date('d/m/y', strtotime($plot->created_at) ));
                    
                })









					
					
                    ->rawColumns(['action','created'])
                    ->make(true);
					
					

        }
      
        return view('plot.plot', compact('plot'));   

    }




	    public function  dropdownlist()
    {
		
		

	   
	  
		 $project = project::where('softdelete',0)->orderBy('name')->get();
	
			
            return response()->json(['project'=> $project

			]);

	   
	   
	   
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
      


        $rules = array(

			'name','project','description','amount',
			
        );
	    $request->amount =  convertToEnglish($request->amount);

        $error = Validator::make($request->all(), $rules);

	
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

		
		$plot = new plot();
		$plot->name = $request->name;
        $plot->amount = $request->amount;
		$plot->project_id = $request->project;
		$plot->user_id = Auth()->user()->id;
		$plot->description = $request->description;
$plot->save();		
		
		
		
		
		
		
		
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
              	   	plot::whereId($id)
  ->update(['softdelete' => '1']);
    }
}

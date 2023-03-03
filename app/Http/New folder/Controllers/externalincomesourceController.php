<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\externalincomesource;
use App\Models\project;

use DataTables;
use Validator;

class externalincomesourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
             $externalincomesource =  externalincomesource::where('softdelete', 0)->orderby('name')->get();
	  
	
	  
	        if ($request->ajax()) {
            $externalincomesource =  externalincomesource::where('softdelete', 0)->orderby('name')->get();
            return Datatables::of($externalincomesource)
                   ->addIndexColumn()
                    ->addColumn('action', function( externalincomesource $data){ 
   
                          $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    })  

					
					
                    ->rawColumns(['action'])
                    ->make(true);
        }
      
        return view('externalincomesource.externalincomesource', compact('externalincomesource'));   

    }



	 public function dropdownlist()
{
	
	$incomeproviderlist =  externalincomesource::OrderBy('name')->where('softdelete',0 )->get();
	$project = project::where('softdelete',0)->get();
            return response()->json(['income_provider' => $incomeproviderlist, 'project'=> $project ]);
	
	
	
}



public function dropdownlistforchild($id)
{
	
	$incomechild =  externalincomesource::OrderBy('name')->where('parent_id', $id )->get();
            return response()->json(['incomechild' => $incomechild ]);
	
	
	
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
        
		
	$externalincomesource = new externalincomesource();
$externalincomesource->name = $request->incomename;



$externalincomesource->balance_of_business_id = Auth()->user()->balance_of_business_id;	

$externalincomesource->save();		
	
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
        	   	externalincomesource::whereId($id)
  ->update(['softdelete' => '1']);
    }
}

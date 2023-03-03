<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



use DataTables;
use Validator;
use App\Models\project_supervisor;
use App\Models\project;
use App\Models\superviser;



class projectsupervisorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	       public function index(Request $request)
    {
      $project_supervisor=  project_supervisor::with('project','superviser')->latest()->get();
	  
	
	  
	        if ($request->ajax()) {
      $project_supervisor=  project_supervisor::with('project','superviser')->latest()->get();
            return Datatables::of($project_supervisor)
                   ->addIndexColumn()
                    ->addColumn('action', function( project_supervisor $data){ 
   
                          $button = '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        $button .= '&nbsp;&nbsp;';
                        //$button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    })  
                              


                      ->addColumn('project_name', function (project_supervisor $project_supervisor) {
                    return $project_supervisor->project->name;
					
                })

                      ->addColumn('project_supervisor', function (project_supervisor $project_supervisor) {
                    return $project_supervisor->superviser->name;
					
                })


		

                 ->editColumn('created', function(project_supervisor $data) {
					
					 return date('d/m/y h:i A', strtotime($data->created_at) );
                    
                })
				

				

					
					
                    ->rawColumns(['action','created' ])

                    ->make(true);
					
					

        }
      
        return view('project_supervisor.project_supervisor', compact('project_supervisor'));   

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
	 
	 
	    public function  dropdownlist()
    {
		
		
			
	   $project = project::where('softdelete', 0)->orderBy('name')->get(); 
	   
		   $superviser = superviser::where('softdelete', 0)->orderBy('name')->get();   
	  
		 

			
            return response()->json(['project' => $project , 'superviser'=>$superviser]);

	   
	   
	   
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
      	$validated = $request->validate([
	
'supervisor_Id',
'project_id',
		
		
    ]); 
 


$project_supervisor = new project_supervisor();
$project_supervisor->superviser_id = $request->supervisor_Id;
$project_supervisor->project_id = $request->project_id;
$project_supervisor->save();

return response()->json(['success' => 'Data Added Successfully']);	

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
		
         $data = project_supervisor::findOrFail($id);
		 $data->delete();
    }
}

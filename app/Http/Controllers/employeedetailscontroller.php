<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\employeedetails;
use DataTables;
use Validator;

class employeedetailscontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
                             $employeedetails=  employeedetails::where('softdelete','0')->latest()->get();
	  
	
	  
	        if ($request->ajax()) {
            $employeedetails =  employeedetails::where('softdelete','0')->latest()->get();
            return Datatables::of($employeedetails)
                   ->addIndexColumn()
                    ->addColumn('action', function( employeedetails $data){ 
   
                          $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    })  


                    ->addColumn('salary', function( employeedetails $data){ 

                      return convertToBangla($data->salary);
                  })                     








					
                    ->rawColumns(['action'])
                    ->make(true);
        }
      
        return view('employeedetails.employeedetails', compact('employeedetails'));  
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
           'name'    =>  'required',
			'designation' =>  'required',
			'salary' => 'required',
			'mobile' => 'required',
			'address' =>  'required',
           
        );

        $error = Validator::make($request->all(), $rules);




        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

   $request->salary = convertToEnglish($request->salary);     

        $form_data = array(
             'name'        =>  $request->name,
			
			
			'designation' =>   $request->designation,
			'salary' =>  $request->salary,
			'mobile' =>  $request->mobile,
			'address' =>  $request->address,
			'balance_of_business_id' => Auth()->user()->balance_of_business_id,
			
           
        );

        employeedetails::create($form_data);

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
            $data = employeedetails::findOrFail($id);
            return response()->json(['data' => $data]);
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
            'name'    =>  'required',
			'designation' =>  'required',
			'salary' => 'required',
			'mobile' => 'required',
			'address' =>  'required',
           
        );

        $error = Validator::make($request->all(), $rules);
        $request->salary = convertToEnglish($request->salary); 
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

       

        $form_data = array(
            'name'        =>  $request->name,
			
			
			'designation' =>   $request->designation,
			'salary' =>  $request->salary,
			'mobile' =>  $request->mobile,
			'address' =>  $request->address,
           
        );


       employeedetails::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		
		
          employeedetails::whereId($id)
  ->update(['softdelete' => '1']);  //softdelete 
  
  
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productcompany;

use DataTables;
use Validator;
class ProductCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	  public function index(Request $request)
    {
    
	
	
				$dealer = Auth()->user()->balance_of_business_id;
	
	if ($dealer != 1)
	{
		abort(404);
		
	}
	  
	
	  $company =  Productcompany::where('softdelete',0)->orderBy('name')->get();
	
	  
	        if ($request->ajax()) {
					
	  $company =  Productcompany::where('softdelete',0)->orderBy('name')->get();

		   //$medicine =  medicine::latest()->get();
            return Datatables::of($company)
                   ->addIndexColumn()
				   

                    ->addColumn('action', function( Productcompany $data){ 
   
                          $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    })  

					
					
                    ->rawColumns(['action'])
                    ->make(true);
        }
		

		return view('company.company', compact('company'));   
	
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
		
		
		
			
				$dealer = Auth()->user()->balance_of_business_id;
	
	if ($dealer != 1)
	{
		abort(404);
		
	}
		
		
		
        $rules = array(
            'name'    =>  'required',
            'address'     =>  'required',
            'mobile'         =>  'required',
			'due'   =>  'required',
			
			
			
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

       

        $form_data = array(
            'name'        =>  $request->name,
            'address'         =>  $request->address,
           'mobile' =>$request->mobile,
		   'due' =>$request->due,
		   		   'openingbalance' =>$request->due,
			'balance_of_business_id' => Auth()->user()->balance_of_business_id,
								   
        );

        Productcompany::create($form_data);

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
		
			
				$dealer = Auth()->user()->balance_of_business_id;
	
	if ($dealer != 1)
	{
		abort(404);
		
	}
		
		
		
        if(request()->ajax())
        {

            $data = Productcompany::findOrFail($id);
			

            return response()->json(['data' => $data  ]);
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
  
    
	
				$dealer = Auth()->user()->balance_of_business_id;
	
	if ($dealer != 1)
	{
		abort(404);
		
	}


    
    $rules = array(
            'name'    =>  'required',
            'address'     =>  'required',
            'mobile'         =>  'required',
			'due'   =>  'required',
			
			
			
        );

            $error = Validator::make($request->all(), $rules);

            if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }
       

        $form_data = array(
            'name'        =>  $request->name,
            'address'         =>  $request->address,
           'mobile' =>$request->mobile,
		   'due' =>$request->due,
		   		   'openingbalance' =>$request->due,

								   
        );
        Productcompany::whereId($request->hidden_id)->update($form_data);

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
		
		
		
			
				$dealer = Auth()->user()->balance_of_business_id;
	
	if ($dealer != 1)
	{
		abort(404);
		
	}
		
		
		
		
		
                    	   	Productcompany::whereId($id)
  ->update(['softdelete' => '1']);
    }
}

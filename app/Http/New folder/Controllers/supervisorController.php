<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\superviser;


use DataTables;
use Validator;



use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;










class supervisorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index(Request $request)
    {
      $superviser=  superviser::where('softdelete', 0)->get();
	  
	
	  
	        if ($request->ajax()) {
            $superviser =  superviser::where('softdelete', 0)->get();
            return Datatables::of($superviser)
                   ->addIndexColumn()
                    ->addColumn('action', function( superviser $data){ 
   
                        $button = '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    })  

					
				                    
   









				
                    ->rawColumns(['action'])
                    ->make(true);
        }
      
        return view('superviser.superviser', compact('superviser'));   

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
				'mobile'    =>  'required',
                'email'    =>  'required',
                'password'    =>  'required',				
            );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

       if($request->role == 5)
	   {
        $form_data = array(
            'name'       =>   $request->name,
			'mobile' =>$request->mobile,
            'email' =>$request->email,
        );

      $s=  superviser::create($form_data);
		
		
		
$user = new User();
		
$user->name = 	$request->name;
$user->email = 	$request->email;
$user->mobile = 	$request->mobile;
$user->password = Hash::make($request->password);
$user->role = 5;
$user->balance_of_business_id = Auth()->user()->balance_of_business_id;
$user->superviser_id = $s->id;
$user->save();
		
	   }
else{


$user = new User();
		
$user->name = 	$request->name;
$user->email = 	$request->email;
$user->mobile = 	$request->mobile;
$user->password = Hash::make($request->password);
$user->role = $request->role;
$user->ob = $request->accob;

$user->balance_of_business_id = Auth()->user()->balance_of_business_id;

$user->save();



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
            $data = superviser::findOrFail($id);
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
     
	 if ($id != 1 )
	 {
       	   	superviser::whereId($id)
  ->update(['softdelete' => '1']);
  
  
  $sum_email = superviser::findOrFail($id)->email;


       	   	User::where('email', $sum_email)
  ->update(['role' => '2']);
	 }
  
  
  
  
  
    }

    }








	 
 

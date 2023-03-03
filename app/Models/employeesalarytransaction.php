<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employeesalarytransaction extends Model
{
    use HasFactory;
	
			 protected $fillable = [
           'employeedetails_id',
	'starting',
		'ending',
		'project_id',
		'totalsalary','balance_of_business_id',		'superviser_id',
		'adjusttype',
		'account_id',
		'month_year',
		
		


    ];
	
	
						 public function employeedetails()
    {
    	
		  return $this->belongsTo(employeedetails::class, );
		
		
    }
	
						 public function project()
    {
    	
		  return $this->belongsTo(project::class, );
		
		
    }	
						 public function account()
    {
    	return $this->belongsTo(user::class,'account_id');
    }	
					 public function superviser()
    {
    	return $this->belongsTo(superviser::class);
    }
	
		public function setTransactionDateAttribute($value)
{
    $this->attributes['starting'] = Carbon::createFromFormat('m/d/Y', $value)->format('Y-m-d');
	    $this->attributes['ending'] = Carbon::createFromFormat('m/d/Y', $value)->format('Y-m-d');
}

	public function getTransactionDateAttribute($value)
{
    return Carbon::createFromFormat('Y-m-d', $value)->format('m/d/Y');
	    return Carbon::createFromFormat('Y-m-d', $value)->format('m/d/Y');
}
	
	
}

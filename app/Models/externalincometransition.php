<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class externalincometransition extends Model
{
    use HasFactory;
	
	
	
						 protected $fillable = [
           'externalincomesource_id',
	'externalincomeprovider_id',
	'user_id',

		'balance_of_business_id',
'due',
	     
		 'amount',
	'project_id',
'superviser_id',	'account_id','adjusttype',

    ];
	
	
	

	
	
	
	
	
	
	
	
	
					 public function project()
    {
    	return $this->belongsTo(project::class);
    }
	
	
							 public function superviser()
    {
    	return $this->belongsTo(superviser::class);
    }	
	
	
	
				 public function externalincomesource()
    {
    	return $this->belongsTo(externalincomesource::class);
    }
	

	
					 public function externalincomeprovider()
    {
    	return $this->belongsTo(externalincomeprovider::class);
    }

	
		public function User()
    {
    	return $this->belongsTo(User::class);
    }
	
	
					 public function account()
    {
    	return $this->belongsTo(user::class,'account_id');
    }	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}

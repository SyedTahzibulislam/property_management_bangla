<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class duecollectionfromincomeprovider extends Model
{
    use HasFactory;
	
	
						 protected $fillable = [
           'externalincomeprovider_id',
	'project_id',
	'user_id',

		'amount',
'comment',
	     
		 'transitiontype',
		

    ];	
	
						 public function project()
    {
    	return $this->belongsTo(project::class);
    }	
	
	
					 public function externalincomeprovider()
    {
    	return $this->belongsTo(externalincomeprovider::class);
    }	
	
					 public function user()
    {
    	return $this->belongsTo(user::class);
    }		
	
							 public function account()
    {
    	return $this->belongsTo(user::class,'account_id');
    }
	
				 public function superviser()
    {
    	return $this->belongsTo(superviser::class);
    }	
	
}

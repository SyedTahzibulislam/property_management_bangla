<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class khoroch_transition extends Model
{
    use HasFactory;
	
					 protected $fillable = [
           'khorocer_khad_id',
	'supplier_id',
	'user_id',
		'unit',
		'unit_price',
		'due',
		'balance_of_business_id',
		'advance',
	    'project_id', 
		 'amount','project_id',
		'superviser_id',
		'adjusttype',
		'account_id',
		'description',

    ];
	
	
	
				public function thirdparent()
    {
    	return $this->belongsTo(khorocer_khad::class, 'thirdparent_id');
    }
	
	
	
	public function secondparent()
    {
    	return $this->belongsTo(khorocer_khad::class, 'secondparent_id');
    }
	
	

	
	
	 public function parentcat()
    {
            	return $this->belongsTo(khorocer_khad::class, 'parent_id');
    }
	

	
						 public function account()
    {
    	return $this->belongsTo(user::class,'account_id');
    }
	
	
	
	
	
	
	
	
				 public function project()
    {
    	return $this->belongsTo(project::class);
    }	
	
				 public function superviser()
    {
    	return $this->belongsTo(superviser::class);
    }	
	
	
	
	
				 public function khorocer_khad()
    {
    	return $this->belongsTo(khorocer_khad::class);
    }
	

	
					 public function supplier()
    {
    	return $this->belongsTo(supplier::class);
    }

	
		public function User()
    {
    	return $this->belongsTo(User::class);
    }
	
	
	
	
	
	
	
}

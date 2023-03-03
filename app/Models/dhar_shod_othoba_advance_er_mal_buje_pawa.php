<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dhar_shod_othoba_advance_er_mal_buje_pawa extends Model
{
    use HasFactory;
	 protected $fillable = [
        'supplier_id',
       'user_id',
		'amount',
		'comment',
		'transitiontype',
		'project_id',
		'balance_of_business_id','adjusttype','superviser_id','account_id',
	
    ];

  public function supplier()
    {
        return $this->belongsTo(supplier::class);
    }
	
  public function project()
    {
        return $this->belongsTo(project::class);
    }


  public function User()
    {
        return $this->belongsTo(User::class);
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

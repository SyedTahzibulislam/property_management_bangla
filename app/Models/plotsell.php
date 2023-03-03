<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class plotsell extends Model
{
    use HasFactory;
	
								 protected $fillable = [
          
		'project_id','customer_id','user_id','plot_id','amount','discount','amountafterdiscount','comment','type','account_id','adjusttype','due','due_first',


    ];
	
	
						 public function plot()
    {
    	return $this->belongsTo(plot::class);
    }	
	
	
	
	
	
					 public function account()
    {
    	return $this->belongsTo(user::class,'account_id');
    }	
	
	
	
	
	
	
						 public function user()
    {
    	return $this->belongsTo(user::class);
    }
	
	
					 public function project()
    {
    	return $this->belongsTo(project::class, 'project_id');
    }


					 public function customer()
    {
    	return $this->belongsTo(customer::class);
    }

	
	
	
	
	
	
}

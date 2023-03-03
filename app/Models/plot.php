<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class plot extends Model
{
    use HasFactory;
	
								 protected $fillable = [
          
		'project_id','amount','customer_id','softdelete','status','user_id','name','description',


    ];
	
	
					 public function user()
    {
    	return $this->belongsTo(user::class);
    }
	
	
					 public function project()
    {
    	return $this->belongsTo(project::class);
    }


					 public function customer()
    {
    	return $this->belongsTo(customer::class);
    }




	
	
	
	
	
	
	
}

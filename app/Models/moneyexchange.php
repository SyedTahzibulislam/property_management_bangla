<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class moneyexchange extends Model
{
    use HasFactory;
	
	 protected $fillable = [
          
'project_id','type','amount','superviser_id','user_id'
    ];		
	
				 public function project()
    {
    	return $this->belongsTo(project::class);
    }	
	
	
	
					 public function user()
    {
    	return $this->belongsTo(user::class);
    }	
	
	
	
	
				 public function superviser()
    {
    	return $this->belongsTo(superviser::class);
    }		
	
	
	
	
	
	
	
}

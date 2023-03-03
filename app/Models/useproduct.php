<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class useproduct extends Model
{
    use HasFactory;
	
	
						 protected $fillable = [
         'project_id', 
	
		'user_id',
	
		'amount',

			'comment',	

    ];	
	
	
	
						 public function user()
    {
    	return $this->belongsTo(user::class);
    }
	
	
						 public function project()
    {
    	return $this->belongsTo(project::class);
    }
	
	
			public function useproducttransition()
    {
        return $this->hasMany(useproducttransition::class);
    }	
	
	
	
	
	
}

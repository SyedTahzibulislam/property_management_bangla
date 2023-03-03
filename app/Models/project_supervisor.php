<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project_supervisor extends Model
{
    use HasFactory;
	
	
		 protected $fillable = [
          'project_id',
		  'superviser_id'
	 

    ];	
	
	
				 public function project()
    {
    	return $this->belongsTo(project::class);
    }
	

					 public function superviser()
    {
    	return $this->belongsTo(superviser::class);
    }
		
	
	
	
	
	
	
	
	
}

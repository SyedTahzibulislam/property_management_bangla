<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class agenttransaction extends Model
{
    use HasFactory;
				 protected $fillable = [
           'agentdetail_id',
	 'user_id',
	
		'paidamount',
		'transitiontype',
		'comment',
		'paidorunpaid',
		'project_id',
	

		


    ];
	
	
			public function agentdetail()
    {
    	
		  return $this->belongsTo(agentdetail::class, );
		
		
    }
	
	





			public function project()
    {
    	
		  return $this->belongsTo(project::class, );
		
		
    }











	

  public function User()
    {
        return $this->belongsTo(User::class);
    }
	
	
	
	
	
	
	
	
}

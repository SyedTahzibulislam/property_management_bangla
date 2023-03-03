<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taka_uttolon_transition extends Model
{
    use HasFactory;
	
	use HasFactory;
	
				 protected $fillable = [
        'amount',
		'balance_of_business_id',
		'comment',
		'transitiontype',
		'sharepartner_id',
		'user_id',
		'project_id',

    ];
	
	  public function sharepartner()
    {
        return $this->belongsTo(sharepartner::class);
    }
	
		  public function user()
    {
        return $this->belongsTo(user::class);
    }
	
		  public function project()
    {
        return $this->belongsTo(project::class);
    }
		
	
	
	
	
}

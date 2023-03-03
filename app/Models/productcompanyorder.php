<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productcompanyorder extends Model
{
    use HasFactory;
	
							 protected $fillable = [
          
		'productcompany_id',
		'user_id',
		'balance_of_business_id',
		'amount',
	'serialno',
	'project_id',
		'comment',	'debit',	'credit', 'balance','type', 'discount', 'amountafterdiscount',
		'superviser_id','adjusttype','account_id',

    ];
					 public function user()
    {
    	return $this->belongsTo(user::class);
    }
	
	
					 public function project()
    {
    	return $this->belongsTo(project::class);
    }




	public function productcompany()
    {
    	return $this->belongsTo(Productcompany::class);
    }

			public function productcompanytransition()
    {
        return $this->hasMany(productcompanytransition::class);
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
	
	 protected $fillable = [
        'Areacode_id',
       'name',
		'customercode',
		'mobile',
		'address',
		'duelimit',
		'openingbalance',
		'presentduebalance',
		'softdelete',
		'balance_of_business_id',
		
	
    ];


	public function plotsell()
    {
        return $this->hasMany(plotsell::class);
    }

	
						 public function balance_of_business()
    {
    	return $this->belongsTo(balance_of_business::class);
    }


						 public function dealer()
    {
    	return $this->belongsTo(balance_of_business::class, 'dealer_id');
    }

	  public function Areacode()
    {
        return $this->belongsTo(Areacode::class);
    }
	
}

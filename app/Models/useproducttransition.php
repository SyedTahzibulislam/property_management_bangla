<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class useproducttransition extends Model
{
    use HasFactory;
	
	
							 protected $fillable = [
         'project_id', 
		'product_id',
		'useproduct_id',
		'unitcoversion_id',
		'unitname',
	'sellingunit', 'user_id',
		'unirprice',
		'quantity',	'quantityinbase',	'amount',	
    ];
	
	
	
					 public function product()
    {
    	return $this->belongsTo(Product::class);
    }
		
	
						 public function project()
    {
    	return $this->belongsTo(project::class);
    }
	
	
	
	
}

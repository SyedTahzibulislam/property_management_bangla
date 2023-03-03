<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class projectstock extends Model
{
    use HasFactory;
	
				 protected $fillable = [

       'product_id',
		'project_id',
		'unitcoversion_id',
		'stock',
		'unitprice',
		'softdelete',

	
    ];
	
	
	
					 public function unitcoversion()
    {
    	return $this->belongsTo(unitcoversion::class);
    }	
	
	
	
	
					 public function product()
    {
    	return $this->belongsTo(product::class);
    }
	
					 public function project()
    {
    	return $this->belongsTo(project::class);
    }	
	
	
	
	
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class superviser extends Model
{
    use HasFactory;
	
			 protected $fillable = [
        'name',
       'mobile',
'softdelete',
'email',
	'superviser_id',
    ];
	
	
	
}

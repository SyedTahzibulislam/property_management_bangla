<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class balance_of_business extends Model
{
    use HasFactory;
	
				 protected $fillable = [
        'balance','shopname','openingbalance','mobile','address','customer_id',


    ];
	
}

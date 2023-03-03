<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class moneyexchangeaccount extends Model
{
    use HasFactory;
	
		 protected $fillable = [
          
'accountant_id','type','amount','user_id'
    ];
	


public function accountant()
{
	
return $this->belongsTo(user::class,'accountant_id');	
}


public function user()
{
return $this->belongsTo(user::class); 	
	
}




	
}

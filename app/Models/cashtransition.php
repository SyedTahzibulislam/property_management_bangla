<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cashtransition extends Model
{
    use HasFactory;
	
		 protected $fillable = [
          
		'balance_of_business_id',
		'Bankname_id',
		'productcompany_id',
		'customer_id',
	'User_id',
		'productcompanyorder_id',
		'productorder_id',
'sharepartner_id',
'Taka_uttolon_transition_id',
'bankchalan_id',
'khoroch_transition_id',
'externalincometransition_id',	
'externalcost_id',	
'employeesalarytransaction_id','incomeproviderduetransition_id',
'amount',
'deposit',
'withdrwal',
'description',
'type',
'transtype',
'moneyexchange_id',
'project_id',
'superviser_id', 
'account_id', 
'adjusttype','plotsell_id',
'agenttransaction_id',
  ];	
	
					 public function plotsell()
    {
    	return $this->belongsTo(plotsell::class);
    }	
	
	
	
						 public function agenttransaction()
    {
    	return $this->belongsTo(agenttransaction::class);
    }	
	
	
	
	
					 public function moneyexchange()
    {
    	return $this->belongsTo(moneyexchange::class);
    }
	
	
						 public function project()
    {
    	return $this->belongsTo(project::class);
    }
	
	
						 public function superviser()
    {
    	return $this->belongsTo(superviser::class);
    }	
	
	
	
	
	
	
	
	
				 public function balance_of_business()
    {
    	return $this->belongsTo(balance_of_business::class);
    }
	
	
	
					 public function Bankname()
    {
    	return $this->belongsTo(Bankname::class);
    }
					 public function productcompany()
    {
    	return $this->belongsTo(productcompany::class);
    }
					 public function customer()
    {
    	return $this->belongsTo(customer::class);
    }
					 public function productcompanyorder()
    {
    	return $this->belongsTo(productcompanyorder::class);
    }
					 public function productorder()
    {
    	return $this->belongsTo(productorder::class);
    }
					 public function sharepartner()
    {
    	return $this->belongsTo(sharepartner::class);
    }
					 public function Taka_uttolon_transition()
    {
    	return $this->belongsTo(Taka_uttolon_transition::class);
    }
					 public function bankchalan()
    {
    	return $this->belongsTo(bankchalan::class);
    }
					 public function khoroch_transition()
    {
    	return $this->belongsTo(khoroch_transition::class);
    }
	
					 public function externalcost()
    {
    	return $this->belongsTo(externalcost::class);
    }
					 public function employeesalarytransaction()
    {
    	return $this->belongsTo(employeesalarytransaction::class);
    }



					 public function user()
    {
    	return $this->belongsTo(user::class,'User_id');
    }	
	
	
					 public function account()
    {
    	return $this->belongsTo(user::class,'account_id');
    }	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}

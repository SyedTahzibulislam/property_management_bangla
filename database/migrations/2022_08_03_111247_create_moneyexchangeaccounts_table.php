<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoneyexchangeaccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moneyexchangeaccounts', function (Blueprint $table) {
            $table->id();
			$table->foreignId('accountant_id')->nullable();
			$table->foreignId('user_id')->nullable(); // entry by 
			
			
			$table->tinyInteger('type')->default('1');  // 1-> give money to project manager 2-> return 
			
			$table->double('amount')->default(0);
			

			
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('moneyexchangeaccounts');
    }
}

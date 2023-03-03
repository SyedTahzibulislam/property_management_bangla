<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoneyexchangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moneyexchanges', function (Blueprint $table) {
            $table->id();
			$table->foreignId('project_id')->nullable();
			$table->foreignId('user_id')->nullable();
			
			
			$table->tinyInteger('type')->default('1');  // 1-> give money to project manager 2-> return money from manager 
			$table->foreignId('superviser_id')->nullable();
			
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
        Schema::dropIfExists('moneyexchanges');
    }
}

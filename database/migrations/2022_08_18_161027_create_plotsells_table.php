<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlotsellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plotsells', function (Blueprint $table) {
            $table->id();
			$table->foreignId('customer_id')->nullable();
			$table->foreignId('project_id')->nullable();
            $table->foreignId('account_id')->nullable(); // account_id from user table	
            $table->tinyInteger('adjusttype')->nullable();  // 1-> onwe dund 2->accounant 3->project's fund				
			$table->foreignId('user_id');
			$table->foreignId('plot_id')->nullable();
			$table->double('amount')->default(0);
			$table->double('discount')->default(0);
			$table->double('amountafterdiscount')->default(0);
			$table->double('paid')->default(0);
			$table->double('due')->default(0);
			$table->double('due_first')->default(0);
			
			$table->string('comment')->nullable();
            $table->tinyInteger('type')->default('1');  // 1-product bikri 2- due payment 3- money back to customer
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
        Schema::dropIfExists('plotsells');
    }
}

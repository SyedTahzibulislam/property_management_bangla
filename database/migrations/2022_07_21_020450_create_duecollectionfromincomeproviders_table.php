<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDuecollectionfromincomeprovidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('duecollectionfromincomeproviders', function (Blueprint $table) {
            $table->id();
			
	
			$table->foreignId('externalincomeprovider_id');
			$table->foreignId('project_id')->nullable();			
			
			
			$table->foreignId('user_id');
			
			   $table->foreignId('superviser_id')->nullable();
		   
			   
			$table->foreignId('account_id')->nullable();   
			   
            $table->tinyInteger('adjusttype')->nullable();  // 1-> onwe dund 2->accounant 3->project's fund				
			

			$table->double('amount');
			$table->string('comment')->nullable();
			$table->tinyInteger('transitiontype')->default('1');  // 1 -> due collection
			

			
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
        Schema::dropIfExists('duecollectionfromincomeproviders');
    }
}

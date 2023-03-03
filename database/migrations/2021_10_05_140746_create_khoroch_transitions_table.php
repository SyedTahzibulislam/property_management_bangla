<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKhorochTransitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('khoroch_transitions', function (Blueprint $table) {
            $table->id();
			$table->foreignId('user_id');
			$table->foreignId('balance_of_business_id');
			$table->foreignId('khorocer_khad_id');
		    $table->foreignId('supplier_id');
			   $table->foreignId('superviser_id')->nullable();
			   $table->foreignId('project_id')->nullable();			   
			   
			$table->foreignId('account_id')->nullable();   
			   
            $table->tinyInteger('adjusttype')->nullable();  // 1-> onwe dund 2->accounant 3->project's fund				   
   	
			$table->double('unit', 14, 4);
			$table->double('unit_price', 14, 4);
			$table->double('amount', 14, 4);
			$table->double('due', 14, 4)->default(0);
			$table->double('advance', 14, 4)->default(0);
			$table->text('description')->nullable();
			
			

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
        Schema::dropIfExists('khoroch_transitions');
    }
}

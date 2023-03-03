<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUseproducttransitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('useproducttransitions', function (Blueprint $table) {
            $table->id();
			$table->foreignId('project_id')->nullable();
			$table->foreignId('product_id');   
			$table->foreignId('useproduct_id'); 
				$table->foreignId('unitcoversion_id')->nullable();			
			$table->string('unitname')->nullable();
			
			$table->double('sellingunit')->nullable();	
				
		
			
			$table->foreignId('user_id')->nullable();
			$table->double('unirprice')->nullable();
			$table->double('quantity')->nullable();
			$table->double('quantityinbase')->nullable();
			$table->double('amount')->nullable();
	
		
			
			
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
        Schema::dropIfExists('useproducttransitions');
    }
}

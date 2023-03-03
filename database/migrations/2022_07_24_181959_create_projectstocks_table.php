<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectstocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projectstocks', function (Blueprint $table) {
            $table->id();
	          
			$table->foreignId('product_id');
			$table->foreignId('project_id');
		    $table->foreignId('user_id');	
            $table->foreignId('unitcoversion_id');	

				
	
		    $table->double('stock', 12, 2);
			$table->double('unitprice', 12, 2);
			$table->tinyInteger('softdelete')->default('0');
			
			
			
			
			
			
			
			
			
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
        Schema::dropIfExists('projectstocks');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductcompanytransitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productcompanytransitions', function (Blueprint $table) {
            $table->id();
$table->foreignId('balance_of_business_id');
			$table->foreignId('productcompany_id');
$table->foreignId('project_id')->nullable();


			$table->foreignId('product_id');   
			$table->foreignId('productcompanyorder_id');   

	$table->foreignId('unitcoversion_id')->nullable();	

			$table->foreignId('user_id');
			$table->string('unitname');
			$table->integer('buyingunit');
			$table->double('unirprice');
			$table->double('quantity');
			$table->double('quantityinbase');
			$table->double('amount');
	$table->double('discountpercentage')->default(0);
			$table->double('discount')->default(0);
		$table->foreignId('superviser_id')->nullable();
		$table->tinyInteger('adjusttype')->nullable();	// 1-> onwe dund 2->accounant 3->project's fund	 
        $table->foreignId('account_id')->nullable(); // account_id from user table		
			
				$table->tinyInteger('type')->default('1');  // 1-product kroy  2- due payment 3-product ferot  4-product ferot babod company theke   money back neya 5-delete entry 10-reverse entry  11-reverse due enry 12-deleted due entry
			$table->double('finalamountafterdiscount');
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
        Schema::dropIfExists('productcompanytransitions');
    }
}

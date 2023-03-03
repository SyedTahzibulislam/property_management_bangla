<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plots', function (Blueprint $table) {
            $table->id();
			$table->string('name');
			$table->double('amount')->default(0);
			$table->foreignId('project_id')->nullable();
			$table->foreignId('user_id')->nullable();
			$table->foreignId('customer_id')->nullable();
			$table->tinyInteger('softdelete')->default('0');
			$table->tinyInteger('status')->default('0'); // 0- vacant 1-booking 2-sold
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
        Schema::dropIfExists('plots');
    }
}

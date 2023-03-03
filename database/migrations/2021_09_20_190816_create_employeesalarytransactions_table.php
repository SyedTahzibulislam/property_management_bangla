<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesalarytransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employeesalarytransactions', function (Blueprint $table) {
            $table->id();
			$table->foreignId('employeedetails_id');
			$table->foreignId('balance_of_business_id');
			$table->foreignId('project_id')->nullable();	
			$table->foreignId('superviser_id')->nullable();
			$table->foreignId('account_id')->nullable();
			$table->foreignId('adjusttype')->nullable();			
			$table->date( 'starting' )->nullable();
			$table->date( 'ending' )->nullable();
			$table->string( 'month' )->nullable();			
			$table->string( 'year' )->nullable();	
			$table->string( 'month_year' )->nullable();	
			
			
			
			$table->double( 'totalsalary');
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
        Schema::dropIfExists('employeesalarytransactions');
    }
}

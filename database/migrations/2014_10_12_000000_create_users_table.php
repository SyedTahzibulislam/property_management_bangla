<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
			$table->foreignId('balance_of_business_id')->nullable();
			$table->foreignId('superviser_id')->nullable();
			$table->foreignId('customer_id')->nullable();
			
			
            $table->string('name');
            $table->string('email')->unique();
			$table->string('mobile');
            $table->tinyInteger('role')->default(2);
			$table->string('doctor_id')->nullable(); 
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
			$table->double('ob')->nullable();
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
        Schema::dropIfExists('users');
    }
}

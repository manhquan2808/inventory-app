<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table){
            $table->string('employee_id',10)->primary();
            $table->string('first_name',255);
            $table->string('last_name', 255);
            $table->integer('number');
            $table->string('email', 255);
            $table->string('password', 255);
            $table->date('birth_date');
            $table->timestamps();

            $table->unsignedBigInteger('role_id',10);
            // $table->unsignedInteger('inventory_id');
            $table->foreign('role_id')->references('role_id')->on('roles');
            // $table->foreign('inventory_id')->references('inventory_id')->on('inventory');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('employees');
    }
};

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
        Schema::create('inventory', function(Blueprint $table){
            $table->unsignedInteger('inventory_id')->autoIncrement();
            $table->primary('inventory_id');
            $table->string('inventory_name',255);
            $table->string('address',255);
            $table->unsignedInteger('type_id');
            $table->foreign('type_id')->references('type_id')->on('inventory_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory');
    }
};

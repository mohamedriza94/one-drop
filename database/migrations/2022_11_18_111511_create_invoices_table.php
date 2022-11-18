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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('requestNo')->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->string('fullname')->nullable();
            $table->string('nic')->nullable();
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->string('bagNo')->nullable();
            $table->string('bloodGroup')->nullable();
            $table->string('expiryDate')->nullable();
            $table->string('staffName')->nullable();
            $table->string('staffTelephone')->nullable();
        });
    }
    
    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
};

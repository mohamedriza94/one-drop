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
        Schema::create('blood_bags', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('bag_no')->unique();
            $table->string('bloodGroup');
            $table->string('received_date');
            $table->string('received_time');
            $table->string('expiry_date')->nullable();
            $table->string('status');
            $table->string('dateCheck')->nullable();
            $table->string('hospital')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blood_bags');
    }
};

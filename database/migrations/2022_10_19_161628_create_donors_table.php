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
        Schema::create('donors', function (Blueprint $table) {
            $table->id();
            $table->string('no')->unique()->nullable();
            $table->string('registered_date')->nullable();
            $table->string('registered_time')->nullable();
            $table->string('fullname')->nullable();
            $table->text('photo')->nullable();
            $table->string('nic')->unique()->nullable();
            $table->string('address')->nullable();
            $table->string('dateofbirth')->nullable();
            $table->string('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('status')->nullable();
            $table->string('hospital')->nullable();
            $table->string('bloodGroup');
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
        Schema::dropIfExists('donors');
    }
};

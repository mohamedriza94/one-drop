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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('no')->unique();
            $table->string('nic')->unique();
            $table->string('fullname');
            $table->string('address')->unique()->nullable();
            $table->string('telephone')->unique();
            $table->text('photo');
            $table->string('dateofbirth')->nullable();
            $table->string('gender')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role');
            $table->string('status');
            $table->unsignedBigInteger('hospital_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();

            
            $table->Index('hospital_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
};

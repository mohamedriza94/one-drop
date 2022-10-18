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
        Schema::create('donor_requests', function (Blueprint $table) {
            $table->id();
            $table->string('donorRequestNo')->unique();
            $table->string('nic');
            $table->string('fullName');
            $table->string('email');
            $table->string('telephone');
            $table->string('age');
            $table->string('dateOfBirth');
            $table->string('date');
            $table->string('time');
            $table->string('status');
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
        Schema::dropIfExists('donor_requests');
    }
};

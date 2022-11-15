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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('requestNo')->unique();
            $table->string('nic');
            $table->string('fullName');
            $table->string('email')->nullable();
            $table->string('telephone');
            $table->string('bloodGroup');
            $table->string('date');
            $table->string('time');
            $table->string('status');
            $table->string('fulfilDate')->nullable();
            $table->string('bloodBagNo')->nullable();
            $table->string('hospitalNo')->nullable();
            $table->string('hospitalResponse')->nullable();
            $table->text('remark')->nullable();
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
        Schema::dropIfExists('requests');
    }
};

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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('message_no')->unique();
            $table->string('sender');
            $table->string('subject')->nullable();
            $table->string('message');
            $table->string('date');
            $table->string('time');
            $table->string('staff_side_status')->nullable();;
            $table->string('admin_side_status')->nullable();;
            $table->string('hospital_side_status')->nullable();;
            $table->string('donor_side_status')->nullable();;
            $table->string('other_status')->nullable();;
            $table->string('reply_status')->nullable();
            $table->string('sender_id')->nullable();
            $table->string('recipient_id')->nullable();
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
        Schema::dropIfExists('messages');
    }
};

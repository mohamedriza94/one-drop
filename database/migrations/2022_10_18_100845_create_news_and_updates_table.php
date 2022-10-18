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
        Schema::create('news_and_updates', function (Blueprint $table) {
            $table->id();
            $table->string('news_no')->unique();
            $table->string('title');
            $table->text('description');
            $table->text('thumbnail');
            $table->string('status');
            $table->string('time');
            $table->unsignedBigInteger('admin_id');
            $table->timestamps();
            
            $table->Index('admin_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_and_updates');
    }
};
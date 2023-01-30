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
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('code');
            $table->char('acronym', 12);
            $table->char('class', 6);
            $table->char('description', 60);
            $table->char('observation', 120);
            $table->char('responsible', 120);
            $table->integer('status')->default(0);
            $table->time('startTime');
            $table->time('endTime');
            $table->char('room_code', 10);
            $table->foreign('room_code')->references('code')->on('rooms');
            $table->char('user_email', 50);
            $table->foreign('user_email')->references('email')->on('users');
            $table->primary('code');
        });

        Schema::create('reservation_date', function (Blueprint $table) {
            $table->date('date');
            $table->unsignedInteger('reservation_code');
            $table->foreign('reservation_code')->references('code')->on('reservations');
            $table->primary(['date','reservation_code']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservation_date');
        Schema::dropIfExists('reservations');
    }
};

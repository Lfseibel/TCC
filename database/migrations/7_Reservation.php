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
            $table->id('code');
            $table->char('acronym', 12)->nullable();
            $table->char('class', 6)->nullable();
            $table->char('description', 60);
            $table->char('observation', 120);
            $table->char('responsible', 120);
            $table->integer('status')->default(0);
            $table->integer('frequency');
            $table->integer('weekday');
            $table->time('startTime');
            $table->time('endTime');
            $table->char('room_code', 10);
            $table->foreign('room_code')->references('code')->on('rooms')->onDelete('cascade')->onUpdate('cascade');
            $table->char('user_email', 50);
            $table->foreign('user_email')->references('email')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
};

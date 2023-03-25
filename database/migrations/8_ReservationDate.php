<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('reservationDate', function (Blueprint $table) {
            $table->date('date');
            $table->unsignedInteger('reservation_code');
            $table->foreign('reservation_code')->references('code')->on('reservations');
            $table->primary(['date','reservation_code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('reservationDate');
    }
};

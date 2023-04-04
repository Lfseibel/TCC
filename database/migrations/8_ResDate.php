<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservation_dates', function (Blueprint $table) {
            $table->date('date');
            $table->unsignedBigInteger('reservation_code');
            $table->foreign('reservation_code')->references('code')->on('reservations')->onDelete('cascade')->onUpdate('cascade');
            $table->primary(['date','reservation_code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_dates');
    }
};

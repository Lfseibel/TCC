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
        Schema::create('rooms', function (Blueprint $table) {
            $table->char('code', 10);
            $table->integer('capacity');
            $table->integer('reduced_capacity');
            $table->char('block_code', 8);
            $table->foreign('block_code')->references('code')->on('blocks');
            $table->primary('code');
        });

        Schema::create('room_unity', function (Blueprint $table){
            $table->char('room_code', 10);
            $table->foreign('room_code')->references('code')->on('rooms');
            $table->char('unity_code', 8);
            $table->foreign('unity_code')->references('code')->on('unities');
            $table->primary(['room_code', 'unity_code']);
           });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room_unity');
        Schema::dropIfExists('rooms');
    }
};

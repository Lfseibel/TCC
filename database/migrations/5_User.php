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
        Schema::create('users', function (Blueprint $table) {
            $table->char('email', 50);
            $table->char('password', 60);
            $table->char('type', 20);
            $table->char('unity_code', 8)->nullable();
            $table->foreign('unity_code')->references('code')->on('unities')->onDelete('set null');
            $table->rememberToken();
            $table->primary('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};

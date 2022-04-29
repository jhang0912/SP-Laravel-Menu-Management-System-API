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
        Schema::create('managerlogintokens', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->char('token', 32)->unique();
            $table->char('managerID', 32);
            $table->foreign('managerID')->references('managerID')->on('managers');
            $table->string('createdTime', 10);
            $table->string('updatedTime', 10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('managerlogintokens');
    }
};

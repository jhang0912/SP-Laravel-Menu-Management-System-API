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
        Schema::create('managers', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->char('managerID', 32)->unique();
            $table->string('name', 50);
            $table->string('account', 70);
            $table->char('password', 40);
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
        Schema::dropIfExists('managers');
    }
};

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
        Schema::create('MenuItems', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->char('itemID', 32)->unique();
            $table->char('categoryID', 32);
            $table->foreign('categoryID')->references('categoryID')->on('MenuCategories');
            $table->string('name', 70);
            $table->unsignedInteger('price');
            $table->integer('orderBy');
            $table->boolean('toggle');
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
        Schema::dropIfExists('MenuItems');
    }
};

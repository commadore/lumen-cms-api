<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('route')->unique();
            $table->string('name');
            $table->integer('layout_id')->unsigned();
            $table->foreign('layout_id')
                ->references('id')
                ->on('layouts');
            $table->boolean('published');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('pages');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GameSectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_section', function (Blueprint $table) 
        {
            $table->integer('game_id')->unsigned();
            $table->integer('section_id')->unsigned();
            $table->foreign('game_id')->references('id')->on('games');
            $table->foreign('section_id')->references('id')->on('sections');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_section');
    }
}

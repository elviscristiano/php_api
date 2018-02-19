<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayergamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playergames', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->integer('game_id')->unsigned();
            $table->integer('player_id')->unsigned();
            $table->timestamps();
            $table->foreign('game_id')->references('id')->on('games');
            $table->foreign('player_id')->references('id')->on('users');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('playergames');
    }
}

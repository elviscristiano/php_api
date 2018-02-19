<?php

namespace App\Http\Controllers\Game;

use App\Game;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class GameController extends ApiController
{
    /**
     * Display all the games.
     * @example /api/games/
     * @return JSON response
     */
    public function index()
    {
        $games = Game::all();
        return $this->showAll($games);
    }

    /**
     * Display the specified game.
     * @example /api/games/1
     * @param  int game $id
     * @return JSON response
     */
    public function show($id)
    {
        $game = Game::findOrFail($id);
        return $this->showOne($game);
    }

}

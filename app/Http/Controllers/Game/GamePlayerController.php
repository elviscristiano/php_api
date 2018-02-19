<?php

namespace App\Http\Controllers\Game;

use App\Game;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class GamePlayerController extends ApiController
{
    /**
     * Display a listing of players of a given game.
     * @example /api/games/1/players
     * @param int game $id
     * @return JSON response
     */
    public function index($id)
    {
        $game = Game::findOrFail($id);
        $players = $game->playergames()
            ->get()
            ->pluck('player_id');
        return $this->showAll($players);
    }

}

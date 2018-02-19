<?php

namespace App\Http\Controllers\Player;

use App\Http\Controllers\ApiController;
use App\Player;
use Illuminate\Http\Request;

class PlayerController extends ApiController
{
    /**
     * Display a listing of players.
     * A user is a player only if he/she plays at least 1 game
     * @example /api/players/
     * @return JSON response
     */
    public function index()
    {
        $players = Player::has('playergames')->get();
        return $this->showAll($players);
    }

    /**
     * Display a player.
     * @example /api/players/1
     * @param  int player $id
     * @return JSON response
     */
    public function show($id)
    {
        $player = Player::has('playergames')->findOrFail($id);
        return $this->showOne($player);
    }
}

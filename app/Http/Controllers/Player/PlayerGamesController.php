<?php

namespace App\Http\Controllers\Player;

use App\Game;
use App\Http\Controllers\ApiController;
use App\Player;
use Illuminate\Http\Request;

class PlayerGamesController extends ApiController
{
    /**
     * Display the player's games.
     * @example /api/players/1/games
     * @param int player $id
     * @return JSON response
     */
    public function index($id)
    {
        $player = Player::findOrFail($id);
        $playerGame = $player->playergames()
            ->with('games')
            ->get()
            ->pluck('game_id');
        return $this->showAll($playerGame);
    }

    /**
     * Remove a game from the player's list.
     * @example /api/players/2/games/4
     * @param  $playerId
     * @param  $gameId
     * @return JSON response     
     */
    public function destroy($playerId, $gameId)
    {
        $player = Player::findOrFail($playerId);
        $gameId = Game::findOrFail($gameId)->id;
        $game = $player->playergames()
            ->where('game_id',$gameId);
        $game->delete();
        return $this->showAll($player->playergames);
    }

}

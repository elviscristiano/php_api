<?php

namespace App\Http\Controllers\Section;

use App\Game;
use App\Http\Controllers\ApiController;
use App\PlayerGame;
use App\Section;
use Illuminate\Http\Request;

class SectionGameController extends ApiController
{
    /**
     * Display a listing of games per section if the game is active.
     * @example /api/sections/1/games
     * @param int section $id
     * @return JSON response
     */
    public function index($id)
    {
        $section = Section::findOrFail($id);
        $activeGames = $section->games()
            ->whereHas('playergames')
            ->with('playergames')
            ->get()
            ->pluck('playergames')
            ->collapse()
            ->pluck('game_id')
            ->unique()
            ->values();
        //Fetch additional information from the games    
        $readableActiveGames = collect();
        foreach ($activeGames as $key => $value)
        {
            $gameObj[$value] = Game::findOrFail($value);
            $readableActiveGames[$key] = $gameObj[$value];
        }
        return $this->showAll($readableActiveGames);
    }

}


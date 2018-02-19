<?php

namespace App\Http\Controllers\Section;

use App\Http\Controllers\ApiController;
use App\Section;
use Illuminate\Http\Request;

class SectionPlayerController extends ApiController
{
    /**
     * Display a listing of players and their games' sections.
     * @param int section $id
     * @return JSON response
     */
    public function index($id)
    {
        $section = Section::findOrFail($id);
        $players = $section->games()
            ->whereHas('playergames')
            ->with('playergames')
            ->get()
            ->pluck('playergames')
            ->collapse()
            ->pluck('player_id')
            ->unique()
            ->values();

        return $this->showAll($players);
    }

}

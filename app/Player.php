<?php

namespace App;

use App\PlayerGame;

class Player extends User
{

    public function playergames()
    {
    	return $this->hasMany(PlayerGame::class);
    }
}

<?php

namespace App;

class Publisher extends User
{

    public function games()
    {
    	return $this->hasMany(Game::class);
    }
}

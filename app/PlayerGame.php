<?php

namespace App;

use App\Game;
use App\Player;
use Illuminate\Database\Eloquent\Model;

class PlayerGame extends Model
{

    protected $table = 'playergames';

    protected $fillable = 
    [
       	'game_id',
       	'player_id'
    ];

    public function games()
    {
    	return $this->belongsTo(Game::class);
    }

    public function players()
    {
    	return $this->belongsTo(Player::class);
    }


}

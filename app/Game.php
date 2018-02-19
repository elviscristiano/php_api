<?php

namespace App;

use App\Player;
use App\PlayerGame;
use App\Publisher;
use App\Section;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = 
    [
       	'title',
       	'publisher_id',
       	'image'
    ];

    public function playergames()
    {
      return $this->hasMany(PlayerGame::class);
    }

    public function publishers()
    {
    	return $this->belongsTo(Publisher::class);
    }

    public function sections()
    {
    	return $this->belongsToMany(Section::class);
    }

}

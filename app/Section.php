<?php

namespace App;

use App\Game;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = 
    [
       	'name'
    ];

    public function games()
    {
    	return $this->belongsToMany(Game::class);
    }
}

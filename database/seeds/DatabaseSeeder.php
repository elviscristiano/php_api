<?php

use App\Game;
use App\PlayerGame;
use App\Publisher;
use App\Section;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('game_section')->truncate();//pivot table doesn't have a model
        Game::truncate();
        Publisher::truncate();
        PlayerGame::truncate();
        Section::truncate();
        User::truncate();

        $gameSeeds = 9;
        $playerGameSeeds = 50;
        $publisherSeeds = 5;
        $sectionSeeds = 4;
        $userSeeds = 50;

        factory(User::class, $userSeeds)->create();
        factory(Section::class, $sectionSeeds)->create();
        factory(Game::class, $gameSeeds)->create()->each(
        	function($game)
        	{
        		$sections = Section::all()->random(mt_rand(1,4))->pluck('id');
        		$game->sections()->attach($sections);
        	}
        );
        factory(PlayerGame::class, $playerGameSeeds)->create();
        factory(Publisher::class, $publisherSeeds)->create();

    }
}

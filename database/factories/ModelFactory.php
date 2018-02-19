<?php

use App\Game;
use App\PlayerGame;
use App\Publisher;
use App\Section;
use App\User;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) 
{
    return 
    [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
        'remember_token' => str_random(10)
    ];
});

$factory->define(Section::class, function (Faker $faker) {
    return 
    [
        'name' => $faker->randomElement(['Action','Adventure','Arcade','Sports'])
    ];
});

$factory->define(PlayerGame::class, function (Faker $faker) 
{
    return 
    [
        'game_id' => Game::all()->random()->id,
        'player_id' => User::all()->random()->id
    ];
});

$factory->define(Publisher::class, function (Faker $faker) 
{
    return 
    [
        'name' => $faker->name
    ];
});

$factory->define(Game::class, function (Faker $faker) 
{
    return 
    [
        'title' => $faker->word,
        'publisher_id' => Publisher::all()->random()->id,
        'image' => $faker->randomElement(['brave.jpg','callofduty.jpg','grid.jpg','gta.jpg','halo.jpg','legostar.jpg','nfl.jpg','owlboy','pacman.jpg'])
    ];
});

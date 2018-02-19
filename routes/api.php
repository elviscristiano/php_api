<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// games routes
Route::resource('games','Game\GameController',['only' => ['index','show']]);
Route::resource('games.players','Game\GamePlayerController',['only' => ['index']]);

//players routes
Route::resource('players','Player\PlayerController',['only' => ['index','show']]);
Route::resource('players.games','Player\PlayerGamesController',['only' => ['index','destroy']]);

// publishers routes
Route::resource('publishers','Publisher\PublisherController',['only' => ['index','show']]);
Route::resource('publishers.games','Publisher\PublisherGameController',['except' => ['create','edit','show']]);

// sections routes
Route::resource('sections','Section\SectionController',['except' => ['create','edit']]);
Route::resource('sections.games','Section\SectionGameController',['only' => ['index']]);
Route::resource('sections.players','Section\SectionPlayerController',['only' => ['index']]);

// users routes
Route::resource('users','User\UserController',['except' => ['create','edit']]);

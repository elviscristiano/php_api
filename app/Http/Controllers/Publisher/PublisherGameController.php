<?php

namespace App\Http\Controllers\Publisher;

use App\Game;
use App\Http\Controllers\ApiController;
use App\Publisher;
use App\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PublisherGameController extends ApiController
{
    /**
     * Display a listing of games per publisher.
     * @param int publisher $id
     * @return JSON response
     */
    public function index($id)
    {
        $publisher = Publisher::findOrFail($id);
        $games = $publisher->games;
        return $this->showAll($games);
    }

    /**
     * Store a newly created game in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Publisher's id
     * @return JSON response
     */
    public function store(Request $request, $publisherId)
    {
        $publisher = User::findOrFail($publisherId);
        $rules = 
        [
            'title' => 'required',
            'image' => 'required|image'
        ];
        $this->validate($request, $rules);
        $data = $request->all();
        $data['image'] = 'pacman.jpg';
        $data['publisher_id'] = $publisher->id;
        $game = Game::create($data);
        return $this->showOne($game);
    }

    /**
     * Update a game in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  $publisherId
     * @param  $gameId
     * @return JSON response
     */
    public function update(Request $request, $publisherId, $gameId)
    {
        $publisher = Publisher::findOrFail($publisherId);
        $game = Game::findOrFail($gameId);
        $rules = 
        [  
            'title' => 'required',
            'image' => 'image'
        ];
        $this->validate($request, $rules);

        $this->checkPublisher($publisher->id, $game->publisher_id);

        $game->fill($request->only(['title']));

        if ($game->sections()->count() == 0)
        {
            return $this->errorResponse('Missing section. A game must have a section.', 409);
        }

        if (!$game->isDirty())
        {
            return $this->errorResponse('Nothing to update', 422);
        }
        $game->save();
        return $this->showOne($game);
    }

    /**
     * Remove a game from the storage.
     *
     * @param  $publisherId
     * @param  $gameId
     * @return JSON response     
     */
    public function destroy($publisherId, $gameId)
    {
        $publisher = Publisher::findOrFail($publisherId);
        $game = Game::findOrFail($gameId);
        $this->checkPublisher($publisher->id, $game->publisher_id);
        $game->delete();
        return $this->showOne($game);
    }

    /**
     * Compare the publisher's id with game's publisher id.
     * @param int $publisherId
     * @param int $gamePublisherId
     */
    protected function checkPublisher($publisherId, $gamePublisherId)
    {
        if ($publisherId != $gamePublisherId)
        {
            throw new HttpException("Publisher conflict.", 422);
        }
    }

}
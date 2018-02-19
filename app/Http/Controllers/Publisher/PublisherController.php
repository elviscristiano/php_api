<?php

namespace App\Http\Controllers\Publisher;

use App\Http\Controllers\ApiController;
use App\Publisher;
use Illuminate\Http\Request;

class PublisherController extends ApiController
{
    /**
     * Display a listing of publishers.
     * @return JSON response
     */
    public function index()
    {
        $publishers = Publisher::has('games')->get();
        return $this->showAll($publishers);
    }

    /**
     * Display a publisher.
     * @param  int  $id
     * @return JSON response
     */
    public function show($id)
    {
        $publisher = Publisher::has('games')->findOrFail($id);
        return $this->showOne($publisher);
    }

}

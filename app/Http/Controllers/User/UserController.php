<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiController;
use App\User;
use Illuminate\Http\Request;

class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return JSON response
     */
    public function index()
    {
        $users = User::all();
        return $this->showAll($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JSON response
     */
    public function store(Request $request)
    {
        $rules = 
        [
            'name' => 'required',
            //'email' => 'required|email|unique:users',
            //'password' => 'required|min:4|confirmed',
        ];
        $this->validate($request, $rules);
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $user = User::create($data);
        return $this->showOne($user, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JSON response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return $this->showOne($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return JSON response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if ($request->has('name'))
        {
            $user->name = $request->name;
        }
        //checking if something has changed
        if (!$user->isDirty())
        {
            return $this->errorResponse('Nothing to update', 422);
        }
        $user->save();
        return $this->showOne($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JSON response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return $this->showOne($user);
    }
}

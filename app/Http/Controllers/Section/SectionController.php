<?php

namespace App\Http\Controllers\Section;

use App\Http\Controllers\ApiController;
use App\Section;
use Illuminate\Http\Request;

class SectionController extends ApiController
{
    /**
     * Display a listing of sections.
     * @example /api/sections
     * @return JSON response
     */
    public function index()
    {
        $sections = Section::all();
        return $this->showAll($sections);
    }

    /**
     * Store a newly created section.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return JSON response
     */
    public function store(Request $request)
    {
        $rules = 
        [
            'name' => 'required'
        ];
        $this->validate($request, $rules);
        $data = $request->all();
        $section = Section::create($data);
        return $this->showOne($section, 200);
    }

    /**
     * Display a section.
     * @example /api/sections/1
     * @param  int section $id
     * @return JSON response
     */
    public function show($id)
    {
        $section = Section::findOrFail($id);
        return $this->showOne($section);
    }

    /**
     * Update a section in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return JSON response
     */
    public function update(Request $request, $id)
    {
        $section = Section::findOrFail($id);
        if ($request->has('name'))
        {
            $section->name = $request->name;
        }
        //checking if something has changed
        if (!$section->isDirty())
        {
            return $this->errorResponse('Nothing to update', 422);
        }
        $section->save();
        return $this->showOne($section);
    }

    /**
     * Remove a section from storage.
     *
     * @param  int  $id
     * @return JSON response
     */
    public function destroy($id)
    {
        $section = Section::findOrFail($id);
        $section->delete();
        return $this->showOne($section);
    }

}

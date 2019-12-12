<?php

namespace App\Http\Controllers\Levels;

use App\Models\Level;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Resources\LevelResource;
use App\Http\Controllers\ApiController;

class LevelController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $vans['level'] = Level::with('subjects')->get();
        $vans['level'] = LevelResource::collection(Level::latest()->get());
        $vans['subject'] = Subject::all();
        return $vans;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
        ];

        $this->validate($request, $rules);
        $data = [
            'name' => $request['name'],
            'description' => $request['description'],
        ];
        $van = Level::create($data);

        $subjects = $request->subjects;
        if ($request->subjects == null) {
            $subjects = [];
        }
        $van->subjects()->sync($subjects);

        return $this->showOne($van, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\level  $level
     * @return \Illuminate\Http\Response
     */
    public function show(Level $level)
    {
        return new LevelResource($level);
        // return $this->showOne($level);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\level  $level
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Level $level)
    {
        if ($request->has('name')) {
            $level->name = $request->name;
        }
        if ($request->has('description')) {
            $level->description = $request->description;
        }

        if (!$level->isDirty()) {
            return $this->errorResponse('Nothing to update Friend', 422);
        }
        $level->update();
        return $this->showOne($level);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Stream  $stream
     * @return \Illuminate\Http\Response
     */
    public function destroy(Level $level)
    {
        $level->delete();
        return $this->showOne($level);
    }
}

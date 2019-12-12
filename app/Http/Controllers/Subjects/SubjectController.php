<?php

namespace App\Http\Controllers\Subjects;

use App\User;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Resources\SubjectResource;
use Symfony\Component\Console\Question\Question;

class SubjectController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $vans = Subject::all();
        $vans = SubjectResource::collection(Subject::latest()->get());
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
        $data = $request->all();
        $van = Subject::create($data);
        return $this->showOne($van);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        return new SubjectResource($subject);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        if ($request->has('name')) {
            $subject->name = $request->name;
        }
        if ($request->has('description')) {
            $subject->description = $request->description;
        }
        if (!$subject->isDirty()) {
            return $this->errorResponse('Nothing to update Friend', 422);
        }
        if (!$subject->isClean()) {
            $subject->update();
            return $this->showOne($subject);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return $this->showOne($subject);
    }
}

<?php

namespace App\Http\Controllers\Results;

use App\Models\Result;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vans = Student::all();
        return $this->showAll($vans);
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
            'mark' => 'required|float',
        ];
        $this->validate($request, $rules);
        $data = $request->all();
        $van = Result::create($data);
        return $this->showOne($van, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Result $result)
    {
        return $this->showOne($result, 201);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Result $result)
    {
        if ($request->has('mark')) {
            $result->mark = $request->mark;
        }
        if (!$result->isDirty()) {
            return $this->errorResponse('Nothing to update Friend', 422);
        }
        $result->update();
        return $this->showOne($result, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Result $result)
    {
        //
    }
}

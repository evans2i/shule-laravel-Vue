<?php

namespace App\Http\Controllers\Students;

use App\Models\Result;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Resources\ResultResource;
use App\Http\Controllers\ApiController;

class StudentResultController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Student $student)
    {
        // $vans  = $student->with('results')->get();
        $id = $student->id;

        dd($id);


        $vans = ResultResource::collection(Result::where('student_id', $student)->get());
        return $vans;
    }
}

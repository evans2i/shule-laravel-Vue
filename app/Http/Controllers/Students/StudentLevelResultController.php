<?php

namespace App\Http\Controllers\Students;

use App\Models\Level;
use App\Models\Result;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Resources\ResultResource;
use App\Http\Controllers\ApiController;

class StudentLevelResultController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Student $student, Level $level)
    {
        $vans = ResultResource::collection(
            Result::where(
                [
                    'student_id' => $student->id,
                    'stream_id' => $student->stream_id,
                    'level_id' => $level->id
                ]
            )->get()
        )->unique('id')->values();

        // return $this->showAll($vans, 200);
        return $vans;
    }
}

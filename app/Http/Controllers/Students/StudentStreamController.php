<?php

namespace App\Http\Controllers\Students;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentStreamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Student $student)
    {
        $van = $student->stream;
    	return $this->showOne($van);
    }
}

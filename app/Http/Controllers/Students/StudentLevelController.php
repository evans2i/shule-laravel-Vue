<?php

namespace App\Http\Controllers\Students;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Resources\LevelResource;
use App\Http\Resources\StudentResource;

class StudentLevelController extends ApiController
{
	public function index(Student $student)
	{
		$levels = $student->stream->levels()->get();
		// $levels = $student->stream->with('levels')->get();

		return $levels;
	}
}

<?php

namespace App\Http\Controllers\Students;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class StudentSubjectController extends ApiController
{
   	public function index(Student $student ){
   		// $vans = $student->stream->levels()->subject()->get();
   		$vans = $student->stream
   				// ->whereHas('levels')
   				// ->with('levels.subjects')
   				// ->get()
   				// ->pluck('levels')
   				// ->collapse()
   				// ->pluck('subjects')
   				// ->unique('id')
   				// ->values();
   				->levels()->with('subjects')
   				->get();
   				return $vans;
   		 // return $this->showAll($vans);
  	}
}

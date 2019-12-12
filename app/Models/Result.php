<?php

namespace App\Models;

use App\Models\Level;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Result extends Model
{

  use SoftDeletes;
  protected $guarded = ['id'];
  protected $dates = ['deleted_at', 'created_at', 'updated_at'];

  public function subject()
  {
    return $this->belongsTo(Subject::class);
  }
  public function level()
  {
    return $this->belongsTo(Level::class);
  }
  public function student()
  {
    return $this->belongsTo(Student::class);
  }
  public function stream()
  {
    return $this->belongsTo(Stream::class);
  }
}

<?php

namespace App\Models;

use App\User;
use App\Models\Stream;
use App\Models\Subject;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($student) {
            $student->slug = Str::slug($student->parent_name . $student->id);
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    use SoftDeletes;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
    public function students()
    {
        return $this->belongsToMany(Subject::class);
    }
    public function stream()
    {
        return $this->belongsTo(Stream::class);
    }
    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function getPathAttribute()
    {
        return "/students/$this->slug";
    }

    public function getLevelAttribute()
    {
        return "/students/$this->slug/levels/";
    }

    // public function resultsall()
    // {
    //     return $this->stream->levels()->with('subjects.result')->get();
    // }

}

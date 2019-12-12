<?php

namespace App\Models;

use App\Models\Level;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stream extends Model
{
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($stream) {
            $stream->slug = Str::slug($stream->name);
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    use SoftDeletes;
    public $table = 'streams';
    protected $guarded = ['id'];
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    public function students()
    {
        return $this->hasMany(Student::class);
    }
    public function levels()
    {
        return $this->belongsToMany(Level::class);
    }
    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

    public function getPathAttribute()
    {
        return "/streams/$this->slug";
    }
}

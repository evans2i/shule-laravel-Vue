<?php

namespace App\Models;

use App\Models\Level;
use App\Models\Staff;
use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($subject) {
            $subject->slug = Str::slug($subject->name);
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    use SoftDeletes;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    public function levels()
    {
        return $this->belongsToMany(Level::class);
    }
    public function staffs()
    {
        return $this->belongsToMany(Staff::class);
    }
    public function students()
    {
        return $this->belongsToMany(Student::class);
    }
    public function result()
    {
        return $this->hasOne(Result::class);
    }

    public function getPathAttribute()
    {
        return "/subjects/$this->slug";
    }
}

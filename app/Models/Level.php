<?php

namespace App\Models;

use App\Models\Stream;
use App\Models\Subject;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Level extends Model
{
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($level) {
            $level->slug = Str::slug($level->name);
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    use SoftDeletes;
    public $table = 'levels';
    protected $guarded = ['id'];
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    public function streams()
    {
        return $this->belongsToMany(Stream::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

    public function getPathAttribute()
    {
        return "/levels/$this->slug";
    }
}

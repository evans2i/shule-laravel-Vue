<?php

namespace App\Models;

use App\User;
use App\Models\Subject;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($staff) {
            $staff->slug = Str::slug($staff->qualification . $staff->id);
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    const SUPPORTIVE = 'supportive';
    const TEACHING = 'teaching';
    use SoftDeletes;

    public $table = 'staffs';

    protected $guarded = ['id'];
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }
    public function streams()
    {
        return $this->belongsToMany(Stream::class);
    }

    public function getPathAttribute()
    {
        return "/staffs/$this->slug";
    }
}

<?php

namespace App;

use App\Models\Staff;
use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($user) {
            $user->slug = Str::slug($user->email);
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    use SoftDeletes;
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'last_name', 'middle_name', 'phone', 'address',
    ];


    // protected $guarded = ['id'];
    // protected $dates = ['deleted_at','created_at','updated_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function student()
    {
        return $this->hasOne(\App\Models\Student::class);
    }

    public function staff()
    {
        return $this->hasOne(\App\Models\Staff::class);
    }


    public function setNameAttribute($name)
    {
        $this->attributes['name'] = strtolower($name);
    }

    public function getNameAttribute($name)
    {
        return ucwords($name);
    }
    // public function setLast_nameAttribute($last_name){
    //     $this->attributes['last_name'] = strtolower($last_name);
    // }

    // public function getLast_nameAttribute($last_name){
    //     return ucwords($last_name);
    // }

    //  public function setMiddle_nameAttribute($middle_name){
    //     $this->attributes['middle_name'] = strtolower($middle_name);
    // }

    // public function getMiddle_nameAttribute($middle_name){
    //     return ucwords($middle_name);
    // }

    public function setEmailAttribute($email)
    {
        $this->attributes['email'] = strtolower($email);
    }

    public function getPathAttribute()
    {
        return "/users/$this->slug";
    }
}

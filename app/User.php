<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public $incrementing = false;

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role', 'id','level_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function lecturer()
    {
    	return $this->hasOne('App\Models\Lecturer');
    }

	public function student()
	{
		return $this->hasOne('App\Models\Student');
	}

	public function studentClasses()
	{
		return $this->hasMany('App\Models\StudentClass', 'class_id');
	}

	public function lecturerClasses()
	{
		return $this->hasMany('App\Models\SchoolClass');
	}
}

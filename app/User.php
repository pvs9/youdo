<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'last_name', 'first_name', 'phone', 'email', 'password', 'experience', 'guarantees', 'type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = [
		'created_at', 'updated_at', 'deleted_at'
	];

	/**
	 * Get the resumes for the user.
	 */
	public function resumes()
	{
		return $this->hasMany('App\Resume');
	}

	/**
	 * Get the categories for the user.
	 */
	public function categories()
	{
		return $this->belongsToMany('App\Category')->withPivot('price');
	}

	/**
	 * Get districts for the user.
	 */
	public function districts()
	{
		return $this->belongsToMany('App\District');
	}
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
	];

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = [
		'created_at', 'updated_at',
	];


	/**
	 * Get the websites for the speciality.
	 */
	public function websites()
	{
		return $this->hasMany('App\Website');
	}

	/**
	 * Get the categories for the speciality.
	 */
	public function categories()
	{
		return $this->hasMany('App\Category');
	}
}
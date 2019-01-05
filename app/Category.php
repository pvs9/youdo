<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
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
	 * Get the speciality for the category.
	 */
	public function speciality()
	{
		return $this->belongsTo('App\Speciality');
	}

	/**
	 * Get resumes for the category.
	 */
	public function resumes()
	{
		return $this->belongsToMany('App\Resume')->withPivot('price');
	}


	/**
	 * Get resumes for the category.
	 */
	public function users()
	{
		return $this->belongsToMany('App\User');
	}
}
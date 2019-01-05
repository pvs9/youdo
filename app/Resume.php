<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'price',
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
	 * Get the category for the resume.
	 */
	public function category()
	{
		return $this->belongsTo('App\Category');
	}

	/**
	 * Get the user for the resume.
	 */
	public function user()
	{
		return $this->belongsTo('App\User');
	}

	/**
	 * Get the reviews for the resume.
	 */
	public function reviews()
	{
		return $this->hasMany('App\Review');
	}
}
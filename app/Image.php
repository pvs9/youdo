<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'path',
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
	 * Get the user for the image.
	 */
	public function user()
	{
		return $this->belongsTo('App\User');
	}

	/**
	 * Get the website for the image.
	 */
	public function website()
	{
		return $this->belongsTo('App\Website');
	}
}
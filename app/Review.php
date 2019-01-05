<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'title', 'description', 'rating',
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
	 * Get the resume for the review.
	 */
	public function resume()
	{
		return $this->belongsTo('App\Resume');
	}
}
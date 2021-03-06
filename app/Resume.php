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
		'experience', 'is_urgent', 'with_loaders', 'rating', 'is_paid', 'is_active',
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
	 * Get categories for the resume.
	 */
	public function categories()
	{
		return $this->belongsToMany('App\Category')->withPivot('price');
	}

	/**
	 * Get the user for the resume.
	 */
	public function user()
	{
		return $this->belongsTo('App\User');
	}

	/**
	 * Get the website for the resume.
	 */
	public function website()
	{
		return $this->belongsTo('App\Website');
	}

	/**
	 * Get reviews for the resume.
	 */
	public function reviews()
	{
		return $this->hasMany('App\Review');
	}

	public function scopeByExperience($query, $experience)
	{
		if($experience)
			return $query->where('experience', 'like', '%'.$experience.'%');
		else
			return $query;
	}
}
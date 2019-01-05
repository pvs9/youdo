<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'address',
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
	 * Get the region that owns the website.
	 */
	public function region()
	{
		return $this->belongsTo('App\Region');
	}

	/**
	 * Get the the speciality that owns the website.
	 */
	public function speciality()
	{
		return $this->belongsTo('App\Speciality');
	}
}
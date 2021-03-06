<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
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
	 * Get districts for the region.
	 */
	public function districts()
	{
		return $this->hasMany('App\District');
	}

	/**
	 * Get werbsites for the region.
	 */
	public function websites()
	{
		return $this->hasMany('App\Website');
	}
}
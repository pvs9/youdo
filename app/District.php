<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
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
	 * Get the region for the district.
	 */
	public function region()
	{
		return $this->belongsTo('App\Region');
	}

	/**
	 * Get users for the district.
	 */
	public function users()
	{
		return $this->belongsToMany('App\User');
	}
}
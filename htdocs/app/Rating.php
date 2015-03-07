<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'series_ratings';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['rating'];

}

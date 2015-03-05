<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'exercises';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['question', 'tips', 'start_code', 'expected_result', 'serieId'];
}
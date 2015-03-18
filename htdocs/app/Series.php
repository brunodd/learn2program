<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Series extends Model {

    public $timestamps = false;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'series';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['title', 'description', 'makerId', 'tId'];

}

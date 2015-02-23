<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'Types';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['subject', 'difficulty'];

}

<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model {

    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'answers';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['given_code'];

}

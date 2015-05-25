<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model {

    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'challenges';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [];

}


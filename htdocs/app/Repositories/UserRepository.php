<?php namespace App\Repositories;

use App\User;
use App\Helpers;

class UserRepository {

	private $user;
	private $count;

	public function findByUsernameOrCreate($userData) {
		if($userData->email == '') {
			$userData->email = "not initialized";;
		}
		$count = User::where('username', '=', $userData->name)->count();
		if ($count == 0) {
			return User::firstOrCreate([
				'username' 	=> $userData->name,
				'mail'		=> $userData->email,
				'pass' 		=> $userData->token
			]);
		} else {
			return User::firstOrCreate([
				'username' 	=> $userData->name
			]);
		}
		//return $user;
	}


}
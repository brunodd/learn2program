<?php namespace App\Repositories;

use App\User;
use App\Helpers;

class UserRepository {

	private $user;
	private $count;

	// for facebook
	public function findByUsernameOrCreate($me) {
		if($me['email'] == '') {
            $me['email'] = "not initialized";;
        }
        $count = \App\User::where('username', '=', $me['name'])->count();
        $user = new \App\User;
        if ($count == 0) {
            return \App\User::firstOrCreate([
                'username'  => $me['name'],
                'mail'      => $me['email'],
                'pass'      => $me['updated_time']
            ]);
        } else {
            return \App\User::firstOrCreate([
                'username'  => $me['name']
            ]);
        }
	}

	// For twitter
	public function findByUsernameOrCreate2($userData) {
		/*if($userData->email == '') {
			$userData->email = "not initialized";;
		}*/
		$count = User::where('username', '=', $userData->name)->count();
		if ($count == 0) {
			return User::firstOrCreate([
				'username' 	=> $userData->name,
				'mail'		=> "not initialized",//$userData->email,
				'pass' 		=> $userData->created_at
			]);
		} else {
			return User::firstOrCreate([
				'username' 	=> $userData->name
			]);
		}

	}

}
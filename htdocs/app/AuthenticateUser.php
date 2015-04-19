<?php namespace App;



use Illuminate\Contracts\Auth\Guard;
use Laravel\Socialite\Contracts\Factory as Socialite;
use App\Repositories\UserRepository;

class AuthenticateUser {

	private $users;
	private $socialite;
	private $auth;

	public function __construct(UserRepository $users, Socialite $socialite, Guard $auth) {
		$this->users = $users;
		$this->socialite = $socialite;
		$this->auth = $auth;

	}

	public function execute($hasCode, AuthenticateUserListener $listener) {
		if (! $hasCode) return $this->getAuthorizationFirst();

		$user = $this->users->findByUsernameOrCreate($this->getFacebookUser());

		$this->auth->login($user);
		//dd($user);
		return $listener->userHasLoggedIn($user);
	}

	private function getFacebookUser() {
		return $this->socialite->driver('facebook')->user();
	}

	private function getAuthorizationFirst() {
		return $this->socialite->driver('facebook')->redirect();
	}

}
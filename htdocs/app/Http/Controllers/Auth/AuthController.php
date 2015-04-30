<?php namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CreateUserRequest;

use App\AuthenticateUser;
use App\AuthenticateUserListener;
use App\Repositories\UserRepository;


class MyGuard extends \Illuminate\Auth\Guard {
    public function attempt(array $credentials = [], $remember = false, $login = true)
    {
        $this->fireAttemptEvent($credentials, $remember, $login);

        $this->lastAttempted = $user = $this->provider->retrieveByCredentials($credentials);

        // If an implementation of UserInterface was returned, we'll ask the provider
        // to validate the user against the given credentials, and if they are in
        // fact valid we'll log the users into the application and return true.
        if ($this->hasValidCredentials($user, $credentials))
        {
            if ($login) $this->login($user, $remember);

            return true;
        }

        return false;
    }
}

class AuthController extends Controller implements AuthenticateUserListener {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar) {
		$this->auth = $auth;
		$this->registrar = $registrar;

        $this->middleware('guest', ['except' => 'getLogout']);
        //$this->middleware('guest', ['only' => 'getLogout']);
	}

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister() {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(CreateUserRequest $request) {
        $validator = $this->registrar->validator($request->all());

        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator
            );
        }
        $username = $request->username;
        $mail = $request->mail;
        //$pass = bcrypt($request->pass);
        $pass = Hash::make($request->pass);

        //dd(Hash::check($request->pass, $pass));

        \DB::insert('insert into `users` (`username`, `mail`, `pass`) values (?, ?, ?)', array($username, $mail, $pass));

        $user = \DB::select('select * from users where username = ?', array($username));
        $this->auth->loginUsingId($user[0]->id);

        //$user = $this->registrar->create($request->all());
        //$this->auth->attempt(['mail' => $mail, 'pass' => $pass]);

        return redirect("/");
    }


    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin() {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request) {
        $user = \DB::select('select * from users where username = ?', [$request->username]);
        if(empty($user)) {
            $user = \DB::select('select * from users where mail = ?', [$request->username]);
        }

        /*
        $a = Hash::make($request->pass);
        $d = Hash::make($request->pass);
        $b = Hash::check($request->pass, Hash::make('a'));
        $c = array($a, $d, $b);
        dd($c);
        */

        //dd(Hash::make($request->pass), $user[0]->pass, Hash::check($request->pass, $user[0]->pass));
        if(!empty($user) && Hash::check($request->pass, $user[0]->pass)) {
            //dd($user[0]->id);
            $this->auth->loginUsingId($user[0]->id/*, $request->has('remember')*/);
            return redirect()->intended("/");
        }

        return redirect("/login")
            ->withInput($request->only('mail', 'remember'))
            ->withErrors('These credentials do not match our records.');


        /*
        $this->validate($request, [
            'mail' => 'required|email', 'pass' => 'required',
        ]);

        $credentials = $request->only('mail', 'pass');
        if ($this->auth->attempt($credentials, $request->has('remember')))
        {
            return redirect()->intended("/");
        }

        return redirect("/login")
            ->withInput($request->only('mail', 'remember'))
            ->withErrors('These credentials do not match our records.');*/
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout() {

        $facebook = new \Facebook(\Config::get('facebook'));
        $this->auth->logout();
        $uid = $facebook->getUser();

        if($uid != 0) {
            $params = array( 'next' => url('/facebook/callback'));
            $facebookLogoutUrl = $facebook->getLogoutUrl($params);
            $facebook->destroySession();
            return redirect($facebookLogoutUrl);
        }
        return redirect('/');
    }

    public function facebookLogin() {
        $facebook = new \Facebook(\Config::get('facebook'));
        $params = array(
            'redirect_uri' => url('/facebook/callback'),
            'scope' => 'email',
        );
        return redirect($facebook->getLoginUrl($params));
    }

    public function facebookCallback(\App\Repositories\UserRepository $listener) {
        $code = \Input::get('code');
        if (strlen($code) == 0) return redirect('/login')->with('message', 'There was an error communicating with Facebook');

        $facebook = new \Facebook(\Config::get('facebook'));
        $uid = $facebook->getUser();
        
        if ($uid == 0) return redirect('/login')->with('message', 'There was an error');

        $me = $facebook->api('/me');
       
        $user = $listener->findByUsernameOrCreate($me);

        \Auth::login($user);

        return redirect('/')->with('message', 'Logged in with Facebook');
    }

    public function twitterLogin(AuthenticateUser $authenticateUser, Request $request) {
        //return \Socialite::with('twitter')->redirect();
        return $authenticateUser->execute($request->has('oauth_token'), $this);
        //return \Socialite::with('facebook')->redirect();
        //return view('auth.loginFB');
    }
    public function userHasLoggedIn($user) {
        return redirect('/');
    }

}

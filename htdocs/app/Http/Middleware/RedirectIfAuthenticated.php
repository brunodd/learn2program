<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;

class RedirectIfAuthenticated {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard  $auth
	 * @return void
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if ($this->auth->check())
		{
            //\Session::flash('flash_message', 'You cannot do that when already logged in.');
            //\Session::flash('flash_message_important', true);
            //      OR
            //session()->flash('flash_message', 'You cannot do that when already logged in.');
            //session()->flash('flash_message_important', true);
            //      OR
            //return redirect('blabla')->with([
            //    'flash_message' => 'You cannot do that when already logged in',
            //    'flash_message_important' => true
            //]);

            //using a flash package
            flash()->error('You cannot do that when already logged in.')->important();

            //flash()->overlay('You cannot do that when already logged in', 'Bad boy!');

			return new RedirectResponse(url('/'));

		}

		return $next($request);
	}

}

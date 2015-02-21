<?php namespace App\Http\Controllers;

use App\User;   // Added to find User model.
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Http\Request;
use Request;    // Enable use of 'Request' in stead of 'Illuminate\Http\Request'

class UserController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return view('user.home');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('user.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        // Work On the Form
        $rules = [
                'username' => 'required|unique:users',
                'pass' => 'required'
                ];

        $validation = Validator::make(Request::all(), $rules);

        if($validation->fails()) {
            $msg = "Illegal input";
            $alert = "You gave incorrect input.";
            return view('user.error', compact('msg', 'alert'));
        }
        else {
            // Start working on this data
            $username = Request::get('username');
            $pass = Request::get('pass');

            // Create User object (model)
            $user = new User;
            $user->username = $username;
            $user->pass = $pass;

            // Store in Databse
            storeUser($user);

            if(empty(loadUser($username))) {
                $msg = "User failed to be saved.";
                $alert = "For an unknown reason, the user could not be stored in our database.";
                return view('user.error', compact('msg', 'alert'));
            }
            // Storing of user is succesful.
            else {
                $myuser = loadUser($username)[0];

                return redirect('user/' . $myuser->id . '/edit');

            }
        }
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        if(empty(loadUser($id))) {
            $msg = "Unknown user";
            $alert = "This user doesn't exist.";
            return view('user.error', compact('msg', 'alert'));
        }
        else {
            $user = loadUser($id)[0];
            return view('user.show', compact('user'));
        }
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        if(empty(loadUser($id))) {
            $msg = "Unknown user";
            $alert = "This user doesn't exist.";
            return view('user.error', compact('msg', 'alert'));
        }
        else {
            $user = loadUser($id)[0];
            return view('user.edit', compact('user'));
        }
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		return "update item with id: $id";
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        return "destroy item with id: $id";
	}

    public function list_all_users()
    {
        $users = loadUsers();
        return view('user.list', compact('users'));
    }
}

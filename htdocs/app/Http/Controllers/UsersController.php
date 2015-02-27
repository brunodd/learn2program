<?php namespace App\Http\Controllers;

use App\User;   // Added to find User model.
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Http\Request;
use Request;    // Enable use of 'Request' in stead of 'Illuminate\Http\Request'
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\LoginUserRequest;
class UsersController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return view('users.home');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateUserRequest $request)
	{
        $input = $request->all();

        // Create User object (model)
        $user = new User;
        $user->username = $input['username'];
        $user->pass = $input['pass'];
        $user->mail = $input['mail'];

        // Store in Databse
        storeUser($user);

        $myuser = loadUser($user->username)[0];

        return redirect('users/' . $myuser->id . '/edit');
	}

    public function login(LoginUserRequest $request)
    {
        $input = $request->all();
        // dd($input);
        $name = $input['username'];
        // dd($name);

        if(empty(loadUser($name))) {
            $msg = "Unknown user";
            $alert = "This is not a registered user";
            return redirect()->back();
        }
        else {
            $user = loadUser($name)[0];
            if($user->pass == $input['pass']) {
                return "Login succesful!";
            }
            else {
                $msg = "Invalid password";
                $alert = "The password was invalid";
                return redirect()->back();
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
            $alert = "This user does not exist.";
            return view('errors.unknown', compact('msg', 'alert'));
        }
        else {
            $user = loadUser($id)[0];
            return view('users.show', compact('user'));
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
            $alert = "This user does not exist.";
            return view('errors.unknown', compact('msg', 'alert'));
        }
        else {
            $user = loadUser($id)[0];
            return view('users.edit', compact('user'));
        }
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
     * @param UpdateUserRequest $request
	 * @return Response
	 */
	public function update($id, UpdateUserRequest $request)
	{
        $input = $request->all();

        $newpass = $input['pass'];
        $user = new User;
        if($newpass) {
            $user->pass = $newpass;
        }
        else {
            $user->pass = loadUser($id)[0]->pass;
        }
        // Create User object (model)
        $user->username = $input['username'];
        $user->mail = $input['mail'];

        updateUser($id, $user);
        return redirect('users/' . $id . '/edit');
        //$updatedUser = loadUser($id)[0];
        //return view('user.edit', compact('updatedUser'));
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
        return view('users.list', compact('users'));
    }
}

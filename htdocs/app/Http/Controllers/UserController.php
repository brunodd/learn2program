<?php namespace App\Http\Controllers;

use App\User;   // Added to find User model.
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Http\Request;
use Request;    // Enable use of 'Request' in stead of 'Illuminate\Http\Request'
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
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

        return redirect('user/' . $myuser->id . '/edit');
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
     * @param UpdateUserRequest $request
	 * @return Response
	 */
	public function update($id, UpdateUserRequest $request)
	{
         $input = $request->all();

        // Create User object (model)
        $user = new User;
        $user->username = $input['username'];
        $user->pass = $input['pass'];

        updateUser($id, $user);
        return redirect('user/' . $id . '/edit');
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
        return view('user.list', compact('users'));
    }
}

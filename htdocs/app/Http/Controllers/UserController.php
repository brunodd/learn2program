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
                'username' => array('required'),
                'pass' => array('required')
                ];

        $validation = Validator::make(Request::all(), $rules);

        if($validation->fails()) {
            return "Some error handling stuff...";
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
                return redirect('user');
            }
            else {
                $myuser = loadUser($username)[0];


                // dd($myuser);
                // return "";
                // return "We got user $id";
                // Do something to continue...
                // return redirect()->route('user.edit', ['id']);
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
		return "show item with id: $id";
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
            return view('user.error', ['user' => $id]);
        }
        else {
            $user = loadUser($id)[0];
            return "editing $user->username's account";
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

}

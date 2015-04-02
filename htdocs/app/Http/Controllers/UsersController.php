<?php namespace App\Http\Controllers;

use App\User;   // Added to find User model.
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Http\Request;
use Request;    // Enable use of 'Request' in stead of 'Illuminate\Http\Request'
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\LoginUserRequest;
use Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $users = loadusers();
        return view('users.home', compact('users'));
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
        //GUESSING OBSOLETE NOW?
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
            /*
            $msg = "Unknown user";
            $alert = "This user does not exist.";
            return view('errors.unknown', compact('msg', 'alert'));
            */
            flash()->error('That user does not exist.')->important();
            return redirect('users');
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
            /*
            $msg = "Unknown user";
            $alert = "This user does not exist.";
            return view('errors.unknown', compact('msg', 'alert'));
            */
            flash()->error('That user does not exist.')->important();
            return redirect('users');
        }
        else if (loadUser($id)[0]->id != Auth::id())
        {
            /*
            $msg = "You must be logged in as this user in order to edit.";
            $alert = "Access Denied!";
            return view('errors.unknown', compact('msg', 'alert'));
            */
            flash()->error('You must be logged in as this user in order to edit.')->important();
            return redirect('users/' . $id);
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
            $user->pass = Hash::make($newpass);
        }
        else {
            $user->pass = loadUser($id)[0]->pass;
        }
        // Create User object (model)
        $user->username = $input['username'];
        $user->mail = $input['mail'];

        updateUser($id, $user);

        if (Input::hasFile('image')) {
            //dd($_FILES['image'], Input::file('image'));
            if (Input::file('image')->isValid()) {
                $extension = Input::file('image')->getClientOriginalExtension();
                $filename = 'user' . \Auth::id() . 'ProfilePicture.' . $extension;
                $upload_success = Input::file('image')->move('images/users', $filename);

                if(!$upload_success) {
                    flash()->error('Something went wrong while uploading your image, try again.');
                    return redirect('users/' . $user->username . '/edit');
                }
            }
        }
        flash()->success('You successfully edited your profile.');
        return redirect('users/' . $user->username . '/edit');
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



    public function addFriend($id1) {
        $id = loadUser($id1)[0]->id;
        if (!findFriends($id, \Auth::id())) {
            \DB::insert('insert into friends (id1, id2) values (?, ?)', [min($id, \Auth::id()), max($id, \Auth::id())]);
            flash()->success('You made a new friend :D.');
            return redirect('users/' . $id1);
        }

        flash()->error('You already are friends, calm down!.');
        return redirect('users/' . $id);
    }

    public function removeFriend($id1) {
        $id = loadUser($id1)[0]->id;
        \DB::statement('delete from friends where id1 = ? and id2 = ?', [min($id, \Auth::id()), max($id, \Auth::id())]);
        flash()->info('You are no longer friends.');
        return redirect('users/' . $id1);
    }
}

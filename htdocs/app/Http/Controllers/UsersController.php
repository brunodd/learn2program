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
	 * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
	 */
	public function getRegister()
	{
        return view('auth.register');
	}

    /**
     * Handle a registration request for the application.
     *
     * @param CreateUserRequest|\Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
	public function postRegister(CreateUserRequest $request)
	{
        $username = $request->username;
        $mail = $request->mail;
        $pass = Hash::make($request->pass);
        //Create user without profile image, can be added in later under settings

        \DB::insert('insert into `users` (`username`, `mail`, `pass`) values (?, ?, ?)', array($username, $mail, $pass));

        $user = \DB::select('select * from users where username = ?', array($username));
        //TODO: don't login automatically, send confirmation mail first
        \Auth::loginUsingId($user[0]->id);

        return redirect("/");
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
            flash()->error('That user does not exist.')->important();
            return redirect('users');
        }
        else if (loadUser($id)[0]->id != Auth::id())
        {
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
        $user = new User;

        $newpass = $request->pass;
        if($newpass) {
            $user->pass = Hash::make($newpass);
        }
        else {
            $user->pass = loadUser($id)[0]->pass;
        }

        $user->username = $request->username;
        $user->mail = $request->mail;

        //TODO: make image handler/uploader class
        if (Input::hasFile('image'))
        {
            //dd($_FILES['image'], Input::file('image'));
            if (Input::file('image')->isValid()) {
                $extension = Input::file('image')->getClientOriginalExtension();
                $filename = 'user' . \Auth::id() . 'ProfileImage.' . $extension;
                $upload_success = Input::file('image')->move('images/users', $filename);

                if(!$upload_success) {
                    flash()->error('Something went wrong while uploading your image, try again.');
                    return redirect('users/' . $user->username . '/edit');
                }
                $user->image = $filename;
            }
        }
        else
        {
            $user->image = loadUser($id)[0]->image;
        }

        updateUser($id, $user);
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
        //TODO: allow users to delete their account, check SQL file comments
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
        return redirect('users/' . $id1);
    }

    public function removeFriend($id1) {
        $id = loadUser($id1)[0]->id;
        \DB::statement('delete from friends where id1 = ? and id2 = ?', [min($id, \Auth::id()), max($id, \Auth::id())]);
        flash()->info('You are no longer friends.');
        return redirect('users/' . $id1);
    }
}

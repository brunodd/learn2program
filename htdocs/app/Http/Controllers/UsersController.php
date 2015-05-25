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

        storeUser(new User(['username' => $username, 'mail' => $mail, 'pass' => $pass, 'score' => 0]));
        flash()->success("Welcome, tell us something about yourself or edit your account in the  'Users' section.");

        $user = loadUser($username);

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
        $oldUser = loadUser($id)[0];
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
        $user->info = $request->info;
        $user->score = $oldUser->score;

        //TODO: make image handler/uploader class
        if (Input::hasFile('image'))
        {
            //dd($_FILES['image'], Input::file('image'));
            if (Input::file('image')->isValid()) {
                $extension = Input::file('image')->getClientOriginalExtension();
                $filename = 'user' . \Auth::id() . 'ProfileImage.' . $extension;
                Input::file('image')->move('images/users', $filename);
                $user->image = $filename;
            }
            else {
                flash()->error('Something went wrong while uploading your image, try again.');
                return redirect('users/' . $user->username . '/edit');
            }
        }
        else
        {
            $user->image = $oldUser->image;
        }

        updateUser($id, $user);
        flash()->success('You successfully edited your profile.');
        return redirect('users/' . $user->username);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

	}

    public function list_all_users()
    {
        $users = loadUsers();
        return view('users.list', compact('users'));
    }

    public function addFriend($id1) {
        $id = loadUser($id1)[0]->id;

        if (isFriendRequestPending($id)) {
            acceptFriend($id);

            flash()->success('You are now friends.');
            return redirect('users/' . $id1);
        } else if (canSendFriendRequest($id)) {
            storeFriendRequest($id);

            storeNotification($id, 'friend request', \Auth::id());

            flash()->success('A friend request has been sent');
            return redirect('users/' . $id1);
        }

        flash()->error('You cannot send a friend request to ' . $id1 . ' anymore.');
        return redirect('users/' . $id1);
    }

    public function removeFriend($id1) {
        $id = loadUser($id1)[0]->id;

        if (loadFriend($id)) {
            deleteFriend($id);

            flash()->info('You are no longer friends.');
            return redirect('users/' . $id1);
        }

        flash()->error('Could not remove friend, try again.');
        return redirect('users/' . $id1);
    }

    public function acceptFriend($id1) {
        $id = loadUser($id1)[0]->id;
        if (isFriendRequestPending($id)) {
            acceptFriend($id);

            storeNotification($id, 'friend request accepted', \Auth::id());
            flash()->success('You are now friends.');
            return redirect('users/' . $id1);
        }

        flash()->error('Could not accept the request, try again.');
        return redirect('users/' . $id1);
    }

    public function declineFriend($id1) {
        $id = loadUser($id1)[0]->id;
        if (isFriendRequestPending($id)) {
            declineFriend($id);

            storeNotification($id, 'friend request declined', \Auth::id());
            flash()->info('You declined the friend request.');
            return redirect('users/' . $id1);
        }

        flash()->error('Could not decline the request, try again.');
        return redirect('users/' . $id1);
    }

    public function myFriends() {
        $friends = loadMyFriends();
        return view('users.my_friends')->with('users', $friends);
    }
}

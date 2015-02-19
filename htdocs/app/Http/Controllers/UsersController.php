<?php namespace App\Http\Controllers;

use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

// use Illuminate\Http\Request;
use Request;

class UsersController extends Controller {

    public function index()
    {
      return view('users.home');
    }

    public function login()
    {
        return view('users.login');
    }

    public function register()
    {
        return view('users.register');
    }

    public function finished_register()
    {
        $username = Request::get('username');
        $pass = Request::get('pass');

        $user = new User();
        $user->username = $username;
        $user->pass = $pass;
        if (strlen($user->pass) == 0) {
            $error = "<script> alert('A password is required.'); </script>";
            return $error;
        }
        // test loadId < sizeMembers
        // if (loadId($username) > 0) {
            // $error = "<script> alert('This username already exists'); </script>";
            /*
             * TODO:
             * pass $error to regiser_error view..
             * Als use this view for 'empty username', 'empty password', ...
             */
            // echo $error;
            // return 'Shit went wrong....';
        // }
        // storeUser($pass, $username);
        storeUser($user);

        return redirect('users');
    }

    public function list_all_users()
    {
        $users = loadUsers();

        return view('users.list', compact('users'));
    }
}

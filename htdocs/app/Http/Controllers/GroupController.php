<?php namespace App\Http\Controllers;

use App\User;   // Added to find User model.
use App\Group;   // Added to find Group model.
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Http\Request;
use Request;    // Enable use of 'Request' in stead of 'Illuminate\Http\Request'
use App\Http\Requests\CreateGroupRequest;
//use App\Http\Requests\UpdateGroupRequest;

class GroupController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('group.home');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('group.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateGroupRequest $request)
	{
        //FIRST OF ALL, MUST CHECK IF THE "REQUESTER" IS LOGGED IN
        //otherwise deny this request!

        $input = $request->all();

        // Create Group object (model)
        $group = new Group;
        $group->name = $input['name'];

        //MUST find the requester since he will automatically be added to this group
        //in fact, i'm in favor of storing the "founder" of the group as well
        //perhaps also moderators which should be a multivalued attribute -> how do we handle this?
        //$user = new User;
        //$user->id = ?;

        // Store in Database
        storeGroup($group);
        $mygroup = loadGroup($group->name)[0];
        addMember2Group(1, $mygroup); //hardcode the user for testing
        //addMember2Group($user, $group);

        return redirect('group/' . $mygroup->id);
}

    /**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        if(empty(loadGroup($id))) {
            $msg = "Unknown group";
            $alert = "This group doesn't exist.";
            return view('user.error', compact('msg', 'alert'));
        }
        else {
            //WILL ALSO NEED TO LOAD ALL MEMBERS
            // i.e. if we want to show them on the group's page
            $group = loadGroup($id)[0];
            //$users = loadMembers($group)[0];
            return view('group.show', compact('group'));
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
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}

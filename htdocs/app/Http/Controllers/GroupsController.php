<?php namespace App\Http\Controllers;

use App\User;   // Added to find User model.
use App\Group;   // Added to find Group model.
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Http\Request;
use Request;    // Enable use of 'Request' in stead of 'Illuminate\Http\Request'
use App\Http\Requests\CreateGroupRequest;
use App\Http\Requests\UpdateGroupRequest;

class GroupsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $groups = loadAllGroups();
		return view('groups.home', compact('groups'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('groups.create');
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

        return redirect('groups/' . $mygroup->id);
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
            return view('users.error', compact('msg', 'alert'));
        }
        else {
            //WILL ALSO NEED TO LOAD ALL MEMBERS
            // i.e. if we want to show them on the group's page
            $group = loadGroup($id)[0];
            //$users = loadMembers($group)[0];
            return view('groups.show', compact('group'));
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
        if(empty(loadGroup($id))) {
            $msg = "Unknown group";
            $alert = "This group doesn't exist.";
            return view('users.error', compact('msg', 'alert'));
        }
        else {
            $group = loadGroup($id)[0];
            return view('groups.edit', compact('group'));
        }
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, UpdateGroupRequest $request)
	{
        //AGAIN, WE MUST CHECK WHETHER THE "REQUESTER" IS ALLOWED TO PERFORM THIS ACTION
        $input = $request->all();

        $groupname = $input['name'];

        //this check is probably redundant since UpdateGroupRequest already took care of this
        if(empty(loadGroup($groupname)))
        {
            updateGroup($id, $groupname);
        }

        return redirect('groups/' . $id . '/edit');
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

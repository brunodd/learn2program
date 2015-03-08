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
use App\Http\Requests\JoinGroupRequest;
use Auth;

use Laracasts\Flash\Flash;

class GroupsController extends Controller {

    /**
     * Middleware checks if the user is logged in
     *
     * veel beter dan overal checks doen en da geeft direct een overzicht wat public is en wat niet
     */
    public function __construct() {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

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
        /*
        if ( !Auth::check() )
        {
            $msg = "You must be logged in to create a new group.";
            $alert = "Access Denied!";
            return view('errors.unknown', compact('msg', 'alert'));
        }
        */
		return view('groups.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateGroupRequest $request)
	{

        $input = $request->all();

        // Create Group object (model)
        $group = new Group;
        $group->name = $input['name'];
        $group->founderId = Auth::id();

        // Store in Database
        storeGroup($group);
        $mygroup = loadGroup($group->name)[0];
        addMember2Group($mygroup->founderId, $mygroup->id);

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
            /*
            $msg = "Unknown group";
            $alert = "This group does not exist.";
            return view('errors.unknown', compact('msg', 'alert'));
            */
            flash()->error('That group does not exist')->important();
            return redirect('groups');
            //Misschien in dit geval toch beter een 404 page hebben?
        }
        else {
            //WILL ALSO NEED TO LOAD ALL MEMBERS
            // i.e. if we want to show them on the group's page
            $group = loadGroup($id)[0];
            $isMember = !noMemberYet(Auth::id(), $id);
            return view('groups.show', compact('group', 'isMember'));
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
        //die return id dat hier stond heeft mij zo hard gefucked gast ik dacht echt wtf is hier aant gebeure xD
        if(empty(loadGroup($id))) {
            /*
            $msg = "Unknown group";
            $alert = "This group does not exist.";
            return view('errors.unknown', compact('msg', 'alert'));
            */
            flash()->error('That group does not exist')->important();
            return redirect('groups');
            //Misschien in dit geval toch beter een 404 page hebben?
        }
        else if (!isFounderOfGroup($id, Auth::id()))
        {
            /*
            $msg = "You must be logged in as the founder of the group in order to edit.";
            $alert = "Access Denied!";
            return view('errors.unknown', compact('msg', 'alert'));
            */
            flash()->error('You must be logged in as the founder of the group in order to edit.')->important();
            return redirect('groups');
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
        //AGAIN, WE MUST CHECK WHETHER THE "REQUESTER" IS ALLOWED TO PERFORM THIS ACTION -> only founders can access edit page
        // thus => everything ok
        $groupname = $request->name;

        //this check is probably redundant since UpdateGroupRequest already took care of this
        if(empty(loadGroup($groupname)))
        {
            updateGroup($id, $groupname);
        }

        return redirect('groups/' . $groupname . '/edit');
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

    public function join($id)
    {
        $member = noMemberYet(Auth::id(), $id);
        if ( Auth::check() and $member )
        {
            addMember2Group(Auth::id(), $id);
            flash()->success('You succesfully joined the group.');
            return redirect('groups/' . $id);
        }
        else if ( Auth::check() and !$member)
        {
            /*
            $msg = "You are already a member of this group.";
            $alert = "Cannot join this group!";
            return view('errors.unknown', compact('msg', 'alert'));
            */
            flash()->error('You are already a member of this group.');
            return redirect('groups/' . $id);
        }
    }

    public function leave($id)
    {
        //we already know that the "requester" is a member of this group & logged in -> no more checks needed
        if ( !isFounderOfGroup($id, Auth::id()) )
        {
            deleteMemberFromGroup(Auth::id(), $id);
            flash()->info('You will be missed :( :(');
            return redirect('groups/' . $id);
        }
        else
        {
            /*
            $msg = "You can not leave the group because you are the founder.";
            $alert = "Cannot leave this group!";
            return view('errors.unknown', compact('msg', 'alert'));
            */
            flash()->error('You can not leave the group because you are the founder.');
            return redirect('groups/' . $id);
        }
    }
}

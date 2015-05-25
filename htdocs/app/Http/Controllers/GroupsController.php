<?php namespace App\Http\Controllers;

use App\User;   // Added to find User model.
use App\Group;   // Added to find Group model.
use App\Http\Requests;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Http\Request;
use Request;    // Enable use of 'Request' in stead of 'Illuminate\Http\Request'
use App\Http\Requests\CreateGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Http\Requests\SendMessageRequest;
use Auth;

use Laracasts\Flash\Flash;

class GroupsController extends Controller {

    /**
     * Middleware checks if the user is logged in
     */
    public function __construct() {
        $this->middleware('auth', ['except' => ['index']]);
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
		return view('groups.create');
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateGroupRequest $request
     * @return Response
     */
	public function store(CreateGroupRequest $request)
	{
        $input = $request->all();

        $group = new Group;
        $group->name = $input['name'];
        $group->founderId = Auth::id();

        \DB::insert('INSERT INTO conversations VALUE ()');
        $conversationId = \DB::select('SELECT id FROM conversations ORDER BY id DESC LIMIT 1')[0]->id;
        $group->conversationId = $conversationId;

        $group->private = $request->type == "private" ? true : false;

        storeGroup($group);
        $mygroup = loadGroup($group->name)[0];
        addMemberToGroup($mygroup->founderId, $mygroup->id);

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
        if(empty(loadGroup($id)))
        {
            flash()->error('That group does not exist')->important();
            return redirect('groups');
        }
        else
        {
            $group = loadGroup($id)[0];
            $users = listUsersOfGroup($group->id);
            $isMember = isMemberOfGroup($group->id);

            //Load last 100 chat messages
            $messages = loadLastNMessages($group->conversationId, 100);

            foreach($messages as &$message) {
                //Add a Carbon time object to each message
                $carbon = Carbon::createFromFormat('Y-n-j G:i:s', $message->date);
                $message = (object) array_merge( (array)$message, array('carbon' => $carbon) );
            }

            return view('groups.show', compact('group', 'isMember', 'messages', 'users'));
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
        if(empty(loadGroup($id)))
        {
            flash()->error('That group does not exist')->important();
            return redirect('groups');
        }
        else if (!isFounderOfGroup($id, Auth::id()))
        {
            flash()->error('You must be logged in as the founder of the group in order to edit.')->important();
            return redirect('groups');
        }
        else
        {
            $group = loadGroup($id)[0];
            return view('groups.edit', compact('group'));
        }
	}

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param  UpdateGroupRequest $request
     * @return Response
     */
	public function update($id, UpdateGroupRequest $request)
	{
        $request->type = $request->type == "private" ? true : false;
        updateGroup($id, $request);

        flash()->success('Your group has been successfully updated.');
        return redirect('groups/' . $request->name);
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


    public function manageMembers($id) {
        if(empty(loadGroup($id)))
        {
            flash()->error('That group does not exist')->important();
            return redirect('groups');
        }
        else if (!isFounderOfGroup($id, Auth::id()))
        {
            flash()->error('You must be logged in as the founder of the group in order to manage members.')->important();
            return redirect('groups');
        }
        else
        {
            $group = loadGroup($id)[0];
            $members = listUsersOfGroup($group->id);
            $membersRequests = loadGroupMembersRequests($group->id);
            $membersDeclined = loadGroupMembersDeclined($group->id);

            return view('groups.manageMembers', compact('group', 'isMember', 'members', 'membersRequests', 'membersDeclined'));
        }
    }

    public function join($id)
    {
        $group = loadGroup($id)[0];

        if (isMemberOfGroup($id)) {
            flash()->error('You are already a member of this group.');
            return redirect('groups/' . $group->name);
        }

        if ($group->private == true) {
            storeJoinGroupRequest(\Auth::id(), $id);
            storeNotification($group->founderId, 'join group request', \Auth::id(), $id);
            flash()->info('You have sent a request to join the group.');

            return redirect('groups/' . $group->name);
        } else {
            addMemberToGroup(\Auth::id(), $id);
            flash()->success('You succesfully joined the group.');

            return redirect('groups/' . $group->name);
        }
    }

    public function leave($id)
    {

        if ( !isFounderOfGroup($id, Auth::id()) )
        {
            deleteMemberFromGroup(Auth::id(), $id);
            flash()->info('You have left the group');
            return redirect('groups/' . $id);
        }
        else
        {
            flash()->error('You can not leave the group because you are the founder.');
            return redirect('groups/' . $id);
        }
    }

    public function acceptMember($groupId, $userId) {
        $group = loadGroup($groupId)[0];

        if (isGroupRequestPending($userId, $groupId) or isGroupRequestDeclined($userId, $groupId)) {
            acceptMemberToGroup($userId, $groupId);

            storeNotification($userId, 'group request accepted', -1, $groupId);
            flash()->success('You have accepted the user to your group.');
            return redirect('groups/' . $group->name . '/manageMembers');
        }

        flash()->error('Could not accept the request, try again.');
        return redirect('groups/' . $group->name . '/manageMembers');
    }

    public function declineMember($groupId, $userId) {
        $group = loadGroup($groupId)[0];

        if (isGroupRequestPending($userId, $groupId)) {
            declineMemberToGroup($userId, $groupId);

            storeNotification($userId, 'group request declined', -1, $groupId);
            flash()->error('You have declined the user from your group. They will not be able to request to join your group again.');
            return redirect('groups/' . $group->name . '/manageMembers');
        }

        flash()->error('Could not decline the request, try again.');
        return redirect('groups/' . $group->name . '/manageMembers');
    }

    public function removeMember($groupId, $userId) {
        $group = loadGroup($groupId)[0];

        if (loadUser($userId)) {
            declineMemberToGroup($userId, $groupId);    //Just the user as "declined"

            flash()->error('You have kicked the user from your group. They will not be able to request to join your group again.');
            return redirect('groups/' . $group->name . '/manageMembers');
        }

        flash()->error('Could not kick member, try again.');
        return redirect('groups/' . $group->name . '/manageMembers');
    }

    public function storeMessage(SendMessageRequest $request) {
        storeMessage($request->conversationId, $request->message);

        return redirect('groups/' . $request->groupname);
    }

    public function myGroups() {
        $groups = loadMyGroups();
        return view('groups.my_groups', compact('groups'));
    }
}

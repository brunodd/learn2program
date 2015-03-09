<?php namespace App\Http\Controllers;

use App\Helpers;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class MessagesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//show all messages in the database
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($toId)
	{
        if (empty(loadUser($toId))) {
            flash()->error('That user does not exist');
            redirect('/users');
        }

        $fromId = \Auth::id();
        $toId2 = loadUser($toId)[0]->id;

        \DB::insert('insert into conversations (userA, userB) values (?, ?)', [min($fromId, $toId2), max($fromId, $toId2)]);

        return $this->show($toId);
        return view(messages.show, compact($toId));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $input)
	{
        $cId = getConversation($input->username);
        $author = loadUser(\Auth::id())[0]->username;
		\DB::insert('insert into messages (conversationId, author, message) value (?, ?, ?)',
                     [$cId, $author, $input->message]);
        return $this->show($input->username);
        //return view(messages.show, compact())
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		if (conversationExists($id)) {
            $messages = getAllMessages($id);
            $user = loadUser($id)[0];
            return view('messages.show', compact('messages', 'user'));
        } else {
            $this->create($id);
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
		//unused, once a message is sent there's no going back
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        //unused, once a message is sent there's no going back
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        //unused, once a message is sent there's no going back
	}

    public function list_all_messages() {
        $messages = getAllMessagesInDB();
        return view('messages.list', compact('messages'));
    }

}

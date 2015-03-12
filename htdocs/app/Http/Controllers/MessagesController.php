<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Http\Request;
use Request;    // Enable use of 'Request' in stead of 'Illuminate\Http\Request'
use App\Http\Requests\SendMessageRequest;
use Auth;


class MessagesController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

	/**
	 * Display a list of conversations in a sidebar.
     * Then Show the conversation with the latest message.
	 *
	 * @return Response
	 */
	public function index()
	{
        //select latest conversation and show it
        $latestConversation =
            \DB::select(' select C.userA, C.userB
                          from conversations C join messages M on C.id = M.conversationId
                          where C.userA = ? or C.userB = ?
                          order by date desc
                          limit 1',
                          [\Auth::id(), \Auth::id()]);
        $user = (\Auth::id() == $latestConversation[0]->userA) ? ($latestConversation[0]->userB) : ($latestConversation[0]->userA);
        $user = loadUser($user)[0];

        return redirect('messages/' . $user->username);
	}


    /**
     * Create a new conversation between the logged in user and $toId
     *
     */
	public function createConversation($toId)
	{
        if (empty(loadUser($toId))) {
            flash()->error('That user does not exist');
            redirect('/users');
        }

        $fromId = \Auth::id();
        $toId2 = loadUser($toId)[0]->id;

        \DB::insert('insert into conversations (userA, userB) values (?, ?)', [min($fromId, $toId2), max($fromId, $toId2)]);
	}

    /**
     * Store a new message in the database.
     *
     * @param SendMessageRequest $request
     * @return Response
     */
	public function store(SendMessageRequest $request)
	{
        $cId = getConversation($request->username)[0]->id;

		\DB::insert('insert into messages (conversationId, author, message) value (?, ?, ?)', [$cId, \Auth::id(), $request->message]);

        return redirect('messages/' . $request->username);
	}

	/**
	 * Display a specified message.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		if (conversationExists($id)) {
            $messages = getAllMessages($id);
            $user = loadUser($id)[0];

            $conversations =
                \DB::select(' select userA, userB, message, date
                              from (select C.id, C.userA, C.userB, M.message, M.date
                                    from conversations C join messages M on C.id = M.conversationId Join users U on U.id = M.author
                                    where C.userA = ? or C.userB = ?
                                    order by date desc) as X
                              group by id
                              order by date desc',
                              [\Auth::id(), \Auth::id()]);

            foreach($conversations as $conversation) {
                $conversation->userA = (\Auth::id() == $conversation->userA) ? ($conversation->userB) : ($conversation->userA);
                $conversation->userB = loadUser($conversation->userA)[0]->username;
            }

            return view('messages.show', compact('messages', 'user', 'conversations'));
        } else {
            $this->createConversation($id);
            $messages = [];
            $user = loadUser($id)[0];
            return $this->show($id);
            //return view('messages.show', compact('messages', 'user'));
        }
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

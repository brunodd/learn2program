<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
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
     * Just show the conversation with the latest message.
	 *
	 * @return Response
	 */
	public function index() {
        $latestConversation = LoadLatestConversation();

        if (empty($latestConversation)) {
            $messages = [];
            $user = (object) array('username' => '');
            $conversations = [];

            return view('messages.show', compact('messages', 'user', 'conversations'));
        } else {
            //Get the user from the conversation that is not the logged in one.
            $userId = (\Auth::id() == $latestConversation[0]->userA) ? ($latestConversation[0]->userB) : ($latestConversation[0]->userA);
            $user = loadUser($userId)[0];

            return redirect('messages/' . $user->username);
        }
	}

    /**
     * Store a new message in the database.
     *
     * @param SendMessageRequest $request
     * @return Response
     */
	public function store(SendMessageRequest $request) {
        $cId = loadConversation($request->username)[0]->id;

        storeMessage($cId, $request->message);

        return redirect('messages/' . $request->username);
	}

	/**
	 * Display a specified message.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
        $userr = loadUser($id);

        if (empty($userr)) {
            flash()->error('That user does not exist');
            return redirect('/messages');
        }

		if (!empty(loadConversation($id))) {
            //Load all messages with $id
            $messages = loadAllMessages($id);
            //Then get user with $id to show him
            $user = $userr[0];
            //Then get all conversations for the logged in user to show those in the sidebar
            $conversations = loadConversationsWithMessage();

            foreach($conversations as $conversation) {
                $conversation->userA = (\Auth::id() == $conversation->userA) ? ($conversation->userB) : ($conversation->userA);
                $conversation->userB = loadUser($conversation->userA)[0]->username;
            }

            foreach($messages as &$message) {
                $carbon = Carbon::createFromFormat('Y-n-j G:i:s', $message->date);
                $message = (object) array_merge( (array)$message, array('carbon' => $carbon) );
            }

            return view('messages.show', compact('messages', 'user', 'conversations'));
        } else {
            $toId2 = loadUser($id)[0]->id;

            storeConversation($toId2);
            return $this->show($id);
        }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
        //TODO
	}

    public function list_all_messages() {
        $messages = loadAllMessagesInDB();
        return view('messages.list', compact('messages'));
    }

}

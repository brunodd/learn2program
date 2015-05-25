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
     * Show the conversation in which the last message was sent/recieved.
	 *
	 * @return Response
	 */
	public function index() {
        $latestConversation = LoadLatestConversation();

        if (empty($latestConversation)) {
            //No conversations with anyone yet -> Send empty arrays/objects to the view
            $messages = [];
            $user = (object) array('username' => '');
            $conversations = [];

            return view('pages.messages', compact('messages', 'user', 'conversations'));
        } else {
            //Redirect to the conversation in which the last message was sent/recieved
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
        $cId = loadConversation($request->username)[0]->conversationId;

        storeMessage($cId, $request->message);

        return redirect('messages/' . $request->username);
	}

	/**
	 * Display a list of messages between the logged in user and user $id.
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

        if ($userr[0]->id == \Auth::id()) {
            return $this->index();
        }

        if (!empty(loadConversation($id))) {
            $conversationId = loadConversation($id)[0]->conversationId;
            //Load all messages with in conversation $id
            //dd($conversationId);
            $messages = loadAllMessages($conversationId);
            //dd($messages);
            //Then get user with $id to show him
            $user = $userr[0];
            updateMessagesToSeen($conversationId);
            //Then get all conversations for the logged in user to show those in the sidebar
            $conversations = loadLastNConversationsWithMessage(999);

            //Find the last message that has been read by user $id
            $lastRead = "";
            if (!empty(loadLastReadMessage($id))) {
                $lastRead = loadLastReadMessage($id)[0]->message;
            }

            //Add a Carbon time object to each message
            foreach($messages as &$message) {
                $carbon = Carbon::createFromFormat('Y-n-j G:i:s', $message->date);
                $message = (object) array_merge( (array)$message, array('carbon' => $carbon) );

                //Give seen status only to the last seen message, not all of them
                if ($message->message == $lastRead) {
                    $message = (object) array_merge( (array)$message, array('seen' => 1) );
                } else {
                    $message = (object) array_merge( (array)$message, array('seen' => 0) );
                }
            }

            //Add a Carbon time object to each $conversation
            foreach($conversations as &$conversation) {
                $carbon = Carbon::createFromFormat('Y-n-j G:i:s', $conversation->date);
                $conversation = (object) array_merge( (array)$conversation, array('carbon' => $carbon) );
            }

            return view('pages.messages', compact('messages', 'user', 'conversations'));
        } else {
            //create a new conversation between the logged in user and $id
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

	}
}

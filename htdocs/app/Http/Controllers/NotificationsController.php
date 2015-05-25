<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Guzzle\Http\Message\Response;
use Illuminate\Http\Request;

class NotificationsController extends Controller {

    /**
     * Middleware checks if the user is logged in
     *
     */
    public function __construct() {
        $this->middleware('auth');
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $notifications = $this->buildNotifications(loadAllNotifications());
        updateNotificationsToSeen();
		return view('pages.notifications', compact('notifications'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
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

	}

    private static function buildUserNotifcations($notification) {
        $string = "";
        $user = loadUser($notification->generator_user_id)[0];
        $username = '<a href=/users/'.$notification->generator_user_id.'>'.$user->username.'</a>';

        switch ($notification->type) {
            case "friend request":
                $string = (object)array_merge((array)$notification, array('message' => $username . ' has sent you a friend request.'));
                break;
            case "friend request accepted":
                $string = (object)array_merge((array)$notification, array('message' => $username . ' has accepted your friend request.'));
                break;
            case "friend request declined":
                $string = (object)array_merge((array)$notification, array('message' => $username . ' has declined your friend request.'));
                break;
            case "join group request":
                $groupname = loadGroup($notification->object_id)[0]->name;
                $group = '<a href=/groups/' . $notification->object_id . '/manageMembers>' . $groupname . '</a>';

                $string = (object)array_merge((array)$notification, array('message' => $username . ' has requested to join your group \'' . $group . '\'.'));
                break;
            case "series completed":
                $seriesTitle = loadSerieWithId($notification->object_id)[0]->title;
                $series = '<a href=/series/' . $notification->object_id . '>\'' . $seriesTitle . '\'</a>.';

                $string = (object)array_merge((array)$notification, array('message' => $username . ' has completed your series ' . $series));
                break;
            case "exercise completed":
                $exercise = '<a href=/exercises/' . $notification->object_id . '>exercise</a>.';

                $string = (object)array_merge((array)$notification, array('message' => $username . ' has accomplished an ' . $exercise));
                break;
            case "answer shared":
                $string = (object)array_merge((array)$notification, array('message' => $username . ' has shared <a href=/sreies/>an answer</a> with you.'));
                break;
            case "challenged":
                $string = (object)array_merge((array)$notification, array('message' => $username . ' has <a href=/challenges/>challenged</a> you.'));
                break;
            case "challenge beaten":
                $string = (object)array_merge((array)$notification, array('message' => $username . ' has beaten your <a href=/challenges/>challenge</a>!'));
                break;
        }

        return $string;
    }

    private static function buildSystemNotifications($notification) {
        $string = "";

        switch ($notification->type) {
            case "group request accepted":
                $groupname = loadGroup($notification->object_id)[0]->name;
                $group = '<a href=/groups/' . $notification->object_id . '>' . $groupname . '</a>';

                $string = (object)array_merge((array)$notification, array('message' => 'Your request to join the group \'' . $group . '\' has been accepted.'));
                break;
            case "group request declined":
                $groupname = loadGroup($notification->object_id)[0]->name;
                $group = '<a href=/groups/' . $notification->object_id . '>' . $groupname . '</a>';
                $string = (object)array_merge((array)$notification, array('message' => 'Your request to join the group \'' . $group . '\' has been declined.'));
                break;
            case "series updated":
                $seriesTitle = loadSerieWithId($notification->object_id)[0]->title;
                $series = '<a href=/series/' . $notification->object_id . '>' . $seriesTitle . '</a>';

                $string = (object)array_merge((array)$notification, array('message' => 'The series \'' . $series . '\' has been updated, check it out!'));
                break;
            case "exercise referenced":
                $series = '<a href=/series/' . $notification->object_id . '>series</a>.';

                $string = (object)array_merge((array)$notification, array('message' => 'An exercise of yours was referenced in another ' . $series));
                break;
            case "exercise copied":
                $series = '<a href=/series/' . $notification->object_id . '>series</a>.';

                $string = (object)array_merge((array)$notification, array('message' => 'An exercise of yours was copied to another ' . $series));
                break;
        }

        return $string;
    }

    public static function buildNotifications($noti) {
        $notifications = array();

        foreach($noti as $notification) {
            //Check if notification was generated by another user
            switch($notification->generator_user_id) {
                //not generated by a user
                case -1:
                    $string = NotificationsController::buildSystemNotifications($notification);
                    break;
                //generated by a user
                default:
                    $string = NotificationsController::buildUserNotifcations($notification);
                    break;
            }
            array_push($notifications, $string);
        }

        return $notifications;
    }

    public function setNotificationsToRead() {
        updateNotificationsToSeen();
        $response = array('message' => 'notifications set to read');

        return response()->json($response);
    }

    public function shareNotification($userId) {
        storeNotification( $userId, 'exercise completed', \Auth::id());
        return view('pages.home');
    }

    public function createNotification() {
        $user_options = loadMyFriends();
        return \View::make('pages.sendNotification', array('user_options' => $user_options));
    }
}

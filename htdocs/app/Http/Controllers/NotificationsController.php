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
		// TODO: maybe allow this
	}

    public static function buildNotifications($noti) {
        $notifications = array();

        foreach($noti as $notification) {
            $username = loadUser($notification->object_id)[0]->username;

            switch($notification->type) {
                case "friend request":
                    $notification = (object) array_merge( (array)$notification, array('message' => '<a href=/users/'.$notification->object_id.'>'.$username.'</a> has sent you a friend request.') );
                    break;

                case "friend request accepted":
                    $notification = (object) array_merge( (array)$notification, array('message' => '<a href=/users/'.$notification->object_id.'>'.$username.'</a> has accepted your friend request.') );
                    break;

                case "friend request declined":
                    $notification = (object) array_merge( (array)$notification, array('message' => '<a href=/users/'.$notification->object_id.'>'.$username.'</a> has declined your friend request.') );
                    break;
            }
            array_push($notifications, $notification);
        }

        return $notifications;
    }

    public function setNotificationsToRead() {
        updateNotificationsToSeen();
        $response = array('message' => 'notifications set to read');

        return response()->json($response);
    }
}

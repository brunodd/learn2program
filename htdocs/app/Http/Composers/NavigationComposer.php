<?php namespace App\Http\Composers;

use App\Http\Controllers\NotificationsController;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;

Class NavigationComposer {

    public function __construct() {

    }

    public function compose($view) {
        $last5notifications = loadLastNNotifications(5);
        $last5notifications = NotificationsController::buildNotifications($last5notifications);
        $last5conversations = loadLastNConversationsWithMessage(5);
        $unreadNotifications = !empty(loadUnreadNotifications());
        $unreadMessages = !empty(loadUnreadMessages());

        $noti = array();
        for ($x = 0; $x < sizeof($last5notifications); $x++) {
            $notification = $last5notifications[$x];
            array_push($noti, $notification->message, $notification->is_read);
        }

        $conv = array();
        for ($x = 0; $x < sizeof($last5conversations); $x++) {
            $conversation = $last5conversations[$x];

            //Add a Carbon time object to each $conversation
            $carbon = Carbon::createFromFormat('Y-n-j G:i:s', $conversation->date);
            $conversation = (object) array_merge( (array)$conversation, array('carbon' => $carbon) );
            array_push($conv, $conversation->username, $conversation->image, $conversation->message, $conversation->is_read, $conversation->author, $conversation->carbon);
        }

        $view->with(array('last5notifications' => $noti,
                          'last5conversations' => $conv,
                          'unreadNotification' => $unreadNotifications,
                          'unreadMessage' => $unreadMessages));
    }
}
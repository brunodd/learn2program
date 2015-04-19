<?php namespace App\Http\Composers;

use Illuminate\Contracts\View\View;

Class NavigationComposer {

    public function __construct() {

    }

    public function compose($view) {
        $last5notifications = loadLastNNotifications(5);
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
            $conversation = $last5conversations[$x];       //Get the xth message
            $user = loadUser($conversation->otherUser)[0]; //Get the authors information
            array_push($conv, $user->username, $user->image, $conversation->message, $conversation->is_read, $conversation->date);
        }

        $view->with(array('last5notifications' => $noti,
                          'last5conversations' => $conv,
                          'unreadNotification' => $unreadNotifications,
                          'unreadMessage' => $unreadMessages));
    }
}
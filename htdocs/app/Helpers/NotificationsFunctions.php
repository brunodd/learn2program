<?php

function loadAllNotifications() {
    return \DB::select('SELECT *
                        FROM notifications
                        WHERE userId = ?',
                        [\Auth::id()]);
}

function loadUnreadNotifications() {
    return \DB::select('SELECT *
                        FROM notifications
                        WHERE userId = ? and is_read = 0',
                        [\Auth::id()]);
}

function loadLastNNotifications($n) {
    return \DB::select('SELECT *
                        FROM notifications
                        WHERE userId = ?
                        ORDER BY id DESC
                        LIMIT ?',
                        [\Auth::id(), $n]);
}

function updateNotificationsToSeen() {
    return \DB::statement('UPDATE   notifications
                           SET      is_read = true
                           WHERE    userId = ?',
                           [\Auth::id()]);
}
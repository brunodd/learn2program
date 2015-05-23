<?php

function loadAllNotifications() {
    return \DB::select('SELECT   *
                        FROM     notifications
                        WHERE    user_id = ?
                        ORDER BY id DESC',
                        [\Auth::id()]);
}

function loadUnreadNotifications() {
    return \DB::select('SELECT  *
                        FROM    notifications
                        WHERE   user_id = ?
                        AND     is_read = 0',
                        [\Auth::id()]);
}

function loadLastNNotifications($n) {
    return \DB::select('SELECT   *
                        FROM     notifications
                        WHERE    user_id = ?
                        ORDER BY id DESC
                        LIMIT    ?',
                        [\Auth::id(), $n]);
}

function updateNotificationsToSeen() {
    return \DB::statement('UPDATE   notifications
                           SET      is_read = true
                           WHERE    user_id = ?',
                           [\Auth::id()]);
}

function storeNotification($id, $type, $genId, $objectId = NULL) {
    \DB::insert('INSERT INTO notifications (user_id, generator_user_id, type, object_id) VALUE (?, ?, ?, ?)',
                                            [$id, $genId, $type, $objectId]);
}
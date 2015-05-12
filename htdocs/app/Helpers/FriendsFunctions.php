<?php

function loadFriend($id) {
    return DB::select('SELECT   *
                       FROM     friends
                       WHERE    id1 = ? AND id2 = ? AND status = \'accepted\'',
                       [min($id, \Auth::id()), max($id, \Auth::id())]);
}

function canSendFriendRequest($id) {
    $a = min($id, \Auth::id());
    $b = max($id, \Auth::id());

    return empty(DB::select('SELECT   *
                             FROM     friends
                             WHERE    id1 = ? AND id2 = ? AND (status = \'accepted\' OR status = \'pending\') AND action_user_id = ?
                             UNION
                             SELECT   *
                             FROM     friends
                             WHERE    id1 = ? AND id2 = ? AND action_user_id = ?',
                            [$a, $b, \Auth::id(), $a, $b, $id]));
}

function storeFriendRequest($id) {
    if (empty(\DB::select('SELECT * FROM friends WHERE id1 = ? AND id2 = ?', [min($id, \Auth::id()), max($id, \Auth::id())]))) {

        \DB::insert('INSERT INTO friends (id1, id2, status, action_user_id)
                     VALUES      (?, ?, ?, ?)',
                     [min(\Auth::id(), $id), max(\Auth::id(), $id), 'pending', \Auth::id()]);

    } else {
        \DB::update('UPDATE friends
                     SET    status = \'pending\', action_user_id = ?
                     WHERE  id1 = ? AND id2 = ?',
                     [\Auth::id(), min($id, \Auth::id()), max($id, \Auth::id())]);
    }
}

function deleteFriend($id) {
    return \DB::update('UPDATE friends
                        SET    status = \'declined\', action_user_id = ?
                        WHERE  id1 = ? AND id2 = ?',
                        [\Auth::id(), min($id, \Auth::id()), max($id, \Auth::id())]);
}

function isFriendRequestPending($id) {
    return !empty(\DB::select('SELECT  *
                               FROM    friends
                               WHERE   id1 = ? AND id2 = ? AND status = \'pending\' AND action_user_id = ?',
                               [min($id, \Auth::id()), max($id, \Auth::id()), $id]));
}

function isSentFriendRequestPending($id) {
    return !empty(\DB::select('SELECT  *
                               FROM    friends
                               WHERE   id1 = ? AND id2 = ? AND status = \'pending\' AND action_user_id = ?',
                               [min($id, \Auth::id()), max($id, \Auth::id()), \Auth::id()]));
}

function acceptFriend($id) {
    return DB::update('UPDATE   friends
                       SET      status = \'accepted\', action_user_id = ?
                       WHERE    id1 = ? AND id2 = ?',
                       [\Auth::id(), min(\Auth::id(), $id), max(\Auth::id(), $id)]);

}

function declineFriend($id) {
    return DB::update('UPDATE   friends
                       SET      status = \'declined\', action_user_id = ?
                       WHERE    id1 = ? AND id2 = ?',
                       [\Auth::id(), min(\Auth::id(), $id), max(\Auth::id(), $id)]);
}

function loadMyFriends() {
    return DB::select('SELECT *
                       FROM users
                       WHERE id <> ?
                       AND id IN (SELECT CASE WHEN id1 = ? THEN id2 ELSE id1 END
                                  FROM friends
                                  WHERE (id1 = ? OR id2 = ?) AND status = \'accepted\')',
        [\Auth::id(), \Auth::id(), \Auth::id(), \Auth::id()]);
}

function loadMeAndFriends() {
    return DB::select('SELECT *
                       FROM users
                       WHERE id IN (SELECT CASE WHEN id1 = ? THEN id2 ELSE id1 END
                                  FROM friends
                                  WHERE (id1 = ? OR id2 = ?) AND status = \'accepted\')
                        OR id = ?
                        ORDER BY score DESC',
        [\Auth::id(), \Auth::id(), \Auth::id(), \Auth::id()]);
}

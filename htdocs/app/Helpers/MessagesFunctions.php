<?php

function storeConversation($id) {
    $userId = loadUser($id)[0]->id;

    DB::insert('INSERT INTO conversations (userA, userB)
                VALUE (?, ?)',
                [min(\Auth::id(), $userId), max(\Auth::id(), $userId)]);
}


function loadConversation($id) {
    $id = loadUser($id)[0]->id;

    return DB::select('SELECT   *
                       FROM     conversations
                       WHERE    userA = ? AND userB = ?',
                       [min(\Auth::id(), $id), max(\Auth::id(), $id)]);
}


function loadLatestConversation() {
    return \DB::select('SELECT   C.userA, C.userB
                        FROM     conversations C
                        JOIN     messages M ON C.id = M.conversationId
                        WHERE    C.userA = ? OR C.userB = ?
                        ORDER BY date DESC
                        LIMIT    1',
                        [\Auth::id(), \Auth::id()]);
}


function storeMessage($cId, $message) {
    return \DB::insert('INSERT INTO messages (conversationId, author, message)
                        VALUE (?, ?, ?)',
                        [$cId, \Auth::id(), $message]);
}


function loadAllMessagesInDB() {
    return DB::select('SELECT   C.userA, C.userB, M.message, M.date, U.username
                       FROM     conversations C
                       JOIN     messages M ON C.id = M.conversationId
                       JOIN     users U ON M.author = U.id
                       ORDER BY date');
}


function loadAllMessages($id) {
    $id2 = loadUser($id)[0]->id;

    return DB::select('SELECT   U.username,M.message,M.date
                       FROM     conversations C
                       JOIN     messages M ON C.id = M.conversationId
                       JOIN     users U ON U.id = M.author
                       WHERE    C.userA = ? AND C.userB = ?',
                       [min(\Auth::id(), $id2), max(\Auth::id(), $id2)]);
}

//Get all conversations for the logged in user, then only select the latest message for each of them
function loadConversationsWithMessage() {
    return \DB::select('SELECT   userA, userB, message, date
                        FROM     (SELECT C.id, C.userA, C.userB, M.message, M.date
                                 FROM    conversations C
                                 JOIN    messages M ON C.id = M.conversationId
                                 JOIN    users U ON U.id = M.author
                                 WHERE   C.userA = ? OR C.userB = ?
                                 ORDER BY DATE DESC) AS X
                        GROUP BY id
                        ORDER BY DATE DESC',
                        [\Auth::id(), \Auth::id()]);
}

//Get all conversations for the logged in user, then only select the latest message for each of them
function loadLastNConversationsWithMessage($n) {
    return \DB::select('SELECT   *
                        FROM     (SELECT    CASE WHEN C.userA = ? THEN C.userB ELSE C.userA END as otherUser, image, message, is_read, author, date
                                 FROM       conversations C
                                 JOIN       messages M ON C.id = M.conversationId
                                 JOIN       users U ON U.id = M.author
                                 WHERE      C.userA = ? OR C.userB = ?
                                 ORDER BY   M.id DESC) AS x
                        GROUP BY otherUser
                        LIMIT    ?',
                        [\Auth::id(), \Auth::id(), \Auth::id(), $n]);
}

function loadUnreadMessages() {
    return \DB::select('SELECT  *
                        FROM    conversations C
                        JOIN    messages M ON C.id = M.conversationId
                        WHERE   M.author <> ? AND M.is_read = 0 AND (C.userA = ? OR C.userB = ?)',
                        [\Auth::id(), \Auth::id(), \Auth::id()]);
}

//get the last message that was user $id has read
function loadLastReadMessage($id) {
    $id2 = loadUser($id)[0]->id;
    $a = min(array(\Auth::id(), $id2));
    $b = max(array(\Auth::id(), $id2));
    return \DB::select('SELECT   *
                        FROM     conversations C
                        JOIN     messages M ON C.id = M.conversationId
                        WHERE    M.is_read = 1 AND C.userA = ? AND C.userB = ? AND M.author = ?
                        ORDER BY M.id DESC',
                        [$a, $b, \Auth::id()]);
}

function loadLastNMessages($n) {
    return \DB::select('SELECT   *
                        FROM     conversations C
                        JOIN     messages M ON C.id = M.conversationId
                        WHERE    C.userA = ? OR C.userB = ?
                        ORDER BY M.id DESC
                        LIMIT    ?',
                        [\Auth::id(), \Auth::id(), $n]);
}

function UpdateMessagesToSeen($id) {
    $id2 = loadUser($id)[0]->id;
    $a = min(array(\Auth::id(), $id2));
    $b = max(array(\Auth::id(), $id2));
    return \DB::statement('UPDATE   messages M
                           JOIN     (SELECT *
                                    FROM    conversations C
                                    WHERE   C.userA = ? AND C.userB = ?) CC
                           ON       CC.id = M.conversationId
                           SET      M.is_read = true
                           WHERE    M.author <> ?',
        [$a, $b, \Auth::id()]);
}
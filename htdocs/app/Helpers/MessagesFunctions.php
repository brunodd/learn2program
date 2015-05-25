<?php

//Store a new conversation between the logged in user and user $id in the database.
function storeConversation($id) {
    $userId = loadUser($id)[0]->id;

    //Create the new conversation
    \DB::insert('INSERT INTO conversations VALUE ()', []);

    //Add the 2 users to the conversation
    $conversationId = \DB::select('SELECT id FROM conversations ORDER BY id DESC LIMIT 1')[0]->id;
    \DB::insert('INSERT INTO conversations_participants (conversationId, userId) VALUE (?, ?)', [$conversationId, \Auth::id()]);
    \DB::insert('INSERT INTO conversations_participants (conversationId, userId) VALUE (?, ?)', [$conversationId, $userId]);
}


//Load a conversation between the logged in user and user $id.
function loadConversation($id) {
    $userId = loadUser($id)[0]->id;

    return \DB::select('SELECT  CP.conversationId
                        FROM    conversations_participants CP
                        JOIN    conversations_participants CP2 ON CP.conversationId = CP2.conversationId
                        WHERE   CP.userId = ?
                        AND     CP2.userId = ?',
                        [\Auth::id(), $userId]);
}

//Load the conversation in which the last message has been sent/recieved
function loadLatestConversation() {
    return \DB::select('SELECT     CP1.userId as userA, CP2.userId as userB
                        FROM       conversations_participants CP1
                        JOIN       conversations_participants CP2  ON  CP1.conversationId = CP2.conversationId
                        JOIN       messages M ON CP1.conversationId = M.conversationId
                        WHERE      CP1.userId = ?
                        AND        CP2.userId <> ?
                        ORDER BY   date     DESC
                        LIMIT 1',
                        [\Auth::id(), \Auth::id()]);
}

//Store a new message in the database
function storeMessage($cId, $message) {
    return \DB::insert('INSERT INTO messages (conversationId, author, message) VALUE (?, ?, ?)',
                                                [$cId, \Auth::id(), $message]);
}

//Load all of the messages for a conversation $Cid
function loadAllMessages($Cid) {
    return \DB::select('SELECT  U.username, M.message, M.date
                        FROM    messages M
                        JOIN    users U     ON  M.author = U.id
                        WHERE   M.conversationId = ?',
                        [$Cid]);
}

//Load the last n messages for a conversation $Cid, used for Groups' chats
function loadLastNMessages($Cid, $n) {
    return \DB::select('SELECT   *
                        FROM     (SELECT  U.username, M.id, M.message, M.date
                                 FROM     messages M
                                 JOIN     users U     ON  M.author = U.id
                                 WHERE    M.conversationId = ?
                                 ORDER BY M.id   DESC
                                 LIMIT    ?) X
                        ORDER BY X.id   ASC',
                        [$Cid, $n]);
}

//Get the last n conversations for the logged in user and only select the latest message for each of them
function loadLastNConversationsWithMessage($n) {
    return \DB::select('SELECT    *
                        FROM      (SELECT C.id, U.username, U.image, M.message, M.is_read, M.author, M.date
                                  FROM      conversations C
                                  JOIN      messages M                    ON C.id = M.conversationId
                                  JOIN      conversations_participants CP ON C.id = CP.conversationId
                                  JOIN      users U                       ON CP.userId = U.id
                                  WHERE     C.id    IN      (SELECT  C2.id
                                                            FROM     conversations C2
                                                            JOIN     conversations_participants CP2 ON C2.id = CP2.conversationId
                                                            WHERE    CP2.userId = ?)
                                  AND       CP.userId <> ?
                                  ORDER BY  M.id DESC) X
                        GROUP BY  X.id
                        ORDER BY  X.date        DESC
                        LIMIT     ?',
                        [\Auth::id(), \Auth::id(), $n]);
}

//Load all of the messages for the logged in the user that have not been read yet
function loadUnreadMessages() {
    return \DB::select('SELECT  *
                        FROM    conversations C
                        JOIN    messages M ON C.id = M.conversationId
                        WHERE   C.id    IN     (SELECT  C2.id
                                               FROM     conversations C2
                                               JOIN     conversations_participants CP2 ON C2.id = CP2.conversationId
                                               WHERE    CP2.userId = ?)
                        AND     M.author <> ?
                        AND     M.is_read = 0',
                        [\Auth::id(), \Auth::id()]);
}

//Load the last message that user $id has read
function loadLastReadMessage($id) {
    $id2 = loadUser($id)[0]->id;

    return \DB::select('SELECT  M.message
                       FROM     conversations_participants CP1
                       JOIN     conversations_participants CP2  ON  CP1.conversationId = CP2.conversationId
                       JOIN     messages M ON CP1.conversationId = M.conversationId
                       WHERE    CP1.userId = ?
                       AND      CP2.userId = ?
                       AND      M.author   = ?
                       AND      M. is_read = 1
                       ORDER BY M.id DESC',
                       [\Auth::id(), $id2, \Auth::id()]);
}

//Update all the messages in conversation $Cid that have not been written by the logged in user to seen
function UpdateMessagesToSeen($Cid) {

    return \DB::statement('UPDATE   messages M
                           SET      M.is_read = true, date = date
                           WHERE    M.conversationId = ?
                           AND      M.author <> ?',
                           [$Cid, \Auth::id()]);
}

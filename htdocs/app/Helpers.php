<?php
    // TODO: split into multiple files

    //GENERAL HELPERS NEEDED FOR THE SYSTEM
    function loadusers() {
        return DB::select('select * from users');
    }

    function loadUser($name) {
        return DB::select('select * from users where username = ? or id = ?', [$name, $name]);
    }

    function loadName($id) {
        return DB::select('select username from users where id = ?', [$id]);
    }
    function loadId($name) {
        return DB::select('select id from users where username = ?', [$name]);
    }

    function storeUser($user) {
        DB::insert('insert into users (pass, username, mail) VALUES (?, ?, ?)', [$user->pass, $user->username, $user->mail]);
    }



    //FRIENDS FUNCTIONS
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
                                 WHERE    id1 = ? AND id2 = ? AND (status = \'accepted\' OR status = \'declined\') AND action_user_id = ?',
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







    function updateUser($id, $data)
    {
        DB::statement('update users SET username = ?, mail = ?, pass = ?, image = ? where id = ? or username = ?', [$data->username, $data->mail, $data->pass, $data->image, $id, $id]);
    }

    function storeSerie($serie)
    {
        DB::insert('insert into series (title, description, makerId, tId) VALUES (?, ?, ?, ?)', [$serie->title, $serie->description, $serie->makerId, $serie->tId]);
    }

    function loadSerieWithId($id)
    {
        return DB::select('select * from series where id = ?', [$id]);
    }

    function loadSerieWithIdOrTitle($id)
    {
        return DB::select('select * from series where id = ? or title = ?', [$id, $id]);
    }

    function loadSerie($title, $tId)
    {
        return DB::select('select * from series where title = ? and tId = ?', [$title, $tId]);
    }

    function loadAllSeries()
    {
        return DB::select('select * from series');
    }

    function loadAllDistinctSeries()
    {
        return DB::select('select * from series group by title');
    }

    function updateSerie($id, $serie, $typeId)
    {
        DB::statement('update series SET title = ?, description = ?, tId = ? where id = ?',[$serie->title, $serie->description, $typeId, $id]);
    }

    function isMakerOfSeries($sId, $mId)
    {
        //$serieID = loadSerieWithIdOrTitle($sId)[0]->id;
        if ( !empty(DB::select('select * from series where (id = ? or title = ?) and makerId = ?',[$sId, $sId, $mId])) )
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function SerieContainsExercises($sId)
    {
        if ( !empty(DB::select('select * from exercises, (select * from exercises_in_series where seriesId = ?) eps
                where exercises.id = eps.exId', [$sId])) )
            return true;
        else return false;
    }

    /*function SerieContainsExercises2($sId)
    {
        $seriesID = loadSerieWithIdOrTitle($sId);
        if ( !empty(DB::select('select * from exercises where seriesId = ?',[$seriesID[0]->id])) ) return true;
        else return false;
    }*/

    function loadExercisesFromSerie($sId)
    {
        return DB::select('select * from exercises, (select * from exercises_in_series where seriesId = ?) eps
                where exercises.id = eps.exId',
                [$sId]);
    }

    /*function loadExercisesFromSerie2($sId)
    {
        $seriesID = loadSerieWithIdOrTitle($sId);
        return DB::select('select * from exercises where seriesId = ?',[$seriesID[0]->id]);
    }*/

    function storeExercise($exercise)
    {
        // Add exercise
        DB::insert('insert into exercises (question, tips, start_code, expected_result, makerId) VALUES (?, ?, ?, ?, ?)',
        [$exercise->question, $exercise->tips, $exercise->start_code, $exercise->expected_result, $exercise->makerId]);

        // Add link with series
        DB::insert('insert into exercises_in_series (exId, seriesId)
            select max(id), ? from exercises', [$exercise->seriesId]);
    }

    function loadAllExercises()
    {
        return DB::select('select * from exercises');
    }

    function loadExercise($id)
    {
        return DB::select('select * from exercises where id = ?', [$id]);
    }

    function isMakerOfExercise($eId, $uId)
    {
        return ( empty(DB::select('select * from exercises where makerId = ? and id = ?', [$uId, $eId])) );
    }

    function nextExerciseInLine($eId, $uId)
    {
        return DB::select('select * from exercises ex1, exercises_in_series eps1
        where (ex1.id = eps1.exId and eps1.seriesId in
            (select seriesId from exercises_in_series eps2 where eps2.exId = ?))
        and (ex1.id not in
            (select eId from answers where uId = ? and success = 1))
        order by id',
        [$eId, $uId]);
    }

    function completedAllPreviousExercisesOfSeries($eId, $uId)
    {
        if( $eId == nextExerciseInLine($eId, $uId)[0]->id ) return true;
        else return userCompletedExercise($eId, $uId);
    }

    function userCompletedExercise($eId, $uId)
    {
        if( empty(DB::select('select * from answers where eId = ? and uId = ? and success = 1', [$eId, $uId])) ) return false;
        else return true;
    }

    function removeUnusedTypes()
    {
        DB::statement('delete from types where id NOT IN (select distinct(tId) from series)');
    }

    /* Subject and Difficulty => this combination is unique */
    function loadTypeId($type)
    {
        return DB::select('select id from types where subject = ? and difficulty = ?', [$type->subject, $type->difficulty]);
    }

    function loadType1($type)
    {
        return DB::select('select * from types where subject = ? and difficulty = ?', [$type->subject, $type->difficulty]);
    }

    function loadType2($id)
    {
        return DB::select('select * from types where id = ?', [$id]);
    }

    function loadAllTypes()
    {
        return DB::select('select * from types');
    }

    function storeType($type)
    {
        DB::insert('insert into types (subject, difficulty) VALUES (?, ?)', [$type->subject, $type->difficulty]);
    }

    function storeGroup($group)
    {
        DB::insert('insert into groups (name, founderId) VALUES (?, ?)', [$group->name, $group->founderId]);
    }

    function loadAllGroups()
    {
        return DB::select('select * from groups ');
    }

    function loadGroup($group)
    {
        return DB::select('select * from groups where id = ? or name = ?', [$group, $group]);
    }

    function isFounderOfGroup($groupId, $founderId)
    {
        if ( !empty(DB::select('select * from groups where (id = ? or name = ?) and founderId = ?',[$groupId, $groupId, $founderId])) )
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function addMember2Group($uId, $gId)
    {
        $group = loadGroup($gId);
        if ( !empty($group) ) DB::insert('insert into members_of_groups (memberId, groupId) VALUES (?, ?)', [$uId, $group[0]->id]);
        //else we must throw an error, however theoretically this should never be the case...
    }

    function deleteMemberFromGroup($uId, $gId)
    {
        $group = loadGroup($gId);
        if ( !empty($group) ) DB::statement('delete from members_of_groups where memberId = ? and groupId = ?', [$uId, $group[0]->id]);
        //else we must throw an error, however theoretically this should never be the case...
    }

    function noMemberYet($uId, $gId)
    {
        $group = loadGroup($gId);
        if ( !empty($group) and !empty(DB::select('select * from members_of_groups where memberId = ? and groupId = ?',[$uId, $group[0]->id])) )
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    function updateGroup($id, $groupname)
    {
        $group = loadGroup($id);
        if ( !empty($group) ) DB::statement('update groups SET name = ? where id = ?', [$groupname, $group[0]->id]);
    }

    function storeAnswer($ans)
    {
        DB::insert('insert into answers (given_code, success, uId, eId) values (?, ?, ?, ?)', [$ans->given_code, $ans->success, $ans->uId, $ans->eId]);
    }

    function listGroupsOfUser($id)
    {
        return DB::select('select groupname from groups join (select distinct(groupId) from members_of_groups where memberId = ?) agg on id=groupId', [$id]);
    }

    function listUsersOfGroup($id)
    {
        return DB::select('select username from users join (select memberId from members_of_groups where groupId = ?) agg on id=memberId', [$id]);
    }

    function notRatedYet($uId, $sId)
    {
        if( empty(DB::select('select * from series_ratings where userId = ? and seriesId = ?', [$uId, $sId])) ) return true;
        else return false;
    }

    function addRating($nr)
    {
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [$nr->rating, $nr->userId, $nr->seriesId]);
    }

    function unratedSeries($sId)
    {
        if( empty(DB::select('select * from series_ratings where seriesId = ?', [$sId])) ) return true;
        else return false;
    }

    //Raphael: since mysql seems to be retarded when it comes to calculating the average, i wrote it myself
    //after a couple of tests, it seems mysql's average is always off by 1
    function averageRating($sId)
    {
        $ratings = DB::select('select * from series_ratings where seriesId = ?', [$sId]);
        $avg = 0;
        foreach( $ratings as $r )
        {
            $avg = $avg + $r->rating;
        }
        $avg = $avg / count($ratings);
        return $avg;
    }


    function compare($s1, $s2)
    {
        $length = strlen($s1);
        if( $length != strlen($s2) ) return false;
        for($i=0; $i < $length; $i++)
        {
            if( $s1[$i] != $s2[$i] ) return false;
        }
        return true;
    }

    function first20chars($string)
    {
        if( strlen($string) > 50 )
        {
            return (substr($string, 0, 50) . "...");
        }
        return $string;
    }

    function ExNrOfSerie($eId, $sId)
    {
        $exercises = loadExercisesFromSerie($sId);
        $index = 1;
        foreach($exercises as $ex)
        {
            if( $ex->id == $eId ) return $index;
            $index++;
        }
    }

    //MESSAGES

    function storeConversation($id) {
        $userId = loadUser($id)[0]->id;

        DB::insert('INSERT INTO conversations (userA, userB) VALUE (?, ?)', [min(\Auth::id(), $userId), max(\Auth::id(), $userId)]);
    }

    function loadConversation($id) {
        $id = loadUser($id)[0]->id;

        return DB::select('SELECT * FROM conversations WHERE userA = ? AND userB = ?', [min(\Auth::id(), $id), max(\Auth::id(), $id)]);
    }


    function loadLatestConversation() {
        return \DB::select(' SELECT C.userA, C.userB
                             FROM conversations C
                                  JOIN messages M ON C.id = M.conversationId
                             WHERE C.userA = ? OR C.userB = ?
                             ORDER BY date DESC
                             LIMIT 1',
                             [\Auth::id(), \Auth::id()]);
    }


    function storeMessage($cId, $message) {
        return \DB::insert('INSERT INTO messages (conversationId, author, message) VALUE (?, ?, ?)', [$cId, \Auth::id(), $message]);
    }


    function loadAllMessagesInDB() {
        return DB::select('SELECT C.userA, C.userB, M.message, M.date, U.username
                           FROM conversations C
                                JOIN messages M ON C.id = M.conversationId
                                JOIN users U ON M.author = U.id
                           ORDER BY date');
    }


    function loadAllMessages($id) {
        $id2 = loadUser($id)[0]->id;

        return DB::select('SELECT U.username,M.message,M.date
                           FROM conversations C
                                JOIN messages M ON C.id = M.conversationId
                                JOIN users U ON U.id = M.author
                           WHERE C.userA = ? AND C.userB = ?',
                           [min(\Auth::id(), $id2), max(\Auth::id(), $id2)]);
    }

    //Get all conversations for the logged in user, then only select the latest message for each of them
    function loadConversationsWithMessage() {
        return \DB::select('SELECT userA, userB, message, date
                                FROM (SELECT C.id, C.userA, C.userB, M.message, M.date
                                      FROM conversations C
                                           JOIN messages M ON C.id = M.conversationId
                                           JOIN users U ON U.id = M.author
                                    WHERE C.userA = ? OR C.userB = ?
                                    ORDER BY DATE DESC) AS X
                                GROUP BY id
                                ORDER BY DATE DESC',
            [\Auth::id(), \Auth::id()]);
    }

    //Get all conversations for the logged in user, then only select the latest message for each of them
    function loadLastNConversationsWithMessage($n) {
        return \DB::select('SELECT *
                            FROM (SELECT CASE WHEN C.userA = ? THEN C.userB ELSE C.userA END as otherUser, image, message, is_read, author, date
                                  FROM conversations C
                                       JOIN messages M ON C.id = M.conversationId
                                       JOIN users U ON U.id = M.author
                                  WHERE C.userA = ? OR C.userB = ?
                                  ORDER BY M.id DESC) AS x
                            GROUP BY otherUser
                            LIMIT ?',
            [\Auth::id(), \Auth::id(), \Auth::id(), $n]);
    }

    function loadUnreadMessages() {
        return \DB::select('SELECT *
                            FROM conversations C
                                 JOIN messages M ON C.id = M.conversationId
                            WHERE M.author <> ? AND M.is_read = 0 AND (C.userA = ? OR C.userB = ?)',
                            [\Auth::id(), \Auth::id(), \Auth::id()]);
    }

    //get the last message that was user $id has read
    function loadLastReadMessage($id) {
        $id2 = loadUser($id)[0]->id;
        $a = min(array(\Auth::id(), $id2));
        $b = max(array(\Auth::id(), $id2));
        return \DB::select('SELECT *
                            FROM conversations C
                                 JOIN messages M ON C.id = M.conversationId
                            WHERE M.is_read = 1 AND C.userA = ? AND C.userB = ? AND M.author = ?
                            ORDER BY M.id DESC',
                            [$a, $b, \Auth::id()]);
    }

    function loadLastNMessages($n) {
        return \DB::select('SELECT *
                            FROM conversations C
                                 JOIN messages M ON C.id = M.conversationId
                            WHERE C.userA = ? OR C.userB = ?
                            ORDER BY M.id DESC
                            LIMIT ?',
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

    //NOTIFICATIONS

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


    //ALL STATISTICAL HELPERS NEEDED FOR THE GRAPHS

    //returns a list of pairs, seriesId & average rating of that serie
    function averageRatingsBySeries() {
        $series = loadAllSeries();
        $avgs = [];
        foreach( $series as $s )
        {
            array_push($avgs, [$s->id, averageRating($s->id)]);
        }
        return $avgs;
    }

    //returns the avarge rating that a user submits
    function averageRatingByUser($id)
    {
        $ratings = DB::select('select * from series_ratings where userId = ?', [$id]);
        $avg = 0;
        foreach( $ratings as $r )
        {
            $avg = $avg + $r->rating;
        }
        $avg = $avg / count($ratings);
        return $avg;
    }

    //returns a list of pairs, userId & average rating given by that user
    function averageRatingsByUsers() {
        $users = loadusers();
        $avgs = [];
        foreach( $users as $u )
        {
            array_push($avgs, [$u->id, averageRatingByUser($u->id)]);
        }
        return $avgs;
    }

    //returns a list of pairs, typeId & average rating for that type
    //tyring a different strategy here since I found out mysql's "offset" is always 1 too much
    // -> please test asap so i can rewrite if necessary
    function averageRatingsByTypes() {
        $avgs = DB::select('select types.id, avg(rating) as a from series_ratings JOIN series JOIN types where series.id = seriesId and tId = types.id group by tId');
        foreach( $avgs as $a )
        {
            $a->average = $a->average - 1;
        }
        return $avgs;
    }

    //returns a list of pairs, userId & number of series created by that user
    function countSeriesByMakers() {
        return DB::select('select makerId, count(id) as c from series group by makerId');
    }

    //returns a list of pairs, userId & the number of exercises created by that user
    function countExercisesByMakers() {
        return DB::select('select makerId, count(exercises.id) as c from exercises group by makerId');
    }

    //return a list of pairs, userId & the number of completed series (i.e. at least tried once on each exercise)
    function countSeriesCompletedByUsers() {
        return DB::select('select uId, count(uId) as c from (select uId, count(distinct(eId)) as c1, agg.seriesId, agg.c2 from answers join exercises join (select seriesId, count(id) as c2 from exercises group by seriesId) agg on eId = exercises.id and exercises.seriesId = agg.seriesId group by uId, agg.seriesId having c1 = c2) agg group by uId');
    }

    //return a list of pairs, userId & the number of completed series (i.e. solved all exercises correctly)
    function countSeriesSucceededByUsers() {
        return DB::select('select uId, count(uId) as c from (select uId, count(distinct(eId)) as c1, agg.seriesId, agg.c2 from answers join exercises join (select seriesId, count(id) as c2 from exercises group by seriesId) agg on eId = exercises.id and exercises.seriesId = agg.seriesId where success = 1 group by uId, agg.seriesId having c1 = c2) agg group by uId');
    }

    function countSeriesSucceededByUser($uId) {
        $pairs = countSeriesSucceededByUsers();
        foreach ($pairs as $pair) {
            if($pair->uId = $uId) {
                return $pair->c;
            }
        }
        return 0;
    }

    function countUsersSucceededAllSeries() {
        return ;
    }

    //return a list of pairs, userId & the number of series in progress (i.e. with exercises still unanswered)
    //in particular -> the number of series in progress equals (total number of series containing exercises - "completed" series)
    function countSeriesInProgressByUsers() {
        return DB::select('select uId, (agg2.c-count(uId)) as c from (select uId, count(distinct(eId)) as c1, agg.seriesId, agg.c2 from answers join exercises join (select seriesId, count(id) as c2 from exercises group by seriesId) agg on eId = exercises.id and exercises.seriesId = agg.seriesId group by uId, agg.seriesId having c1 = c2) agg, (select count(distinct(seriesId)) as c from exercises) agg2 group by uId');
    }

    //returns list of pairs, userId & number of series for which none of the exercises was made so far
    //series with no exercises are not taken into account
    function countSeriesUnstartedByUsers() {
        return DB::select('select * from (select users.id, agg.c as c from users, (select count(id) as c from series where id in (select distinct(seriesId) from exercises)) agg where users.id not in (select uId from answers) union (select uId as id, (agg.c-count(distinct(seriesId))) from (answers join exercises on eId = exercises.id), (select count(id) as c from series where id in (select distinct(seriesId) from exercises)) agg group by uId)) agg group by id');
    }

    //return a list of pairs, userId & the number of completed exercises (i.e. at least tried once)
    function countExercisesCompletedByUsers() {
        return DB::select('select uId, count(distinct(eId)) as c from answers group by uId');
    }

    //return a list of pairs, userId & the number of completed exercises (i.e. solved correctly)
    function countExercisesSucceededByUsers() {
        return DB::select('select uId, count(distinct(eId)) as c from answers where success = 1 group by uId');
    }

    //return a list of pairs, userId & the number of completed exercises (i.e. not correct)
    function countExercisesFailedByUsers() {
        return DB::select('select uId, count(distinct(eId)) as c from answers where success = 0 group by uId');
    }

    //return a list of pairs, userId & number of exercises for which no answer has been submitted yet
    function countExercisesUnstartedByUsers() {
        return DB::select('select * from (select users.id, agg.c as c from users, (select count(id) as c from exercises) agg where users.id not in (select uId from answers) union (select uId as id, (agg.c-count(distinct(eId))) from answers, (select count(id) as c from exercises) agg group by uId)) agg group by id');
    }

    //return a list of pairs, userId & the number of completed types (i.e. at least tried all exercises of a certain type)
    function countTypesCompletedByUsers() {
        return DB::select('select uId, count(agg1.tId) as c from (select agg.uId, count(agg.eId) as c, series.tId from (select uId, eId from answers group by uId, eId) agg join exercises join series on agg.eId = exercises.id and seriesId = series.id group by agg.uId, tId) agg1 join (select tId, count(exercises.id) as c from exercises join series on seriesId = series.id group by tId) agg2 on agg1.tId = agg2.tId where agg1.c = agg2.c group by uId');
    }

    //return a list of pairs, userId & the number of completed types (i.e. solved correctly)
    function countTypesSucceededByUsers() {
        return DB::select('select uId, count(agg1.tId) as c from (select agg.uId, count(agg.eId) as c, series.tId from (select uId, eId from answers where success = 1 group by uId, eId) agg join exercises join series on agg.eId = exercises.id and seriesId = series.id group by agg.uId, tId) agg1 join (select tId, count(exercises.id) as c from exercises join series on seriesId = series.id group by tId) agg2 on agg1.tId = agg2.tId where agg1.c = agg2.c group by uId');
    }

    //return a list of pairs, userId & the number of types in progress (i.e. analog to countSeriesInProgressByUsers)
    function countTypesInProgressByUsers() {
        return DB::select('select uId, (agg2.c-agg1.c) as c from (select agg.uId, count(agg.eId) as c, series.tId from (select uId, eId from answers group by uId, eId) agg join exercises join series on agg.eId = exercises.id and seriesId = series.id group by agg.uId, tId) agg1 join (select tId, count(exercises.id) as c from exercises join series on seriesId = series.id group by tId) agg2 on agg1.tId = agg2.tId group by uId');
    }

    //returns a list of pairs, userId & the number of types for which no answer has been submitted yet
    //types for which no exercises exist are not taken into account
    function countTypesUnstartedByUsers() {
        return DB::select('select * from (select users.id, agg.c as c from users, (select count(id) as c from types where id in (select tId from series where id in (select distinct(seriesId) from exercises))) agg where users.id not in (select uId from answers) union (select uId as id, (agg.c-count(distinct(tId))) from (answers join exercises join series join types on eId = exercises.id and seriesId = series.id and tId = types.id), (select count(id) as c from types where id in (select tId from series where id in (select distinct(seriesId) from exercises)) ) agg )) agg group by id');
    }

    //return a list of pairs, typeId & number of series with that type
    function countSeriesByTypes() {
        return DB::select('select tId, count(id) as c from series group by tId');
    }

    //return a list of pairs, groupId & number of members of that group
    function countUsersByGroups() {
        return DB::select('select groupId, count(memberId) as c from members_of_groups group by groupId');
    }

    //return a list of pairs, userId & number of groups associated to that user
    function countGroupsByUsers() {
        return DB::select('select memberId, count(groupId) as c from members_of_groups group by memberId');
    }

    //return a list of pairs, seriesId & the number of exercises associated to that serie
    function countExercisesBySeries() {
        return DB::select('select * from ( (select id, 0 as c  from series where id not in (select seriesId from exercises group by seriesId)) union (select seriesId, count(id) as c from exercises group by seriesId) ) agg group group by id');
    }

    //return a list of pairs, seriesId & the number of users that have successfully completed all the exercises for that serie
    function countUsersSucceededSerie() {
        return DB::select('select sId, count(distinct(uId)) as c from (select sId, count(distinct(eId)) as c, uId from exercises join (select series.id as sId, exercises.id as eId, uId from (series join exercises on series.id = seriesId) join answers on exercises.id = eId where success = 1 group by sId, eId, uId) agg on seriesId=sId and id=eId group by seriesId, uId) agg join (select seriesId, count(id) as c from exercises group by seriesId) agg2 on seriesId=sId and agg.c=agg2.c group by sId union (select id as sId, 0 as c  from series where id not in (select seriesId from exercises join answers on exercises.id=eId where success = 1 group by seriesId)) order by sId');
    }

    // NEW CODE
    function returnSeriesSameMaker($serie) {
        return DB::select('SELECT *
                            FROM series
                            WHERE series.title != ? and makerId = ?',
                                [$serie->title, $serie->makerId]);
    }

    function returnSeriesSameDifficulty($serie) {
        $difficulty = DB::select('SELECT *
                                FROM types
                                WHERE types.id = ?', [$serie->tId]);

        return DB::select(' SELECT * 
                            FROM series, types
                            WHERE series.title != ? and series.tId = types.id and types.difficulty = ?',
                             [$serie->title, $difficulty[0]->difficulty]);
    }

?>


<?php

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

    function findFriends($a, $b) {
        $idA = loadUser($a)[0]->id;
        $idB = loadUser($b)[0]->id;
        return DB::select('select * from friends where id1 = ? and id2 = ?', [min($idA, $idB), max($idA, $idB)]);
    }

    function updateUser($id, $data) {
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
        if ( !empty(DB::select('select * from exercises where serieId = ?',[$sId])) ) return true;
        else return false;
    }

    /*function SerieContainsExercises2($sId)
    {
        $seriesID = loadSerieWithIdOrTitle($sId);
        if ( !empty(DB::select('select * from exercises where serieId = ?',[$seriesID[0]->id])) ) return true;
        else return false;
    }*/

    function loadExercisesFromSerie($sId)
    {
        return DB::select('select * from exercises where serieId = ?',[$sId]);
    }

    /*function loadExercisesFromSerie2($sId)
    {
        $seriesID = loadSerieWithIdOrTitle($sId);
        return DB::select('select * from exercises where serieId = ?',[$seriesID[0]->id]);
    }*/

    function storeExercise($exercise)
    {
        DB::insert('insert into exercises (question, tips, start_code, expected_result, serieId) VALUES (?, ?, ?, ?, ?)', [$exercise->question, $exercise->tips, $exercise->start_code, $exercise->expected_result, $exercise->serieId]);
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
        if( empty(DB::select('select * from series where makerId = ? and id in (select serieId from exercises where id = ?)', [$uId, $eId])) ) return false;
        else return true;
    }

    function nextExerciseInLine($eId, $uId)
    {
        return DB::select('select * from exercises where (serieId in (select serieId from exercises where id = ?)) and (id not in (select eId from answers where uId = ? and success = 1)) order by id', [$eId, $uId]);
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
        if( empty(DB::select('select * from series_ratings where userId = ? and serieId = ?', [$uId, $sId])) ) return true;
        else return false;
    }

    function addRating($nr)
    {
        DB::insert('insert into series_ratings (rating, userId, serieId) VALUES (?, ?, ?)', [$nr->rating, $nr->userId, $nr->serieId]);
    }

    function unratedSeries($sId)
    {
        if( empty(DB::select('select * from series_ratings where serieId = ?', [$sId])) ) return true;
        else return false;
    }

    //Raphael: since mysql seems to be retarded when it comes to calculating the average, i wrote it myself
    //after a couple of tests, it seems mysql's average is always off by 1
    function averageRating($sId)
    {
        $ratings = DB::select('select * from series_ratings where serieId = ?', [$sId]);
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
        return \DB::select(' select userA, userB, message, date
                             from (select C.id, C.userA, C.userB, M.message, M.date
                                   from conversations C
                                        join messages M on C.id = M.conversationId
                                        join users U on U.id = M.author
                                   where C.userA = ? or C.userB = ?
                                   order by date desc) as X
                             group by id
                             order by date desc',
            [\Auth::id(), \Auth::id()]);
    }

    //ALL STATISTICAL HELPERS NEEDED FOR THE GRAPHS

    //returns a list of pairs, serieId & average rating of that serie
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
        $avgs = DB::select('select types.id, avg(rating) as a from series_ratings JOIN series JOIN types where series.id = serieId and tId = types.id group by tId');
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
        return DB::select('select makerId, count(exercises.id) as c from exercises join series join users on serieId = series.id and makerId = users.id group by makerId');
    }

    //return a list of pairs, userId & the number of completed series (i.e. at least tried once on each exercise)
    function countSeriesCompletedByUsers() {
        return DB::select('select uId, count(uId) as c from (select uId, count(distinct(eId)) as c1, agg.serieId, agg.c2 from answers join exercises join (select serieId, count(id) as c2 from exercises group by serieId) agg on eId = exercises.id and exercises.serieId = agg.serieId group by uId, agg.serieId having c1 = c2) agg group by uId');
    }

    //return a list of pairs, userId & the number of completed series (i.e. solved all exercises correctly)
    function countSeriesSucceededByUsers() {
        return DB::select('select uId, count(uId) as c from (select uId, count(distinct(eId)) as c1, agg.serieId, agg.c2 from answers join exercises join (select serieId, count(id) as c2 from exercises group by serieId) agg on eId = exercises.id and exercises.serieId = agg.serieId where success = 1 group by uId, agg.serieId having c1 = c2) agg group by uId');
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
        return DB::select('select uId, (agg2.c-count(uId)) as c from (select uId, count(distinct(eId)) as c1, agg.serieId, agg.c2 from answers join exercises join (select serieId, count(id) as c2 from exercises group by serieId) agg on eId = exercises.id and exercises.serieId = agg.serieId group by uId, agg.serieId having c1 = c2) agg, (select count(distinct(serieId)) as c from exercises) agg2 group by uId');
    }

    //returns list of pairs, userId & number of series for which none of the exercises was made so far
    //series with no exercises are not taken into account
    function countSeriesUnstartedByUsers() {
        return DB::select('select * from (select users.id, agg.c as c from users, (select count(id) as c from series where id in (select distinct(serieId) from exercises)) agg where users.id not in (select uId from answers) union (select uId as id, (agg.c-count(distinct(serieId))) from (answers join exercises on eId = exercises.id), (select count(id) as c from series where id in (select distinct(serieId) from exercises)) agg group by uId)) agg group by id');
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
        return DB::select('select uId, count(agg1.tId) as c from (select agg.uId, count(agg.eId) as c, series.tId from (select uId, eId from answers group by uId, eId) agg join exercises join series on agg.eId = exercises.id and serieId = series.id group by agg.uId, tId) agg1 join (select tId, count(exercises.id) as c from exercises join series on serieId = series.id group by tId) agg2 on agg1.tId = agg2.tId where agg1.c = agg2.c group by uId');
    }

    //return a list of pairs, userId & the number of completed types (i.e. solved correctly)
    function countTypesSucceededByUsers() {
        return DB::select('select uId, count(agg1.tId) as c from (select agg.uId, count(agg.eId) as c, series.tId from (select uId, eId from answers where success = 1 group by uId, eId) agg join exercises join series on agg.eId = exercises.id and serieId = series.id group by agg.uId, tId) agg1 join (select tId, count(exercises.id) as c from exercises join series on serieId = series.id group by tId) agg2 on agg1.tId = agg2.tId where agg1.c = agg2.c group by uId');
    }

    //return a list of pairs, userId & the number of types in progress (i.e. analog to countSeriesInProgressByUsers)
    function countTypesInProgressByUsers() {
        return DB::select('select uId, (agg2.c-agg1.c) as c from (select agg.uId, count(agg.eId) as c, series.tId from (select uId, eId from answers group by uId, eId) agg join exercises join series on agg.eId = exercises.id and serieId = series.id group by agg.uId, tId) agg1 join (select tId, count(exercises.id) as c from exercises join series on serieId = series.id group by tId) agg2 on agg1.tId = agg2.tId group by uId');
    }

    //returns a list of pairs, userId & the number of types for which no answer has been submitted yet
    //types for which no exercises exist are not taken into account
    function countTypesUnstartedByUsers() {
        return DB::select('select * from (select users.id, agg.c as c from users, (select count(id) as c from types where id in (select tId from series where id in (select distinct(serieId) from exercises))) agg where users.id not in (select uId from answers) union (select uId as id, (agg.c-count(distinct(tId))) from (answers join exercises join series join types on eId = exercises.id and serieId = series.id and tId = types.id), (select count(id) as c from types where id in (select tId from series where id in (select distinct(serieId) from exercises)) ) agg )) agg group by id');
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

    //return a list of pairs, serieId & the number of exercises associated to that serie
    function countExercisesBySeries() {
        return DB::select('select * from ( (select id, 0 as c  from series where id not in (select serieId from exercises group by serieId)) union (select serieId, count(id) as c from exercises group by serieId) ) agg group group by id');
    }

    //return a list of pairs, serieId & the number of users that have successfully completed all the exercises for that serie
    function countUsersSucceededSerie() {
        return DB::select('select sId, count(distinct(uId)) as c from (select sId, count(distinct(eId)) as c, uId from exercises join (select series.id as sId, exercises.id as eId, uId from (series join exercises on series.id = serieId) join answers on exercises.id = eId where success = 1 group by sId, eId, uId) agg on serieId=sId and id=eId group by serieId, uId) agg join (select serieId, count(id) as c from exercises group by serieId) agg2 on serieId=sId and agg.c=agg2.c group by sId union (select id as sId, 0 as c  from series where id not in (select serieId from exercises join answers on exercises.id=eId where success = 1 group by serieId)) order by sId');
    }

?>


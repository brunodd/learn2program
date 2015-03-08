<?php

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

    function updateUser($id, $data) {
        DB::statement('update users SET username = ?, mail = ?, pass = ? where id = ?', [$data->username, $data->mail, $data->pass, $id]);
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
        if ( !empty(DB::select('select * from series where id = ? and makerId = ?',[$sId, $mId])) )
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

    function removeUnusedTypes()
    {
        DB::statement('delete from types where id NOT IN (select distinct(tId) from Series)');
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
        if ( !empty($group) ) DB::statement('update groups SET name = ? where id = ?', [$groupname, $group->id]);
    }

    function storeAnswer($ans)
    {
        DB::insert('insert into exercises_answers (given_code, success, uId, eId) values (?, ?, ?, ?)', [$ans->given_code, $ans->success, $ans->uId, $ans->eId]);
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
?>

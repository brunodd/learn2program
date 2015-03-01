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

    function loadSerie($title, $tId)
    {
        return DB::select('select * from series where title = ? and tId = ?', [$title, $tId]);
    }

    function loadAllSeries()
    {
        return DB::select('select * from series');
    }

    function updateSerie($id, $serie, $typeId)
    {
        DB::statement('update series SET title = ?, description = ?, tId = ? where id = ?',[$serie->title, $serie->description, $typeId, $id]);
    }

    function isMakerOfSeries($sId, $mId)
    {
        if ( !empty(DB::select('select * from series where id = ? and makerId = ?',[$sId, $mId])) )
        {
            return true;
        }
        else
        {
            return false;
        }
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
        if ( !empty(DB::select('select * from groups where id = ? and founderId = ?',[$groupId, $founderId])) )
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
        DB::insert('insert into members_of_groups (memberId, groupId) VALUES (?, ?)', [$uId, $gId]);
    }

    function deleteMemberFromGroup($uId, $gId)
    {
        DB::statement('delete from members_of_groups where memberId = ? and groupId = ?', [$uId, $gId]);
    }

    function noMemberYet($uId, $gId)
    {
        if ( !empty(DB::select('select * from members_of_groups where memberId = ? and groupId = ?',[$uId, $gId])) )
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
        DB::statement('update groups SET name = ? where id = ?', [$groupname, $id]);
    }

?>

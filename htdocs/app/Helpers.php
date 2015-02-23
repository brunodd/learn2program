<?php

    function loadUsers() {
        return DB::select('select * from Users');
    }

    function loadUser($name) {
        return DB::select('select * from Users where username = ? or id = ?', [$name, $name]);
    }

    function loadName($id) {
        return DB::select('select username from Users where id = ?', [$id]);
    }
    function loadId($name) {
        return DB::select('select id from Users where username = ?', [$name]);
    }

    function storeUser($user) {
        DB::insert('insert into Users (pass, username, mail) VALUES (?, ?, ?)', [$user->pass, $user->username, $user->mail]);
    }

    function updateUser($id, $data) {
        DB::statement('update Users SET username = ?, mail = ?, pass = ? where id = ?', [$data->username, $data->mail, $data->pass, $id]); 
    }

    function storeSerie($serie)
    {
        DB::insert('insert into Series (title, description, makerId, tId) VALUES (?, ?, ?, ?)', [$serie->title, $serie->description, $serie->makerId, $serie->tId]);
    }

    function loadSerieWithId($id)
    {
        return DB::select('select * from Series where id = ?', [$id]);
    }

    function loadSerie($title, $tId)
    {
        return DB::select('select * from Series where title = ? and tId = ?', [$title, $tId]);
    }

    /* Subject and Difficulty => this combination is unique */
    function loadTypeId($type)
    {
        return DB::select('select id from Types where subject = ? and difficulty = ?', [$type->subject, $type->difficulty]);
    }

    function loadType1($type)
    {
        return DB::select('select * from Types where subject = ? and difficulty = ?', [$type->subject, $type->difficulty]);
    }

    function loadType2($id)
    {
        return DB::select('select * from Types where id = ?', [$id]);
    }

    function storeType($type)
    {
        DB::insert('insert into Types (subject, difficulty) VALUES (?, ?)', [$type->subject, $type->difficulty]);
    }

?>

<?php

    function loadUsers() {
        return DB::select('select * from Users');
    }

    function loadName($id) {
        return DB::select('select username from Users where id = ?', [$id]);
    }
    function loadId($name) {
        return DB::select('select id from Users where username = ?', [$name]);
    }

    function storeUser($user) {
        DB::select('insert into Users (pass, username) VALUES (?, ?)', [$user->pass, $user->username]);
    }
?>

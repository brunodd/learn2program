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
    DB::insert('insert into users (pass, username, score, mail, info) VALUES (?, ?, ?, ?)', [$user->pass, $user->username, $user->score, $user->mail, $user->info]);
}

function updateUser($id, $data)
{
    DB::statement('update users
                    SET username = ?, mail = ?, pass = ?, score = ?, image = ? , info = ?
                    where id = ? or username = ?',
        [$data->username, $data->mail, $data->pass, $data->score, $data->image, $data->info, $id, $id]);
}

function setUserScore($id, $score) {
    DB::statement('update users
                    SET score = ?
                    where id = ?',
                    [$score, $id]);
}

function loadUsersSearch($s) {
    return DB::select('SELECT *
                       FROM users
                       WHERE username LIKE ?',
                       ['%'.$s.'%']);
}

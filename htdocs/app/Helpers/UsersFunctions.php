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
    DB::insert('insert into users (pass, username, mail, info) VALUES (?, ?, ?, ?)', [$user->pass, $user->username, $user->mail, $user->info]);
}

function updateUser($id, $data)
{
    DB::statement('update users SET username = ?, mail = ?, pass = ?, image = ? , info = ? where id = ? or username = ?', [$data->username, $data->mail, $data->pass, $data->image, $data->info, $id, $id]);
}

function loadUsersSearch($s) {
    return DB::select('SELECT *
                       FROM users
                       WHERE username LIKE ?',
                       ['%'.$s.'%']);
}

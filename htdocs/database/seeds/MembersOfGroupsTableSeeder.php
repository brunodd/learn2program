<?php

use Illuminate\Database\Seeder;
use App\User;

class MemersOfGroupsTableSeeder extends Seeder {

    public function run() {
        DB::table('members_of_groups')->delete();

        DB::insert('insert into members_of_groups (memberId, groupId) VALUES (?, ?)', [1, 1]);
        DB::insert('insert into members_of_groups (memberId, groupId) VALUES (?, ?)', [1, 2]);
        DB::insert('insert into members_of_groups (memberId, groupId) VALUES (?, ?)', [2, 1]);
        DB::insert('insert into members_of_groups (memberId, groupId) VALUES (?, ?)', [2, 3]);
        DB::insert('insert into members_of_groups (memberId, groupId) VALUES (?, ?)', [3, 1]);
        DB::insert('insert into members_of_groups (memberId, groupId) VALUES (?, ?)', [3, 3]);
        DB::insert('insert into members_of_groups (memberId, groupId) VALUES (?, ?)', [4, 2]);
    }
}

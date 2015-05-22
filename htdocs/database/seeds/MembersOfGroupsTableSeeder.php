<?php

use Illuminate\Database\Seeder;

class MembersOfGroupsTableSeeder extends Seeder {

    public function run() {
        DB::table('members_of_groups')->delete();

        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [3, 1, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [1, 2, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [2, 2, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [3, 2, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [4, 2, 'accepted']);
        //DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [4, 2, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [2, 3, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [3, 3, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [1, 4, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [2, 4, 'pending']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [3, 4, 'pending']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [4, 4, 'pending']);
    }
}

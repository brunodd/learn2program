<?php

use Illuminate\Database\Seeder;

class MembersOfGroupsTableSeeder extends Seeder {

    public function run() {
        DB::table('members_of_groups')->delete();

        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [1, 1, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [2, 1, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [3, 1, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [4, 1, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [5, 1, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [6, 1, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [7, 1, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [8, 1, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [9, 1, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [10, 1, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [11, 1, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [12, 1, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [13, 1, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [14, 1, 'accepted']);

        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [1, 2, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [2, 2, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [3, 2, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [4, 2, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [15, 2, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [16, 2, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [17, 2, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [18, 2, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [19, 2, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [20, 2, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [21, 2, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [22, 2, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [23, 2, 'accepted']);

        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [1, 3, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [2, 3, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [3, 3, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [4, 3, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [24, 3, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [25, 3, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [26, 3, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [27, 3, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [28, 3, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [29, 3, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [30, 3, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [31, 3, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [32, 3, 'accepted']);

        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [1, 4, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [2, 4, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [3, 4, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [4, 4, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [33, 4, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [34, 4, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [35, 4, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [36, 4, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [6, 4, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [14, 4, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [19, 4, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [20, 4, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [21, 4, 'accepted']);

        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [1, 5, 'accepted']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [2, 5, 'pending']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [3, 5, 'pending']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [4, 5, 'pending']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [35, 5, 'pending']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [36, 5, 'pending']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [12, 5, 'pending']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [13, 5, 'pending']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [14, 5, 'pending']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [15, 5, 'pending']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [26, 5, 'pending']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [27, 5, 'pending']);
        DB::insert('insert into members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)', [21, 5, 'pending']);
    }
}

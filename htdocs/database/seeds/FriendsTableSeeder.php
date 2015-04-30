<?php

use Illuminate\Database\Seeder;

class FriendsTableSeeder extends Seeder {

    public function run() {
        DB::table('friends')->delete();

        DB::insert('insert into friends (id1, id2, status, action_user_id) VALUES (?, ?, ?, ?)',
                    [1, 3, 'declined', 3]);
        DB::insert('insert into friends (id1, id2, status, action_user_id) VALUES (?, ?, ?, ?)',
                    [1, 2, 'accepted', 2]);
        DB::insert('insert into friends (id1, id2, status, action_user_id) VALUES (?, ?, ?, ?)',
                    [1, 4, 'pending', 4]);
    }
}

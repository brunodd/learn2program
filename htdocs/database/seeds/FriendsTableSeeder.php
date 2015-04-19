<?php

use Illuminate\Database\Seeder;

class FriendsTableSeeder extends Seeder {

    public function run() {
        DB::table('friends')->delete();
        /*
        DB::insert('insert into friends (id1, id2) VALUES (?, ?)', [1, 2]);
        DB::insert('insert into friends (id1, id2) VALUES (?, ?)', [1, 3]);
        DB::insert('insert into friends (id1, id2) VALUES (?, ?)', [3, 4]);
        */
    }
}

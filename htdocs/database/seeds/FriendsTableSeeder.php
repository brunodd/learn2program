<?php

use Illuminate\Database\Seeder;
use App\User;

class FriendsTableSeeder extends Seeder {

    public function run() {
        DB::table('friends')->delete();

        DB::insert('insert into friends (id1, id2) VALUES (?, ?)', [1, 2]);
        DB::insert('insert into friends (id1, id2) VALUES (?, ?)', [1, 3]);
        DB::insert('insert into friends (id1, id2) VALUES (?, ?)', [1, 4]);
        DB::insert('insert into friends (id1, id2) VALUES (?, ?)', [2, 3]);
        DB::insert('insert into friends (id1, id2) VALUES (?, ?)', [2, 4]);
        DB::insert('insert into friends (id1, id2) VALUES (?, ?)', [3, 4]);
    }
}

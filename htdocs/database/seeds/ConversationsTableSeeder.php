<?php

use Illuminate\Database\Seeder;

class ConversationsTableSeeder extends Seeder {

    public function run() {
        DB::table('conversations')->delete();
        DB::statement('ALTER TABLE conversations AUTO_INCREMENT=1');


        DB::insert('insert into conversations (userA, userB) VALUES (?, ?)', [1, 2]);
        DB::insert('insert into conversations (userA, userB) VALUES (?, ?)', [1, 3]);
        DB::insert('insert into conversations (userA, userB) VALUES (?, ?)', [1, 4]);
        DB::insert('insert into conversations (userA, userB) VALUES (?, ?)', [2, 3]);
        DB::insert('insert into conversations (userA, userB) VALUES (?, ?)', [3, 4]);
    }
}

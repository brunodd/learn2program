<?php

use Illuminate\Database\Seeder;
use App\Challenge;

class ChallengesTableSeeder extends Seeder {

    public function run() {
        DB::table('challenges')->delete();
        DB::statement('ALTER TABLE challenges AUTO_INCREMENT=1');

        DB::insert('INSERT INTO challenges (userA, userB, exId, winner)
                                VALUES (1, 2, 1, 2)');

        DB::insert('INSERT INTO challenges (userA, userB, exId, winner)
                                VALUES (1, 2, 2, 1)');

        DB::insert('INSERT INTO challenges (userA, userB, exId, winner)
                                VALUES (1, 2, 8, 2)');

        DB::insert('INSERT INTO challenges (userA, userB, exId, winner)
                                VALUES (1, 2, 3, 2)');

        DB::insert('INSERT INTO challenges (userA, userB, exId, winner)
                                VALUES (1, 2, 10, 1)');
    }
}

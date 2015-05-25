<?php

use Illuminate\Database\Seeder;
use App\Answer;

class ExercisesAnswersTableSeeder extends Seeder {

    public function run() {
        DB::table('answers')->delete();
        DB::statement('ALTER TABLE answers AUTO_INCREMENT=1');

        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                                VALUES ("xx", true, 1, 1)');

        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                                VALUES ("xx", true, 2, 1)');

        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                                VALUES ("xx", true, 2, 2)');

        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                                VALUES ("xx", true, 1, 5)');

        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                                VALUES ("xx", true, 1, 3)');

        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                                VALUES ("xx", true, 4, 5)');

        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                                VALUES ("xx", true, 10, 10)');

        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                                VALUES ("xx", true, 2, 3)');

        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                                VALUES ("xx", true, 9, 1)');

        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                                VALUES ("xx", true, 2, 10)');

        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                                VALUES ("xx", true, 1, 7)');
    }
}

<?php

use Illuminate\Database\Seeder;
use App\User;

class ExercisesAnswersTableSeeder extends Seeder {

    public function run() {
        DB::table('exercises_answers')->delete();
        DB::statement('ALTER TABLE exercises_answers AUTO_INCREMENT=1');

    }
}

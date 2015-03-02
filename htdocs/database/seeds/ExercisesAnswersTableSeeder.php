<?php

use Illuminate\Database\Seeder;
use App\User;

class ExercisesAnswersTableSeeder extends Seeder {

    public function run() {
        DB::table('exercises_answers')->delete();

    }
}

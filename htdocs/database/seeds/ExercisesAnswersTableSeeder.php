<?php

use Illuminate\Database\Seeder;

class ExercisesAnswersTableSeeder extends Seeder {

    public function run() {
        DB::table('answers')->delete();
        DB::statement('ALTER TABLE answers AUTO_INCREMENT=1');

    }
}

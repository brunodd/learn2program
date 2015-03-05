<?php

use Illuminate\Database\Seeder;
use App\Exercise;

class ExercisesTableSeeder extends Seeder {

    public function run() {
        DB::table('exercises')->delete();


        Exercise::create(['question' => 'aaa', 'tips' => 'aaa', 'start_code' => '1', 'expected_result' => 'A', 'serieId' => 1]);
        Exercise::create(['question' => 'bbb', 'tips' => 'bbb', 'start_code' => '2', 'expected_result' => 'B', 'serieId' => 2]);
        Exercise::create(['question' => 'ccc', 'tips' => 'ccc', 'start_code' => '3', 'expected_result' => 'C', 'serieId' => 3]);
    }
}

<?php

use Illuminate\Database\Seeder;
use App\User;

class ExercisesTableSeeder extends Seeder {

    public function run() {
        DB::table('exercises')->delete();

    }
}

<?php

use Illuminate\Database\Seeder;
use App\Series;

class SeriesTableSeeder extends Seeder {

    public function run() {
        DB::table('series')->delete();
        DB::statement('ALTER TABLE series AUTO_INCREMENT=1');

        Series::create(['title' => 'Hello world!', 'description' => 'Introduction to python, explanation about print function', 'makerId' => 1, 'tId' => 1]);
        Series::create(['title' => 'Hello turtles!', 'description' => 'Introduction to turtle module', 'makerId' => 2, 'tId' => 2]);
        Series::create(['title' => 'Series example 3', 'description' => 'Description about this series', 'makerId' => 3, 'tId' => 3]);
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Series;

class SeriesTableSeeder extends Seeder {

    public function run() {
        DB::table('series')->delete();
        DB::statement('ALTER TABLE series AUTO_INCREMENT=1');

        Series::create(['title' => 'Chapter 1', 'description' => 'The way of the program', 'makerId' => 1, 'tId' => 1]);
        Series::create(['title' => 'Chapter 2', 'description' => 'Variables, expressions and statements', 'makerId' => 2, 'tId' => 2]);
        Series::create(['title' => 'Chapter 3', 'description' => 'Functions', 'makerId' => 3, 'tId' => 3]);
        Series::create(['title' => 'Chapter 4', 'description' => 'Conditionals', 'makerId' => 4, 'tId' => 4]);
        Series::create(['title' => 'Series 5', 'description' => 'Description about this series', 'makerId' => 1, 'tId' => 5]);
        Series::create(['title' => 'Series 6', 'description' => 'Description about this series', 'makerId' => 2, 'tId' => 6]);
        Series::create(['title' => 'Series 7', 'description' => 'Description about this series', 'makerId' => 3, 'tId' => 7]);
        Series::create(['title' => 'Series 8', 'description' => 'Description about this series', 'makerId' => 4, 'tId' => 8]);
        Series::create(['title' => 'Series 9', 'description' => 'Description about this series', 'makerId' => 1, 'tId' => 9]);
        Series::create(['title' => 'Series 10', 'description' => 'Description about this series', 'makerId' => 1, 'tId' => 10]);
        Series::create(['title' => 'Series 11', 'description' => 'Description about this series', 'makerId' => 1, 'tId' => 11]);
        Series::create(['title' => 'Series 12', 'description' => 'Description about this series', 'makerId' => 1, 'tId' => 12]);
    }
}

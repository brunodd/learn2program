<?php

use Illuminate\Database\Seeder;
use App\Series;

class SeriesTableSeeder extends Seeder {

    public function run() {
        DB::table('series')->delete();
        DB::statement('ALTER TABLE series AUTO_INCREMENT=1');

        Series::create(['title' => 'aa', 'description' => 'aaa', 'makerId' => 1, 'tId' => 1]);
        Series::create(['title' => 'bb', 'description' => 'bbb', 'makerId' => 2, 'tId' => 2]);
        Series::create(['title' => 'cc', 'description' => 'ccc', 'makerId' => 3, 'tId' => 3]);
    }
}

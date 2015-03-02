<?php

use Illuminate\Database\Seeder;
use App\User;

class SeriesTableSeeder extends Seeder {

    public function run() {
        DB::table('series')->delete();

    }
}

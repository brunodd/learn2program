<?php

use Illuminate\Database\Seeder;
use App\User;

class SeriesRatingsTableSeeder extends Seeder {

    public function run() {
        DB::table('users')->delete();

    }
}

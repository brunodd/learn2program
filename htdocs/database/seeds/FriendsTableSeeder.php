<?php

use Illuminate\Database\Seeder;
use App\User;

class FriendsTableSeeder extends Seeder {

    public function run() {
        DB::table('friends')->delete();

    }
}

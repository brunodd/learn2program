<?php

use Illuminate\Database\Seeder;
use App\User;

class GroupsTableSeeder extends Seeder {

    public function run() {
        DB::table('groups')->delete();

    }
}

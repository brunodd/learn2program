<?php

use Illuminate\Database\Seeder;
use App\User;

class MemersOfGroupsTableSeeder extends Seeder {

    public function run() {
        DB::table('members_of_groups')->delete();

    }
}

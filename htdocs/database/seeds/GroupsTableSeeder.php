<?php

use Illuminate\Database\Seeder;
use App\Group;

class GroupsTableSeeder extends Seeder {

    public function run() {
        DB::table('groups')->delete();

        Group::create(['name' => 'a', 'founderId' => 1]);
        Group::create(['name' => 'b', 'founderId' => 2]);
        Group::create(['name' => 'c', 'founderId' => 3]);
    }
}

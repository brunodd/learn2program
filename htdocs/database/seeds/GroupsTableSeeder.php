<?php

use Illuminate\Database\Seeder;
use App\Group;

class GroupsTableSeeder extends Seeder {

    public function run() {
        DB::table('groups')->delete();
        DB::statement('ALTER TABLE groups AUTO_INCREMENT=1');

        Group::create(['name' => 'Group for BINF2', 'founderId' => 3]);
        Group::create(['name' => 'Everyone who loves python', 'founderId' => 1]);
        Group::create(['name' => 'WE WANT C++ !!!', 'founderId' => 2]);
    }
}

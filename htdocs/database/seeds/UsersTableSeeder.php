<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder {

    public function run() {
        // wipe the table clean before populating
        DB::table('users')->delete();

        User::create(['username' => 'armin', 'mail' => 'a@a.a', 'pass' => bcrypt('armin')]);
        User::create(['username' => 'bruno', 'mail' => 'b@b.b', 'pass' => bcrypt('bruno')]);
        User::create(['username' => 'raphael', 'mail' => 'r@r.r', 'pass' => bcrypt('raphael')]);
        User::create(['username' => 'fouad', 'mail' => 'f@f.f', 'pass' => bcrypt('fouad')]);
    }

    public function runn() {
        DB::table('users')->delete();

        $projects = array(
            ['id' => 1, 'username' => 'armin', 'mail' => 'a@a.a', 'pass' => bcrypt('armin')],
            ['id' => 2, 'username' => 'bruno', 'mail' => 'b@b.b', 'pass' => bcrypt('bruno')],
            ['id' => 3, 'username' => 'raphael', 'mail' => 'r@r.r', 'pass' => bcrypt('raphael')],
            ['id' => 3, 'username' => 'fouad', 'mail' => 'f@f.f', 'pass' => bcrypt('fouad')]
        );

        DB::table('projects')->insert($projects);
    }
}

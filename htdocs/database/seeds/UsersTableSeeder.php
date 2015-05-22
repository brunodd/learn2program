<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder {

    public function run() {
        // wipe the table clean before populating
        DB::table('users')->delete();
        DB::statement('ALTER TABLE users AUTO_INCREMENT=1');

        User::create(['username' => 'armin', 'mail' => 'a@a.a', 'pass' => bcrypt('armin'), 'score' => '5',
            'image' => 'user1ProfileImage.jpg', 'info' => 'Armin Halilovic is the driving force.']);
        User::create(['username' => 'bruno', 'mail' => 'b@b.b', 'pass' => bcrypt('bruno'), 'score' => '10',
            'image' => 'user2ProfileImage.jpg', 'info' => 'Bruno De Deken is our main design architect.']);
        User::create(['username' => 'raphael', 'mail' => 'r@r.r', 'pass' => bcrypt('raphael'), 'score' => '0',
            'image' => 'user3ProfileImage.jpg', 'info' => 'Raphael Assa is the database designer.']);
        User::create(['username' => 'fouad', 'mail' => 'f@f.f', 'pass' => bcrypt('fouad'), 'score' => '0', 
            'image' => 'user4ProfileImage.jpg', 'info' => 'Fouad is the graphic designer.']);

        //For each user, create a conversation with themselves

        for ($x = 1; $x < 5; $x++) {
            DB::insert('INSERT INTO conversations VALUE ()');
            $conversationId = \DB::select('SELECT id FROM conversations ORDER BY id DESC LIMIT 1')[0]->id;
            echo $conversationId;
            \DB::insert('INSERT INTO conversations_participants (conversationId, userId) VALUE (?, ?)', [$conversationId, $x]);
        }
    }
    /*
    public function runn() {
        DB::table('users')->delete();

        $projects = array(
            ['id' => 1, 'username' => 'armin', 'mail' => 'a@a.a', 'pass' => bcrypt('armin')],
            ['id' => 2, 'username' => 'bruno', 'mail' => 'b@b.b', 'pass' => bcrypt('bruno')],
            ['id' => 3, 'username' => 'raphael', 'mail' => 'r@r.r', 'pass' => bcrypt('raphael')],
            ['id' => 4, 'username' => 'fouad', 'mail' => 'f@f.f', 'pass' => bcrypt('fouad')]
        );

        DB::table('projects')->insert($projects);
    }*/
}

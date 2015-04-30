<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class NotificationsTableSeeder extends Seeder {

    public function run() {
        DB::table('notifications')->delete();
        DB::statement('ALTER TABLE notifications AUTO_INCREMENT=1');

        DB::insert('insert into notifications (user_id, generator_user_id, type) VALUES (?, ?, ?)',
                    [1, 4, 'friend request']);
        DB::insert('insert into notifications (user_id, generator_user_id, type) VALUES (?, ?, ?)',
                    [1, 2, 'friend request accepted']);
        DB::insert('insert into notifications (user_id, generator_user_id, type) VALUES (?, ?, ?)',
                    [1, 3, 'friend request declined']);
        DB::insert('insert into notifications (user_id, generator_user_id, type, object_id) VALUES (?, ?, ?, ?)',
                    [1, -1, 'series updated', 1]);
        DB::insert('insert into notifications (user_id, generator_user_id, type, object_id) VALUES (?, ?, ?, ?)',
                    [1, -1, 'exercise referenced', 1]);
        DB::insert('insert into notifications (user_id, generator_user_id, type, object_id) VALUES (?, ?, ?, ?)',
                    [1, -1, 'exercise copied', 1]);
        DB::insert('insert into notifications (user_id, generator_user_id, type, object_id) VALUES (?, ?, ?, ?)',
                    [1, 4, 'exercise completed', 1]);
    }

}
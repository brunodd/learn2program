<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class NotificationsTableSeeder extends Seeder {

    public function run() {
        DB::table('notifications')->delete();
        DB::statement('ALTER TABLE notifications AUTO_INCREMENT=1');

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
        DB::insert('insert into notifications (user_id, generator_user_id, type, object_id) VALUES (?, ?, ?, ?)',
            [1, 4, 'series completed', 1]);
        DB::insert('insert into notifications (user_id, generator_user_id, type, object_id) VALUES (?, ?, ?, ?)',
            [1, 2, 'challenged', 1]);
        DB::insert('insert into notifications (user_id, generator_user_id, type, object_id) VALUES (?, ?, ?, ?)',
            [1, -1, 'group request accepted', 1]);
        DB::insert('insert into notifications (user_id, generator_user_id, type, object_id) VALUES (?, ?, ?, ?)',
            [1, -1, 'group request declined', 1]);
        DB::insert('insert into notifications (user_id, generator_user_id, type, object_id) VALUES (?, ?, ?, ?)',
            [1, 4, 'join group request', 1]);
        DB::insert('insert into notifications (user_id, generator_user_id, type, object_id) VALUES (?, ?, ?, ?)',
            [1, 3, 'challenge beaten', 1]);
        DB::insert('insert into notifications (user_id, generator_user_id, type) VALUES (?, ?, ?)',
            [1, 35, 'friend request']);
        DB::insert('insert into notifications (user_id, generator_user_id, type) VALUES (?, ?, ?)',
            [1, 36, 'friend request accepted']);
    }

}
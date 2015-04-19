<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class NotificationsTableSeeder extends Seeder {

    public function run() {
        DB::table('notifications')->delete();
        DB::statement('ALTER TABLE notifications AUTO_INCREMENT=1');

        //DB::insert('insert into notifications (userId, type, message, object_id) VALUES (?, ?)', [1, 2]);
        /*DB::insert('insert into notifications (userId, message) VALUES (?, ?)', [1, 'a']);
        DB::insert('insert into notifications (userId, message) VALUES (?, ?)', [1, 'b']);
        DB::insert('insert into notifications (userId, message) VALUES (?, ?)', [1, 'c']);
        DB::insert('insert into notifications (userId, message) VALUES (?, ?)', [1, 'd']);*/
    }

}
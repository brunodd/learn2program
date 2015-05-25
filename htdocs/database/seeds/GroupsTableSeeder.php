<?php

use Illuminate\Database\Seeder;
use App\Group;

class GroupsTableSeeder extends Seeder {

    public function run() {
        DB::table('groups')->delete();
        DB::statement('ALTER TABLE groups AUTO_INCREMENT=1');

        //Create a conversation for each group, for the chat on their page.
        DB::insert('INSERT INTO conversations VALUE ()');
        $conversationId = \DB::select('SELECT id FROM conversations ORDER BY id DESC LIMIT 1')[0]->id;
        DB::insert('INSERT INTO groups (name, founderId, conversationId, private) VALUES (?, ?, ?, ?)',
                                        ["Group for BINF2", 3, $conversationId, 0]);

        DB::insert('INSERT INTO conversations VALUE ()');
        $conversationId = \DB::select('SELECT id FROM conversations ORDER BY id DESC LIMIT 1')[0]->id;
        DB::insert('INSERT INTO groups (name, founderId, conversationId, private) VALUES (?, ?, ?, ?)',
                                        ["Everyone who loves python", 1, $conversationId, 0]);

        DB::insert('INSERT INTO conversations VALUE ()');
        $conversationId = \DB::select('SELECT id FROM conversations ORDER BY id DESC LIMIT 1')[0]->id;
        DB::insert('INSERT INTO groups (name, founderId, conversationId, private) VALUES (?, ?, ?, ?)',
                                        ["WE LOVE C++ !!!", 2, $conversationId, 0]);

        DB::insert('INSERT INTO conversations VALUE ()');
        $conversationId = \DB::select('SELECT id FROM conversations ORDER BY id DESC LIMIT 1')[0]->id;
        DB::insert('INSERT INTO groups (name, founderId, conversationId, private) VALUES (?, ?, ?, ?)',
                                        ["Join this group for help with chapter 3", 1, $conversationId, 0]);

        DB::insert('INSERT INTO conversations VALUE ()');
        $conversationId = \DB::select('SELECT id FROM conversations ORDER BY id DESC LIMIT 1')[0]->id;
        DB::insert('INSERT INTO groups (name, founderId, conversationId, private) VALUES (?, ?, ?, ?)',
                                        ["This is a private group", 1, $conversationId, 1]);
    }
}

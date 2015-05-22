<?php

use Illuminate\Database\Seeder;

class MessagesTableSeeder extends Seeder {

    public function run() {
        DB::table('messages')->delete();
        DB::statement('ALTER TABLE messages AUTO_INCREMENT=1');

        //First, create a conversation between the users
        DB::insert('INSERT INTO conversations VALUE ()');
        $conversationId = \DB::select('SELECT id FROM conversations ORDER BY id DESC LIMIT 1')[0]->id;
        //Add the two users to the conversation.
        DB::insert('INSERT INTO conversations_participants (conversationId, userId) VALUES (?, 1)', [$conversationId]);
        DB::insert('INSERT INTO conversations_participants (conversationId, userId) VALUES (?, 2)', [$conversationId]);

        DB::insert('INSERT INTO messages (conversationId, message, author, is_read) VALUES (?, ?, ?, ?)',
                    [$conversationId, 'hello', 1, 1]);
        DB::insert('INSERT INTO messages (conversationId, message, author, is_read) VALUES (?, ?, ?, ?)',
                    [$conversationId, 'world', 1, 1]);
        DB::insert('INSERT INTO messages (conversationId, message, author, is_read) VALUES (?, ?, ?, ?)',
                    [$conversationId, 'how are you', 1, 1]);
        DB::insert('INSERT INTO messages (conversationId, message, author, is_read) VALUES (?, ?, ?, ?)',
                    [$conversationId, 'can you help me?', 1, 1]);
        DB::insert('INSERT INTO messages (conversationId, message, author, is_read) VALUES (?, ?, ?, ?)',
                    [$conversationId, 'i don\'t understand x', 1, 1]);
        DB::insert('INSERT INTO messages (conversationId, message, author, is_read) VALUES (?, ?, ?, ?)',
                    [$conversationId, 'sure', 2, 1]);
        sleep(1);
        DB::insert('INSERT INTO messages (conversationId, message, author, is_read) VALUES (?, ?, ?, ?)',
                    [$conversationId, 'what don\'t you understand about it?', 2, 1]);



        DB::insert('INSERT INTO conversations VALUE ()');
        $conversationId = \DB::select('SELECT id FROM conversations ORDER BY id DESC LIMIT 1')[0]->id;
        DB::insert('INSERT INTO conversations_participants (conversationId, userId) VALUES (?, 1)', [$conversationId]);
        DB::insert('INSERT INTO conversations_participants (conversationId, userId) VALUES (?, 3)', [$conversationId]);

        DB::insert('INSERT INTO messages (conversationId, message, author, is_read) VALUES (?, ?, ?, ?)',
                    [$conversationId, 'hello my friend', 1, 1]);
        DB::insert('INSERT INTO messages (conversationId, message, author, is_read) VALUES (?, ?, ?, ?)',
                    [$conversationId, 'i\'m not your friend, buddy', 3, 1]);
        DB::insert('INSERT INTO messages (conversationId, message, author, is_read) VALUES (?, ?, ?, ?)',
                    [$conversationId, 'i\'m not your buddy, dude', 1, 1]);
        DB::insert('INSERT INTO messages (conversationId, message, author, is_read) VALUES (?, ?, ?, ?)',
                    [$conversationId, 'i\'m not your  dude, pal', 3, 1]);
        DB::insert('INSERT INTO messages (conversationId, message, author, is_read) VALUES (?, ?, ?, ?)',
                    [$conversationId, 'i\'m not your pal, man', 1, 1]);
        sleep(1);
        DB::insert('INSERT INTO messages (conversationId, message, author, is_read) VALUES (?, ?, ?, ?)',
                    [$conversationId, 'i\'m not your man, sir', 3, 1]);



        DB::insert('INSERT INTO conversations VALUE ()');
        $conversationId = \DB::select('SELECT id FROM conversations ORDER BY id DESC LIMIT 1')[0]->id;
        DB::insert('INSERT INTO conversations_participants (conversationId, userId) VALUES (?, 2)', [$conversationId]);
        DB::insert('INSERT INTO conversations_participants (conversationId, userId) VALUES (?, 3)', [$conversationId]);

        DB::insert('INSERT INTO messages (conversationId, message, author, is_read) VALUES (?, ?, ?, ?)',
                    [$conversationId, 'Lorem ipsum', 2, 1]);
        DB::insert('INSERT INTO messages (conversationId, message, author, is_read) VALUES (?, ?, ?, ?)',
                    [$conversationId, 'Lorem ipsum dolor congue lobortis cubilia rutrum condimentum diam velit habitasse tortor facilisis gravida enim vestibulum duis leo ultricies aliquet dolor.', 3, 1]);
        DB::insert('INSERT INTO messages (conversationId, message, author, is_read) VALUES (?, ?, ?, ?)',
                    [$conversationId, 'Fames molestie vivamus euismod etiam eget ad quisque eget ac mattis, congue felis tellus enim posuere potenti ac pellentesque eleifend nisi, litora nibh aenean aliquam aenean sed neque dictumst eros.', 2, 1]);
        DB::insert('INSERT INTO messages (conversationId, message, author, is_read) VALUES (?, ?, ?, ?)',
                    [$conversationId, 'Tempus curabitur non ullamcorper elementum eleifend at conubia commodo, molestie placerat varius suspendisse fames sagittis maecenas magna, varius luctus bibendum inceptos luctus maecenas libero, ac ipsum accumsan eu varius feugiat vitae diam ac neque cursus.', 3, 1]);
        DB::insert('INSERT INTO messages (conversationId, message, author, is_read) VALUES (?, ?, ?, ?)',
                    [$conversationId, 'Semper hac porta vel interdum congue integer potenti egestas, nibh potenti ultrices hendrerit sociosqu eleifend dui, pretium suscipit urna fermentum quisque accumsan nibh mollis lacus diam primis dapibus aenean vulputate.', 2, 1]);
        DB::insert('INSERT INTO messages (conversationId, message, author, is_read) VALUES (?, ?, ?, ?)',
                    [$conversationId, 'Convallis velit vivamus quisque lobortis scelerisque netus consectetur elementum primis inceptos proin volutpat ullamcorper platea hac commodo a cras cubilia porttitor.', 3, 1]);
        DB::insert('INSERT INTO messages (conversationId, message, author, is_read) VALUES (?, ?, ?, ?)',
                    [$conversationId, 'Habitant turpis pulvinar ac sollicitudin ultricies aenean, nunc mi at sollicitudin potenti eget, morbi quam egestas velit erat.', 2, 1]);
        DB::insert('INSERT INTO messages (conversationId, message, author, is_read) VALUES (?, ?, ?, ?)',
                    [$conversationId, 'Platea sem mattis venenatis eget lorem accumsan consectetur diam, augue dui id netus sem tortor praesent, malesuada ornare litora massa class vehicula sit ut ullamcorper leo ut ac vehicula litora fringilla placerat dui.', 3, 1]);
        DB::insert('INSERT INTO messages (conversationId, message, author, is_read) VALUES (?, ?, ?, ?)',
                    [$conversationId, 'Nunc pharetra tristique ad mattis consectetur pretium maecenas, gravida velit hac justo integer lobortis pulvinar, quisque feugiat ac cras tristique lorem.', 2, 1]);
        sleep(1);
        DB::insert('INSERT INTO messages (conversationId, message, author, is_read) VALUES (?, ?, ?, ?)',
                    [$conversationId, 'Lorem ipsum', 3, 1]);


    }
}

/*
DB::insert('INSERT INTO conversations VALUE () (userA, userB) VALUES (?, ?)', [1, 2]);
DB::insert('INSERT INTO conversations VALUE () (userA, userB) VALUES (?, ?)', [1, 3]);
DB::insert('INSERT INTO conversations VALUE () (userA, userB) VALUES (?, ?)', [1, 4]);
DB::insert('INSERT INTO conversations VALUE () (userA, userB) VALUES (?, ?)', [2, 3]);
DB::insert('INSERT INTO conversations VALUE () (userA, userB) VALUES (?, ?)', [3, 4]);


CREATE TABLE messages (
    conversationId INT NOT NULL,
    message VARCHAR(512) NOT NULL,
    author VARCHAR(50) NOT NULL,
    date TIMESTAMP,
    FOREIGN KEY (conversationId) REFERENCES conversations(id) ON DELETE CASCADE
);

*/
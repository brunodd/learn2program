<?php

use Illuminate\Database\Seeder;

class MessagesTableSeeder extends Seeder {

    public function run() {
        DB::table('messages')->delete();

        DB::insert('insert into messages (conversationId, message, author, is_read) VALUES (?, ?, ?, ?)',
                    [1, 'hello', 1, 1]);
        DB::insert('insert into messages (conversationId, message, author, is_read) VALUES (?, ?, ?, ?)',
                    [1, 'world', 1, 1]);
        DB::insert('insert into messages (conversationId, message, author, is_read) VALUES (?, ?, ?, ?)',
                    [1, 'how are you', 1, 1]);
        DB::insert('insert into messages (conversationId, message, author, is_read) VALUES (?, ?, ?, ?)',
                    [1, 'can you help me?', 1, 1]);
        DB::insert('insert into messages (conversationId, message, author, is_read) VALUES (?, ?, ?, ?)',
                    [1, 'i don\'t understand x', 1, 1]);
        DB::insert('insert into messages (conversationId, message, author, is_read) VALUES (?, ?, ?, ?)',
                    [1, 'sure', 2, 1]);
        sleep(1);
        DB::insert('insert into messages (conversationId, message, author) VALUES (?, ?, ?)',
                    [1, 'what don\'t you understand about it?', 2]);

        DB::insert('insert into messages (conversationId, message, author) VALUES (?, ?, ?)',
                    [2, 'hello my friend', 1]);
        DB::insert('insert into messages (conversationId, message, author) VALUES (?, ?, ?)',
                    [2, 'i\'m not your friend, buddy', 3]);
        DB::insert('insert into messages (conversationId, message, author) VALUES (?, ?, ?)',
                    [2, 'i\'m not your buddy, dude', 1]);
        DB::insert('insert into messages (conversationId, message, author) VALUES (?, ?, ?)',
                    [2, 'i\'m not your  dude, pal', 3]);
        DB::insert('insert into messages (conversationId, message, author) VALUES (?, ?, ?)',
                    [2, 'i\'m not your pal, man', 1]);
        sleep(1);
        DB::insert('insert into messages (conversationId, message, author) VALUES (?, ?, ?)',
                    [2, 'i\'m not your man, sir', 3]);

        DB::insert('insert into messages (conversationId, message, author) VALUES (?, ?, ?)',
                    [4, 'Lorem ipsum', 2]);
        DB::insert('insert into messages (conversationId, message, author) VALUES (?, ?, ?)',
                    [4, 'Lorem ipsum dolor congue lobortis cubilia rutrum condimentum diam velit habitasse tortor facilisis gravida enim vestibulum duis leo ultricies aliquet dolor.', 3]);
        DB::insert('insert into messages (conversationId, message, author) VALUES (?, ?, ?)',
                    [4, 'Fames molestie vivamus euismod etiam eget ad quisque eget ac mattis, congue felis tellus enim posuere potenti ac pellentesque eleifend nisi, litora nibh aenean aliquam aenean sed neque dictumst eros.', 2]);
        DB::insert('insert into messages (conversationId, message, author) VALUES (?, ?, ?)',
                    [4, 'Tempus curabitur non ullamcorper elementum eleifend at conubia commodo, molestie placerat varius suspendisse fames sagittis maecenas magna, varius luctus bibendum inceptos luctus maecenas libero, ac ipsum accumsan eu varius feugiat vitae diam ac neque cursus.', 3]);
        DB::insert('insert into messages (conversationId, message, author) VALUES (?, ?, ?)',
                    [4, 'Semper hac porta vel interdum congue integer potenti egestas, nibh potenti ultrices hendrerit sociosqu eleifend dui, pretium suscipit urna fermentum quisque accumsan nibh mollis lacus diam primis dapibus aenean vulputate.', 2]);
        DB::insert('insert into messages (conversationId, message, author) VALUES (?, ?, ?)',
                    [4, 'Convallis velit vivamus quisque lobortis scelerisque netus consectetur elementum primis inceptos proin volutpat ullamcorper platea hac commodo a cras cubilia porttitor.', 3]);
        DB::insert('insert into messages (conversationId, message, author) VALUES (?, ?, ?)',
                    [4, 'Habitant turpis pulvinar ac sollicitudin ultricies aenean, nunc mi at sollicitudin potenti eget, morbi quam egestas velit erat.', 2]);
        DB::insert('insert into messages (conversationId, message, author) VALUES (?, ?, ?)',
                    [4, 'Platea sem mattis venenatis eget lorem accumsan consectetur diam, augue dui id netus sem tortor praesent, malesuada ornare litora massa class vehicula sit ut ullamcorper leo ut ac vehicula litora fringilla placerat dui.', 3]);
        DB::insert('insert into messages (conversationId, message, author) VALUES (?, ?, ?)',
                    [4, 'Nunc pharetra tristique ad mattis consectetur pretium maecenas, gravida velit hac justo integer lobortis pulvinar, quisque feugiat ac cras tristique lorem.', 2]);
        sleep(1);
        DB::insert('insert into messages (conversationId, message, author) VALUES (?, ?, ?)',
                    [4, 'Lorem ipsum', 3]);


    }
}

/*
DB::insert('insert into conversations (userA, userB) VALUES (?, ?)', [1, 2]);
DB::insert('insert into conversations (userA, userB) VALUES (?, ?)', [1, 3]);
DB::insert('insert into conversations (userA, userB) VALUES (?, ?)', [1, 4]);
DB::insert('insert into conversations (userA, userB) VALUES (?, ?)', [2, 3]);
DB::insert('insert into conversations (userA, userB) VALUES (?, ?)', [3, 4]);


CREATE TABLE messages (
    conversationId INT NOT NULL,
    message VARCHAR(512) NOT NULL,
    author VARCHAR(50) NOT NULL,
    date TIMESTAMP,
    FOREIGN KEY (conversationId) REFERENCES conversations(id) ON DELETE CASCADE
);

*/
<?php

use Illuminate\Database\Seeder;

class ConversationsTableSeeder extends Seeder {

    public function run() {
        DB::table('conversations')->delete();
        DB::statement('ALTER TABLE users AUTO_INCREMENT=1');


    }
}

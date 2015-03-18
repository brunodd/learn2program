<?php

use Illuminate\Database\Seeder;

class MessagesTableSeeder extends Seeder {

    public function run() {
        DB::table('messages')->delete();

    }
}

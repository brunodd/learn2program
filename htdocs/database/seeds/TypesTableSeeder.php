<?php

use Illuminate\Database\Seeder;
use App\Type;

class TypesTableSeeder extends Seeder {

    public function run() {
        DB::table('types')->delete();
        DB::statement('ALTER TABLE types AUTO_INCREMENT=1');
/*
        Type::create(['Subject' => 'aaaa', 'Difficulty' => 'easy']);
        Type::create(['Subject' => 'bbbb', 'Difficulty' => 'hard']);
        Type::create(['Subject' => 'cccc', 'Difficulty' => 'insane']);
*/
        Type::create(['subject' => 'aaaa', 'difficulty' => 1]);
        Type::create(['subject' => 'bbbb', 'difficulty' => 2]);
        Type::create(['subject' => 'cccc', 'ifficulty' => 3]);
    }
}

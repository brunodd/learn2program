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
        Type::create(['subject' => 'aaa', 'difficulty' => 'easy']);
        Type::create(['subject' => 'bbb', 'difficulty' => 'easy']);
        Type::create(['subject' => 'ccc', 'difficulty' => 'easy']);
        Type::create(['subject' => 'aaa', 'difficulty' => 'intermediate']);
        Type::create(['subject' => 'bbb', 'difficulty' => 'intermediate']);
        Type::create(['subject' => 'ccc', 'difficulty' => 'intermediate']);
        Type::create(['subject' => 'aaa', 'difficulty' => 'hard']);
        Type::create(['subject' => 'bbb', 'difficulty' => 'hard']);
        Type::create(['subject' => 'ccc', 'difficulty' => 'hard']);
        Type::create(['subject' => 'aaa', 'difficulty' => 'insane']);
        Type::create(['subject' => 'bbb', 'difficulty' => 'insane']);
        Type::create(['subject' => 'ccc', 'difficulty' => 'insane']);
    }
}

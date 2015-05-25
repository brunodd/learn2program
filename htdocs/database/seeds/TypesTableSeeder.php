<?php

use Illuminate\Database\Seeder;
use App\Type;

class TypesTableSeeder extends Seeder {

    public function run() {
        DB::table('types')->delete();
        DB::statement('ALTER TABLE types AUTO_INCREMENT=1');

        DB::insert('insert into types (subject, difficulty) value (?, ?)', [
            'aaa',
            'easy'
        ]);

        DB::insert('insert into types (subject, difficulty) value (?, ?)', [
            'bbb',
            'easy'
        ]);

        DB::insert('insert into types (subject, difficulty) value (?, ?)', [
            'ccc',
            'easy'
        ]);

        DB::insert('insert into types (subject, difficulty) value (?, ?)', [
            'aaa',
            'intermediate'
        ]);

        DB::insert('insert into types (subject, difficulty) value (?, ?)', [
            'bbb',
            'intermediate'
        ]);

        DB::insert('insert into types (subject, difficulty) value (?, ?)', [
            'ccc',
            'intermediate'
        ]);

        DB::insert('insert into types (subject, difficulty) value (?, ?)', [
            'aaa',
            'hard'
        ]);

        DB::insert('insert into types (subject, difficulty) value (?, ?)', [
            'bbb',
            'hard'
        ]);

        DB::insert('insert into types (subject, difficulty) value (?, ?)', [
            'ccc',
            'hard'
        ]);

        DB::insert('insert into types (subject, difficulty) value (?, ?)', [
            'aaa',
            'insane'
        ]);

        DB::insert('insert into types (subject, difficulty) value (?, ?)', [
            'bbb',
            'insane'
        ]);

        DB::insert('insert into types (subject, difficulty) value (?, ?)', [
            'ccc',
            'insane'
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Series;

class SeriesTableSeeder extends Seeder {

    public function run() {
        DB::table('series')->delete();
        DB::statement('ALTER TABLE series AUTO_INCREMENT=1');

        DB::insert('insert into series (title, description, makerId, tId) value (?, ?, ?, ?)', [
            'Chapter 1',
            'The way of the program',
            1,
            1
        ]);

        DB::insert('insert into series (title, description, makerId, tId) value (?, ?, ?, ?)', [
            'Chapter 2',
            'Variables, expressions and statements',
            2,
            2
        ]);

        DB::insert('insert into series (title, description, makerId, tId) value (?, ?, ?, ?)', [
            'Chapter 3',
            'Functions',
            3,
            3
        ]);

        DB::insert('insert into series (title, description, makerId, tId) value (?, ?, ?, ?)', [
            'Chapter 4',
            'Conditionals',
            4,
            4
        ]);

        DB::insert('insert into series (title, description, makerId, tId) value (?, ?, ?, ?)', [
            'Chapter 5',
            'Turtles',
            2,
            5
        ]);

        DB::insert('insert into series (title, description, makerId, tId) value (?, ?, ?, ?)', [
            'Series 6',
            'Description about this series',
            2,
            6
        ]);

        DB::insert('insert into series (title, description, makerId, tId) value (?, ?, ?, ?)', [
            'Series 7',
            'Description about this series',
            3,
            7
        ]);

        DB::insert('insert into series (title, description, makerId, tId) value (?, ?, ?, ?)', [
            'Series 8',
            'Description about this series',
            4,
            8
        ]);

        DB::insert('insert into series (title, description, makerId, tId) value (?, ?, ?, ?)', [
            'Series 9',
            'Description about this series',
            1,
            9
        ]);

        DB::insert('insert into series (title, description, makerId, tId) value (?, ?, ?, ?)', [
            'Series 10',
            'Description about this series',
            1,
            10
        ]);

        DB::insert('insert into series (title, description, makerId, tId) value (?, ?, ?, ?)', [
            'Series 11',
            'Description about this series',
            1,
            11
        ]);

        DB::insert('insert into series (title, description, makerId, tId) value (?, ?, ?, ?)', [
            'Series 12',
            'Description about this series',
            1,
            12
        ]);
    }
}

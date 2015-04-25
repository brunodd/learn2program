<?php

use Illuminate\Database\Seeder;

class ExercisesInSeriesTableSeeder extends Seeder {

    public function run() {
        DB::table('exercises_in_series')->delete();

        DB::insert('insert into exercises_in_series (exId , seriesId, ex_index) VALUES (?, ?, ?)', [1, 1, 1]);
        DB::insert('insert into exercises_in_series (exId , seriesId, ex_index) VALUES (?, ?, ?)', [2, 1, 2]);
        DB::insert('insert into exercises_in_series (exId , seriesId, ex_index) VALUES (?, ?, ?)', [3, 1, 3]);
        DB::insert('insert into exercises_in_series (exId , seriesId, ex_index) VALUES (?, ?, ?)', [1, 2, 1]);
        DB::insert('insert into exercises_in_series (exId , seriesId, ex_index) VALUES (?, ?, ?)', [2, 3, 1]);


    }
}

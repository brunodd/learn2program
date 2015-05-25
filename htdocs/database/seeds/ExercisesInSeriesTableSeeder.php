<?php

use Illuminate\Database\Seeder;

class ExercisesInSeriesTableSeeder extends Seeder {

    public function run() {
        DB::table('exercises_in_series')->delete();

        DB::insert('insert into exercises_in_series (exId , seriesId, ex_index) VALUES (?, ?, ?)', [1, 1, 1]);
        DB::insert('insert into exercises_in_series (exId , seriesId, ex_index) VALUES (?, ?, ?)', [2, 1, 2]);
        DB::insert('insert into exercises_in_series (exId , seriesId, ex_index) VALUES (?, ?, ?)', [3, 2, 1]);
        DB::insert('insert into exercises_in_series (exId , seriesId, ex_index) VALUES (?, ?, ?)', [4, 2, 2]);
        DB::insert('insert into exercises_in_series (exId , seriesId, ex_index) VALUES (?, ?, ?)', [2, 2, 3]);
        DB::insert('insert into exercises_in_series (exId , seriesId, ex_index) VALUES (?, ?, ?)', [5, 3, 1]);
        DB::insert('insert into exercises_in_series (exId , seriesId, ex_index) VALUES (?, ?, ?)', [6, 3, 2]);
        DB::insert('insert into exercises_in_series (exId , seriesId, ex_index) VALUES (?, ?, ?)', [7, 4, 1]);
        DB::insert('insert into exercises_in_series (exId , seriesId, ex_index) VALUES (?, ?, ?)', [8, 4, 2]);
        DB::insert('insert into exercises_in_series (exId , seriesId, ex_index) VALUES (?, ?, ?)', [9, 4, 3]);
        DB::insert('insert into exercises_in_series (exId , seriesId, ex_index) VALUES (?, ?, ?)', [10, 5, 1]);
        DB::insert('insert into exercises_in_series (exId , seriesId, ex_index) VALUES (?, ?, ?)', [11, 3, 3]);
        DB::insert('insert into exercises_in_series (exId , seriesId, ex_index) VALUES (?, ?, ?)', [12, 3, 4]);
        DB::insert('insert into exercises_in_series (exId , seriesId, ex_index) VALUES (?, ?, ?)', [13, 3, 5]);
    }
}

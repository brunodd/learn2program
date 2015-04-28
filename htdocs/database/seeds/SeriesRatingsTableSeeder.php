<?php

use Illuminate\Database\Seeder;

class SeriesRatingsTableSeeder extends Seeder {

    public function run() {
        DB::table('series_ratings')->delete();
/*
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [1, 1, 1]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [3, 1, 2]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [4, 1, 3]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [3, 2, 1]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [3, 2, 2]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [4, 2, 3]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [1, 3, 1]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [5, 3, 2]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [1, 3, 3]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [2, 4, 1]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [5, 4, 2]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [4, 4, 3]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [4, 4, 8]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [5, 4, 7]);*/
    }
}

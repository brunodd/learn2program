<?php

use Illuminate\Database\Seeder;
use App\User;

class SeriesRatingsTableSeeder extends Seeder {

    public function run() {
        DB::table('series_ratings')->delete();

        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [1, 1, 1]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [3, 1, 2]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [5, 1, 3]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [5, 2, 1]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [3, 2, 2]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [1, 2, 3]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [1, 3, 1]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [3, 3, 2]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [5, 3, 3]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [5, 4, 1]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [3, 4, 2]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [1, 4, 3]);
    }
}

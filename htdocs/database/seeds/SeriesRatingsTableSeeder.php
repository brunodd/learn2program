<?php

use Illuminate\Database\Seeder;

class SeriesRatingsTableSeeder extends Seeder {

    public function run() {
        DB::table('series_ratings')->delete();

        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [1, 1, 1]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [3, 1, 2]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [4, 1, 3]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [3, 1, 4]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [4, 1, 5]);

        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [2, 2, 1]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [1, 2, 2]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [5, 2, 3]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [4, 2, 4]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [2, 2, 5]);

        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [2, 3, 1]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [4, 3, 2]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [5, 3, 3]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [3, 3, 4]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [1, 3, 5]);

        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [2, 4, 1]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [5, 4, 2]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [4, 4, 3]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [4, 4, 4]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [4, 4, 5]);

        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [4, 5, 1]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [4, 5, 2]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [4, 5, 3]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [4, 5, 4]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [4, 5, 5]);

        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [3, 6, 1]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [3, 6, 2]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [3, 6, 3]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [3, 6, 4]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [3, 6, 5]);

        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [2, 7, 1]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [2, 7, 2]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [2, 7, 3]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [1, 7, 4]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [1, 7, 5]);

        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [2, 8, 1]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [2, 8, 2]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [2, 8, 3]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [5, 8, 4]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [5, 8, 5]);

        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [4, 9, 1]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [4, 9, 2]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [4, 9, 3]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [4, 9, 4]);
        DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [4, 9, 5]);
    }
}

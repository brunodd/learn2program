<?php

function returnSeriesSameMaker($serie) {
    return DB::select('SELECT *
                       FROM series
                       WHERE series.title != ? and makerId = ?',
                       [$serie->title, $serie->makerId]);
}

function returnSeriesSameDifficulty($serie) {
    $difficulty = DB::select('SELECT *
                              FROM types
                              WHERE types.id = ?', [$serie->tId]);

    return DB::select(' SELECT *
                        FROM series, types
                        WHERE series.title != ? and series.tId = types.id and types.difficulty = ?',
                        [$serie->title, $difficulty[0]->difficulty]);
}

function returnSeriesSameRating($serie) {
    $rating = DB::select('SELECT rating
                          FROM series, series_ratings
                          WHERE series.id = series_ratings.seriesId and series.id = ?', [$serie->id]);
    return DB::select( 'SELECT *
                        FROM series, series_ratings 
                        WHERE series.id = series_ratings.seriesId and series_ratings.rating = ?',[$rating[0]]);
}
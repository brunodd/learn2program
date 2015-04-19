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
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
                        WHERE series.title != ? 
                        and series.tId = types.id 
                        and types.difficulty = ?',
                        [$serie->title, $difficulty[0]->difficulty]);
}

function returnSeriesSameRating($serie) {
    $rating = DB::select('SELECT *
                          FROM series, series_ratings
                          WHERE series.id = series_ratings.seriesId and series.id = ?', [$serie->id]);
    
    if (!empty($rating)) {
        return DB::select( 'SELECT *
                            FROM series, series_ratings 
                            WHERE series.id = series_ratings.seriesId 
                            and series.id != ?
                            and series_ratings.rating = ? ',
                            [$serie->id, $rating[0]->rating]); 
    } 
    return DB::select('SELECT *
                       FROM series
                       WHERE series.id != series.id');
  
}
function returnSeriesRandom($serie) {
    $result = DB::select(' SELECT *
                        FROM series
                        WHERE series.id != ?
                        ORDER BY RAND()
                        limit 2',
                        [$serie->id]);
    if(empty($result)) {
        return returnSeriesRandom($serie);
    }
    if(isEmptySeries($result[0])) {
        return returnSeriesRandom($serie);
    }
    return $result;
}

function isEmptySeries($serie) {
    $variable = DB::select('SELECT * 
                            FROM series, exercises, exercises_in_series
                            WHERE series.id = exercises_in_series.seriesId
                            and exercises.id = exercises_in_series.exId
                            and series.id = ?', [$serie->id]);
    if (!empty($variable)) {
            return false;
    }
    return true; 

}

function mergeSeries($array1, $array2) {
    $boolean = false;
    foreach ($array2 as $item2) {
        foreach ($array1 as $item1) {
            if($item1->title == $item2->title and $item1->tId == $item2->tId) {
              $boolean = true;
              break;
            }
        }
        if(!$boolean) {
          array_push($array1, $item2);
          $boolean = false;
        }     
    }
    return $array1;
}

function returnRecommendations($serie) {
  $sameMaker = returnSeriesSameMaker($serie);
  $sameDifficulty = returnSeriesSameDifficulty($serie);
  $sameRating = returnSeriesSameRating($serie);

  $result = array();

  $result = mergeSeries($result, $sameMaker);
  $result = mergeSeries($result, $sameRating);
  $result = mergeSeries($result, $sameDifficulty);
  //= $sameDifficulty + $sameMaker + $sameRating;

  return $result;
}
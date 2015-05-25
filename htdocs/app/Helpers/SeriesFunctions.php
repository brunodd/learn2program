<?php

function storeSerie($serie)
{
    DB::insert('insert into series (title, description, makerId, tId) VALUES (?, ?, ?, ?)', [$serie->title, $serie->description, $serie->makerId, $serie->tId]);
}

function loadSerieWithId($id)
{
    return DB::select('select * from series where id = ?', [$id]);
}

function loadSerieWithIdOrTitle($id)
{
    return DB::select('select * from series where id = ? or title = ?', [$id, $id]);
}

function loadSerieWithIdOrTitleAndExercise($sId, $eId)
{
    return DB::select('select * from series where (id = ? or title = ?)
                                            and id in (select seriesId as id
                                                        from exercises_in_series
                                                        where exId = ?)', [$sId, $sId, $eId]);
}

function loadSerie($title, $tId)
{
    return DB::select('select * from series where title = ? and tId = ?', [$title, $tId]);
}

function loadAllSeries()
{
    return DB::select('select * from series');
}

function loadAllDistinctSeries()
{
    return DB::select('select * from series group by title');
}

function updateSerie($id, $serie, $typeId)
{
    DB::statement('update series SET title = ?, description = ?, tId = ? where id = ?',[$serie->title, $serie->description, $typeId, $id]);
}

function isMakerOfSeries($sId, $mId)
{
    //$serieID = loadSerieWithIdOrTitle($sId)[0]->id;
    if ( !empty(DB::select('select * from series where (id = ? or title = ?) and makerId = ?',[$sId, $sId, $mId])) )
    {
        return true;
    }
    else
    {
        return false;
    }
}

function SerieContainsExercises($sId)
{
    if ( !empty(DB::select('select * from exercises, (select * from exercises_in_series where seriesId = ?) eps
                where exercises.id = eps.exId', [$sId])) )
        return true;
    else return false;
}

/*function SerieContainsExercises2($sId)
{
    $seriesID = loadSerieWithIdOrTitle($sId);
    if ( !empty(DB::select('select * from exercises where seriesId = ?',[$seriesID[0]->id])) ) return true;
    else return false;
}*/

function loadSeriesSortedByNameASC()
{
    return DB::select('select * from series group by title order by title ASC');
}

function MySeriesSortASC($avgs) {
    $sorted = [];
    for( $i = 0; $i < count($avgs); $i++ ) {
        if( $avgs[$i][1] == "Not rated yet" ) {
            array_push($sorted, [$avgs[$i][0], $avgs[$i][1]]);
            array_splice($avgs, $i, 1);
            $i--;
        }

    }
    for( $i = 0; $i < count($avgs); $i++ ) {
        $next = 0; //represents the index
        for( $j = 0; $j < count($avgs); $j++ ) {
            if( $j == 0 || ($avgs[$next][1] > $avgs[$j][1]) ) $next = $j;
        }
        array_push($sorted, [$avgs[$next][0], $avgs[$next][1]]);
        array_splice($avgs, $next, 1);
        $i--;
    }
    return $sorted;
}

function MySeriesSortDESC($avgs) {
    $sorted = [];
    for( $i = 0; $i < count($avgs); $i++ ) {
        $next = 0; //represents the index
        for( $j = 0; $j < count($avgs); $j++ ) {
            if( $j == 0 || ($avgs[$next][1] < $avgs[$j][1]) ) $next = $j;
        }
        array_push($sorted, [$avgs[$next][0], $avgs[$next][1]]);
        array_splice($avgs, $next, 1);
        $i--;
    }
    for( $i = 0; $i < count($avgs); $i++ ) {
        if( $avgs[$i][1] == "Not rated yet" ) {
            array_push($sorted, [$avgs[$i][0], $avgs[$i][1]]);
            array_splice($avgs, $i, 1);
            $i--;
        }

    }
    return $sorted;
}

function loadSeriesSortedByRatingASC()
{
    $avgs = averageRatingsBySeries();
    $sortedAvgs = MySeriesSortASC($avgs);
    $series = [];
    foreach( $sortedAvgs as $avg )
    {
        array_push($series, DB::select('select * from series where id = ?', [$avg[0]])[0]);
    }
    return $series;
}

function loadSeriesSortedByDiffASC()
{
    return DB::select('select * from series join types on tId = types.id order by difficulty ASC');
}

function loadSeriesSortedBySubASC()
{
    return DB::select('select * from series join types on tId = types.id order by subject ASC');
}

function loadSeriesSortedByNameDESC()
{
    return DB::select('select * from series group by title order by title DESC');
}

function loadSeriesSortedByRatingDESC()
{
    $avgs = averageRatingsBySeries();
    $sortedAvgs = MySeriesSortDESC($avgs);
    $series = [];
    foreach( $sortedAvgs as $avg )
    {
        array_push($series, DB::select('select * from series where id = ?', [$avg[0]])[0]);
    }
    return $series;
}

function loadSeriesSortedByDiffDESC()
{
    return DB::select('select * from series join types on tId = types.id order by difficulty DESC');
}

function loadSeriesSortedBySubDESC()
{
    return DB::select('select * from series join types on tId = types.id order by subject DESC');
}

function loadSeriesWithExercise($eId)
{
    return DB::select('select * from series join exercises_in_series on id = seriesId where exId = ?', [$eId]);
}

function loadMySeries() {
    return DB::select('SELECT *
                       FROM series
                       WHERE makerId = ?',
                       [\Auth::id()]);
}

function userOwnsSeries($uId) {
    if( !empty( DB::select('select * from series where makerId = ?', [\Auth::id()]) ) ) return true;
    else return false;
}

function loadSeriesSearch($s) {
    return DB::select('SELECT *
                       FROM series
                       WHERE title LIKE ?
                             OR description LIKE ?',
                       ['%'.$s.'%', '%'.$s.'%']);
}

function userCompletedSeries($userId, $seriesId) {
    $sId = loadSerieWithIdOrTitle($seriesId);
    return DB::select('SELECT   *
                       FROM     series S
                                JOIN exercises_in_series EXS    ON S.id = EXS.seriesId
                                JOIN exercises E                ON EXS.ex_index = E.id
                                JOIN answers A                  ON E.id = A.eId
                       WHERE    A.succes = false
                                AND A.uId = ?
                                AND S.id = ?', [$userId, $sId]);
}

function loadUsersBeganSeries($series_id) {
    $sId = loadSerieWithIdOrTitle($series_id)[0]->id;

    return DB::select('SELECT   DISTINCT A.uId
                       FROM     series S
                                JOIN exercises_in_series EXS    ON S.id = EXS.seriesId
                                JOIN exercises E                ON EXS.exId = E.id
                                JOIN answers A                  ON E.id = A.eId
                       WHERE    S.id = ?', [$sId]);
}


function returnAccomplishedPercentageSeries($user, $serie) {
    $allExercises = loadExercisesFromSerie($serie->id);
    $totalExercises = count($allExercises);
    $count = 0;
    foreach ($allExercises as $exercise) {
        if( userCompletedExercise($exercise->id, $user->id) ) {
            $count += 1;
        }
    }
    return ($totalExercises == 0) ? 0 : (100*$count/$totalExercises); //result in percentage
}

function addViewToSeries($serie) {
    DB::statement('UPDATE series
                    SET views = views + 1
                    where id = ?',
                    [$serie->id]);
}


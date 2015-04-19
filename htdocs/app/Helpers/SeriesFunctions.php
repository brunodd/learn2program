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


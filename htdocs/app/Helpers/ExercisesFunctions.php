<?php

function loadExercisesFromSerie($sId)
{
    return DB::select('select * from exercises, (select * from exercises_in_series where seriesId = ?) eps
                where exercises.id = eps.exId',
        [$sId]);
}

/*function loadExercisesFromSerie2($sId)
{
    $seriesID = loadSerieWithIdOrTitle($sId);
    return DB::select('select * from exercises where seriesId = ?',[$seriesID[0]->id]);
}*/

function storeExercise($exercise)
{
    // Add exercise
    DB::insert('insert into exercises (question, tips, start_code, expected_result, makerId) VALUES (?, ?, ?, ?, ?)',
        [$exercise->question, $exercise->tips, $exercise->start_code, $exercise->expected_result, $exercise->makerId]);

    // Add link with series
    DB::insert('insert into exercises_in_series (exId, seriesId)
            select max(id), ? from exercises', [$exercise->seriesId]);
}

function loadAllExercises()
{
    return DB::select('select * from exercises');
}

function loadExercise($id)
{
    return DB::select('select * from exercises where id = ?', [$id]);
}

function isMakerOfExercise($eId, $uId)
{
    return ( empty(DB::select('select * from exercises where makerId = ? and id = ?', [$uId, $eId])) );
}

function nextExerciseInLine($eId, $uId)
{
    return DB::select('select * from exercises ex1, exercises_in_series eps1
        where (ex1.id = eps1.exId and eps1.seriesId in
            (select seriesId from exercises_in_series eps2 where eps2.exId = ?))
        and (ex1.id not in
            (select eId from answers where uId = ? and success = 1))
        order by id',
        [$eId, $uId]);
}

function completedAllPreviousExercisesOfSeries($eId, $uId)
{
    if( $eId == nextExerciseInLine($eId, $uId)[0]->id ) return true;
    else return userCompletedExercise($eId, $uId);
}

function userCompletedExercise($eId, $uId)
{
    if( empty(DB::select('select * from answers where eId = ? and uId = ? and success = 1', [$eId, $uId])) ) return false;
    else return true;
}

function storeAnswer($ans)
{
    DB::insert('insert into answers (given_code, success, uId, eId) values (?, ?, ?, ?)', [$ans->given_code, $ans->success, $ans->uId, $ans->eId]);
}
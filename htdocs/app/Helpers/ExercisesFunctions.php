<?php

function loadExercisesFromSerie($sId)
{
    return DB::select('select * from exercises, (select * from exercises_in_series where seriesId = ?) eps
                where exercises.id = eps.exId order by ex_index',
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

    storeReference($exercise);
}

function storeReference($exercise)
{
    // Add link with series
    DB::insert('insert into exercises_in_series (exId, seriesId, ex_index)
            select max(exercises.id), ?, (agg.count + 1)
            from exercises, (select count(seriesId) as count from exercises_in_series where exercises_in_series.seriesId = ?) agg', [$exercise->seriesId, $exercise->seriesId]);
}

function addToSeries($exId, $seriesId)
{
    if(empty(DB::select('select * from exercises_in_series where exId = ? and seriesId = ?', [$exId, $seriesId]))) {
    DB::insert('insert into exercises_in_series(exId, seriesId, ex_index)
            select ?, ?, (agg.count + 1)
            from (select count(seriesId) as count 
                    from exercises_in_series
                    where exercises_in_series.seriesId = ?) agg',
            [$exId, $seriesId, $seriesId]);
    }
}

function loadAllExercises()
{
    return DB::select('select * from exercises');
}

function loadAllAccessableExercises($uId)
{
    return DB::select('select * from exercises
                        where id in (select exId as id
                                        from exercises_in_series
                                        where ex_index = 1)
                        group by id
                       union
                        select * from exercises where makerId = ?
                       union
                        select * from exercises
                        where id in
                            (select exId as id
                                from exercises_in_series join answers on exId = eId
                                where uId = ? and success = 1)
                        or id in
                            (select exId as id from exercises_in_series
                                where (ex_index-1) in
                                    (select ex_index
                                        from exercises_in_series join answers on exId = eId
                                        where uId = ? and success = 1))
                        group by id', [$uId, $uId, $uId]);
}

//Especially for guests
function loadAllFirstExercises()
{
    return DB::select('select * from exercises
                        where id in (select exId as id
                                        from exercises_in_series
                                        where ex_index = 1)
                        group by id');
}

function loadExercise($id)
{
    return DB::select('select * from exercises where id = ?', [$id]);
}

function isMakerOfExercise($eId, $uId)
{
    return ( !empty(DB::select('select * from exercises where makerId = ? and id = ?', [$uId, $eId])) );
}

function nextExerciseOfSerie($eId, $sId)
{
    return DB::select('select * from exercises
                        where id in (select exId as id from exercises_in_series
                                        where (ex_index-1) in (select ex_index from exercises_in_series
                                                                where exId=? and seriesId=?))
                        group by id', [$eId, $sId]);
}

function nextExerciseInLine($eId, $uId, $sId)
{
    return DB::select('select * from exercises_in_series
                        where seriesId = ? and ex_index not in
                            (select ex_index from (exercises_in_series eis) join answers on eis.exId = eId
                                where eis.seriesId in (select seriesId from exercises_in_series where exId=?) and uId=? and success=1
                                group by exId)
                        group by exId
                        order by ex_index', [$sId, $eId, $uId]);
}

function firstExerciseOfSerie($eId)
{
    if( !empty( DB::select('select * from exercises_in_series where exId = ? and ex_index = 1', [$eId]) ) ) return true;
    else return false;
}

function completedAllPreviousExercisesOfSeries($eId, $uId, $sId)
{
    if( !empty(nextExerciseInLine($eId, $uId, $sId)) && nextExerciseInLine($eId, $uId, $sId)[0]->exId == $eId ) return true;
    else if( firstExerciseOfSerie($eId) ) return true;
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

function loadMyExercises() {
    return DB::select('SELECT *
                       FROM exercises
                       WHERE makerId = ?',
                       [\Auth::id()]);
}

function loadExercisesSearch($s) {
    return DB::select('SELECT *
                       FROM exercises
                       WHERE question LIKE ?',
                       ['%'.$s.'%']);
}

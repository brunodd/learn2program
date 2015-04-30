<?php

//returns a list of pairs, seriesId & average rating of that serie
function averageRatingsBySeries() {
    $series = loadAllSeries();
    $avgs = [];
    foreach( $series as $s )
    {
        array_push($avgs, [$s->id, averageRating($s->id)]);
    }
    return $avgs;
}

//returns the avarge rating that a user submits
function averageRatingByUser($id)
{
    $ratings = DB::select('select * from series_ratings where userId = ?', [$id]);
    $avg = 0;
    foreach( $ratings as $r )
    {
        $avg = $avg + $r->rating;
    }
    $avg = $avg / count($ratings);
    return $avg;
}

//returns a list of pairs, userId & average rating given by that user
function averageRatingsByUsers() {
    $users = loadusers();
    $avgs = [];
    foreach( $users as $u )
    {
        array_push($avgs, [$u->id, averageRatingByUser($u->id)]);
    }
    return $avgs;
}

//returns a list of pairs, typeId & average rating for that type
//tyring a different strategy here since I found out mysql's "offset" is always 1 too much
// -> please test asap so i can rewrite if necessary
function averageRatingsByTypes() {
    $avgs = DB::select('select types.id, avg(rating) as a from series_ratings JOIN series JOIN types where series.id = seriesId and tId = types.id group by tId');
    foreach( $avgs as $a )
    {
        $a->average = $a->average - 1;
    }
    return $avgs;
}

//returns a list of pairs, userId & number of series created by that user
function countSeriesByMakers() {
    return DB::select('select makerId, count(id) as c from series group by makerId');
}

//returns a list of pairs, userId & the number of exercises created by that user
function countExercisesByMakers() {
    return DB::select('select makerId, count(exercises.id) as c from exercises group by makerId');
}

//return a list of pairs, userId & the number of completed series (i.e. at least tried once on each exercise)
function countSeriesCompletedByUsers() {
    return DB::select('select uId, count(uId) as c from (select uId, count(distinct(eId)) as c1, agg.seriesId, agg.c2 from answers join exercises join (select seriesId, count(id) as c2 from exercises group by seriesId) agg on eId = exercises.id and exercises.seriesId = agg.seriesId group by uId, agg.seriesId having c1 = c2) agg group by uId');
}

//return a list of pairs, userId & the number of completed series (i.e. solved all exercises correctly)
function countSeriesSucceededByUsers() {
    return DB::select('select uId, count(uId) as c from (select uId, count(distinct(eId)) as c1, agg.seriesId, agg.c2 from answers join exercises join (select seriesId, count(id) as c2 from exercises group by seriesId) agg on eId = exercises.id and exercises.seriesId = agg.seriesId where success = 1 group by uId, agg.seriesId having c1 = c2) agg group by uId');
}

function countSeriesSucceededByUser($uId) {
    $pairs = countSeriesSucceededByUsers();
    foreach ($pairs as $pair) {
        if($pair->uId = $uId) {
            return $pair->c;
        }
    }
    return 0;
}

//return a list of pairs, userId & the number of series in progress (i.e. with exercises still unanswered)
//in particular -> the number of series in progress equals (total number of series containing exercises - "completed" series)
function countSeriesInProgressByUsers() {
    return DB::select('select uId, (agg2.c-count(uId)) as c from (select uId, count(distinct(eId)) as c1, agg.seriesId, agg.c2 from answers join exercises join (select seriesId, count(id) as c2 from exercises group by seriesId) agg on eId = exercises.id and exercises.seriesId = agg.seriesId group by uId, agg.seriesId having c1 = c2) agg, (select count(distinct(seriesId)) as c from exercises) agg2 group by uId');
}

//returns list of pairs, userId & number of series for which none of the exercises was made so far
//series with no exercises are not taken into account
function countSeriesUnstartedByUsers() {
    return DB::select('select * from (select users.id, agg.c as c from users, (select count(id) as c from series where id in (select distinct(seriesId) from exercises)) agg where users.id not in (select uId from answers) union (select uId as id, (agg.c-count(distinct(seriesId))) from (answers join exercises on eId = exercises.id), (select count(id) as c from series where id in (select distinct(seriesId) from exercises)) agg group by uId)) agg group by id');
}

//return a list of pairs, userId & the number of completed exercises (i.e. at least tried once)
function countExercisesCompletedByUsers() {
    return DB::select('select uId, count(distinct(eId)) as c from answers group by uId');
}

//return a list of pairs, userId & the number of completed exercises (i.e. solved correctly)
function countExercisesSucceededByUsers() {
    return DB::select('select uId, count(distinct(eId)) as c from answers where success = 1 group by uId');
}

//return a list of pairs, userId & the number of completed exercises (i.e. not correct)
function countExercisesFailedByUsers() {
    return DB::select('select uId, count(distinct(eId)) as c from answers where success = 0 group by uId');
}

//return a list of pairs, userId & number of exercises for which no answer has been submitted yet
function countExercisesUnstartedByUsers() {
    return DB::select('select * from (select users.id, agg.c as c from users, (select count(id) as c from exercises) agg where users.id not in (select uId from answers) union (select uId as id, (agg.c-count(distinct(eId))) from answers, (select count(id) as c from exercises) agg group by uId)) agg group by id');
}

//return a list of pairs, userId & the number of completed types (i.e. at least tried all exercises of a certain type)
function countTypesCompletedByUsers() {
    return DB::select('select uId, count(agg1.tId) as c from (select agg.uId, count(agg.eId) as c, series.tId from (select uId, eId from answers group by uId, eId) agg join exercises join series on agg.eId = exercises.id and seriesId = series.id group by agg.uId, tId) agg1 join (select tId, count(exercises.id) as c from exercises join series on seriesId = series.id group by tId) agg2 on agg1.tId = agg2.tId where agg1.c = agg2.c group by uId');
}

//return a list of pairs, userId & the number of completed types (i.e. solved correctly)
function countTypesSucceededByUsers() {
    return DB::select('select uId, count(agg1.tId) as c from (select agg.uId, count(agg.eId) as c, series.tId from (select uId, eId from answers where success = 1 group by uId, eId) agg join exercises join series on agg.eId = exercises.id and seriesId = series.id group by agg.uId, tId) agg1 join (select tId, count(exercises.id) as c from exercises join series on seriesId = series.id group by tId) agg2 on agg1.tId = agg2.tId where agg1.c = agg2.c group by uId');
}

//return a list of pairs, userId & the number of types in progress (i.e. analog to countSeriesInProgressByUsers)
function countTypesInProgressByUsers() {
    return DB::select('select uId, (agg2.c-agg1.c) as c from (select agg.uId, count(agg.eId) as c, series.tId from (select uId, eId from answers group by uId, eId) agg join exercises join series on agg.eId = exercises.id and seriesId = series.id group by agg.uId, tId) agg1 join (select tId, count(exercises.id) as c from exercises join series on seriesId = series.id group by tId) agg2 on agg1.tId = agg2.tId group by uId');
}

//returns a list of pairs, userId & the number of types for which no answer has been submitted yet
//types for which no exercises exist are not taken into account
function countTypesUnstartedByUsers() {
    return DB::select('select * from (select users.id, agg.c as c from users, (select count(id) as c from types where id in (select tId from series where id in (select distinct(seriesId) from exercises))) agg where users.id not in (select uId from answers) union (select uId as id, (agg.c-count(distinct(tId))) from (answers join exercises join series join types on eId = exercises.id and seriesId = series.id and tId = types.id), (select count(id) as c from types where id in (select tId from series where id in (select distinct(seriesId) from exercises)) ) agg )) agg group by id');
}

//return a list of pairs, typeId & number of series with that type
function countSeriesByTypes() {
    return DB::select('select tId, count(id) as c from series group by tId');
}

//return a list of pairs, groupId & number of members of that group
function countUsersByGroups() {
    return DB::select('select groupId, count(memberId) as c from members_of_groups group by groupId');
}

//return a list of pairs, userId & number of groups associated to that user
function countGroupsByUsers() {
    return DB::select('select memberId, count(groupId) as c from members_of_groups group by memberId');
}

//return a list of pairs, seriesId & the number of exercises associated to that serie
function countExercisesBySeries() {
    return DB::select('select * from
                        ( (select id as seriesId, 0 as c
                            from series
                            where id not in
                                (select seriesId
                                    from exercises_in_series
                                    group by seriesId) )
                         union
                          (select seriesId, count(exId) as c
                            from exercises_in_series
                            group by seriesId) )
                        agg
                        group by seriesId');
}

//return a list of pairs, seriesId & the number of users that have successfully completed all the exercises for that serie
function countUsersSucceededSeries() {
    return DB::select('select * from
                        (select seriesId, count(distinct(uId)) as c from
                            (select count(distinct(exId)) as c, seriesId, uId
                                from exercises_in_series join answers on exId = eId
                                where success = 1
                                group by seriesId, uId) agg1
                            join
                            (select count(exId) as exCount, seriesId as sId
                                from exercises_in_series
                                group by sId) agg2
                            on (seriesId = sId and c = exCount)
                            group by seriesId
                        union
                         select seriesId, 0 as c from exercises_in_series
                         where exId not in
                            (select eId as exId
                                from answers
                                where success = 1
                                group by seriesId)
                        union
                         select id as seriesId, 0 as c from series
                         where id not in (select seriesId as id
                                            from exercises_in_series
                                            group by seriesId)) agg
                        group by seriesId');
}

function countExercisesInSeries($seriesId) {
    return DB::select('select count(distinct(exId)) as c
                        from exercises_in_series eis
                        where eis.seriesId = ?',
                        [$seriesId]);
}

// returns a list of pairs, seriesId & the number of exercises successfully completed for that serie for the given user
function countUserSucceededExercisesBySeries($uId) {
    return DB::select('select seriesId, c from
                        (select seriesId, count(distinct(exId)) as c
                          from exercises_in_series join answers on eId=exId
                          where success = 1 and uId = ?
                          group by seriesId
                        union
                         select seriesId, 0 as c from exercises_in_series
                          where exId not in
                              (select eId as exId from answers
                               where success=1 and eId=exId and uId=?)
                        union
                         select id as seriesId, 0 as c from series
                          where id not in (select seriesId as id from exercises_in_series)
                      ) agg
                       group by seriesId', [$uId, $uId]);
}

function attemptedSeries($uId, $sId) {
    if (empty(DB::select('  select *
                            from answers, exercises_in_series
                            where eId = exId
                            and uId = ?
                            and seriesId = ?',
                        [$uId, $sId])))
        return false;
    else 
        return true;
}

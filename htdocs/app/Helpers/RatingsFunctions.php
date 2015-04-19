<?php

function notRatedYet($uId, $sId)
{
    if( empty(DB::select('select * from series_ratings where userId = ? and seriesId = ?', [$uId, $sId])) ) return true;
    else return false;
}

function addRating($nr)
{
    DB::insert('insert into series_ratings (rating, userId, seriesId) VALUES (?, ?, ?)', [$nr->rating, $nr->userId, $nr->seriesId]);
}

function unratedSeries($sId)
{
    if( empty(DB::select('select * from series_ratings where seriesId = ?', [$sId])) ) return true;
    else return false;
}

//Raphael: since mysql seems to be retarded when it comes to calculating the average, i wrote it myself
//after a couple of tests, it seems mysql's average is always off by 1
function averageRating($sId)
{
    $ratings = DB::select('select * from series_ratings where seriesId = ?', [$sId]);
    $avg = 0;
    foreach( $ratings as $r )
    {
        $avg = $avg + $r->rating;
    }

    return (count($ratings) != 0) ? $avg / count($ratings) : 0;
}
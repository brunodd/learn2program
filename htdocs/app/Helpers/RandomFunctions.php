<?php

function compare($s1, $s2)
{
    $length = strlen($s1);
    if( $length != strlen($s2) ) return false;
    for($i=0; $i < $length; $i++)
    {
        if( $s1[$i] != $s2[$i] ) return false;
    }
    return true;
}

function first20chars($string)
{
    return firstChars($string, 20);
}

function firstChars($string, $limit)
{
    if( strlen($string) > $limit)
        return (substr($string, 0, $limit) . "...");

    return $string;
}

function ExNrOfSerie($eId, $sId)
{
    return DB::select('select * from exercises_in_series where exId = ? and seriesId = ?', [$eId, $sId])[0]->ex_index;
}

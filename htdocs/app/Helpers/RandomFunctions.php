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
    if( strlen($string) > 50 )
    {
        return (substr($string, 0, 50) . "...");
    }
    return $string;
}

function ExNrOfSerie($eId, $sId)
{
    $exercises = loadExercisesFromSerie($sId);
    $index = 1;
    foreach($exercises as $ex)
    {
        if( $ex->id == $eId ) return $index;
        $index++;
    }
}
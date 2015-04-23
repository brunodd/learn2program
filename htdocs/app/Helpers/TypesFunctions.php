<?php

function removeUnusedTypes()
{
    DB::statement('delete from types where id NOT IN (select distinct(tId) from series)');
}

/* Subject and Difficulty => this combination is unique */
function loadTypeId($type)
{
    return DB::select('select id from types where subject = ? and difficulty = ?', [$type->subject, $type->difficulty]);
}

function loadType1($type)
{
    return DB::select('select * from types where subject = ? and difficulty = ?', [$type->subject, $type->difficulty]);
}

function loadType2($id)
{
    return DB::select('select * from types where id = ?', [$id]);
}

function loadAllTypes()
{
    return DB::select('select * from types');
}

function storeType($type)
{
    DB::insert('insert into types (subject, difficulty) VALUES (?, ?)', [$type->subject, $type->difficulty]);
}

function loadDifficultyAsInt($id) {
    $bla = DB::select('SELECT difficulty FROM types WHERE id = ?', [$id])[0]->difficulty;
    switch($bla) {
        case "Easy":
            return 0;
            break;
        case "Intermediate":
            return 1;
            break;
        case "Hard":
            return 2;
            break;
        case "Insane":
            return 3;
            break;
    }
}
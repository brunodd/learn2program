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

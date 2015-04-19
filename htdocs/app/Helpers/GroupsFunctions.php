<?php

function storeGroup($group)
{
    DB::insert('insert into groups (name, founderId) VALUES (?, ?)', [$group->name, $group->founderId]);
}

function loadAllGroups()
{
    return DB::select('select * from groups ');
}

function loadGroup($group)
{
    return DB::select('select * from groups where id = ? or name = ?', [$group, $group]);
}

function isFounderOfGroup($groupId, $founderId)
{
    if ( !empty(DB::select('select * from groups where (id = ? or name = ?) and founderId = ?',[$groupId, $groupId, $founderId])) )
    {
        return true;
    }
    else
    {
        return false;
    }
}

function addMember2Group($uId, $gId)
{
    $group = loadGroup($gId);
    if ( !empty($group) ) DB::insert('insert into members_of_groups (memberId, groupId) VALUES (?, ?)', [$uId, $group[0]->id]);
    //else we must throw an error, however theoretically this should never be the case...
}

function deleteMemberFromGroup($uId, $gId)
{
    $group = loadGroup($gId);
    if ( !empty($group) ) DB::statement('delete from members_of_groups where memberId = ? and groupId = ?', [$uId, $group[0]->id]);
    //else we must throw an error, however theoretically this should never be the case...
}

function noMemberYet($uId, $gId)
{
    $group = loadGroup($gId);
    if ( !empty($group) and !empty(DB::select('select * from members_of_groups where memberId = ? and groupId = ?',[$uId, $group[0]->id])) )
    {
        return false;
    }
    else
    {
        return true;
    }
}

function updateGroup($id, $groupname)
{
    $group = loadGroup($id);
    if ( !empty($group) ) DB::statement('update groups SET name = ? where id = ?', [$groupname, $group[0]->id]);
}

function listGroupsOfUser($id)
{
    return DB::select('select groupname from groups join (select distinct(groupId) from members_of_groups where memberId = ?) agg on id=groupId', [$id]);
}

function listUsersOfGroup($id)
{
    return DB::select('select username from users join (select memberId from members_of_groups where groupId = ?) agg on id=memberId', [$id]);
}

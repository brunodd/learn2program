<?php

function storeGroup($group)
{
    DB::insert('INSERT INTO groups (name, founderId, conversationId, private) VALUES (?, ?, ?, ?)',
                                   [$group->name, $group->founderId, $group->conversationId, $group->private]);
}

function loadAllGroups()
{
    return DB::select('SELECT   *
                       FROM     groups ');
}

function loadGroup($group)
{
    return DB::select('SELECT   *
                       FROM     groups
                       WHERE    id = ?
                       OR name = ?',
                       [$group, $group]);
}

function updateGroup($id, $request)
{
    $group = loadGroup($id);
    if ( !empty($group) ) DB::statement('UPDATE groups SET name = ?, private = ? WHERE id = ?', [$request->name, $request->type, $group[0]->id]);
}

function isFounderOfGroup($groupId, $founderId)
{
    return ( !empty(DB::select('SELECT  *
                                FROM    groups
                                WHERE   (id = ? OR name = ?)
                                AND     founderId = ?',
                                [$groupId, $groupId, $founderId])) );
}

function storeJoinGroupRequest($uId, $gId)
{
    DB::insert('INSERT INTO members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)',
                                              [$uId, $gId, 'pending']);
}

function isGroupRequestPending($uId, $gId) {
    return (\DB::select('SELECT *
                         FROM   members_of_groups
                         WHERE  groupId = ?
                         AND    memberId = ?
                         AND    status = ?',
                         [$gId, $uId, 'pending']));
}

function isGroupRequestDeclined($uId, $gId) {
    return (\DB::select('SELECT *
                         FROM   members_of_groups
                         WHERE  groupId = ?
                         AND    memberId = ?
                         AND    status = ?',
        [$gId, $uId, 'declined']));
}

function addMemberToGroup($uId, $gId)
{
    DB::insert('INSERT INTO members_of_groups (memberId, groupId, status) VALUES (?, ?, ?)',
                                              [$uId, $gId, 'accepted']);
}


function acceptMemberToGroup($uId, $gId) {
    DB::statement('UPDATE   members_of_groups
                   SET      status = \'accepted\'
                   WHERE    groupId = ?
                   AND      memberId = ?',
                   [$gId, $uId]);
}

function declineMemberToGroup($uId, $gId) {
    DB::statement('UPDATE   members_of_groups
                   SET      status = \'declined\'
                   WHERE    groupId = ?
                   AND      memberId = ?',
                   [$gId, $uId]);
}

function deleteMemberFromGroup($uId, $gId)
{
    DB::statement('DELETE FROM members_of_groups WHERE memberId = ? AND groupId = ?', [$uId, $gId]);
}

function isMemberOfGroup($id) {
    return !empty(\DB::select('SELECT  *
                               FROM    members_of_groups
                               WHERE   groupId = ?
                               AND     memberId = ?
                               AND     status = \'accepted\'',
                               [$id, \Auth::id()]));
}

function listGroupsOfUser($id)
{
    return DB::select('SELECT   groupname
                       FROM     groups
                       JOIN     (SELECT distinct(groupId)
                                FROM members_of_groups
                                WHERE memberId = ?) agg ON id=groupId',
                       [$id]);
}

function listUsersOfGroup($id)
{
    return DB::select('SELECT   *
                       FROM     users
                       JOIN     (SELECT     memberId
                                FROM        members_of_groups
                                WHERE       groupId = ?
                                AND         status = \'accepted\') agg ON id=memberId',
                      [$id]);
}

function loadGroupMembersRequests($id) {
    return DB::select('SELECT   *
                       FROM     users
                       WHERE    id  IN  (SELECT memberId
                                        FROM    members_of_groups
                                        WHERE   memberId = id
                                        AND     groupId = ?
                                        AND     status = \'pending\')',
                       [$id]);
}

function loadGroupMembersDeclined($id) {
    return DB::select('SELECT   *
                       FROM     users
                       WHERE    id  IN  (SELECT memberId
                                        FROM    members_of_groups
                                        WHERE   memberId = id
                                        AND     groupId = ?
                                        AND     status = \'declined\')',
                       [$id]);
}

function loadAllGroupsSortedByNameASC()
{
    return DB::select('SELECT * FROM groups order by name ASC');
}

function loadAllGroupsSortedByNameDESC()
{
    return DB::select('SELECT * FROM groups order by name DESC');
}

function loadAllGroupsSortedByFounderASC()
{
    return DB::select('SELECT * FROM groups JOIN users ON founderId = users.id order by username ASC');
}

function loadAllGroupsSortedByFounderDESC()
{
    return DB::select('SELECT * FROM groups JOIN users ON founderId = users.id order by username DESC');
}

function MyGroupsSort($asc) {
    $groups = loadAllGroups();
    $sorted = [];
    for( $i = 0; $i < count($groups); $i++ ) {
        $next = 0; //represents the index
        for( $j = 0; $j < count($groups); $j++ ) {
            if( $asc == 1 ) {
                if( count(listUsersOfGroup($groups[$next]->id)) > count(listUsersOfGroup($groups[$j]->id)) ) $next = $j;
            }
            else if( $asc == 0 ) {
                if( count(listUsersOfGroup($groups[$next]->id)) < count(listUsersOfGroup($groups[$j]->id)) ) $next = $j;
            }
        }
        array_push($sorted, $groups[$next]);
        array_splice($groups, $next, 1);
        $i--;
    }
    return $sorted;
}

function loadAllGroupsSortedByMCASC()
{
    return MyGroupsSort(1);
}

function loadAllGroupsSortedByMCDESC()
{
    return MyGroupsSort(0);
}

function loadMyGroups() {
    return DB::select('SELECT   *
                       FROM     groups
                       WHERE    id IN (SELECT DISTINCT groupId
                                      FROM    members_of_groups
                                      WHERE   memberId = ? and status = "accepted")',
                       [\Auth::id()]);
}

function loadGroupsSeach($s) {
    return DB::select('SELECT   *
                       FROM     groups
                       WHERE    name LIKE ?',
                       ['%'.$s.'%']);
}

<?php

function storeChallenge($userA, $userB, $exId, $winner = NULL) {
    return DB::insert('INSERT INTO challenges (userA, userB, exId, winner)
                        VALUE (?, ?, ?, ?)',
                    [$userA, $userB, $exId, $winner]);
}

function loadChallengesByUser($userId) {
    return DB::select('SELECT * FROM challenges
                        WHERE userA = ?
                        OR userB = ?',
                        [$userId, $userId]);
}

function loadChallengesByUserExercise($uId, $eId) {
    return DB::select('SELECT * FROM challenges
                        WHERE userA = ?
                        OR userB = ?
                        and exId = ?',
                        [$uId, $uId, $eId]);
}

function loadChallengesByUsers($user1, $user2) {
    return DB::select('SELECT * from challenges
                        WHERE (userA = ? AND userB = ?)
                        OR (userB = ? and userA = ?)',
                        [$user1, $user2, $user1, $user2]);
}

function loadChallengeByUsersExercise($user1, $user2, $exId) {
    return DB::select('SELECT * FROM challenges
                        WHERE ((userA = ? AND userB = ?)
                            OR (userB = ? and userA = ?))
                        AND (exId = ?)',
                        [$user1, $user2, $user1, $user2, $exId]);

}

function loadChallenge($id) {
    return DB::select('SELECT * FROM challenges
                        WHERE id = ?',
                        [$id]);
}

function setWinner($id, $winner) {
    return DB::statement(' update challenges
                            set winner = ?
                            where id = ?',
                            [$winner, $id]);
}

?>

<?php

function loadChallengesByUser($userId) {
    return \DB::select('SELECT * from challenges
                        WHERE userA = ?
                        OR userB = ?',
                        [$userId, $userId]);
}

function loadChallengesByUsers($user1, $user2) {
    return \DB::select('SELECT * from challenges
                        WHERE (userA = ? AND userB = ?)
                        OR (userB = ? and userA = ?)',
                        [$user1, $user2, $user1, $user2]);
}

function storeChallenge($userA, $userB, $exId, $status = 'pending', $winner = NULL) {
    return \DB::insert('INSERT INTO challenges (userA, userB, exId, status, winner)
                        VALUE (?, ?, ?, ?, ?)',
                    [$userA, $userB, $exId, $status, $winner]);
}

?>

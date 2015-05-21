<?php

function loadAllGuides() {
    return DB::select('select * from guides');
}

function loadGuideByTitleOrId($id) {
    return DB::select('select * from guides where title = ? or id = ?', [$id, $id]);
}

function storeGuide($guide) {
    DB::insert('insert into guides (title, content, writerId) VALUES (?, ?, ?)', [$guide->title, $guide->content, $guide->writerId]);
}

?>


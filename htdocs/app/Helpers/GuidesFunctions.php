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

function updateGuide($guide) {
    DB::statement('update guides SET content = ? where id = ?', [$guide->content, $guide->id]);
}
function deleteGuideByTitleOrId($id){
    DB::statement('delete from guides where id = ? or title = ?', [$id, $id]);
}

function loadMyGuides($id) {
    return DB::select('select * from guides where writerId = ?', [$id]);
}

function loadGuidesSearch($s) {
    return DB::select('SELECT   *
                       FROM     guides
                       WHERE    title LIKE ? or content LIKE ?',
                       ['%'.$s.'%', '%'.$s.'%']);
}

?>


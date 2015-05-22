<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFriendsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('friends', function(Blueprint $table) {
            $table->integer('id1')->unsigned();
            $table->foreign('id1')->references('id')->on('users');
            $table->integer('id2')->unsigned();
            $table->foreign('id2')->references('id')->on('users');
            $table->primary(['id1', 'id2']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('friends');
	}
}

/*
CREATE TABLE friends (
    id1 int REFERENCES users(id),
    id2 int REFERENCES users(id),
    PRIMARY KEY(id1, id2)
);
*/

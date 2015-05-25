<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChallengesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('challenges', function(Blueprint $table) {
            $table->increments('id');   //automatically sets primary key
            $table->integer('userA');
            $table->foreign('userA')->references('id')->on('users');
            $table->integer('userB');
            $table->foreign('userB')->references('id')->on('users');
            $table->integer('exId');
            $table->foreign('exId')->references('id')->on('exercises');
            $table->integer('winner');
            $table->foreign('winner')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('challenges');
	}
}

/*

CREATE TABLE users (
    id int AUTO_INCREMENT,
    pass varchar(255) NOT NULL,
    username varchar(20) NOT NULL UNIQUE,
    mail varchar(50) NOT NULL,
    PRIMARY KEY(id)
);
*/

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExercisesAswersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('answers', function(Blueprint $table) {
			$table->increments('id');
            $table->text('given_code');
            $table->boolean('succes');

            $table->integer('uId')->unsigned();
            $table->foreign('uId')->references('id')->on('users');
            $table->integer('eId')->unsigned();
            $table->foreign('eId')->references('id')->on('exercises');

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('answers');
	}
}

/*
CREATE TABLE answers (
    id int AUTO_INCREMENT,
    given_code text NOT NULL,
    success bool NOT NULL,
    uId int NOT NULL REFERENCES users(id),
    eId int NOT NULL REFERENCES exercises(id),
    PRIMARY KEY(id)
);
*/

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExercisesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('exercises', function(Blueprint $table) {
			$table->increments('id');
            $table->string('question');
            $table->text('tips');
            $table->text('start_code');
            $table->text('expected_result');

            $table->integer('serieId')->unsigned();
            $table->foreign('serieId')->references('id')->on('series');

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('exercises');
	}
}

/*
CREATE TABLE exercises (
    id int AUTO_INCREMENT,
    question varchar(767) NOT NULL,
    tips varchar(500),
    start_code text NOT NULL,
    expected_result text NOT NULL,
    serieId int NOT NULL,
    FOREIGN KEY (serieId) REFERENCES series(id),
    PRIMARY KEY(id)
);
*/

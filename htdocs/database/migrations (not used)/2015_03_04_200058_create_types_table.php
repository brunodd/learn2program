<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('types', function(Blueprint $table) {
			$table->increments('id');
            $table->string('subject');
            $table->enum('difficulty', ['easy', 'intermediate', 'hard', 'insane']);

            $table->unique(['subject', 'difficulty']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('types');
	}
}

/* Only allow 4 values for difficulty? => easy, intermediate, hard, insane

CREATE TABLE types (
    id int AUTO_INCREMENT,
    subject varchar(50) NOT NULL,
    difficulty ENUM('easy', 'intermediate', 'hard', 'insane') NOT NULL,
    PRIMARY KEY(id),
    UNIQUE(subject, difficulty)
);
*/

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('series', function(Blueprint $table)	{
			$table->increments('id');
            $table->string('title');
            $table->text('description');

            $table->integer('makerId')->unsigned();
            $table->foreign('makerId')->references('id')->on('users');
            $table->integer('tId')->unsigned();
            $table->foreign('tId')->references('id')->on('types');

			$table->timestamps();

            $table->unique(['title', 'tId']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('series');
	}
}

/* Must make sure that at least 1 exercise belongs to a serie
    => design the site so that this is always the case?
CREATE TABLE series (
    id int AUTO_INCREMENT,
    title varchar(50) NOT NULL,
    description varchar(500),
    makerId int NOT NULL,
    FOREIGN KEY (makerId) REFERENCES users(id),
    tId int NOT NULL,
    FOREIGN KEY (tId) REFERENCES types(id),
    PRIMARY KEY(id),
    UNIQUE(title, tId)
);
*/

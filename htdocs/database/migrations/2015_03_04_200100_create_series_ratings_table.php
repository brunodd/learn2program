<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeriesRatingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('series_ratings', function(Blueprint $table) {
            $table->enum('rating', ['1', '2', '3', '4', '5']);

			$table->integer('userId')->unsigned();
            $table->foreign('userId')->references('id')->on('users');
            $table->integer('serieId')->unsigned();
            $table->foreign('serieId')->references('id')->on('series');
            $table->primary(['userId', 'serieId']);

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('series_ratings');
	}
}


/* Again choose between pre-defined values for rating?

CREATE TABLE series_ratings (
    userId int REFERENCES users(id),
    serieId int REFERENCES series(id),
    rating ENUM('0', '1', '2', '3', '4', '5') NOT NULL,
    PRIMARY KEY (userId, serieId)
);
*/

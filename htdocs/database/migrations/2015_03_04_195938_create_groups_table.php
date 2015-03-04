<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('groups', function(Blueprint $table)	{
			$table->increments('id');
            $table->string('name')->unique();

            $table->integer('founderId')->unsigned();
            $table->foreign('founderId')->references('id')->on('users');

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('groups');
	}
}

/*

CREATE TABLE groups (
    id int AUTO_INCREMENT,
    name varchar(30) NOT NULL UNIQUE,
    founderId int NOT NULL,
    FOREIGN KEY (founderId) REFERENCES users(id),
    PRIMARY KEY(id)
);
*/

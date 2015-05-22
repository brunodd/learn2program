<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
        //Schema::drop if exists?
		Schema::create('users', function(Blueprint $table) {
            $table->increments('id');   //automatically sets primary key
            $table->string('username')->unique();
            $table->string('mail');
            $table->string('pass');

            $table->rememberToken();    //remember_token VARCHAR(100) NULL
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('users');
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

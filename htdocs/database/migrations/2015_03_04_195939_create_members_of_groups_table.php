<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersOfGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('members_of_groups', function(Blueprint $table) {
            $table->integer('memberId')->unsigned();
            $table->foreign('memberId')->references('id')->on('users');
            $table->integer('groupId')->unsigned();
            $table->foreign('groupId')->references('id')->on('groups');
            $table->primary(['memberId', 'groupId']);

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('members_of_groups');
	}
}

/*

CREATE TABLE members_of_groups (
    memberId int REFERENCES users(id),
    groupId int REFERENCES Groups(id),
    PRIMARY KEY (memberId, groupId)
);
*/

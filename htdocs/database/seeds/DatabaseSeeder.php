<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        //TO RUN: composer dump-autoload, then php artisan db:seed




		//Model::unguard();

        $this->call('ConversationsTableSeeder');
        $this->command->info('conversations table seeded!');

        $this->call('UsersTableSeeder');
        $this->command->info('users table seeded!');

        $this->call('FriendsTableSeeder');
        $this->command->info('friends table seeded!');

        $this->call('GroupsTableSeeder');
        $this->command->info('groups table seeded!');

        $this->call('MembersOfGroupsTableSeeder');
        $this->command->info('members_of_groups table seeded!');

        $this->call('TypesTableSeeder');
        $this->command->info('types table seeded!');

        $this->call('SeriesTableSeeder');
        $this->command->info('series table seeded!');

        $this->call('SeriesRatingsTableSeeder');
        $this->command->info('series_ratings table seeded!');

        $this->call('ExercisesTableSeeder');
        $this->command->info('exercises table seeded!');

        // $this->call('ChallengesTableSeeder');
        // $this->command->info('challenges table seeded!');

        $this->call('ExercisesAnswersTableSeeder');
        $this->command->info('answers table seeded!');

        $this->call('ExercisesInSeriesTableSeeder');
        $this->command->info('exercises_in_series table seeded!');

        $this->call('MessagesTableSeeder');
        $this->command->info('messages table seeded!');

        $this->call('NotificationsTableSeeder');
        $this->command->info('notifications table seeded!');

        $this->call('GuidesTableSeeder');
        $this->command->info('guides table seeded!');
	}
}

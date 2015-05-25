<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// List all routes with: $ php artisan route:list

// Miscellaneous routes
Route::get('/', 'PagesController@home');
Route::get('about', 'PagesController@about');
Route::get('faqs', 'PagesController@faqs');
Route::resource('messages', 'MessagesController', ['only' => ['index', 'show', 'store']]);
Route::get('statistics', 'StatisticsController@home');
Route::get('leaderboard', 'LeaderboardController@index');


//Users routes
Route::resource('users', 'UsersController');
Route::post('users/{id}/addFriend', 'UsersController@addFriend');
Route::post('users/{id}/removeFriend', 'UsersController@removeFriend');
Route::post('users/{id}/acceptFriend', 'UsersController@acceptFriend');
Route::post('users/{id}/declineFriend', 'UsersController@declineFriend');
Route::get('my_friends', 'UsersController@myFriends');


//Series routes
Route::resource('series', 'SeriesController');
Route::get('series/{id}/newexercise', 'SeriesController@createExercise');
Route::post('series/{id}/newexercise', 'SeriesController@storeExercise');
Route::post('series/{id}/storeRating', 'SeriesController@storeRating');
Route::post('series/{id}/referenceexercise', 'SeriesController@storeReference');
Route::post('series/{id}/copyexercise', 'SeriesController@storeCopy');
Route::get('my_series', 'SeriesController@mySeries');


//Groups routes
Route::resource('groups', 'GroupsController');
Route::post('groups/{id}/joinGroup', 'GroupsController@join');
Route::post('groups/{id}/leaveGroup', 'GroupsController@leave');
Route::post('groups/{id}/storeMessage', 'GroupsController@storeMessage');
Route::get('groups/{id}/manageMembers', 'GroupsController@manageMembers');
Route::post('groups/{id}/manageMembers/accept/{id2}', 'GroupsController@acceptMember');
Route::post('groups/{id}/manageMembers/decline/{id2}', 'GroupsController@declineMember');
Route::post('groups/{id}/manageMembers/remove/{id2}', 'GroupsController@removeMember');
Route::get('my_groups', 'GroupsController@myGroups');


//Exercises routes
Route::resource('exercises', 'ExercisesController');
Route::post('exercises/{id}/storeAnswer', 'ExercisesController@storeAnswer');
Route::get('my_exercises', 'ExercisesController@myExercises');
Route::get('exercises/{id}/referenceexercise', 'SeriesController@referenceExercise');
Route::get('exercises/{id}/copyexercise', 'SeriesController@copyExercise');
Route::post('exercises/{id}/referenceexercise', 'SeriesController@storeReference');
Route::post('exercises/{id}/copyexercise', 'SeriesController@storeCopy');


//Challenges routes
Route::resource('challenges', 'ChallengesController');
Route::get('exercises/{id}/challenge', 'ChallengesController@create');
Route::get('challenge/{uId}/{exId}' , 'ChallengesController@store');


//Guides routes
Route::resource('guides', 'GuidesController');
Route::get('guides/{id}/delete', 'GuidesController@destroy');
Route::get('my_guides', 'GuidesController@myGuides');


//Notifications routes
Route::get('search', 'SearchController@search');
Route::get('notifications', 'NotificationsController@index');
Route::post('notificationsRead', 'NotificationsController@setNotificationsToRead');
Route::get('sendnotification', 'NotificationsController@createNotification');
Route::any('sharenotification/{user}', array( 'as' => 'pages.sendNotification', 'uses' => 'NotificationsController@shareNotification'));


//Authentication routes
Route::get('register', 'UsersController@getRegister');
Route::post('register', 'UsersController@postRegister');
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');
Route::get('email', 'Auth\PasswordController@getEmail');
Route::post('email', 'Auth\PasswordController@postEmail');
Route::get('reset', 'Auth\PasswordController@getReset');
Route::post('reset', 'Auth\PasswordController@postReset');

Route::get('twitter/error', function() {return 'Problem singing in with Twitter.';});
Route::get('twitter/login', 'Auth\AuthController@twitterLogin');
Route::get('twitter/callback', ['as' => 'twitter.callback', 'uses' => 'Auth\AuthController@twitterCallback']);

Route::get('facebook/login', 'Auth\AuthController@facebookLogin');
Route::get('facebook/callback', 'Auth\AuthController@facebookCallback');
Route::get('facebook/error', function() {return 'Problem singing in with Facebook.';});
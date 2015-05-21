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

//Shows SQL queries used on the page
//Event::listen('illuminate.query', function($sql) { var_dump($sql); });


// List all routes with: $ php artisan route:list
Route::get('/', 'PagesController@home');
Route::get('about', 'PagesController@about');
Route::get('list_all_users', 'UsersController@list_all_users'); // For Development mode - check content of users table.
Route::get('list_all_messages', 'MessagesController@list_all_messages'); // For Development mode - check content of messages table.
Route::get('search', 'SearchController@search');
Route::get('notifications', 'NotificationsController@index'); //TODO: don't forget, armin
Route::post('notificationsRead', 'NotificationsController@setNotificationsToRead');
Route::get('sendnotification', 'NotificationsController@createNotification');
Route::any('sharenotification/{user}', array( 'as' => 'pages.sendNotification', 'uses' => 'NotificationsController@shareNotification'));

//Route::post('sharenotification/{user}', array( 'as' => 'sharenotification', 'uses' => 'NotificationsController@shareNotification'));
Route::resource('messages', 'MessagesController', ['only' => ['index', 'show', 'store']]);


Route::get('code', 'PagesController@code'); //can be removed??

Route::get('statistics', 'StatisticsController@home');


Route::resource('users', 'UsersController');
Route::post('users/{id}/addFriend', 'UsersController@addFriend');
Route::post('users/{id}/removeFriend', 'UsersController@removeFriend');
Route::post('users/{id}/acceptFriend', 'UsersController@acceptFriend');
Route::post('users/{id}/declineFriend', 'UsersController@declineFriend');
Route::get('my_friends', 'UsersController@myFriends');


Route::resource('series', 'SeriesController');
Route::get('seriesSortedByNameASC', 'SeriesController@indexSortedByNameASC');
Route::get('seriesSortedByRatingASC', 'SeriesController@indexSortedByRatingASC');
Route::get('seriesSortedByDifficultyASC', 'SeriesController@indexSortedByDiffASC');
Route::get('seriesSortedBySubjectASC', 'SeriesController@indexSortedBySubASC');
Route::get('seriesSortedByNameDESC', 'SeriesController@indexSortedByNameDESC');
Route::get('seriesSortedByRatingDESC', 'SeriesController@indexSortedByRatingDESC');
Route::get('seriesSortedByDifficultyDESC', 'SeriesController@indexSortedByDiffDESC');
Route::get('seriesSortedBySubjectDESC', 'SeriesController@indexSortedBySubDESC');
Route::get('series/{id}/newexercise', 'SeriesController@createExercise');
Route::post('series/{id}/newexercise', 'SeriesController@storeExercise');
Route::post('series/{id}/storeRating', 'SeriesController@storeRating');
Route::post('series/{id}/referenceexercise', 'SeriesController@storeReference');
Route::post('series/{id}/copyexercise', 'SeriesController@storeCopy');
Route::get('my_series', 'SeriesController@mySeries');


Route::resource('groups', 'GroupsController');
Route::post('groups/{id}/joinGroup', 'GroupsController@join');
Route::post('groups/{id}/leaveGroup', 'GroupsController@leave');
Route::get('groupsSortedByNameASC', 'GroupsController@indexSortedByNameASC');
Route::get('groupsSortedByFounderASC', 'GroupsController@indexSortedByFounderASC');
Route::get('groupsSortedByMCASC', 'GroupsController@indexSortedByMCASC');
Route::get('groupsSortedByNameDESC', 'GroupsController@indexSortedByNameDESC');
Route::get('groupsSortedByFounderDESC', 'GroupsController@indexSortedByFounderDESC');
Route::get('groupsSortedByMCDESC', 'GroupsController@indexSortedByMCDESC');
Route::get('my_groups', 'GroupsController@myGroups');


Route::resource('exercises', 'ExercisesController');
Route::post('exercises/{id}/storeAnswer', 'ExercisesController@storeAnswer');
Route::get('my_exercises', 'ExercisesController@myExercises');
Route::get('exercises/{id}/referenceexercise', 'SeriesController@referenceExercise');
Route::get('exercises/{id}/copyexercise', 'SeriesController@copyExercise');
Route::post('exercises/{id}/referenceexercise', 'SeriesController@storeReference');
Route::post('exercises/{id}/copyexercise', 'SeriesController@storeCopy');

Route::resource('challenges', 'ChallengesController');
Route::get('exercises/{id}/challenge', 'ChallengesController@create');
Route::get('challenge/{uId}/{exId}' , 'ChallengesController@store');

Route::resource('guides', 'GuidesController');


//Authentication related
Route::get('/register', 'UsersController@getRegister');
Route::post('/register', 'UsersController@postRegister');
Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('/login', 'Auth\AuthController@postLogin');
Route::get('/logout', 'Auth\AuthController@getLogout');
Route::get('/email', 'Auth\PasswordController@getEmail');
Route::post('/email', 'Auth\PasswordController@postEmail');
Route::get('/reset', 'Auth\PasswordController@getReset');
Route::post('/reset', 'Auth\PasswordController@postReset');

//Route::get('/twitter/login', 'Auth\AuthController@twitterLogin');
Route::get('/twitter/error', function() {return 'Problem singing in with Twitter.';});

//['as' => 'twitter.login', 
Route::get('/twitter/login', 'Auth\AuthController@twitterLogin');

Route::get('/twitter/callback', ['as' => 'twitter.callback', 'uses' => 'Auth\AuthController@twitterCallback']);

Route::get('/facebook/login', 'Auth\AuthController@facebookLogin');
Route::get('/facebook/callback', 'Auth\AuthController@facebookCallback');
Route::get('/facebook/error', function() {return 'Problem singing in with Facebook.';});


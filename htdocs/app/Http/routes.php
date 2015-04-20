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
Route::get('notifications', function() { return view('pages.notifications'); }); //TODO: don't forget, armin
Route::get('search', 'SearchController@search');

Route::get('code', 'PagesController@code'); //can be removed??

Route::get('statistics', 'StatisticsController@home');


Route::resource('users', 'UsersController');
Route::post('users/{id}/addFriend', 'UsersController@addFriend');
Route::post('users/{id}/removeFriend', 'UsersController@removeFriend');


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
Route::get('series/{id}/referenceexercise', 'SeriesController@referenceExercise');
Route::get('series/{id}/copyexercise', 'SeriesController@copyExercise');
Route::post('series/{id}/newexercise', 'SeriesController@storeExercise');
Route::post('series/{id}/storeRating', 'SeriesController@storeRating');


Route::resource('groups', 'GroupsController');
Route::post('groups/{id}/joinGroup', 'GroupsController@join');
Route::post('groups/{id}/leaveGroup', 'GroupsController@leave');
Route::get('groupsSortedByNameASC', 'GroupsController@indexSortedByNameASC');
Route::get('groupsSortedByFounderASC', 'GroupsController@indexSortedByFounderASC');
Route::get('groupsSortedByMCASC', 'GroupsController@indexSortedByMCASC');
Route::get('groupsSortedByNameDESC', 'GroupsController@indexSortedByNameDESC');
Route::get('groupsSortedByFounderDESC', 'GroupsController@indexSortedByFounderDESC');
Route::get('groupsSortedByMCDESC', 'GroupsController@indexSortedByMCDESC');


Route::resource('exercises', 'ExercisesController');
Route::post('exercises/{id}/storeAnswer', 'ExercisesController@storeAnswer');


Route::resource('messages', 'MessagesController', ['only' => ['index', 'show', 'store']]);


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

Route::get('/login-fb', 'Auth\AuthController@loginFB');

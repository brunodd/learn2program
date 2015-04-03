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
Route::get('code', 'PagesController@code'); //can be removed??
Route::get('notifications', function() { return view('pages.notifications'); }); //TODO: don't forget, armin
Route::get('search', 'SearchController@search');

Route::get('statistics', 'StatisticsController@home');

Route::resource('users', 'UsersController');
Route::post('users/{id}/addFriend', 'UsersController@addFriend');
Route::post('users/{id}/removeFriend', 'UsersController@removeFriend');


Route::patch('series/{id}/edit', 'SeriesController@update');
Route::get('series/{id}/newexercise', 'SeriesController@createExercise');
Route::post('series/{id}/newexercise', 'SeriesController@storeExercise');
Route::post('series/{id}', 'SeriesController@storeRating');
Route::resource('series', 'SeriesController');


Route::patch('groups/{id}/edit', 'GroupsController@update');
Route::post('groups/{id}', 'GroupsController@join');
Route::patch('groups/{id}', 'GroupsController@leave');
Route::resource('groups', 'GroupsController');


Route::post('exercises/{id}', 'ExercisesController@storeAnswer');
Route::resource('exercises', 'ExercisesController');


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


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

Route::get('/', 'PagesController@home');
Route::get('about', 'PagesController@about');
Route::get('list_all_users', 'UsersController@list_all_users'); // For Development mode - check content of users table.
Route::get('code', 'PagesController@code');


Route::post('users/login', 'UsersController@login');
Route::patch('users/{id}/edit', 'UsersController@update');
Route::post('users/{id}', 'UsersController@addFriend');
Route::patch('users/{id}', 'UsersController@removeFriend');
Route::resource('users', 'UsersController');


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


//Authentication related
Route::get('/register', 'Auth\AuthController@getRegister');
Route::post('/register', 'Auth\AuthController@postRegister');
Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('/login', 'Auth\AuthController@postLogin');
Route::get('/logout', 'Auth\AuthController@getLogout');
Route::get('/email', 'Auth\PasswordController@getEmail');
Route::post('/email', 'Auth\PasswordController@postEmail');
Route::get('/reset', 'Auth\PasswordController@getReset');
Route::post('/reset', 'Auth\PasswordController@postReset');


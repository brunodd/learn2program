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

Route::get('/', 'PagesController@home');
Route::get('about', 'PagesController@about');
Route::get('list_all_users', 'UsersController@list_all_users'); // For Development mode - check content of users table.
//Route::get('list_all_groups', 'GroupController@list_all_groups');
Route::get('code', 'PagesController@code');

Route::post('users/login', 'UsersController@login');

Route::patch('users/{id}/edit', 'UsersController@update');
Route::patch('series/{id}/edit', 'SeriesController@update');
Route::patch('groups/{id}/edit', 'GroupsController@update');

Route::post('groups/{id}', 'GroupsController@join');
Route::patch('groups/{id}', 'GroupsController@leave');

Route::get('series/{id}/newexercise', 'SeriesController@createExercise');
Route::post('series/{id}/newexercise', 'SeriesController@storeExercise');


/* Add all routes needed for user. List with:
$ php artisan route:list */
Route::resource('users', 'UsersController');

/* Add all routes needed for s. List with:
$ php artisan route:list */
Route::resource('series', 'SeriesController');

/* Add all routes needed for group. List with:
$ php artisan route:list */
Route::resource('groups', 'GroupsController');

Route::resource('exercises', 'ExercisesController');

Route::get('/register', 'Auth\AuthController@getRegister');
Route::post('/register', 'Auth\AuthController@postRegister');
Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('/login', 'Auth\AuthController@postLogin');
Route::get('/logout', 'Auth\AuthController@getLogout');
Route::get('/email', 'Auth\PasswordController@getEmail');
Route::post('/email', 'Auth\PasswordController@postEmail');
Route::get('/reset', 'Auth\PasswordController@getReset');
Route::post('/reset', 'Auth\PasswordController@postReset');

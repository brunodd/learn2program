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
Route::get('list_all_users', 'UserController@list_all_users'); // For Development mode - check content of users table.
//Route::get('list_all_groups', 'GroupController@list_all_groups');

Route::post('users/login', 'UserController@login');

Route::patch('users/{id}/edit', 'UserController@update');
Route::patch('series/{id}/edit', 'SeriesController@update');
Route::patch('groups/{id}/edit', 'GroupsController@update');

/* Add all routes needed for user. List with:
$ php artisan route:list */
Route::resource('users', 'UserController');

/* Add all routes needed for s. List with:
$ php artisan route:list */
Route::resource('series', 'SeriesController');

/* Add all routes needed for group. List with:
$ php artisan route:list */
Route::resource('groups', 'GroupsController');

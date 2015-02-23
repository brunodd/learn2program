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

Route::post('user/login', 'UserController@login');

Route::patch('user/{id}/edit', 'UserController@update');
Route::patch('serie/{id}/edit', 'SeriesController@update');

/* Add all routes needed for user. List with:
$ php artisan route:list */
Route::resource('user', 'UserController');

/* Add all routes needed for user. List with:
$ php artisan route:list */
Route::resource('serie', 'SeriesController');

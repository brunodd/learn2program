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

Route::get('/twitter/callback', ['as' => 'twitter.callback', function() {
    // You should set this route on your Twitter Application settings as the callback
    // https://apps.twitter.com/app/YOUR-APP-ID/settings
    if (Session::has('oauth_request_token'))
    {
        $request_token = [
            'token'  => Session::get('oauth_request_token'),
            'secret' => Session::get('oauth_request_token_secret'),
        ];

        Twitter::reconfig($request_token);

        $oauth_verifier = false;

        if (Input::has('oauth_verifier'))
        {
            $oauth_verifier = Input::get('oauth_verifier');
        }

        // getAccessToken() will reset the token for you
        $token = Twitter::getAccessToken($oauth_verifier);

        if (!isset($token['oauth_token_secret']))
        {
            return Redirect::route('twitter.login')->with('flash_error', 'We could not log you in on Twitter.');
        }

        $credentials = Twitter::getCredentials();

        if (is_object($credentials) && !isset($credentials->error))
        {
            // $credentials contains the Twitter user object with all the info about the user.
            // Add here your own user logic, store profiles, create new users on your tables...you name it!
            // Typically you'll want to store at least, user id, name and access tokens
            // if you want to be able to call the API on behalf of your users.

            // This is also the moment to log in your users if you're using Laravel's Auth class
            // Auth::login($user) should do the trick.

        	//dd($credentials);
        	$newonee = new App\Repositories\UserRepository();
        	$user = $newonee->findByUsernameOrCreate2($credentials);
			Auth::login($user);

            Session::put('access_token', $token);

            return Redirect::to('/')->with('flash_notice', 'Congrats! You\'ve successfully signed in!');
        }

        return Redirect::route('twitter.error')->with('flash_error', 'Crab! Something went wrong while signing you up!');
    }
}]);

Route::get('/facebook/login', 'Auth\AuthController@facebookLogin');
Route::get('/facebook/callback', 'Auth\AuthController@facebookCallback');
Route::get('/facebook/error', function() {return 'Problem singing in with Facebook.';});


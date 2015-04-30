<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Third Party Services
	|--------------------------------------------------------------------------
	|
	| This file is for storing the credentials for third party services such
	| as Stripe, Mailgun, Mandrill, and others. This file provides a sane
	| default location for this type of information, allowing packages
	| to have a conventional place to find your various credentials.
	|
	*/

	'mailgun' => [
		'domain' => '',
		'secret' => '',
	],

	'mandrill' => [
		'secret' => '',
	],

	'ses' => [
		'key' => '',
		'secret' => '',
		'region' => 'us-east-1',
	],

	'stripe' => [
		'model'  => 'User',
		'secret' => '',
	],

	// FACEBOOK INTEGREATION
	'facebook' => [
		'client_id' => '1639597616273304',
		'client_secret' => '74f870a77d9600f4b3d7973118277c56',
		'redirect' => 'http://localhost:8000/login-fb'
	],

	// TWITTER INTEGRATION
	'twitter' =>[
		'client_id' => getenv('TWITTER_APP_ID'),
		'client_secret' => getenv('TWITTER_APP_SECRET'),
		'redirect' => 'http://localhost:8000/twitter/login',
	],

];

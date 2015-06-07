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

//Route::get('/', 'WelcomeController@index');

Route::get('home', function() {
	return Redirect::to('/');
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

// HomeController
Route::get('/', 'HomeController@index');

// UserController
Route::get('/user/manage', 
	[
		'middleware' => 'auth',
		'uses' => 'UserController@manage'
	]
);

Route::get('/user/stats', 
	[
		'middleware' => 'auth',
		'uses' => 'UserController@stats'
	]
);

// ContentController
Route::get('/content/show/{id}', 
	[
		'middleware' => 'auth',
		'uses' => 'ContentController@showArticle'
	]
);

Route::get('/content/add', 
	[
		'middleware' => 'auth',
		'uses' => 'ContentController@create'
	]
);

Route::post('/content/add',
	[
		'middleware' => 'auth',
		'uses' => 'ContentController@store'
	]
);

Route::get('/content/test', 
	[
		'middleware' => 'auth',
		'uses' => 'ContentController@test'
	]
);

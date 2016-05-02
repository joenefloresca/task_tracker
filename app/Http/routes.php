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

Route::group(['middleware' => 'auth'], function()
{
    Route::get('/', function () {
    	return view('home');
	});

	Route::get('home', function () {
	    return view('home');
	});

	/* Reports Route */
	Route::get('tasks-list', 'TaskController@getTasksList');
	Route::get('daily-tasks-list', 'TaskController@getDailyTasksList');
	Route::get('generate-report', 'TaskController@generateReport');
	Route::get('generate-email', 'TaskController@generateEmail');

});


Route::get('config', function () {
    return view('config');
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::resource('tasks', 'TaskController');

/* Dashboard Route */
Route::get('get-barchart', 'TaskController@getBarChart');
Route::get('get-piechart', 'TaskController@getPieChart');


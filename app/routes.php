<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
/* Closure-based route to landing page
Route::get('/', function()
{
	return View::make('hello');
});
 */

/* Controller based route */
Route::get('/', 'HomeController@showWelcome');

/*
| In Laravel, the simplest route is a route to a Closure:

Route::get('users', function()
{
	return 'Users!';
});

*/
/* Here's a closure that calls the view users.php directly:
Route::get('users', function()
{
	return View::make('users');
});

/* Here's the same thing using a controller instead. */
Route::any('users', 'ListController@userList');

Route::get('user/{slug?}', 'DetailController@userDetail');

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
Route::get('/', array('as' => 'home', 'uses' => 'HomeController@showWelcome'));

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
/*
Route::any('users', 'UserController@index');

Route::get('users/{slug?}', 'UserController@show');
*/

/* Spelling out crud op/route mapping by hand here is clear, but seems
|  like it could get unwieldy:
|----------------------------------------------------------------------
|mitch@Filmore:~/Projects/php-projects/laravel-firstapp$ php artisan routes
+--------+-------------------+-------------------+----------------------------+----------------+---------------+
| Domain | URI               | Name              | Action                     | Before Filters | After Filters |
+--------+-------------------+-------------------+----------------------------+----------------+---------------+
|        | GET /             |                   | HomeController@showWelcome |                |               |
|        | GET users         |                   | UserController@index       |                |               |
|        | GET users/{slug?} |                   | UserController@show        |                |               |
+--------+-------------------+-------------------+----------------------------+----------------+---------------+
*/

/* Route::resource('user', 'UserController');
	                array('only' => array('index', 'show'))); */

/* Route::Resource() gives a complete Rails-like set of CRUD routes, a subset of which can be chosen with the "only" param,
 * but, it's a bit odd because it sure seems like the route to user.store ought to be "POST user/{user}" right?
| -------------------------------------------------------------------------------------------------------------------------
| mitch@Filmore:~/Projects/php-projects/laravel-firstapp$ php artisan route
+--------+----------------------+-------------------+----------------------------+----------------+---------------+
| Domain | URI                  | Name              | Action                     | Before Filters | After Filters |
+--------+----------------------+-------------------+----------------------------+----------------+---------------+
|        | GET /                |                   | HomeController@showWelcome |                |               |
|        | GET user             | user.index        | UserController@index       |                |               |
|        | GET user/create      | user.create       | UserController@create      |                |               |
|        | POST user            | user.store        | UserController@store       |                |               |
|        | GET user/{user}      | user.show         | UserController@show        |                |               |
|        | GET user/{user}/edit | user.edit         | UserController@edit        |                |               |
|        | PUT user/{user}      | user.update       | UserController@update      |                |               |
|        | PATCH user/{user}    |                   | UserController@update      |                |               |
|        | DELETE user/{user}   | user.destroy      | UserController@destroy     |                |               |
+--------+----------------------+-------------------+----------------------------+----------------+---------------+
|
|  There is also a Route::Controller() method with a good explanation of it here:
|  http://stackoverflow.com/questions/18402298/laravel-4-defining-restful-controllers
|  which references an article by Phil Sturgeon, advocating building routes by hand here:
|  http://philsturgeon.co.uk/blog/2013/07/beware-the-route-to-evil
 */

/* Standard REST API to User */
Route::get('user', array('as' => 'user.index', 'uses' => 'UserController@index'));
Route::get('user/create', array('as' => 'user.create', 'uses' => 'UserController@create'));
Route::get('user/{id}', array('as' => 'user.show', 'uses' => 'UserController@show'));
Route::post('user/{id}', array('as' => 'user.store', 'uses' => 'UserController@store'));
Route::get('user/{id}/edit', array('as' => 'user.edit', 'uses' => 'UserController@edit'));
Route::put('user/{id}', array('as' => 'user.update', 'uses' => 'UserController@update'));
Route::patch('user/{id}', 'UserController@update');
Route::delete('user/{id}', array('as' => 'user.destroy', 'uses' => 'UserController@destroy'));

/* Additional User Actions */
Route::group(["before" => "guest"], function()
{
	Route::any('login', array('as' => 'user.login', 'uses' => 'UserController@loginAction'));
	Route::any('request-password-reset', array('as' => 'user.request', 'uses' => 'UserController@requestAction'));
	Route::any('reset-password', array("as" => 'user.reset', 'uses' => 'UserController@resetAction'));
});

Route::group(["before" => "auth"], function()
{
	Route::any('profile', array('as' => 'user.profile', 'uses' => 'UserController@profileAction'));
	Route::any('lofout', array('as' => 'user.logout', 'uses' => 'UserController@logoutAction'));
});

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

Route::resource('users', 'UserController');
/*	                array('only' => array('index', 'show'))); */

/* Route::Resource() gives a complete Rails-lise set of CRUD routes, a subset of which can be chosen with the "only" param:
| -------------------------------------------------------------------------------------------------------------------------
| mitch@Filmore:~/Projects/php-projects/laravel-firstapp$ php artisan routes
+--------+------------------------+---------------------+----------------------------+----------------+---------------+
| Domain | URI                    | Name                | Action                     | Before Filters | After Filters |
+--------+------------------------+---------------------+----------------------------+----------------+---------------+
|        | GET /                  |                     | HomeController@showWelcome |                |               |
|        | GET users              | users.index         | UserController@index       |                |               |
|        | GET users/create       | users.create        | UserController@create      |                |               |
|        | POST users             | users.store         | UserController@store       |                |               |
|        | GET users/{users}      | users.show          | UserController@show        |                |               |
|        | GET users/{users}/edit | users.edit          | UserController@edit        |                |               |
|        | PUT users/{users}      | users.update        | UserController@update      |                |               |
|        | PATCH users/{users}    |                     | UserController@update      |                |               |
|        | DELETE users/{users}   | users.destroy       | UserController@destroy     |                |               |
+--------+------------------------+---------------------+----------------------------+----------------+---------------+
|
|  There is also a Route::Controller() method with a good explanation of it here:
|  http://stackoverflow.com/questions/18402298/laravel-4-defining-restful-controllers
|  which references an article by Phil Sturgeon, advocating building routes by hand here:
|  http://philsturgeon.co.uk/blog/2013/07/beware-the-route-to-evil
 */


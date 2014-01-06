<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

App::error(function(ModelNotFoundException $e)
{
	return Response::make('Not Found', 404);
});

class UserController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default User Controller
	|--------------------------------------------------------------------------
	|
	| GET user           | user.index      | UserController@index
	| GET user/create    | user.create     | UserController@create
	| GET user/{id}      | user.show       | UserController@show
	| POST user/{id}     | user.store      | UserController@store
	| GET user/{id}/edit | user.edit       | UserController@edit
	| PUT user/{id}      | user.update     | UserController@update
	| PATCH user/{id}    |                 | UserController@update
	| DELETE user/{id}   | user.destroy    | UserController@destroy
	|
	*/

	public function index()
	{
		$users = User::all();
		return View::make('users')->with('users', $users);
	}

	public function create()
	{
		return View::make('create_user_form'); //->with('user', $user);
	}

	public function show($id = Null)
	{
		$user = User::find($id);
		return View::make('user', array('user' => $user));
	}
	
	public function store()
	{
		$user = User::create(Input::all());
		if($user->id)
		{
			return Redirect::route('user.index')->with('flash', 'The new user has been created');
		}
		
		return Redirect::route('user.create')->withInput()->withErrors($s->errors());
	}

	public function edit($id)
	{
		$user = User::where('id', '=', $id)->firstOrFail();
		return View::make('update_user_form')->with('user', $user);
	}

	public function update($id)
	{
		$user = User::find($id);
		$user::update(Input::all());
		return Redirect::route('user.index')->with('flash', 'The new user has been updated.');
	}

} 

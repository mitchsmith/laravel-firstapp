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
	|
	*/

	public function index()
	{
		$users = User::all();
		return View::make('users')->with('users', $users);
	}


	public function show($slug = Null)
	{
		$user = User::where('name','LIKE',$slug)->firstOrFail();
		return View::make('user', array('slug' => $slug, 'user' => $user));
	}
	
	
} 

<?php

class UserController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default User Controller
	|--------------------------------------------------------------------------
	|
	|
	*/

	public function getIndex()
	{
		$users = User::all();
		return View::make('users')->with('users', $users);
	}


	public function getUser($slug = 'test_user')
	{
		return View::make('user', array('slug' => $slug));
	}
} 

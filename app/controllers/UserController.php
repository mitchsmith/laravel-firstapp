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
		return View::make('users');
	}


	public function getUser($slug = 'test_user')
	{
		return View::make('user', array('slug' => $slug));
	}
} 

<?php

class DetailController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Controller for any entity detail page
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|
	*/

	public function userDetail($slug = 'test_user')
	{
		return View::make('user', array('slug' => $slug));
	}

}

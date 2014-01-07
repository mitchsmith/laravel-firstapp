<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\MessageBag;

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

	/* Standard REST API to User */
	public function index()
	{
		$users = User::all();
		return View::make('user/users')->with('users', $users);
	}

	public function create()
	{
		return View::make('user/create_user_form'); //->with('user', $user);
	}

	public function show($id = Null)
	{
		$user = User::find($id);
		return View::make('user/user', array('user' => $user));
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
		return View::make('user/update_user_form')->with('user', $user);
	}

	public function update($id)
	{
		$user = User::find($id);
		$user::update(Input::all());
		return Redirect::route('user.index')->with('flash', 'The new user has been updated.');
	}

	/* Additional User Actions */

	/* User Login */
	public function loginAction()
	{
 		$errors = new MessageBag();

         	if ($old = Input::old("errors"))
		{
			$errors = $old;
		}

		$data = [
			"errors" => $errors
		];

		if (Input::server("REQUEST_METHOD") == "POST")
		{
			$validator = Validator::make(Input::all(), [
				"username" => "required",
				"password" => "required"
			]);

			if ($validator->passes())
			{
				$credentials = [
					"username" => Input::get("username"),
					"password" => Input::get("password")
				];

				 if (Auth::attempt($credentials))
				 {
				 	return Redirect::route("user.profile");
				 }
			}

			$data["errors"] = new MessageBag([
				"password" => ["Invalid username or password."]
			]);

			$data["username"] = Input::get("username");

			return Redirect::route("user.login")->withInput($data);
		}

		return View::make("user/login_form", $data);
	}
	
	/* User Logout  */
	public function logoutAction()
	{
		Auth::logout();
		return Redirect::route("user.login");
	}

	/* Request a password reset */
	public function requestAction()
	{
		$data = [
			"requested" => Input::old("requested")
		];

		if (Input::server("REQUEST_METHOD") == "POST")
		{
			$validator = Validator::make(Input::all(), [
				"email" => "required"
			]);

			if ($validator->passes())
			{
				$credentials = [
					"email" => Input::get("email")
				];

				Password::remind($credentials,
					function($message, $user)
					{
						$message->from("chris@example.com");
					}
				);

				$data["requested"] = true;

				return Redirect::route("user.request")->withInput($data);
			}
		}

		return View::make("user.request", $data);
	}
        
	/* Process a password reset request */
	public function resetAction()
	{
		$token = "?token=" . Input::get("token");

		$errors = new MessageBag();

		if ($old = Input::old("errors"))
		{
			$errors = $old;
		}

		$data = [
			"token"  => $token,
			"errors" => $errors
		];

		if (Input::server("REQUEST_METHOD") == "POST")
		{
			$validator = Validator::make(Input::all(), [
				"email" => "required|email",
				"password" => "required|min:6",
				"password_confirmation"	=> "same:password",
				"token" => "exists:token, token"
			]);

			if ($validator->passes())
			{
				$credentials = [
					"email" => Input::get("email")
				];

				Password::reset($credentials,
					function($user, $password)
					{
						$user->password = Hash::make($password);
						$user->save();

						Auth::login($user);

						return Redirect::route("user.profile");
					}
				);
			}

			$data["email"] = Input::get("email");
			$data["errors"] = $validator->errors();

			return Redirect::to(URL::route("user.reset") . $token)->withInput($data);
		}

		return View::make("user.reset", $data);
	}

	/* User Profile Actions */
	public function profileAction()
	{
		return View::make("user/profile");
	}


}

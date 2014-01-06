<?php

class UserSeeder
extends DatabaseSeeder
{
	public function run()
	{
		$users = [
			[
				"username" => "mitch",
				"password" => Hash::make("changeme"),
				"email"    => "mitch@example.com"
			]
		];

		foreach ($users as $user)
		{
			User::create($user);
		}
	}
}

@extends('layout')

@section('content')

<div>
	<h1>List of Users</h1>
	<p></p>
    @foreach($users as $user)
        <p><a href="{{ URL::action('UserController@show', $user->id) }}">{{ $user->username }}</a> <a class="edit-button" href="{{ URL::action('UserController@edit', $user->id) }}">Edit</a></p>
    @endforeach

</div>
<!-- // @stop

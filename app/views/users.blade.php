@extends('layout')

<div>
	<h1>List of Users</h1>
	<p></p>
@section('content')
    @foreach($users as $user)
        <p>{{ $user->name }}</p>
    @endforeach
</div>
@stop

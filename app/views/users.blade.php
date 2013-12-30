@extends('layout')

@section('content')

<div>
	<h1>List of Users</h1>
	<p></p>
    @foreach($users as $user)
        <p>{{ $user->name }}</p>
    @endforeach

</div>
@stop

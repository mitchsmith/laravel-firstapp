@extends('layout')

@section('content')
<div class="welcome">
<h2>Edit User Info</h2>

{{ Form::open(array('url' => 'user/' . $user->id, 'method' => 'put')) }}

{{ Form::label('name', 'Name') . Form::text('name', $user->username) }}
{{ Form::label('email', 'E-mail') . Form::text('email', $user->email) }}

{{ Form::submit('Save') }}

{{ Form::token() . Form::close() }}
@stop;
</div>

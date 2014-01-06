@extends('layout')

@section('content')
<div class="welcome">
<h2>Register!</h2>

{{ Form::open(array('route' => 'user.create')) }}

{{ Form::label('name', 'Name') . Form::text('name', Input::old('name')) }}
{{ Form::label('email', 'E-mail') . Form::text('email', Input::old('email')) }}

{{ Form::submit('Register!') }}

{{ Form::token() . Form::close() }}
@stop

</div>

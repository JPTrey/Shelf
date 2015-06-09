@extends('app')
@section('title') Settings @stop

@section('content')

<form action="/user/settings" method="POST">

	<input name="hide-scrollbar" type="checkbox" checked="{{$hideScrollbar}}"></input>
	<label for="hide-scrollbar">Hide the scrollbar when reading articles</label>

	<label for="read-speed">My read speed (words per second)</label>
	<input type="range" name="read-speed" min="1" max="10" value="{{$readSpeed}}">

	<input name="auto-read-speed" type="checkbox" checked="{{$autoReadSpeed}}"></input>
	<label>Analyse my reading speed whenever I mark an article complete</label>

	<input name="show-completed" type="checkbox" checked="{{$showCompleted}}"></input>
	<label>Show completed articles on my Shelf</label>

	<input type="submit" value="Submit">

</form>

@stop

@stop
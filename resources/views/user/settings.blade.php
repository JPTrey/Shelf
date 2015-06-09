@extends('app')
@section('title') TEST @stop
@section('pre-scripts') <link rel="stylesheet" type="text/css" href="{{url('/css/style.css')}}"> @stop

@section('content')

<style type="text/css">
	body {
		margin-top: 70px;
	}

</style>

<div class='container'>

	<h1>My Settings</h1>
	<div class="row">
		<div class="col-sm-6">
		<form action="/user/settings" method="POST">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<input name="hide-scrollbar" type="checkbox" checked="{{$hideScrollbar}}"></input>
			<label for="hide-scrollbar">Hide the scrollbar when reading articles</label>
			<br>
			<label for="read-speed">My read speed (words per second)</label>
			<input type="range" name="read-speed" min="1" max="10" value="{{$readSpeed}}">
			<br>
			<input name="auto-read-speed" type="checkbox" checked="{{$autoReadSpeed}}"></input>
			<label>Analyse my reading speed whenever I mark an article complete</label>
			<br>
			<input name="show-completed" type="checkbox" checked="{{$showCompleted}}"></input>
			<label>Show completed articles on my Shelf</label>
			<br>
			<input type="submit" value="Submit">

		</form>
		</div>
	</div>
	
</div>

@stop
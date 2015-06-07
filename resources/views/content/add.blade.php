@extends('app')
@section('title') Add an article @stop

@section('content')

<div class="container">
	<div class="row">
		<h2>Add to List</h2>
		{!! Form::open(['url' => '/content/add']) !!}
		
		{!! Form::label('url', 'URL link') !!}
		{!! Form::text('url', '', ['placeholder' => 'e.g. "http://www.nytimes.com/2011/01/24/technology/24music.html?_r=2"']) !!}	
		<br>
		{!! Form::label('title', 'Title') !!}
		{!! Form::text('title', '', ['placeholder' => '(optional)']) !!}
		<br>
		{!! Form::checkbox('check-media', true, ['checked' => 'true', 'hidden' => 'true']) !!}		
		{!! Form::label('check-media', 'Include photo and video content') !!}
		<br>
		{!! Form::submit('Add', ['class' => 'btn btn-primary']) !!}
		{!! Form::close() !!}
	</div>
</div>

@stop
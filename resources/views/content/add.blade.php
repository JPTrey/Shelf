<style type="text/css">
	input[type=text] {
		width: 250px;
	}
</style>

<div class="container">

		<h2>Add to List</h2>
		{!! Form::open(['url' => '/content/add']) !!}
		
		{!! Form::text('url', '', ['placeholder' => 'URL e.g. "http://www.nytimes.com/2011/01/24/technology/24music.html?_r=2"']) !!}	
		<br>
		{!! Form::text('title', '', ['placeholder' => 'Title (optional)']) !!}
		<br>
		{{--!! Form::checkbox('check-media', true, ['checked' => 'true', 'hidden' => 'true']) !!--}}		
		{{--!! Form::label('check-media', 'Include photo and video content') !!--}}
		<br>
		{!! Form::submit('Add', ['class' => 'btn btn-primary']) !!}
		{!! Form::close() !!}
</div>
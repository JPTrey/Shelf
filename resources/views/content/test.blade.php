@extends('app')
@section('title') TEST @stop
@section('pre-scripts') <link rel="stylesheet" type="text/css" href="{{url('/css/style.css')}}"> @stop

@section('content')

<div class="container">
	<h1 class="text-center">{{$title}}</h1>
	<div class="row">
		<div class="col-md-9">
			@foreach ($text as $element)
			<?php echo $element ?>
			@endforeach
		</div>		
		<div class="col-md-3">
			<h4>Toolbar</h4>
		</div>
	</div>
</div>

@stop
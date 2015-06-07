@extends('app')
@section('title') Viewing Article <?php echo $article->name ?> @stop

@section('pre-scripts') 

<link rel="stylesheet" type="text/css" href="{{url('/css/style.css')}}"> 
<link rel="stylesheet" type="text/css" href="{{url('/css/jquery.sidr.dark.css')}}">
@stop

<style type="text/css">
	html, body {
	 	overflow: hidden;
	}

	#content {
		position: absolute;
		left: 0;
		top: 50;
		right: -30px;
		bottom: 0;	
		padding-right: 15px;
		overflow-y: scroll;
	}

	h1 {
		padding: 10px 0 50px 0;
		font-family: helvetica;
		border-bottom: 2px solid black;
	}

	p {
		font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;
	}

	body {
		background: url("{{url('/img/Melamine-wood-001.png')}}");
	}


	#text {
		border: 1px ridge gray;
		box-shadow: 10px 10px 5px #888888;
		background: white;
		margin-bottom: 20px;
		padding: 5% 5% 10% 5%;
	}

	#toolbar {
		padding-top: 10px;
		font-family: arial;

	}

	#bigger-font, #smaller-font {
		width: 40%;
		clear: none;
		display: inline-block;
		text-align: center;
	}

	#font-controls {
		margin: 0 0 10px 10%;
	}

</style>

@section('content')


<div id="content" class="container-fluid">

	<div class="row">
		<div id="toolbar" class="col-sm-2 pull-right">
			<div id="font-controls">	
				<a class="btn btn-default" id="bigger-font"><span class="glyphicon glyphicon-zoom-in"></span></a>
				<a class="btn btn-default" id="smaller-font"><span class="glyphicon glyphicon-zoom-out"></span></a>
	    	</div>
	    	<a class="btn btn-default btn-block" href="{{url('/')}}"><span class="glyphicon glyphicon-chevron-left"></span> Back to Article List</a>
			<a class="btn btn-primary btn-block" href="{{url('/')}}"><span class="glyphicon glyphicon-tag"></span> Bookmark this Page</a>
			<a class="btn btn-success btn-block" href="{{url('/')}}"><span class="glyphicon glyphicon-check"></span> Mark as Read</a>
			<a class="btn btn-danger btn-block" href="{{url('/')}}"><span class="glyphicon glyphicon-remove"></span> Delete</a>
		</div>
		<div id="text" class="col-md-9 col-md-offset-1">
		<h1 class="text-center"><?php echo $article->name ?></h1>
			<?php echo $article->content ?>
		</div>		
	</div>
</div>

@section('post-scripts')
<script type="text/javascript">
(function($) {
	$(document).ready(function() {
		$('#bigger-font').click(function() {
			$('#smaller-font').removeClass("disabled");

			var font_size = parseInt($('#text').css('font-size'));
			font_size += 2;
			if (font_size >= 48) {
				font_size = 48;
				$('#bigger-font').addClass("disabled");
			}
			$('#text').css('font-size', font_size + "px");
		});

		$('#smaller-font').click(function() {
			$('#bigger-font').removeClass("disabled");

			var font_size = parseInt($('#text').css('font-size'));
			font_size -= 2;
			if (font_size <= 8) {
				font_size = 8;
				$('#smaller-font').addClass("disabled");
			}
			$('#text').css('font-size', font_size + "px");
		});
	});
})(jQuery);

</script>
@stop

@stop
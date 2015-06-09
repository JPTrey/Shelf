@extends('app')
@section('title') My Shelf @stop

@section('content')

<style type="text/css">
	body {
		margin-top: 50px;
	}
	
	.article-link {
		color: #888888;
	}

	.article-block:hover {
		background-color: #CEE0DF;
	}

	.article-block {
		box-shadow: 5px 5px 2px #888888;
		margin-bottom: 10px;
	}

	.article-block-complete {
		box-shadow: 5px 5px 2px #888888;
		margin-bottom: 10px;
		color: #B8BFBE;
	}

	.section-title {
		border-bottom: 1px solid #FAFAFA;
	}

	.sidebar {
		font-family: helvetica;
		font-size: .5em;
	}

	#shelf-banner {
		font-size: 6em;
	}
</style>

<div class="container">
	<div class="row" id="heading">
		<div class="col-sm-9">
			<h1 class="text-center" id="shelf-banner">My Shelf ({{$unreadCount}} unread)</h1>
		</div>
		<div class="col-sm-3">
			@include('content.add')
		</div>
	</div>

	@if (sizeof($articles) > 0)

		@if (isset($lengths['instant']))
		<div class="row"> <!-- ROW 1 min -->
			<h1 class="section-title">Instant Reads <span class="sidebar">(less than a minute)</span></h1>
			<!-- <hr> -->
			@foreach ($articles['instant'] as $article)
				<a class="article-link" href="{{url('/content/show/' . $article->id)}}">
					<div class="col-sm-8 article-block">
						<h4 class="article-name">{{ $article->name }}</h4>
						<p class="read-speed">{{ ceil($article->word_count / $user->words_per_minute) }} min</p>
					</div>
				</a>
			@endforeach
		</div> <!-- END ROW 1 min -->
		@endif

		@if (isset($lengths['short']))
		<div class="row"> <!-- ROW 5 min -->
			<h1 class="section-title">Short Articles <span class="sidebar">(less than 5 minutes)</span></h1>
			<!-- <hr> -->
			@foreach ($articles['short'] as $article)
				<a class="article-link" href="{{url('/content/show/' . $article->id)}}">
					<div class="col-sm-8 article-block">
						<h4 class="article-name">{{ $article->name }}</h4>
						<p class="read-speed">{{ ceil($article->word_count / $user->words_per_minute) }} min</p>
					</div>
				</a>
				
			@endforeach
		</div> <!-- END ROW 5 min -->
		@endif

		@if (isset($lengths['in-depth']))
		<div class="row"> <!-- ROW 20 min -->
			<h1 class="section-title">In-depth <span class="sidebar">(less than 20 minutes)</span></h1>
			<!-- <hr> -->
			@foreach ($articles['in-depth'] as $article)
				<a class="article-link" href="{{url('/content/show/' . $article->id)}}">
					<div class="col-sm-8 article-block">
						<h4 class="article-name">{{ $article->name }}</h4>
						<p class="read-speed">{{ ceil($article->word_count / $user->words_per_minute) }} min</p>
					</div>
				</a>	
				
			@endforeach
		</div> <!-- END ROW 20 min -->
		@endif

		@if (isset($lengths['lengthy']))
		<div class="row"> <!-- ROW 1 hr -->
			<h1 class="section-title">Lengthy <span class="sidebar">(less than an hour)</span></h1>
			<!-- <hr> -->
			@foreach ($articles['lengthy'] as $article)
				<a class="article-link" href="{{url('/content/show/' . $article->id)}}">
					<div class="col-sm-8 article-block">
						<h4 class="article-name">{{ $article->name }}</h4>
						<p class="read-speed">{{ ceil($article->word_count / $user->words_per_minute) }} min</p>
					</div>
				</a>
			@endforeach
		</div> <!-- END ROW 1 hr -->
		@endif

		@if (isset($lengths['long']))
		<div class="row"> <!-- ROW long -->
			<h1 class="section-title">Books and Texts <span class="sidebar">(over an hour)</span></h1>
			<!-- <hr> -->
			@foreach ($articles['long'] as $article)
				<a class="article-link" href="{{url('/content/show/' . $article->id)}}">	
					<div class="col-sm-8 article-block">
						<h4 class="article-name">{{ $article->name }}</h4>
						<p class="read-speed">{{ ceil(($article->word_count / $user->words_per_minute) / 60) }} hrs</p>
					</div>
				</a>
			@endforeach
		</div> <!-- END ROW long -->
		@endif

		@if (isset($articles['complete']))
		<div class="row"> <!-- ROW completed -->
			<h1 class="section-title">Completed</h1>
			<!-- <hr> -->
			@foreach ($articles['complete'] as $article)
				<a class="article-link" href="{{url('/content/show/' . $article->id)}}">	
					<div class="col-sm-8 article-block-complete">
						<h4 class="article-name">{{ $article->name }}</h4>
						<p class="read-speed">{{ ceil(($article->word_count / $user->words_per_minute) / 60) }} hrs</p>
					</div>
				</a>
			@endforeach
		</div> <!-- END ROW long -->
		@endif

	@else
	<h1 id="no-articles">You don't have any articles saved.  Click <a>here</a> to add.</h1>	

	@endif

</div>

@stop
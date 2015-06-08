<?php namespace Shelf\Http\Controllers;

use Shelf;
use Input;
use DB;
use Auth;
use Shelf\Http\Requests;
use Shelf\Http\Controllers\Controller;
use Sunra\PhpSimple\HtmlDomParser;
use Illuminate\Http\Request;

class ContentController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
	}
	
	public function showArticle($article_id)
	{
		$article;
		$estimate;
		$bookmark = 0;
		
		// get article
		$article = Article::findOrFail($article_id);
		
		// // get bookmark, if present
		// $bookmark_id = DB::table('bookmarks')->where
		// 	(
		// 		'article_id', $article_id,
		// 		'user_id', Auth::user()->id
		// 	)
		// 	->first();
		// if (isset($bookmark_id))
		// {
		// 	$bookmark = Shelf\Bookmark::find($bookmark_id);
		// }

		// $estimate = ceil(($article->word_count - $bookmark->word_count) / Auth::user()->words_per_minute);	
		
		// return view('content.article', 
		// 	[
		// 		'article' => $article,
		// 		'estimate' => $estimate,
		// 		'bookmark' => $bookmark
		// 	]
		// );

		return view('content.article',
			[
				'article' => $article,
			]
		);
	}
	
	public function showVideo($video_id)
	{
		return 'Video playback is not supported in this build.';
	}

	public function test() 
	{
		// $url = 'http://www.giantbomb.com/articles/koji-igarashi-s-mysterious-new-project-is-bloodsta/1100-5201/';
		// $url = 'http://www.nytimes.com/2012/01/26/business/ieconomy-apples-ipad-and-the-human-costs-for-workers-in-china.html?_r=4&adxnnl=1&pagewanted=all&adxnnlx=1343278804-Bu4FYq6zJLZ6t2Zo/v46jQ&';
		// $url = url('/views/nytimes.html');
		// $url = 'http://www.tested.com/tech/529355-testing-ares-quadcopter-accessories/';
		// $url = 'https://www.fanfiction.net/s/4943848/3/The-Heart-Never-Lies';
		$url = 'https://www.fanfiction.net/s/4219558/1/Level-Up-Love';
		// $url = 'http://www.bbc.com/sport/0/football/32982449';
		$dom = HtmlDomParser::file_get_html($url);

		// $text = $this->getText($dom);

		$title = $dom->find('title');
		$text = $this->getText($dom);

		if (sizeof($text) == 0)
		{
			return "NULL!";
		}
		else 
		{
			$has_tags = true;	
			$article = new Shelf\Article;
			$article->content = $text;
			return view('content.article', 
				[
					'article' => $article,
					'title' => $title[0]->plaintext,
					'has_tags' => $has_tags
				]
			);
		}
	}

	/**
	 * GET: /article/add
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('content.add');
	}

	/**
	 * POST: /article/add
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		echo "storing article: " . Input::get('url');
		
		$article = new Shelf\Article;
		
		echo "\narticle Model loaded";
		$article->url = Input::get('url');
		$article->user_id = Auth::user()->id;
		$dom = HtmlDomParser::file_get_html($article->url);
		echo "\nDOM loaded";
		$text = $this->getText($dom);
		echo "\ntext loaded";

		if (Input::get('check-media'))
		{
			$content = '';
			foreach ($text as $word) 
			{
				$content .= $word;
			}

			$article->content = $content;
		}

		else
		{
			$article->content = $text[0]->plaintext;
		}

		if (Input::get('title') != null) 
		{
			$article->name = Input::get('title');
		}
		else 
		{
			$title = $dom->find('title');
			$article->name = $title[0]->plaintext;
		}

		$article->word_count = str_word_count($article->content);
		$article->was_read = false;
		
		echo "\n saving article...";
		$article->save();
		echo "done!";

		// remove excess tags
		// get site_id

		return redirect('/');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	private function getText($dom) 
	{

		if (sizeof($dom->find('*[class=story-body-text]')))
		{
			return $dom->find('*[class=story-body-text]');
		}
		
		else if (sizeof($dom->find('*[class=story-body]')))
		{
			return $dom->find('*[class=story-body]');
		}


		else if (sizeof($dom->find('*[class=article-body]')))
		{
			return $dom->find('*[class=article-body]');
		}

		else if (sizeof($dom->find('*[id=storytext]')))
		{
			return $dom->find('*[id=storytext]');
		}

		else if (sizeof($dom->find('*[id=printdetail]')))
		{
			return $dom->find('*[id=printdetail]');
		}

		else if (sizeof($dom->find('*[role=main]')))
		{
			return $dom->find('*[role=main]');
		}

		else if (sizeof($dom->find('article')))
		{
			return $dom->find('article');
		}




		// if (sizeof($dom->find('*[role=main]')))
		// {
		// 	return $dom->find('*[role=main]');
		// }

		// else if (sizeof($dom->find('article')))
		// {
		// 	return $dom->find('article');
		// }

		// else if (sizeof($dom->find('div[class=story-body]')))
		// {
		// 	return $dom->find('div[class=story-body]');
		// }

		// else if (sizeof($dom->find('p[class=story-body-text]')))
		// {
		// 	return $dom->find('p[class=story-body-text]');
		// }

		// else if (sizeof($dom->find('section[class=article-body]')))
		// {
		// 	return $dom->find('section[class=article-body]');
		// }

		// else if (sizeof($dom->find('div[id=storytext]')))
		// {
		// 	return $dom->find('div[id=storytext]');
		// }

		// else if (sizeof($dom->find('div[id=printdetail]')))
		// {
		// 	return $dom->find('div[id=printdetail]');
		
		
		else 
		{
			return $dom->find('h1, h2, h3, h4, h5, h6, span, p');
		}
	}
}

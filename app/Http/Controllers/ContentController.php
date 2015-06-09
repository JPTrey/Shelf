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
		echo "fetching model...";
		
		// get article
		$article = Shelf\Article::findOrFail($article_id);
		
		echo "article found!";
		
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
		
		echo "loading view...";
		
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

		
			$content = '';
			foreach ($text as $word) 
			{
				$content .= $word;
			}

			$article->content = $content;
		

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
		$article = Shelf\Article::findOrFail($id);
		$article->delete();

		return redirect('/');
	}

	/**
	 * Move the specified resource to 'Completed'.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function markRead($id) 
	{
		$article = Shelf\Article::findOrFail($id);
		$article->was_read = true;
		$article->save();

		return redirect('/');

	}

	private function getText($dom) 
	{

		if (sizeof($dom->find('*[id=storytext]')))
		{
			return $dom->find('*[id=storytext]');
		}

		else if (sizeof($dom->find('*[class=story-body-text]')))
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
		
		else 
		{
			return $dom->find('h1, h2, h3, h4, h5, h6, span, p');
		}
	}
}

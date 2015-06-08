<?php namespace Shelf\Http\Controllers;

use Shelf\Article;
use Shelf\User;
use Auth;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	// sorts articles based on word count (ascending)
	private function compareArticles($a, $b) 
	{
		if ($a->word_count == $b->word_count)
		{
			return 0;
		}

		return ($a->word_count > $b->word_count) ? +1 : -1;
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Auth::check()) // if: logged in, show article list
		{
			$user = User::findOrFail(Auth::user()->id);
			$myArticles = Article::where('user_id', $user->id)->orderBy('word_count')->get();

			// divide articles into lengths
			$articles = [];
			$hasLengths = [];

			foreach ($myArticles as $item) 
			{
				if (($item->word_count / $user->words_per_minute) <= 1)
				{
					$articles['instant'][] = $item;
					$hasLengths['instant'] = true;
				}

				else if (($item->word_count / $user->words_per_minute) <= 5)
				{
					$articles['short'][] = $item;
					$hasLengths['short'] = true;
				}

				else if (($item->word_count / $user->words_per_minute) <= 20)
				{
					$articles['in-depth'][] = $item;
					$hasLengths['in-depth'] = true;
				}

				else if (($item->word_count / $user->words_per_minute) <= 60)
				{
					$articles['lengthy'][] = $item;
					$hasLengths['lengthy'] = true;
				}

				else if (($item->word_count / $user->words_per_minute) > 60)
				{
					$articles['long'][] = $item;
					$hasLengths['long'] = true;
				}

				else {
					continue;
				}
			}

			// foreach ($articles as $key => $value)
			// {
			// 	echo $key;
			// 	echo $value;
			// }


			return view('index', 
				[
					'articles' => $articles,
					'user' => $user,
					'lengths' => $hasLengths
				]
			);
		}
		
		// else: show welcome screen
		return view('welcome');
	}


}

<?php namespace Shelf\Http\Controllers;

use Auth;
use Shelf\Http\Requests;
use Shelf\Http\Controllers\Controller;

use Illuminate\Http\Request;

class UserController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function manage()
	{
		return view('manage');
	}
	
	public function stats() 
	{
		return view('statistics');
	}
	
	public function settings() 
	{
		return "preparing settings page";

		$user = Auth::user();
		
		$hideScrollbar = $user->hideScrollbar;
		$readSpeed = ceil($user->words_per_minute / 60);
		$autoReadSpeed = $user->autoReadSpeed;
		$showCompleted = $user->showCompleted;

		return view('settings', 
			[
				'hideScrollbar' => $hideScrollbar,
				'readSpeed' => $readSpeed,
				'autoReadSpeed' => $autoReadSpeed,
				'showCompleted' => $showCompleted
			]
		);
	}

	public function updateSettings() 
	{
		$user->Auth::user();

		$user->hideScrollbar = Input::get('hide-scrollbar');
		$user->words_per_minute = Input::get('read-speed') * 60;
		$user->autoReadSpeed = Input::get('auto-read-speed');
		$user->showCompleted = Input::get('showCompleted');

		$user->save();

		return redirect('/');

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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

}

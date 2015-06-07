<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Initial extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('articles', function(Blueprint $newtable) {
			$newtable->increments('id');
			$newtable->string('site_id');
			$newtable->string('user_id');
			$newtable->string('name');
			$newtable->text('content');
			$newtable->integer('word_count')->unsigned();
			$newtable->boolean('was_read');
			$newtable->timestamp();
		});
		
		Schema::create('sites', function(Blueprint $newtable) {
			$newtable->increments('id');
			$newtable->string('user_id');
			$newtable->string('name');
			$newtable->string('section');
			$newtable->smallInteger('read_count')->unsigned();
			$newtable->timestamp();
		});

		Schema::create('bookmarks', function (Blueprint $table) {
			$table->increments('id');
			$table->string('user_id');
			$table->string('article_id');
			$table->integer('at_word')->unsigned();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('articles');
		Schema::drop('sites');
		Schema::drop('bookmarks');
	}

}

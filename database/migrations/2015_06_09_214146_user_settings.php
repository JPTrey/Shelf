<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserSettings extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function($table) {
			$table->boolean('hideScrollbar')->default(0);
			$table->boolean('autoReadSpeed')->default(1);
			$table->boolean('showCompleted')->default(0);
		});	
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function($table) {
			$table->dropColumn('hideScrollbar');
			$table->dropColumn('autoReadSpeed');
			$table->dropColumn('showCompleted');
		});
	}

}

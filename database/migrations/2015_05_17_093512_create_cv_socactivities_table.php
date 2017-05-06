<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCvSocactivitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cv_socactivities', function(Blueprint $table)
		{
			$table->increments('id');

            $table->integer('cv_id')->unsigned();
            $table->string('socactivity_name');

            $table->index('cv_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cv_socactivities');
	}

}

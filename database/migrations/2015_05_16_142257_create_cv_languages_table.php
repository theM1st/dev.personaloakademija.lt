<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCvLanguagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cv_languages', function(Blueprint $table)
		{
			$table->increments('id');

            $table->integer('cv_id')->unsigned();
            $table->integer('first_language_id')->unsigned();
            $table->integer('foreign_language_id')->unsigned();
            $table->string('understanding_level', 50)->nullable();;
            $table->string('speaking_level', 50)->nullable();;
            $table->string('reading_level', 50)->nullable();;
            $table->string('writing_level', 50)->nullable();;

            $table->index('cv_id');
            $table->index('first_language_id');
            $table->index('foreign_language_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cv_languages');
	}

}

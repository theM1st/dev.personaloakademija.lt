<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCvWorksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cv_works', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('cv_id')->unsigned();
            $table->integer('work_scope_id')->unsigned();
            $table->integer('city_id')->unsigned();
            $table->string('work_position');
            $table->text('work_description');

            $table->index('cv_id');
            $table->index('work_scope_id');
            $table->index('city_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cv_works');
	}

}

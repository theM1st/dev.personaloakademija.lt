<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCvStudiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cv_studies', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('cv_id')->unsigned();
            $table->integer('institution_id')->unsigned();
            $table->integer('study_scope_id')->unsigned();
            $table->string('specialty');
            $table->integer('study_grade_id')->unsigned();
            $table->smallInteger('study_course')->unsigned();
            $table->integer('study_form_id')->unsigned();
            $table->smallInteger('study_from_year')->unsigned();
            $table->smallInteger('study_to_year')->unsigned();
            $table->string('study_tags', 2000);

            $table->index('cv_id');
            $table->index('institution_id');
            $table->index('study_scope_id');
            $table->index('study_grade_id');

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
		Schema::drop('cv_studies');
	}

}

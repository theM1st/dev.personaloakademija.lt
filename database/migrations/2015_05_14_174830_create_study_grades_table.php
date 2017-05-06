<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudyGradesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('study_grades', function(Blueprint $table)
		{
			$table->increments('id');

            $table->string('name_lt');
            $table->string('name_en');
            $table->enum('type', ['student', 'graduate'])->nullable()->default(null);
            $table->smallInteger('position');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('study_grades');
	}

}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCvExperiencesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cv_experiences', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('cv_id')->unsigned();
            $table->string('company_name');
            $table->string('work_position');
            $table->string('main_tasks');
            $table->string('achievements');
            $table->string('reason_go_out', 2000);
            $table->string('work_from', 50)->nullable();
            $table->string('work_to', 50)->nullable();

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
		Schema::drop('cv_experiences');
	}

}

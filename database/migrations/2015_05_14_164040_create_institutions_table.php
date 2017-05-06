<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstitutionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('institutions', function(Blueprint $table)
		{
			$table->increments('id');

            $table->string('name_lt');
            $table->string('name_en');
            $table->smallInteger('position');

            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('institution_categories');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('institutions');
	}

}

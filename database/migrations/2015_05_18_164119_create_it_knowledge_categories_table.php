<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItKnowledgeCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('it_knowledge_categories', function(Blueprint $table)
		{
			$table->increments('id');

            $table->string('name_lt');
            $table->string('name_en');
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
		Schema::drop('it_knowledge_categories');
	}

}

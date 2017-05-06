<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItKnowledgesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('it_knowledges', function(Blueprint $table)
		{
			$table->increments('id');

            $table->string('name_lt');
            $table->string('name_en');
            $table->smallInteger('position');

            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('it_knowledge_categories');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('it_knowledges');
	}

}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCvItKnowledgesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cv_it_knowledges', function(Blueprint $table)
		{
			$table->increments('id');

            $table->integer('cv_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('knowledge_id')->unsigned();
            $table->string('knowledge_name');
            $table->smallInteger('knowledge_level');

            $table->index('cv_id');
            $table->index('category_id');
            $table->index('knowledge_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cv_it_knowledges');
	}

}

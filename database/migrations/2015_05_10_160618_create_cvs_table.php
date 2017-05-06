<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCvsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cv_profiles', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->string('name');
            $table->date('birthday')->nullable();
            $table->enum('gender', ['M', 'F']);
            $table->string('email')->nullable();
            $table->string('telephone', 25)->nullable();
            $table->integer('practice_city_id')->unsigned();
            $table->integer('job_city_id')->unsigned();
            $table->string('photo')->nullable();
            $table->enum('cv_status', ['active', 'passive'])->default('active');
            $table->string('cv_name')->nullable();
            $table->text('description')->nullable();
            $table->smallInteger('state')->default(1);

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
		Schema::drop('cv_profiles');
	}

}

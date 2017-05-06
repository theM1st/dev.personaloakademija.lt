<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('offers', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('user_id')->unsigned()->index();

            $table->integer('city_id')->unsigned();
            $table->integer('scope_id')->unsigned();
            $table->smallInteger('offer_duration');
            $table->string('work_position');
            $table->integer('logo_id')->nullable();
            $table->text('company_description');
            $table->timestamp('offer_valid_until');
            $table->enum('offer_type', ['job', 'practice'])->default('job');

            $table->text('offer_description');
            $table->text('offer_requirements');
            $table->text('offer_skills');
            $table->text('company_offers');

            $table->index('city_id');
            $table->index('scope_id');
            $table->index('logo_id');

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
		Schema::drop('offers');
	}

}

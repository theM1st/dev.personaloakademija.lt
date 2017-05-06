<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopCvProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('top_cv_profiles', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->enum('gender', ['M', 'F'])->nullable();
            $table->smallInteger('age')->unsigned()->nullable();
            $table->integer('city_id')->index()->unsigned();
            $table->string('telephone', 25)->nullable();
            $table->string('email')->nullable();
            $table->integer('scope_id')->index()->unsigned();
            $table->integer('scope_category_id')->index()->unsigned();
            $table->enum('cv_status', ['active', 'passive'])->default('active');
            $table->text('about')->nullable();
            $table->text('cv_tags')->nullable();
            $table->text('cv_skills')->nullable();
            $table->text('cv_trainings')->nullable();
            $table->text('cv_certificates')->nullable();
            $table->text('cv_info')->nullable();
            $table->string('driving_license')->nullable();
            $table->smallInteger('driving_license_year')->unsigned()->nullable();
            $table->string('salary_trial')->nullable();
            $table->string('salary')->nullable();
            $table->boolean('active')->default(0);
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
        Schema::drop('top_cv_profiles');
    }
}

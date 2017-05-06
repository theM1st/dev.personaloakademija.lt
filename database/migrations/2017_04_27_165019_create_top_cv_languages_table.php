<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopCvLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('top_cv_languages', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('first_language_id')->unsigned()->nullable();
            $table->integer('foreign_language_id')->unsigned()->nullable();
            $table->string('speaking_level', 50)->nullable();
            $table->string('writing_level', 50)->nullable();
            $table->string('reading_level', 50)->nullable();
            $table->integer('cv_id')->unsigned();
            $table->foreign('cv_id')->references('id')->on('top_cv_profiles')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('top_cv_languages');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopCvStudiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('top_cv_studies', function(Blueprint $table) {
            $table->increments('id');
            $table->string('institution');
            $table->string('study_date');
            $table->string('specialty');
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
        Schema::drop('top_cv_studies');
    }
}

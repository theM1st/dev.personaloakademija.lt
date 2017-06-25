<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopCvCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('top_cv_category', function(Blueprint $table) {
            $table->integer('cv_id')->unsigned();
            $table->integer('category_id')->unsigned();

            $table->foreign('cv_id')->references('id')->on('top_cv_profiles')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('top_cv_scope_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('top_cv_category');
    }
}

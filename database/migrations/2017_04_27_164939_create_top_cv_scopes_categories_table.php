<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopCvScopesCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('top_cv_scope_categories', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->smallInteger('position')->nullable();
            $table->integer('scope_id')->unsigned();
            $table->foreign('scope_id')->references('id')->on('top_cv_scopes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('top_cv_scope_categories');
    }
}

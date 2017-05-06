<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->nullable();
            $table->integer('lft')->nullable();
            $table->integer('rgt')->nullable();
            $table->integer('depth')->nullable();
            $table->string('slug_lt')->nullable()->index();
            $table->string('slug_en')->nullable()->index();
            $table->string('slug_ru')->nullable()->index();
            $table->string('title_lt');
            $table->string('title_en');
            $table->string('title_ru');
            $table->string('description_lt');
            $table->string('description_en');
            $table->string('description_ru');
            $table->text('content_lt');
            $table->text('content_en');
            $table->text('content_ru');
            $table->string('link_lt');
            $table->string('link_en');
            $table->string('link_ru');
            $table->smallInteger('menu')->nullable()->index();
            $table->boolean('active')->default(1);
            $table->boolean('main_page')->nullable();
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
        Schema::dropIfExists('pages');
    }
}

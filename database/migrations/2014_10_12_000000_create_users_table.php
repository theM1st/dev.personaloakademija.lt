<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('email')->unique();
			$table->string('password', 60);
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('telephone', 25)->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_code')->nullable();
            $table->string('company_position')->nullable();
            $table->boolean('email_subscription')->default(1);

            $table->enum('user_type', ['student', 'graduate', 'company']);
			$table->rememberToken();
			$table->timestamps();

            $table->index('user_type');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStockUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('stock_user', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('username', 120);
			$table->string('password', 120);
			$table->string('user_type', 20);
			$table->string('answer', 100);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('stock_user');
	}

}

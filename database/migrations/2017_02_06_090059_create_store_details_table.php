<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStoreDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('store_details', function(Blueprint $table)
		{
			$table->string('name', 100);
			$table->string('log', 100);
			$table->string('type', 100);
			$table->string('address', 100);
			$table->string('place', 100);
			$table->string('city', 100);
			$table->string('phone', 100);
			$table->string('email', 100);
			$table->string('web', 100);
			$table->string('pin', 100);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('store_details');
	}

}

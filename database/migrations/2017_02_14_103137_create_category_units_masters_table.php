<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoryUnitsMastersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('category_units_masters', function(Blueprint $table)
		{
			$table->increments('cu_id');
			$table->integer('category_id');
			$table->integer('measure_id');
			$table->integer('uom_id')->nullable();
			$table->float('value', 10)->nullable();
			$table->timestamps();
			$table->boolean('status')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('category_units_masters');
	}

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStockUnitsDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('stock_units_details', function(Blueprint $table)
		{
			$table->integer('sud_id', true);
			$table->integer('stock_id')->nullable();
			$table->integer('category_id')->nullable();
			$table->integer('measure_id')->nullable();
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
		Schema::drop('stock_units_details');
	}

}

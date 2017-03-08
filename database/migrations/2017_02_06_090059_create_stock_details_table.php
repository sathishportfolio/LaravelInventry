<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStockDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('stock_details', function(Blueprint $table)
		{
			$table->increments('stock_id');
			$table->string('stock_name', 120);
			$table->integer('category_id');
			$table->string('category_name',120)->nullable();
			$table->float('purchase_cost', 10,0)->unsigned()->nullable()->default(0);
			$table->float('selling_cost', 10,0)->unsigned()->nullable()->default(0);
			$table->integer('supplier_id')->unsigned();
			$table->string('supplier_name',120)->nullable();
			$table->integer('stock_quantity')->default(0)->unsigned();
			// $table->string('measuring_units', 120)->nullable();
			$table->timestamps();
			$table->softDeletes();
			
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('stock_details');
	}

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransactionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transactions', function(Blueprint $table)
		{

			$table->increments('id');
			$table->boolean('type');
			$table->integer('sales_id')->nullable();
			$table->integer('purchase_id')->nullable();
			$table->integer('customer_id')->nullable();
			$table->integer('supplier_id')->nullable();
			$table->float('subtotal', 10,2)->unsigned();
			$table->float('payment', 10,2)->unsigned();
			$table->boolean('mode');
			$table->float('balance', 10,2)->unsigned();
			$table->float('due',10,2)->unsigned();
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
		Schema::drop('transactions');
	}

}

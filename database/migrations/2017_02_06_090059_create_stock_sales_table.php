<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStockSalesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('stock_sales', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('transactionid', 250);
			$table->integer('transidnumber');
			$table->string('stock_name', 200);
			$table->string('category', 120);
			$table->string('supplier_name', 200);
			$table->decimal('selling_price', 10)->unsigned();
			$table->decimal('quantity', 10)->unsigned();
			$table->decimal('amount', 10)->unsigned();
			$table->date('date');
			$table->string('username', 120);
			$table->string('customer_id', 120);
			$table->decimal('subtotal', 10)->unsigned();
			$table->decimal('payment', 10)->unsigned();
			$table->decimal('balance', 10)->unsigned();
			$table->decimal('discount', 10, 0)->unsigned();
			$table->decimal('tax', 10, 0)->unsigned();
			$table->string('tax_dis', 100);
			$table->decimal('dis_amount', 10, 0)->unsigned();
			$table->decimal('grand_total', 10, 0)->unsigned();
			$table->date('due');
			$table->string('mode', 250);
			$table->string('description', 500);
			$table->integer('count1');
			$table->string('billnumber', 120);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('stock_sales');
	}

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSupplierDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('supplier_details', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('supplier_name', 200);
			$table->string('supplier_email', 200);
			$table->string('supplier_address', 500);
			$table->string('supplier_contact1', 100);
			$table->string('supplier_contact2', 100);
			$table->float('balance', 10, 0)->default(0)->unsigned();
			$table->float('due', 10, 0)->default(0)->unsigned();
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
		Schema::drop('supplier_details');
	}

}

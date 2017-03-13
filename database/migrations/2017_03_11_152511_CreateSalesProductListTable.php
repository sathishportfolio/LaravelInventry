<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesProductListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_product_list', function(Blueprint $table)
        {
            $table->increments('sales_product_id');
            $table->integer('sales_id');
            $table->string('category_name',32);
            $table->integer('category_id');
            $table->integer('stock_id');
            $table->float('purchase_cost',10,2)->unsigned()->nullable();
            $table->float('selling_cost',10,2)->unsigned()->nullable();
            $table->integer('opening_stock')->unsigned();
            $table->integer('closing_stock')->unsigned();
            $table->integer('sales_quantity')->unsigned();
            $table->float('sub_total',10,2)->unsigned()->nullable();
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
        Schema::drop('sales_product_list');
    }
}

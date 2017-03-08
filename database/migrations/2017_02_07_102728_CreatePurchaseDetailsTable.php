<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_details', function(Blueprint $table)
        {
            $table->increments('purchase_id');
            $table->integer('stock_id');
            $table->integer('category_id');
            $table->integer('supplier_id');
            $table->string('supplier_address', 260);
            $table->biginteger('supplier_contact1');
            $table->float('opening_due',10,2)->unsigned();
            $table->float('opening_balance',10,2)->unsigned();
            $table->integer('purchase_quantity')->unsigned();
            $table->float('purchase_total',10,2)->unsigned();
            $table->float('purchase_cost',10,2)->unsigned()->nullable()->default(0);
            $table->float('selling_cost',10,2)->unsigned()->nullable()->default(0);
            $table->integer('opening_stock')->unsigned();
            $table->integer('closing_stock')->unsigned();
            $table->string('description',255)->nullable();
            $table->float('grand_total',10,2)->unsigned();
            $table->float('payment',10,2)->unsigned();
            $table->float('closing_due',10,2)->unsigned();
            $table->float('closing_balance',10,2)->unsigned();
            $table->boolean('mode');
            $table->string('billnumber', 120)->nullable();
            $table->date('billdate')->nullable();
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
        Schema::drop('purchase_details');
    }
}

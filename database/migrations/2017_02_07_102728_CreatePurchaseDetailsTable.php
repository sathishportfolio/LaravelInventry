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
            $table->integer('supplier_id');
            $table->string('supplier_name', 260);
            $table->string('supplier_address', 260);
            $table->biginteger('supplier_contact1');
            $table->float('opening_due',10,2)->unsigned();
            $table->float('opening_balance',10,2)->unsigned();
            
            $table->float('purchase_total',10,2)->unsigned();
            
            $table->float('discount_percent',10,2)->unsigned();
            $table->float('discount_amount',10,2)->unsigned();
            
            $table->string('tax_description',255)->nullable();
            $table->float('tax_percent',10,2)->unsigned();
            $table->float('tax_amount',10,2)->unsigned();

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

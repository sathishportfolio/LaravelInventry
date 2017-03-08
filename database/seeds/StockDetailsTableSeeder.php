<?php

use Illuminate\Database\Seeder;

class StockDetailsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('stock_details')->delete();
        
        \DB::table('stock_details')->insert(array (
            0 => 
            array (
                'stock_id' => 1,
                'stock_name' => 'Cello Fine Grip',
                'category_id' => 10,
                'purchase_cost' => 10.0,
                'selling_cost' => 12.0,
                'supplier_id' => '1',
                'stock_quantity' => 0,
                'uom' => NULL,
                'created_at' => '2017-02-07 09:25:23',
                'updated_at' => '2017-02-07 09:25:23',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'stock_id' => 2,
                'stock_name' => 'Hero',
                'category_id' => 10,
                'purchase_cost' => 40.0,
                'selling_cost' => 50.0,
                'supplier_id' => '1',
                'stock_quantity' => 0,
                'uom' => NULL,
                'created_at' => '2017-02-07 09:25:23',
                'updated_at' => '2017-02-07 09:25:23',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'stock_id' => 3,
                'stock_name' => 'Parker',
                'category_id' => 10,
                'purchase_cost' => 100.0,
                'selling_cost' => 125.0,
                'supplier_id' => '1',
                'stock_quantity' => 0,
                'uom' => NULL,
                'created_at' => '2017-02-07 09:25:23',
                'updated_at' => '2017-02-07 09:25:23',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}
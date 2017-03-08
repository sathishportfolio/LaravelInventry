<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SuppliersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $created_at = Carbon::now();

        $array[0] = ['supplier_name'=>'arun','supplier_email'=>'arun@gmail.com','supplier_address'=>'address1','supplier_contact1'=>'9654659875','supplier_contact2'=>'9654659875','due'=>265,'created_at'=>$created_at];

        $array[1] = ['supplier_name'=>'bharath','supplier_email'=>'bharath@gmail.com','supplier_address'=>'address1','supplier_contact1'=>'9654659875','supplier_contact2'=>'9654659875','due'=>698,'created_at'=>$created_at];

        $array[2] = ['supplier_name'=>'Chandru','supplier_email'=>'srini@gmail.com','supplier_address'=>'address1','supplier_contact1'=>'9654659875','supplier_contact2'=>'9654659875','due'=>985,'created_at'=>$created_at];
    	
        \App\Models\SupplierDetail::truncate();

        \App\Models\SupplierDetail::insert($array);
    }


}

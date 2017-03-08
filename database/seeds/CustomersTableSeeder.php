<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $created_at = Carbon::now();

        $array[0] = ['customer_name'=>'srivas','customer_email'=>'srivas@gmail.com','customer_address'=>'address1','customer_contact1'=>'9654659875','customer_contact2'=>'9654659875','created_at'=>$created_at];

        $array[1] = ['customer_name'=>'edwin','customer_email'=>'edwin@gmail.com','customer_address'=>'address1','customer_contact1'=>'9654659875','customer_contact2'=>'9654659875','created_at'=>$created_at];

        $array[2] = ['customer_name'=>'srinivas','customer_email'=>'srini@gmail.com','customer_address'=>'address1','customer_contact1'=>'9654659875','customer_contact2'=>'9654659875','created_at'=>$created_at];
    	
        \App\Models\CustomerDetail::truncate();

        \App\Models\CustomerDetail::insert($array);
    }


}

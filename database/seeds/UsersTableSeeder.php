<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$array = ['name'=>'Administrator','email'=>'admin@mystocks.in','password'=>bcrypt('12345678')];
    	
        \App\Models\User::truncate();
        \App\Models\User::create($array);
    }
}

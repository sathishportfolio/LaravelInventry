<?php

use Illuminate\Database\Seeder;

class MeasuresMasterTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('measures_master')->delete();
        
        \DB::table('measures_master')->insert(array (
            0 => 
            array (
                'measure_id' => 1,
                'name' => 'Length',
            ),
            1 => 
            array (
                'measure_id' => 2,
                'name' => 'Breadth',
            ),
            2 => 
            array (
                'measure_id' => 3,
                'name' => 'Diametre',
            ),
            3 => 
            array (
                'measure_id' => 4,
                'name' => 'Thickness',
            ),
            4 => 
            array (
                'measure_id' => 5,
                'name' => 'Weight',
            ),
            5 => 
            array (
                'measure_id' => 6,
                'name' => 'Volume',
            ),
        ));
        
        
    }
}
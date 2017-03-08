<?php

use Illuminate\Database\Seeder;

class CategoryDetailsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('category_details')->delete();
        
        \DB::table('category_details')->insert(array (
            0 => 
            array (
                'id' => 1,
                'category_name' => 'Beverages ',
                'category_description' => 'coffee/tea, juice, soda',
            ),
            1 => 
            array (
                'id' => 2,
                'category_name' => 'Bread/Bakery ',
                'category_description' => 'sandwich loaves, dinner rolls, tortillas, bagels',
            ),
            2 => 
            array (
                'id' => 3,
                'category_name' => 'Canned/Jarred ',
                'category_description' => 'vegetables, spaghetti sauce, ketchup',
            ),
            3 => 
            array (
                'id' => 4,
                'category_name' => 'Dairy ',
                'category_description' => 'cheeses, eggs, milk, yogurt, butter',
            ),
            4 => 
            array (
                'id' => 5,
                'category_name' => 'Dry/Baking ',
                'category_description' => 'cereals, flour, sugar, pasta, mixes',
            ),
            5 => 
            array (
                'id' => 6,
                'category_name' => 'Frozen ',
                'category_description' => 'waffles, vegetables, individual meals, ice cream',
            ),
            6 => 
            array (
                'id' => 7,
                'category_name' => 'Meat ',
                'category_description' => 'lunch meat, poultry, beef, pork',
            ),
            7 => 
            array (
                'id' => 8,
                'category_name' => 'Produce ',
                'category_description' => 'fruits, vegetables',
            ),
            8 => 
            array (
                'id' => 9,
                'category_name' => 'Cleaners ',
                'category_description' => 'purpose, laundry detergent, dishwashing liquid/detergent',
            ),
            9 => 
            array (
                'id' => 10,
                'category_name' => 'Paper ',
                'category_description' => 'paper towels, toilet paper, aluminum foil, sandwich bags',
            ),
            10 => 
            array (
                'id' => 11,
                'category_name' => 'Personal ',
                'category_description' => 'shampoo, soap, hand soap, shaving cream',
            ),
            11 => 
            array (
                'id' => 12,
                'category_name' => 'Other ',
                'category_description' => 'baby items, pet items, batteries, greeting cards',
            ),
        ));
        
        
    }
}
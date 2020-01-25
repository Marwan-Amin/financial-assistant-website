<?php

use Illuminate\Database\Seeder;

class ExpenseSubCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subCategories = array(
            array('name' => "Vegtables",'category_id' =>1),
            array('name' => "Fruits",'category_id' =>1),
            array('name' => "Fast Foood",'category_id' =>1),
            array('name' => "Meat",'category_id' =>1),
            array('name' => "Chicken",'category_id' =>1),
            array('name' => "Fish",'category_id' =>1),
            array('name' => "Snacks",'category_id' =>1),
            array('name' => "Oils",'category_id' =>1),
            array('name' => "Groceries",'category_id' =>1),
            array('name' => "Restaurants",'category_id' =>1),

            array('name' => "Water",'category_id' =>2),
            array('name' => "Milk",'category_id' =>2),
            array('name' => "Coffee",'category_id' =>2),
            array('name' => "Tea",'category_id' =>2),
            array('name' => "Juice",'category_id' =>2),

            array('name' => "Electricity bill",'category_id' =>3),
            array('name' => "Natural gas bill",'category_id' =>3),
            array('name' => "water bill",'category_id' =>3),
            array('name' => "Internet connection bill",'category_id' =>3),
            array('name' => "Land line bill",'category_id' =>3),

            array('name' => "Plane",'category_id' =>4),
            array('name' => "Bus",'category_id' =>4),
            array('name' => "Taxi",'category_id' =>4),
            array('name' => "Train",'category_id' =>4),
            array('name' => "Taxi",'category_id' =>4),
            array('name' => "Uber",'category_id' =>4),
            array('name' => "Careem",'category_id' =>4),

            array('name' => "houshold Repairs",'category_id' =>5),
            array('name' => "Lamps",'category_id' =>5),
            array('name' => "Furniture",'category_id' =>5),
            array('name' => "Rugs",'category_id' =>5),
            array('name' => "Accessories",'category_id' =>5),
            array('name' => "Renting",'category_id' =>5),

            array('name' => "Fuel/Gas",'category_id' =>6),
            array('name' => "Car wash",'category_id' =>6),
            array('name' => "Parking fees",'category_id' =>6),
            array('name' => "Accessories",'category_id' =>6),
            array('name' => "Mechanic",'category_id' =>6),
            array('name' => "Oil changes",'category_id' =>6),

            array('name' => "Games",'category_id' =>7),
            array('name' => "Movies",'category_id' =>7),
            array('name' => "Concerts",'category_id' =>7),
            array('name' => "Website Subscriptions",'category_id' =>7),

            array('name' => "T-Shirts",'category_id' =>8),
            array('name' => "Jeans",'category_id' =>8),
            array('name' => "Shirts and dresses",'category_id' =>8),
            array('name' => "Jackets and Coats",'category_id' =>8),
            array('name' => "Suits",'category_id' =>8),
            array('name' => "Footware",'category_id' =>8),
            array('name' => "Underware",'category_id' =>8),

            array('name' => "Home insurance",'category_id' =>9),
            array('name' => "Car insurance",'category_id' =>9),
            array('name' => "life insurance",'category_id' =>9),
            array('name' => "Medical insurance",'category_id' =>9),
            array('name' => "Travel insurance",'category_id' =>9),

            array('name' => "Medicines",'category_id' =>10),
            array('name' => "Hospitals",'category_id' =>10),
            array('name' => "Doctors",'category_id' =>10),


            array('name' => "Gym",'category_id' =>11),
            array('name' => "Club Training",'category_id' =>11),

            array('name' => "Diapers",'category_id' =>12),
            array('name' => "Baby food",'category_id' =>12),
            array('name' => "Toys",'category_id' =>12),
            array('name' => "Baby Clothes",'category_id' =>12),
            array('name' => "Baby accessories",'category_id' =>12),

            array('name' => "Pet food",'category_id' =>13),
            array('name' => "Bed",'category_id' =>13),
            array('name' => "Vet",'category_id' =>13),
            array('name' => "Pet medicine",'category_id' =>13),

            array('name' => "Makeup",'category_id' =>14),
            array('name' => "Shampo",'category_id' =>14),
            array('name' => "Lotions",'category_id' =>14),
            array('name' => "Perfumes",'category_id' =>14),
            array('name' => "Skincare",'category_id' =>14),
            array('name' => "Haircare",'category_id' =>14),

            array('name' => "TV",'category_id' =>15),
            array('name' => "Mobile Accessories",'category_id' =>15),
            array('name' => "Computer Accessories",'category_id' =>15),
            array('name' => "Computer components",'category_id' =>15),

            array('name' => "Gift",'category_id' =>16),
            
            array('name' => "travel",'category_id' =>17),

            array('name' => "Courses",'category_id' =>18),
            array('name' => "university feess",'category_id' =>18),
            
            array('name' => "Book",'category_id' =>19),

            array('name' => "Office fees",'category_id' =>20),

        );

        DB::table('expense_sub_categories')->insert($subCategories);
        

    }
}

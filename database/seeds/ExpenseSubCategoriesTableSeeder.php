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
            array( 'sub_category_icon' => 'flaticon-vegetable', 'name' => "Vegtables",'category_id' =>1),
            array( 'sub_category_icon' => 'flaticon-grapes', 'name' => "Fruits",'category_id' =>1),
            array( 'sub_category_icon' => 'flaticon-pizza', 'name' => "Fast Foood",'category_id' =>1),
            array( 'sub_category_icon' => 'flaticon-meat', 'name' => "Meat",'category_id' =>1),
            array( 'sub_category_icon' => 'flaticon-chicken', 'name' => "Chicken",'category_id' =>1),
            array( 'sub_category_icon' => 'flaticon-fish', 'name' => "Fish",'category_id' =>1),
            array( 'sub_category_icon' => 'flaticon-popcorn', 'name' => "Snacks",'category_id' =>1),
            array( 'sub_category_icon' => 'flaticon-olive-oil', 'name' => "Oils",'category_id' =>1),
            array( 'sub_category_icon' => 'flaticon-grocery', 'name' => "Groceries",'category_id' =>1),
            array( 'sub_category_icon' => 'flaticon-fork', 'name' => "Restaurants",'category_id' =>1),

            array( 'sub_category_icon' => 'flaticon-water', 'name' => "Water",'category_id' =>2),
            array( 'sub_category_icon' => 'flaticon-milk-tank', 'name' => "Milk",'category_id' =>2),
            array( 'sub_category_icon' => 'flaticon-coffee-cup', 'name' => "Coffee",'category_id' =>2),
            array( 'sub_category_icon' => 'flaticon-tea', 'name' => "Tea",'category_id' =>2),
            array( 'sub_category_icon' => 'flaticon-diet', 'name' => "Juice",'category_id' =>2),

            array( 'sub_category_icon' => 'flaticon-plug', 'name' => "Electricity bill",'category_id' =>3),
            array( 'sub_category_icon' => 'flaticon-valve', 'name' => "Natural gas bill",'category_id' =>3),
            array( 'sub_category_icon' => 'flaticon-bill-1', 'name' => "water bill",'category_id' =>3),
            array( 'sub_category_icon' => 'flaticon-lan', 'name' => "Internet connection bill",'category_id' =>3),
            array( 'sub_category_icon' => 'flaticon-call', 'name' => "Land line bill",'category_id' =>3),

            array( 'sub_category_icon' => 'flaticon-air-freight', 'name' => "Plane",'category_id' =>4),
            array( 'sub_category_icon' => 'flaticon-bus-1', 'name' => "Bus",'category_id' =>4),
            array( 'sub_category_icon' => 'flaticon-taxi', 'name' => "Taxi",'category_id' =>4),
            array( 'sub_category_icon' => 'flaticon-subway', 'name' => "Train",'category_id' =>4),
            array( 'sub_category_icon' => 'flaticon-uber', 'name' => "Uber",'category_id' =>4),
            array( 'sub_category_icon' => 'flaticon-route', 'name' => "Careem",'category_id' =>4),

            array( 'sub_category_icon' => 'flaticon-roller', 'name' => "houshold Repairs",'category_id' =>5),
            array( 'sub_category_icon' => 'flaticon-lamp', 'name' => "Lamps",'category_id' =>5),
            array( 'sub_category_icon' => 'flaticon-bed', 'name' => "Furniture",'category_id' =>5),
            array( 'sub_category_icon' => 'flaticon-adornment', 'name' => "Rugs",'category_id' =>5),
            array( 'sub_category_icon' => 'flaticon-necklace', 'name' => "Accessories",'category_id' =>5),
            array( 'sub_category_icon' => 'flaticon-key', 'name' => "Renting",'category_id' =>5),

            array( 'sub_category_icon' => 'flaticon-fuel', 'name' => "Fuel/Gas",'category_id' =>6),
            array( 'sub_category_icon' => 'flaticon-car-service', 'name' => "Car wash",'category_id' =>6),
            array( 'sub_category_icon' => 'flaticon-fee', 'name' => "Parking fees",'category_id' =>6),
            // array( 'sub_category_icon' => 'flaticon-', 'name' => "Accessories",'category_id' =>6),
            array( 'sub_category_icon' => 'flaticon-mechanic', 'name' => "Mechanic",'category_id' =>6),
            array( 'sub_category_icon' => 'flaticon-car-service-1', 'name' => "Oil changes",'category_id' =>6),

            array( 'sub_category_icon' => 'flaticon-options', 'name' => "Games",'category_id' =>7),
            array( 'sub_category_icon' => 'flaticon-play-button', 'name' => "Movies",'category_id' =>7),
            array( 'sub_category_icon' => 'flaticon-microphone', 'name' => "Concerts",'category_id' =>7),
            array( 'sub_category_icon' => 'flaticon-pricing', 'name' => "Website Subscriptions",'category_id' =>7),

            array( 'sub_category_icon' => 'flaticon-tshirt', 'name' => "T-Shirts",'category_id' =>8),
            array( 'sub_category_icon' => 'flaticon-jeans', 'name' => "Jeans",'category_id' =>8),
            array( 'sub_category_icon' => 'flaticon-dress', 'name' => "Shirts and dresses",'category_id' =>8),
            array( 'sub_category_icon' => 'flaticon-jacket', 'name' => "Jackets and Coats",'category_id' =>8),
            array( 'sub_category_icon' => 'flaticon-suit', 'name' => "Suits",'category_id' =>8),
            array( 'sub_category_icon' => 'flaticon-socks', 'name' => "Footware",'category_id' =>8),
            array( 'sub_category_icon' => 'flaticon-knickers', 'name' => "Underware",'category_id' =>8),

            array( 'sub_category_icon' => 'flaticon-mortgage', 'name' => "Home insurance",'category_id' =>9),
            array( 'sub_category_icon' => 'flaticon-car-insurance', 'name' => "Car insurance",'category_id' =>9),
            array( 'sub_category_icon' => 'flaticon-ife-insurance', 'name' => "life insurance",'category_id' =>9),
            array( 'sub_category_icon' => 'flaticon-health-insurance', 'name' => "Medical insurance",'category_id' =>9),
            array( 'sub_category_icon' => 'flaticon-travel-insurance', 'name' => "Travel insurance",'category_id' =>9),

            array( 'sub_category_icon' => 'flaticon-medicine', 'name' => "Medicines",'category_id' =>10),
            array( 'sub_category_icon' => 'flaticon-first-aid-kit', 'name' => "Hospitals",'category_id' =>10),
            array( 'sub_category_icon' => 'flaticon-doctor', 'name' => "Doctors",'category_id' =>10),


            array( 'sub_category_icon' => 'flaticon-muscle', 'name' => "Gym",'category_id' =>11),
            array( 'sub_category_icon' => 'flaticon-badge', 'name' => "Club Training",'category_id' =>11),

            array( 'sub_category_icon' => 'flaticon-diaper', 'name' => "Diapers",'category_id' =>12),
            array( 'sub_category_icon' => 'flaticon-baby-food', 'name' => "Baby food",'category_id' =>12),
            array( 'sub_category_icon' => 'flaticon-scooter', 'name' => "Toys",'category_id' =>12),
            array( 'sub_category_icon' => 'flaticon-onesie', 'name' => "Baby Clothes",'category_id' =>12),
            array( 'sub_category_icon' => 'flaticon-mittens', 'name' => "Baby accessories",'category_id' =>12),

            array( 'sub_category_icon' => 'flaticon-pet-food', 'name' => "Pet food",'category_id' =>13),
            array( 'sub_category_icon' => 'flaticon-bed-1', 'name' => "Bed",'category_id' =>13),
            array( 'sub_category_icon' => 'flaticon-pet-friendly', 'name' => "Vet",'category_id' =>13),
            array( 'sub_category_icon' => 'flaticon-veterinary', 'name' => "Pet medicine",'category_id' =>13),

            array( 'sub_category_icon' => 'flaticon-lipstick', 'name' => "Makeup",'category_id' =>14),
            array( 'sub_category_icon' => 'flaticon-shampoo', 'name' => "Shampo",'category_id' =>14),
            array( 'sub_category_icon' => 'flaticon-cream', 'name' => "Lotions",'category_id' =>14),
            array( 'sub_category_icon' => 'flaticon-bottle', 'name' => "Perfumes",'category_id' =>14),
            array( 'sub_category_icon' => 'flaticon-cosmetic', 'name' => "Skincare",'category_id' =>14),
            array( 'sub_category_icon' => 'flaticon-comb', 'name' => "Haircare",'category_id' =>14),

            array( 'sub_category_icon' => 'flaticon-computer-1', 'name' => "TV",'category_id' =>15),
            array( 'sub_category_icon' => 'flaticon-mobile-phone-back-with-a-hanging-tool', 'name' => "Mobile Accessories",'category_id' =>15),
            array( 'sub_category_icon' => 'flaticon-keyboard', 'name' => "Computer Accessories",'category_id' =>15),
            array( 'sub_category_icon' => 'flaticon-mainboard', 'name' => "Computer components",'category_id' =>15),

            array( 'sub_category_icon' => 'flaticon-gift-1', 'name' => "Gift",'category_id' =>16),
            
            array( 'sub_category_icon' => 'flaticon-airplane-1', 'name' => "travel",'category_id' =>17),

            array( 'sub_category_icon' => 'flaticon-elearning', 'name' => "Courses",'category_id' =>18),
            array( 'sub_category_icon' => 'flaticon-university', 'name' => "university feess",'category_id' =>18),
            
            array( 'sub_category_icon' => 'flaticon-book-2', 'name' => "Book",'category_id' =>19),

            array( 'sub_category_icon' => 'flaticon-process', 'name' => "Office fees",'category_id' =>20),

        );

        DB::table('expense_sub_categories')->insert($subCategories);
        

    }
}

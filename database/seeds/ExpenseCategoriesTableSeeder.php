<?php

use App\ExpenseCategory;
use Illuminate\Database\Seeder;

class ExpenseCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories=[
            'Food',
            'Drinks',
            'Bills',
            'Transportation',
            'Home',
            'Car',
            'Entertainment',
            'Clothing',
            'Insurance',
            'Health',
            'Sport',
            'Baby',
            'Pet',
            'Beauty',
            'Electronics',
            'Gifts',
            'Travel',
            'Education',
            'Books',
            'Office',
            'Others'
        ];

        foreach ($categories as $category) {
            ExpenseCategory::create(['name' => $category]);
       }

    }
}

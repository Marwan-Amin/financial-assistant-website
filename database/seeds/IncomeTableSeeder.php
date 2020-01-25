<?php

use App\Income;
use Illuminate\Database\Seeder;

class IncomeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types=[
            'Salary',
            'Awards',
            'Grants',
            'Rental',
            'Refunds',
            'Investments',
            'Sale',
            'Others'
        ];
        
        foreach ($types as $type) {
            Income::create(['type' => $type]);
       }
    }
}

<?php

namespace App\Exports;

use App\User;
use App\UserIncome;
use App\UserSubCategory;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExpensesExport implements FromQuery, WithMapping,  WithHeadings
{
    use Exportable;

    public function query()
    {
        $user = UserSubCategory::all();
        // dd($user[0]->subCategory->name);
        return UserSubCategory::where('user_id','=',Auth::user()->id);
    }
    
     /**
    * @var Invoice $invoice
    */
    public function map($expense): array
    {
        return [
            $expense->subCategory->category->name,
            $expense->subCategory->name,
            $expense->amount,
            $expense->date
        ];
    }

    public function headings(): array
    {
        return [
            'Expense Category',
            'sub category',
            'amount',
            'Date added',
        ];
    }
}

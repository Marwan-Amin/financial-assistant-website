<?php

namespace App\Exports;

use App\User;
use App\UserIncome;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserIncomesExport implements FromQuery, WithMapping,  WithHeadings
{

    use Exportable;

    public function query()
    {
        return UserIncome::where('user_id','=',Auth::user()->id);
    }
    
     /**
    * @var Invoice $invoice
    */
    public function map($income): array
    {
        return [
            $income->income->type,
            $income->amount,
            $income->Date
        ];
    }

    public function headings(): array
    {
        return [
            'Income Type',
            'amount',
            'Date added',
        ];
    }
}

<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        $userInfo = User::find(Auth::user()->id);
        // dd($userInfo->subexpenses );
        return view ('Reporting.index', [
            'user' => $userInfo , 
            'expenses' => $userInfo->subexpenses 
        ]);
    }
}

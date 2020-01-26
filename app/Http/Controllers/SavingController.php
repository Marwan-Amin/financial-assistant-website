<?php

namespace App\Http\Controllers;

use App\Saving;
use Illuminate\Http\Request;

class SavingController extends Controller
{
    function create (){
        return view('savings.create'); 
    }
    function store(Request $request)
    {
      //dd($request->amount);
      Saving::create([
        'amount' => $request->amount,
        'user_id' => $request->user()->id
    ]);
    return redirect()->route('savings.create');
    }
}

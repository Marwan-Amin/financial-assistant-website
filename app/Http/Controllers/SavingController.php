<?php

namespace App\Http\Controllers;

use App\Saving;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
class SavingController extends Controller
{
    function index() 
    {
       $user_id = Auth::user()->id;       
       return view('savings.index',[
        'savings' => user::find(Auth::user()->id)->savings()->get()
        ]);
    }
    function create (){
        return view('savings.create'); 
    }
    function store(Request $request)
    {
      Saving::create([
        'amount' => $request->amount,
        'user_id' => $request->user()->id
    ]);
    return redirect()->route('savings.index');
    }
    function destroy($saving_id)
    {
        $saving = Saving::findOrFail($saving_id);
        $saving->delete();
        return redirect()->route('savings.index');
    }
    function update($saving_id,Request $request)
    {
        $saving = Saving::findOrFail($saving_id);
        $saving->amount = $request->amount;
        $saving->save();
        return redirect()->route('savings.index');
    }
    function edit($saving_id)
    {
        $saving = Saving::find($saving_id);
        return view('savings.edit',[
            'saving' => $saving 
        ]); 
        
    }
}

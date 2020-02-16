<?php

namespace App\Http\Controllers\Finance;
use App\Http\Controllers\Controller;

use App\Saving;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Finance\Target_saving;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\DataCollector\AjaxDataCollector;

class SavingController extends Controller
{
    function index() 
    {
       $saving=new Target_saving;
       $sum=$saving->sum_savings();      
       return view('savings.create',[
        'savings' => user::find(Auth::user()->id)->savings,
        'sum' => $sum
        ]);
    }
    
    function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|between:0.25,9999999999.99',
        ]);
        $saving = Saving::create([
        'amount' => $request->amount,
        'user_id' => Auth::user()->id
        ]);
        $save = new Target_saving;
        $savings_sum = $save->sum_savings();
        $sum = $save->Edit_target_savings($savings_sum);
        return redirect()->route('savings.create');

       

    }

    function destroy($saving_id)
    {
        //return response()->json($saving_id);
        $saving = Saving::findOrFail($saving_id);
        $saving->delete();
        $save=new Target_saving;
        $savings_sum=$save->sum_savings();
        $sum = $save->Edit_target_savings($savings_sum);
        return redirect()->route('savings.create');
    }

    function update($saving_id,Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|between:0.25,9999999999.99',
        ]);
        $saving = Saving::findOrFail($saving_id);
        $saving->amount = $request->amount;
        $saving->save();
        $save=new Target_saving;
        $savings_sum=$save->sum_savings();
        $save->Edit_target_savings($savings_sum);
        return redirect()->route('savings.create');
    }
    function edit($saving_id)
    {
        $saving = Saving::find($saving_id);
        return view('savings.edit',compact('saving')); 
        
    }
}

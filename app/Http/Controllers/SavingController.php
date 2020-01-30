<?php

namespace App\Http\Controllers;

use App\Saving;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Target_saving;
use Illuminate\Support\Facades\Validator;

class SavingController extends Controller
{
    function index() 
    {
       $user_id = Auth::user()->id; 
       $saving=new Target_saving;
       $sum=$saving->sum_savings();      
       return view('savings.create',[
        'savings' => user::find(Auth::user()->id)->savings()->get(),
        'sum' => $sum
        ]);
    }
    
    function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'saving_amount' => 'required',
        ]);
        if ($validator->passes()) {
        //return response()->json($request); //ajax dd :D
        $saving = Saving::create([
        'amount' => $request->saving_amount,
        'user_id' => Auth::user()->id
     ]);
        $save = new Target_saving;
        $savings_sum = $save->sum_savings();
        $sum = $save->Edit_target_savings($savings_sum);
        //return response()->json($saving);
        return response()->json(['saving'=>$saving,'sum'=>$sum]);

        }
        return response()->json(['error'=>$validator->errors()->all()]);  

    }

    function destroy($saving_id)
    {
        //return response()->json($saving_id);
        $saving = Saving::findOrFail($saving_id);
        $saving->delete();
        $save=new Target_saving;
        $savings_sum=$save->sum_savings();
        $sum = $save->Edit_target_savings($savings_sum);
        return response()->json(['saving'=>$saving,'sum'=>$sum]);
    }

    function update($saving_id,Request $request)
    {
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
        return view('savings.edit',[
            'saving' => $saving 
        ]); 
        
    }
}

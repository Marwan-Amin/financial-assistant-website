<?php
namespace App\Http\Controllers\Finance;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
//use App\Saving
use App\User;
use App\Target;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Finance\Target_saving;
use Illuminate\Support\Facades\Validator;
class TargetController extends Controller
{
    function index() 
    {
        $saving=new Target_saving;
        $savings=$saving->sum_savings();
        return view('targets.create',[
        'targets' => user::find(Auth::user()->id)->target()->get(),
        'savings' => $savings
        ]);
    }
    
    function store(Request $request)
    {
        $request->validate([
            'target_name' => 'required|unique:targets',
            'amount' => 'required',
        ]);
       
        $saving=new Target_saving;
        $savings=$saving->sum_savings();
        Target::create(
            ['user_id' => Auth::user()->id,'target_name' => $request->target_name ,
             'target_amount' => $request->amount,
             'savings' => $savings,
            ]
            );            
      
    
        return redirect()->route('targets.create');
    }

    function destroy($target_id)
    {

        $target = Target::findOrFail($target_id);
        $target->delete();
        return redirect()->route('targets.create');
    }

    function update($target_id,Request $request)
    {
        $target = target::findOrFail($target_id);
        $target->target_amount = $request->target_amount;
        $target->target_name = $request->target_name;
        $target->save();
        return redirect()->route('targets.create');
    }
    function edit($target_id)
    {
        $target = target::find($target_id);
        return view('targets.edit',[
            'target' => $target 
        ]);
    }
}
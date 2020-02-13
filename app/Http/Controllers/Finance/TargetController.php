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
        $user_id = Auth::user()->id;
        $saving=new Target_saving;
        $savings=$saving->sum_savings();
        return view('targets.create',[
        'targets' => user::find(Auth::user()->id)->target()->paginate(5)->get(),
        'savings' => $savings
        ]);
    }
    
    function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'target_name' => 'required|unique:targets',
            'target_amount' => 'required',
        ]);
        if ($validator->passes()) {
        $saving=new Target_saving;
        $savings=$saving->sum_savings();
        $target = Target::create(
        ['user_id' => Auth::user()->id,'target_name' => $request->target_name ,  
        'target_amount' => $request->target_amount,
        'savings' => $savings,       
        ]);
        $target = Target::find($target->id);
        
            return response()->json(['success'=>'Budget Goal is added Successfully.','targetData'=>$target]);
        }
        return response()->json(['error'=>$validator->errors()->all()]);  
    }

    function destroy($target_id)
    {

        $target = Target::findOrFail($target_id);
        $target->delete();
        return response()->json($target);
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
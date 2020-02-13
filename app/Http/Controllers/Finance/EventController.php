<?php

namespace App\Http\Controllers\Finance;
use App\Http\Controllers\Controller;

use App\CustomCategory;
use App\CustomSubCategory;
use App\ExpenseCategory;
use App\ExpenseSubCategory;
use App\Http\Requests\EventRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class EventController extends Controller
{
    public function index(){
        $events = CustomCategory::all();
        return view('events.index',compact('events'));
    }
    public function create(){
        return view('events.create');
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'eventName' => 'required',
            'eventDate' => 'required|date',
        ]);
        
        if ($validator->passes()) {
            $category = CustomCategory::updateOrCreate(
                ['name'=>$request->eventName,'user_id'=>Auth::user()->id,'date' =>$request->eventDate]
            );



			return response()->json(['success'=>'Added new records.','isStored'=>true,'categoryId'=>$category->id]);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }
    public function updateSubEvent($id,Request $request){
        $validator = Validator::make($request->all(), [
            'customSubCategoryName' => 'required|string',
            'customSubCategoryAmount' => 'required|numeric',
        ]);
        if ($validator->passes()) {
            $customSubCategory = CustomSubCategory::find($id);
            $customSubCategory->name =$request->customSubCategoryName;
            $customSubCategory->amount =$request->customSubCategoryAmount;
            $customSubCategory->save();
            return response()->json(['success'=>'Added new records.']);
        }      
          return response()->json(['error'=>$validator->errors()->all()]);
}


public function storeSubEvent(Request $request){


    $validator = Validator::make($request->all(), [
        'subName' => 'required|string',
        'amount' => 'required|numeric',
    ]);
    
    if ($validator->passes()) {
        $row = CustomSubCategory::where('name',$request->subName)->where('category_id',$request->categoryId);
        $amount = $row->exists()?$row->first():['amount'=>0];
        $customSubCategory = CustomSubCategory::updateOrCreate(
            ['name' =>$request->subName,'category_id'=>$request->categoryId],
            [
           'amount' =>$amount['amount']+$request->amount,
            ]);
        
        $customSubCategory = CustomSubCategory::where('name',$request->subName)->where('category_id',$request->categoryId)->first();

        $event = CustomCategory::find($request->categoryId);
        $balanceObj=new BalanceCalculation;
        $balanceObj->calculateBalance($event->date , $request->amount); 

       if($amount['amount']==0){
           $isUpdated=false;
        return response()->json(['success'=>'Added new records.','data'=>$customSubCategory,'isUpdated'=>$isUpdated]);

       }
       $isUpdated=true;
       return response()->json(['success'=>'Added new records.','data'=>$customSubCategory,'isUpdated'=>$isUpdated]);

    }      
      return response()->json(['error'=>$validator->errors()->all()]);

}


public function edit($id){
    $customCategory = CustomCategory::find($id);
    return view('events.edit',compact('customCategory'));
}


public function show($id){
    $customCategory = CustomCategory::find($id);
    return view('events.edit',compact('customCategory'));
}


public function destroy($id){
    $customCategory = CustomCategory::find($id);
    $customCategory->delete();
    return response()->json(true);
}


public function update($id,Request $request){
    $customCategory = CustomCategory::find($id);
    $customCategory->name = $request->customCategoryName;
    $customCategory->date = $request->customCategoryDate;
   $customCategory->save();
    return response()->json(true);
}
}

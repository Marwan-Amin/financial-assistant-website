<?php

namespace App\Http\Controllers;

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
            'category' => 'required|string',
            'date' => 'required|date',
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
       if($amount['amount']==0){
           $customSubCategory['isUpdated']=false;
        return response()->json(['success'=>'Added new records.','data'=>$customSubCategory]);

       }
       $customSubCategory['isUpdated']=true;
        return response()->json(['success'=>'Added new records.','data'=>$customSubCategory]);


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

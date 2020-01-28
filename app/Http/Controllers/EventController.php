<?php

namespace App\Http\Controllers;

use App\CustomCategory;
use App\CustomSubCategory;
use App\ExpenseCategory;
use App\ExpenseSubCategory;
use App\Http\Requests\EventRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
           $category = CustomCategory::create([
                'name'=>$request->eventName,
                'user_id'=>Auth::user()->id,
                'date' =>$request->eventDate
            ]);
            return response()->json(['isStored'=>true,'categoryId'=>$category->id]);
    }
    public function updateSubEvent($id,Request $request){

        $customSubCategory = CustomSubCategory::find($id);
        $customSubCategory->name =$request->customSubCategoryName;
        $customSubCategory->amount =$request->customSubCategoryAmount;
        $customSubCategory->save();
        return response()->json(true);

}
public function edit($id){
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

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
                'user_id'=>Auth::user()->id
            ]);
            return response()->json(['isStored'=>true,'categoryId'=>$category->id]);
    }
    public function storeSubCategory(Request $request){
        $customSubCategory = CustomSubCategory::create([
            'name'=>$request->subName,
            'category_id'=>$request->categoryId,
            'date'=>$request->date,
            'amount'=>$request->amount
        ]);
        return response()->json($customSubCategory);

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
}

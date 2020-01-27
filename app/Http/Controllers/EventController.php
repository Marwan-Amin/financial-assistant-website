<?php

namespace App\Http\Controllers;

use App\ExpenseCategory;
use App\ExpenseSubCategory;
use App\Http\Requests\EventRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function create(){
        return view('events.create');
    }
    public function store(Request $request){
           $category = ExpenseCategory::create([
                'name'=>$request->eventName,
                'user_id'=>Auth::user()->id
            ]);
            return response()->json(['isStored'=>true,'categoryId'=>$category->id]);
    }
    public function storeSubCategory(Request $request){
        ExpenseSubCategory::create([
            'name'=>$request->subName,
            'category_id'=>$request->categoryId
        ]);
}
}

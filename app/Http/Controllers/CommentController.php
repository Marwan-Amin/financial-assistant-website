<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function fetchComment($id){
        $blog = Blog::find($id);
        return response()->json($blog);
    }
    
    public function sendComment(Request $request){

        Comment::create([
            'user_id'=>Auth::user()->id,
            'post_id'=>$request->post_id,
            'body'=>$request->body
        ]);
            return ['status'=>'success'];
    }
}

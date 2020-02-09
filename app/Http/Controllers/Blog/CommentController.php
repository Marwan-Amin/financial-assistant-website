<?php

namespace App\Http\Controllers\Blog;
use App\Http\Controllers\Controller;

use App\Blog;
use App\Comment;
use App\Events\LiveCommentEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function fetchComment($id){
        $blog = Blog::find($id);
        $comments = $blog->comments()->with('user')->paginate(5);
        return response()->json(['comments' => $comments]);
    }
    
    public function sendComment($id,Request $request){

      $comment =  Comment::create([
            'user_id'=>Auth::user()->id,
            'blog_id'=>$id,
            'body'=>$request->comment
        ]);
        //send comment to event and this will broadcast this comment now we go to listen this event on our comment component
        broadcast(new LiveCommentEvent($comment->load('user')))->toOthers();
            return ['status'=>'success'];
    }
}

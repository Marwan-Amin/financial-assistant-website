<?php

namespace App\Http\Controllers\Blog;

use App\Blog;
use App\Http\Controllers\Controller;
use App\Http\Requests\BlogStoreRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index(){
       $blogs = Blog::all();
        return view('blogs.index',compact('blogs'));
    }
    public function create(){
        return view('blogs.create');
    }
    public function store(BlogStoreRequest $request){
        $image = $request->blog_image?Storage::putfile('blog_images', $request->file('blog_image')):'null';

       $isCreated = Blog::create([
            'title'=>$request->title,
            'body'=>strip_tags($request->body),
            'blog_image'=>$image,
            'user_id'=> Auth::user()->id
        ]);
        $request->blog_image->move(public_path('blog_images'), $image);

        if($isCreated){
            return redirect()->route('blogs.index');
        }
        dd('failed');
    }
    public function show($id){
        $blog = Blog::find($id)->withCount('comments')->first();
        return view('blogs.show',compact('blog'));
    }
    
}

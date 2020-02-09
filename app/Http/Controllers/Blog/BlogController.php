<?php

namespace App\Http\Controllers\Blog;
use App\Http\Controllers\Controller;

use App\Blog;
use App\Comment;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\BlogStoreRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index(){
       $blogs = Blog::all();
      
        return view('blogs.index',compact('blogs'));
    }
    public function create($id = null){
        if($id){
            
            $blog = Blog::find($id);
            if($blog->user_id == Auth::user()->id){
                $tags='';
        foreach($blog->tags as $tag){
            $tags.=$tag->name.',';
        }
       $tags = rtrim($tags,",");
            return view('blogs.create',compact('blog','tags'));

            }else{  
                return view('blogs.denied');
            }
                    }
        return view('blogs.create');
    }
    public function store(BlogStoreRequest $request){
        $image = $request->blog_image?Storage::putfile('blog_images', $request->file('blog_image')):'null';
            $tags = explode(",", trim($request->tags));
            $tags= array_map('trim', $tags);
            $tags = array_filter($tags);
       $blog = Blog::create([
            'title'=>$request->title,
            'body'=>strip_tags($request->body),
            'blog_image'=>$image,
            'user_id'=> Auth::user()->id
        ]);
        $request->blog_image->move(public_path('blog_images'), $image);
        
        if($blog){
            if(count($tags) >= 1  ){
                $blog->attachTags($tags);
            }
            return redirect()->route('blogs.index');
        }
        dd('failed');
    }
    public function update($id,BlogStoreRequest $request){
        $blog = Blog::find($id);
        $blog->title = $request->title ;
        $blog->body = $request->body ;
        $blog->title = $request->title;
        if($blog->blog_image != $request->blog_image && $request->blog_image != ''){
            Storage::delete($blog->blog_image);
            $image = Storage::putfile('blog_images', $request->file('blog_image'));
            $request->blog_image->move(public_path('blog_images'), $image);
            $blog->blog_image = $image;
        }
        
        $blog->save();
        $tags = explode(",", $request->tags);
        $tags= array_map('trim', $tags);
        $tags = array_filter($tags);
        if(count($tags) >= 1){
            $blog->syncTags($tags);
        }
        return redirect()->route('blogs.show',['id'=>$blog->id]);
    }
    public function show($id){
        
        $blog = Blog::where('id',$id)->withCount('comments')->first();
        $recentBlogs = Blog::latest('created_at')->limit(3)->get();
       $tags = Blog::find($id)->tags;
        return view('blogs.show',compact('blog','tags','recentBlogs'));
    }
    public function getTagBlogs($tag){

        $blogs = Blog::withAnyTags([$tag])->get();
        return view('blogs.tagBlogs',compact('blogs','tag'));
    }
    public function destroy($id){
        $blog = Blog::find($id);
        if($blog->user_id == Auth::user()->id){
            Storage::delete($blog->blog_image);
            $blog->delete();
            return redirect()->route('blogs.index');
    
        }else{
            return view('blogs.denied');
        }
        
    }
    
}

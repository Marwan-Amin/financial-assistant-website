 @extends('layouts.homeLayout')
 @section('content')

 <div class="main-panel">
 <div class="content-wrapper">
 
<div class="container my-5">
<div class="row">
<div class="col-md-12 grid-margin stretch-card">
              <div class="text-center my-5">
                <h3 class="page-title">
                      <span class="page-title-icon bg-gradient-primary text-white mr-2">

                      <i class="mdi mdi-cake-variant menu-icon"></i>
                    </span> 
                    Create Your Own Blog
                </h3></div>
                <div class="card">
                  <div class="card-body">
                    @isset($blog)
                      <form action="{{route('blogs.update',['id'=>$blog->id])}}" method="post" enctype="multipart/form-data">
                     @method('PUT')
                      @else
                     <form action="{{route('blogs.store')}}" method="post" enctype="multipart/form-data">
                     @endisset
                      @csrf
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Blog Title</label>
                        <div class="col-sm-9">
                          <input type="text" name="title" class="form-control"  placeholder="Enter your Blog Title" 
                                  
                                        @isset($blog)
                                        value="{{$blog->title}}"
                                        @endisset
                          >
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="body" class="col-sm-3 col-form-label">Blog Description</label>
                        <div class="col-sm-9">
                        <textarea class="form-control"  name="body" cols="50" rows="10" >@isset($blog){{$blog->body}}@endisset</textarea>
                        </div>
                      </div>
                       @isset($blog)                       
                     <img class="mt-5" width="100px" height="100px" src="{{ URL::asset($blog->blog_image) }}"/>
                     <input type="file"  name="blog_image">
                     <label class="custom-file-label" for="blog_image">Change Your Image</label>
                     @else
                    <input type="file"  name="blog_image">
                    <label  for="blog_image">Choose Image for your blog</label>
                    @endisset 
                     
                    <div class="form-group row">
                    <label class="col col-form-label" for="tags">Write Tags For This Blog Separated with [,]</label>
  
                    <input type="text" class="form-control" name="tags"
                      @isset($tags)
                            value="{{$tags}}"
                      @endisset
                      >
                     </div>
                      <div >
                      <button class="btn btn-dark mt-5">Create Blog</button>
                    </div>
                      </form>
                  </div>
                </div>
            </div>
         </div>
    </div>
 </div>
 </div>

 @endsection

@extends('layouts.app3')
 @section('content')
 <div class="main-panel">
 <div class="content-wrapper">
 <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">

        <i class="mdi mdi-cake-variant menu-icon"></i>
      </span> 
      Create Your Own Blog
  </h3>
</div>
<div class="row">
<div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                      <form action="{{route('blogs.store')}}" method="post" enctype="multipart/form-data">
                     @csrf
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Blog Title</label>
                        <div class="col-sm-9">
                          <input type="text" name="title" class="form-control"  placeholder="Enter your Blog Title">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="body" class="col-sm-3 col-form-label">Blog Description</label>
                        <div class="col-sm-9">
                        <textarea class="form-control" name="body" rows="3"></textarea>
                        </div>
                      </div>
                      <div class="input-group">
                     <div class="custom-file">
                      <input type="file" class="custom-file-input" name="blog_image">
                      <label class="custom-file-label" for="blog_image">Choose Image</label>
                     </div>
                     
                    </div>
                      <div >
                      <button class="btn btn-gradient-success">Create Blog</button>
                    </div>
                      </form>
                  </div>
                </div>
            </div>
         </div>
    </div>
 </div>
 @endsection
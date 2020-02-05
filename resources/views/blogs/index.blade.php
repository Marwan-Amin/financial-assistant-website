@extends('layouts.homeLayout')

@section('content')

<section class="home-slider ftco-degree-bg">
      <div class="slider-item bread-wrap" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">
            <div class="col-md-10 col-sm-12 ftco-animate mb-4 text-center">
              <p class="breadcrumbs"><span class="mr-2"><a href="/blogs/create">Create New Blog</a></span> <span>Blog</span></p>
              <h1 class="mb-3 bread">Read our blog</h1>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section ftco-degree-bg">
      <div class="container">
        <div class="row">
        @isset($blogs)
        @foreach($blogs as $blog)
          <div class="col-md-4 ftco-animate">
          <div class="blog-entry">
              <a href="/blogs/{{$blog->id}}/show" class="block-20" style='background-image: "{{asset($blog->blog_image)}}"'>
              </a>
              <div class="text p-4 d-block">
                <div class="meta mb-3">
                <div>{{$blog->user->name}}</div>
                  <div>{{$blog->created_at}}</div>
                </div>
                <h3 class="heading"><a href="/blogs/{{$blog->id}}/show">{{$blog->title}}</a></h3>
              </div>
            </div>
          </div>
          @endforeach
          @else
          <div class="col-md-4 ftco-animate">
          <div class="blog-entry">
             
              <div class="text p-4 d-block">
                <div class="meta mb-3">
                There's No Blogs    
                </div>
              </div>
            </div>
          </div>
          @endisset
      </div>
    </div>
    </section>

@endsection
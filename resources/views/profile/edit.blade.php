@extends('layouts.app')
@section('content')
<div class="main-panel">
          <div class="content-wrapper">
          @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif
            <div class="page-header" style="padding: 2.75rem 2.25rem;">
              <nav aria-label="breadcrumb">
              </nav>
            </div>
            <div class="row">

              <div class="col-12">
              
                <div class="card">
                
                  <div class="card-body" style="position: relative">
                  <form class="form-sample" style="padding-top:7em" method="post" action="/user_profile/{{ Auth::user()->id }}" enctype="multipart/form-data">
                    @csrf
                    {{method_field('PUT')}}
                    <div class="img-box profile-image">
                    
                    
                      <div class="avatar-upload">
                          <div class="avatar-edit">
                              <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg"  name="avatar" value="{{ substr(asset(Auth::user()->avatar),29) }}" />
                              <label for="imageUpload" style="text-align: center;line-height: 34px;color: #a65fff;">
                              <i class="mdi mdi-camera"></i>
                              </label>
                          </div>
                          
                          <div class="avatar-preview">
                           
                             @if ( Auth::user()->avatar)
                        
                              
                              <div id="imagePreview" style="background-image: url({{asset(Auth::user()->avatar)}})"></div>
                              @else
                              <div id="imagePreview" style="background-image: url(https://www.shareicon.net/data/2016/05/24/770117_people_512x512.png);"></div>
                                @endif
                          </div>
                  </div>
                    </div>
                    <h3 class="card-title"> Personal Info </h3>
                    <br><br>  
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                              <input  type="text" class="form-control" name="name" value="@guest Guest @else {{ Auth::user()->name }}@endguest" />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                              <input  type="email" class="form-control" name="email" value="@guest Guest @else {{ Auth::user()->email }}@endguest" />
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Gender</label>
                            <div class="col-sm-9">
                            <input  type="text" class="form-control" name="gender" value="@guest Guest @else {{ Auth::user()->gender }}@endguest" />  
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Age</label>
                            <div class="col-sm-9">
                            <input  type="text" class="form-control" name="age" value="@guest Guest @else {{ Auth::user()->age }}@endguest" />
                            </div>
                          </div>
                        </div>
                      </div>
                      <p class="card-description"> Location </p>

                      <div class="row">
                      <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Country</label>
                            <div class="col-sm-9"> 
                     <select class="form-control form-control-lg" name="country" id="country" value="" >
                     <option value="{{Auth::user()->country}}" selected>{{Auth::user()->country}}</option>

                      @if($countries)
                      @foreach ($countries as $country)
                      @if($country->name != Auth::user()->country)
                          <option value="{{$country->name}}">
                          {{$country->name}}
                            </option>
                      @endif
                            @endforeach
                      @endif
                    </select>
                    @error('country')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                            </div>
                          </div>
                        </div>
                          <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">City</label>
                            <div class="col-sm-9">


                            <select class="form-control form-control-lg" name="city" id="state" value="">
                              <option value="{{Auth::user()->city}}" selected>{{Auth::user()->city}}</option>
                            </select>
                            @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            </div>
                          </div>
                        </div>                       
                       </div>
                       <div class="row text-center">
                       <div class="col-md-12">
                            <button type="submit" class="btn btn-lg btn-gradient-primary mt-4">Update profile </button>
                            &nbsp;&nbsp;
                            <a class="btn btn-lg btn-gradient-primary mt-4" href="/user_profile">Cancel Update</a>
                        </div>
                        
                       </div>
                        
                    </form>
                  </div>
                </div>
              </div>
            </div>
            </div>
            </div> 
          
        <script>
    let previousValue = document.getElementById('country').value;
    let url = "{{route('user.ajax',['countryName'=>':countryName'])}}";

</script>
<script src="{{asset('js/profile/profile.js')}}"></script>
@endsection
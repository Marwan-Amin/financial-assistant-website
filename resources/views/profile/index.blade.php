@extends('layouts.app')
@section('content')
        <div class="main-panel">
          <div class="content-wrapper">
          @if(session()->has('message'))
            <div class="alert alert-success">
               Your Profile is {{ session()->get('message') }}
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
                    <!-- <h4 class="card-title">Horizontal Two column</h4> -->
                    <div class="img-box profile-image">
                    
                    @if ( Auth::user()->avatar)
                        
                   <img src="{{asset(Auth::user()->avatar)}}" class="w-100 h-100" style="border: 7px solid #fff;border-radius: 50%">
                   @else
                   <img src="https://www.shareicon.net/data/2016/05/24/770117_people_512x512.png" class="w-100" style="border: 7px solid #fff;border-radius: 50%">
    
                    @endif
                    
                
                    </div>
                    
                    <br>
                    <div class="text-center">
                        <a class="btn btn-lg btn-gradient-primary mt-5" href="/user_profile/{{ Auth::user()->id }}/edit">Edit Profile</a>
                    </div> 
                     
                     
                     
                    <form class="form-sample" style="padding-top:7em">
                    
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                              <input disabled type="text" class="form-control" value="@guest Guest @else {{ Auth::user()->name }}@endguest" />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                              <input disabled type="email" class="form-control" value="@guest Guest @else {{ Auth::user()->email }}@endguest" />
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Gender</label>
                            <div class="col-sm-9">
                            <input disabled type="email" class="form-control" value="@guest Guest @else {{ Auth::user()->gender }}@endguest" />  
                          
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Age</label>
                            <div class="col-sm-9">
                            <input disabled type="text" class="form-control" value="@guest Guest @else {{ Auth::user()->age }}@endguest" />
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
                                <input disabled type="text" class="form-control" value="@guest Guest @else {{ Auth::user()->country }}@endguest" />  
                             
                            </div>
                          </div>
                        </div>                          
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">City</label>
                            <div class="col-sm-9">
                            <input disabled type="text" class="form-control" value="@guest Guest @else {{ Auth::user()->city }}@endguest" />
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            </div>
            </div>
          
@endsection
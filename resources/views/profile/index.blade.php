@extends('layouts.app')
@section('content')
        <!-- partial -->
        
        <div class="main-panel">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
          <div class="content-wrapper" style="padding: 5rem 2.25rem;">
            <div class="page-header">
              <h3 class="page-title"> Personal info </h3>
              <nav aria-label="breadcrumb">
                <!-- <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Forms</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Form elements</li>
                </ol> -->
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
                      <!-- <p class="card-description"> Personal info </p> -->
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
                              <!-- <select disabled  class="form-control" >
                                <option >Male</option>
                                <option selected>Female</option>
                              </select> -->
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
                      <!-- <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Category</label>
                            <div class="col-sm-9">
                              <select disabled  class="form-control">
                                <option>Category1</option>
                                <option>Category2</option>
                                <option>Category3</option>
                                <option>Category4</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Membership</label>
                            <div class="col-sm-4">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input disabled type="radio" class="form-check-input" name="membershipRadios" id="membershipRadios1" value="" checked> Free </label>
                              </div>
                            </div>
                            <div class="col-sm-5">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input disabled type="radio" class="form-check-input" name="membershipRadios" id="membershipRadios2" value="option2"> Professional </label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div> -->
                      <p class="card-description"> Location </p>

                      <div class="row">
                      <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Country</label>
                            <div class="col-sm-9">
                                <input disabled type="text" class="form-control" value="@guest Guest @else {{ Auth::user()->country }}@endguest" />  
                              <!-- <select disabled  class="form-control">
                              <option selected>Egypt</option>  
                                <option>America</option>
                                <option>Italy</option>
                                <option>Russia</option>
                                <option>Britain</option>
                              </select> -->
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
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2017 <a href="https://www.bootstrapdash.com/" target="_blank">BootstrapDash</a>. All rights reserved.</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
@endsection
@extends('layouts.reg_login')
@section('content')
<div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                
                  <!-- <img src="{{asset('UI/PurpleAdmin/assets/images/logo.svg')}}"> -->
                  <h2 class="text-primary"> <b>Financial Assistant</b> </h2>
                  
                </div>
                <h4>New here?</h4>
                <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
                <form class="pt-3" method="POST" action="{{ route('register') }}">
                  @csrf
                  <div class="form-group">
                    <input type="text" class="form-control @error('name') is-invalid @enderror form-control-lg" id="name" placeholder="name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror form-control-lg"  placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
        
                  <div class="form-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror form-control-lg"  placeholder="Password" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <input id="password-confirm" type="password" class="form-control form-control-lg"  placeholder="confirm your Password" name="password_confirmation" required autocomplete="new-password">
                    
                  </div>

                  <div class="form-group">
                    <select class="form-control form-control-lg" name="country" id="country">
                      <option value="">Select Country</option>
                      @if($countries)
                      @foreach ($countries as $country) 
                          <option value="{{$country->name}}">
                          {{$country->name}}
                            </option>
                      @endforeach
                      @endif
                    </select>
                    @error('country')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>


                  <div class="form-group">
                    <select class="form-control form-control-lg" name="city" id="state" value="Select City">
                      <option value="" selected id="defaultCity">No Country Selected</option>
                    </select>
                    @error('city')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>

                  <!--radio buttons-->
                  <div class="form-group">
                  <h6 class="font-weight-light">Gender</h6>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input @error('gender') is-invalid @enderror" name="gender" value="male" required autocomplete="gender" autofocus> Male <i class="input-helper"></i></label>
                      </div>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input @error('gender') is-invalid @enderror" name="gender" value="female" required autocomplete="gender" autofocus> Female <i class="input-helper"></i></label>
                      </div>
                      @error('gender')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                  <!--radio buttons-->

                  <div class="form-group">
                  
                    <input  type="number" class="form-control @error('age') is-invalid @enderror"  name="age" value="{{ old('age') }}" placeholder="Age" required autocomplete="age" autofocus>

                    @error('age')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    
                  </div>

                  @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif


                  <!-- <div class="mb-4">
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                        <input type="checkbox" class="form-check-input"> I agree to all Terms & Conditions </label>
                    </div>
                  </div> -->
                  <div class="mt-3">
                    <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SIGN UP</button>
                  </div>
                  <!-- <div class="text-center mt-4 font-weight-light"> Already have an account? <a href="#" class="text-primary">Login</a> -->
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
@endsection
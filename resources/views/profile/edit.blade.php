@extends('layouts.app2')
@section('content')

        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper" style="padding: 11.75rem 2.25rem;">
            <div class="page-header">
              <!-- <h3 class="page-title"> Personal info </h3> -->
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
                    
                    <div class="img-box profile-image">
                    
                    @if ( Auth::user()->avatar)
                        
                   <img src="{{asset(Auth::user()->avatar)}}" class="w-100 h-100" style="border: 7px solid #fff;border-radius: 50%">
                   @else
                   <img src="https://www.shareicon.net/data/2016/05/24/770117_people_512x512.png" class="w-100" style="border: 7px solid #fff;border-radius: 50%">
    
                    @endif
                    
                
                    </div>
                     
                     
                    <form class="form-sample" style="padding-top:7em" method="post" action="/user_profile/{{ Auth::user()->id }}" enctype="multipart/form-data">
                    @csrf
                    {{method_field('PUT')}}
                    <h3 class="card-title"> Personal Info </h3>
                    <br><br>  
                      <!-- <p class="card-description"> Personal info </p> -->
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
                              <!-- <select   class="form-control" >
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
                            <input  type="text" class="form-control" name="age" value="@guest Guest @else {{ Auth::user()->age }}@endguest" />
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Category</label>
                            <div class="col-sm-9">
                              <select   class="form-control">
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
                                  <input  type="radio" class="form-check-input" name="membershipRadios" id="membershipRadios1" value="" checked> Free </label>
                              </div>
                            </div>
                            <div class="col-sm-5">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input  type="radio" class="form-check-input" name="membershipRadios" id="membershipRadios2" value="option2"> Professional </label>
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
                       <!---start upload image-->
                       <div class="form-group col-md-12">
                        <label>File upload</label>
                        @if ( Auth::user()->avatar)
                        <input type="file" name="avatar" class="file-upload-default" value="{{Auth::user()->avatar}}">
                        
                        @else
                        <input type="file" name="avatar" class="file-upload-default" value="https://www.shareicon.net/data/2016/05/24/770117_people_512x512.png">
                        <!-- <img src="https://www.shareicon.net/data/2016/05/24/770117_people_512x512.png" class="w-100" style="border: 7px solid #fff;border-radius: 50%"> -->
          
                          @endif
                        
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                          </span>
                        </div>
                      </div>
                        <!-- end uplaod image -->
                        <div class="col-md-12">
                        <div class="col-md-6 m-auto">
                            <button type="submit" class="w-100 btn btn-lg btn-gradient-primary mt-4">submit</button>
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
        <script>
    let previousValue = document.getElementById('country').value;
    document.getElementById('country').addEventListener('change',function(){
//     
        let countryName = $(this).val();
        let url = "{{route('user.ajax',['countryName'=>':countryName'])}}";
            url = url.replace(':countryName',countryName);
        if(previousValue != this.value ){

          $.ajax({
           type:'GET',
           url:url,
          dataType:'json',
           success:function(data){
            previousValue=countryName;
            renderStates(data);
           }
        });  
        }else if(this.value == "" || previousValue == this.value){
            renderStates(this.value);
        }

    });
function renderStates(states){
 let selectDropDown = document.getElementById('state');
 if(states){
    selectDropDown.innerHTML='';
    for(let i = 0 ;i<states.length;i++){
    let optionItem = document.createElement('option');
    optionItem.value = states[i];
    optionItem.innerHTML = states[i];
    selectDropDown.appendChild(optionItem);
 }
 }else if(states == ""){
    selectDropDown.innerHTML='';
    let optionItem = document.createElement('option');
    optionItem.value = "";
    optionItem.innerHTML = 'No Country Selected';
    optionItem.setAttribute('id','defaultCity');
    selectDropDown.appendChild(optionItem);
 }
 
}
</script>
        <!-- main-panel ends -->
@endsection
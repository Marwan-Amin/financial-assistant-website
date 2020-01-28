@extends('layouts.app')
@section('content')

            <div class="page-header" style="padding: 2.75rem 2.25rem;">
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
                  <form class="form-sample" style="padding-top:7em" method="post" action="/user_profile/{{ Auth::user()->id }}" enctype="multipart/form-data">
                    @csrf
                    {{method_field('PUT')}}
                    <div class="img-box profile-image">

                    
                      <div class="avatar-upload">
                          <div class="avatar-edit">
                              <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg"  name="avatar"/>
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
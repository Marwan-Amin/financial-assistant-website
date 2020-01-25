@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>


                        <div class="form-group row">

                            <div class="col-md-6">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">Male</label>

                                <input  type="radio" class="form-control @error('gender') is-invalid @enderror" name="gender" value="male" required autocomplete="gender" autofocus>
                                <label for="gender" class="col-md-4 col-form-label text-md-right">Female</label>
                                <input  type="radio" class="form-control @error('gender') is-invalid @enderror" name="gender" value="female" required autocomplete="gender" autofocus>

                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="country" class="col-md-4 col-form-label text-md-right">Country</label>

                            <select class="form-control" name="country" id="country">
                                 <option value="">Select Country</option>
                                 @if($countries)
                                 @foreach ($countries as $country) 
                                      <option value="{{$country->name}}">
                                     {{$country->name}}
                                        </option>
                                 @endforeach
                                 @endif
                                 @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                             </select>
                             <label for="city" class="col-md-4 col-form-label text-md-right">City</label>

                             <select class="form-control" name="city" id="state" value="Select City">
                             <option value="" selected id="defaultCity">No Country Selected</option>
                             @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                             </select>
                        <div class="form-group row">

                            
                        <div class="form-group row">
                            <label for="age" class="col-md-4 col-form-label text-md-right"> Age</label>

                            <div class="col-md-6">
                                <input  type="number" class="form-control @error('age') is-invalid @enderror" name="age" value="{{ old('age') }}" required autocomplete="age" autofocus>

                                @error('age')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    let previousValue = document.getElementById('country').value;
    document.getElementById('country').addEventListener('change',function(){
//     
        let countryId = $(this).val();
        if(previousValue != this.value ){
          $.ajax({
           type:'GET',
           url:"http://127.0.0.1:8000//states/ajax/"+countryId,
          dataType:'json',
           success:function(data){
              renderStates(data);
           }
        });  
        }else if(this.value == ""){
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
@endsection

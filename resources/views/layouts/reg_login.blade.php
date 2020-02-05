<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>financial_assistant</title>
    <!-- plugins:css -->
    
    <link rel="stylesheet" href="{{asset('UI/PurpleAdmin/assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    
    <link rel="stylesheet" href="{{asset('UI/PurpleAdmin/assets/vendors/css/vendor.bundle.base.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('UI/PurpleAdmin/assets/css/style.css')}}">
    <!-- End layout styles -->
    
    <link rel="shortcut icon" href="{{asset('UI/PurpleAdmin/assets/images/favicon.png')}}" />
  </head>
  <body>
@yield('content')
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{asset('UI/PurpleAdmin/assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset('UI/PurpleAdmin/assets/js/off-canvas.js')}}"></script>
    <script src="{{asset('UI/PurpleAdmin/assets/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('UI/PurpleAdmin/assets/js/misc.js')}}"></script>
    <!-- endinject -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script>
    let previousValue = document.getElementById('country').value;
    document.getElementById('country').addEventListener('change',function(){
//     
        let countryName = $(this).val();
        let url = "{{route('ajax',['countryName'=>':countryName'])}}";
            url = url.replace(':countryName',countryName);
        if(previousValue != this.value ){

          $.ajax({
           type:'GET',
           url:url,
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
  </body>
</html>
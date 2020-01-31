@extends('layouts.app')
@section('content')
<div class="alert alert-danger print-error-msg" style="display:none">
  <ul></ul>
  </div>
<div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
        <i class="mdi mdi-run-fast menu-icon"></i>
        </span> Your Budget Goals</h3>
    </div>
<div class="col-12">
    <div class="card">
      <div class="card-body">        
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Goal</label>
                <div class="col-sm-9">
                  <input id="target_name" type="text" name="target_name" class="form-control" />
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Amount</label>
                <div class="col-sm-9">
                  <input id="target_amount" type="number" name="amount" class="form-control" />
                </div>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label"></label>
                <div class="col-sm-9">
                    <button id="add_target_btn" class="btn btn-gradient-danger btn-lg ">+ Add Budget Goal</button>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Total Savings</label>
                <div class="col-sm-9">
                <span>{{$savings}}</span>
                </div>
              </div>
            </div>
          </div>
          </div>
          
     </div>
    </div>
</div>
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <table class="table table-striped " >
        <thead>
          <tr>
            <th> Goal </th>
            <th> Amount </th>
            <th> Progress </th>
            <th> Edit </th>
            <th> Delete </th>
          </tr>
        </thead>
        <tbody id="target_table">
          @isset($targets)
          @foreach ($targets as $target)
          <tr>
            <td>{{$target->target_name}}</td>
            <td>{{$target->target_amount}}</td>
            <td>
            @if($target->progress > 100||$target->progress ==100)
              <div class="progress">
                <div class="progress-bar bg-success" role="progressbar" style="width: 100%" >100%</div>
              </div>
              
            @else 
            <div class="progress">
              <div class="progress-bar bg-warning" role="progressbar" style="width: {{$target->progress}}%" >{{$target->progress}}%</div>

            </div>
            @endif
            </td>
            
            <td><a class="btn btn-gradient-danger " href="{{route('targets.edit',['target_id'=>$target->id])}}" >Edit</a>
            </td>
            <td>
                    <button class="btn btn-gradient-danger"  onclick='ajaxDelete(this,"{{$target->id}}");' >
                      Delete
                    </button> 
            </td> 
          </tr>
          @endforeach
          @endisset
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
  document.getElementById("add_target_btn").addEventListener('click',function(){
    let target_amount = document.getElementById("target_amount").value;
    let target_name = document.getElementById("target_name").value;
    $.ajax({
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
      type:"POST",
      data : {target_amount , target_name},
      dataType : "json",
      url :"{{route('targets.store')}}",
      success : function (response){
        if($.isEmptyObject(response.error)){
          console.log(response);
          createRecord(response.targetData);
        }else{
          printErrorMsg(response.error);
        }
        
      }
  
    });
  });
  
  
 //create DOM elements
  function createRecord (response){
    console.log(response.progress);
  let href= "{{route('targets.edit',['target_id'=>':response.id'])}}";
  href=href.replace(':response.id',response.id);
  let table_body = document.getElementById("target_table");
  let table_row = document.createElement("tr");
  //target amount
  let table_data_target = document.createElement("td");
  table_data_target.innerHTML=response.target_name;
  //target name
  let table_data_amount = document.createElement("td");
  table_data_amount.innerHTML=response.target_amount;
  
  //progress hna ya 3mr 
  let table_data_progress = document.createElement("td");
  let progressBig_div =document.createElement('div');
      progressBig_div.classList.add('progress');
  let progress_div =document.createElement('div');
      progress_div.classList.add('progress-bar');
      progress_div.setAttribute('role','progressbar');
      if(response.progress > 100){
        progress_div.style.width ='100%';
        progress_div.innerHTML = '100%';
        progress_div.classList.add('bg-success');

      }else{
        progress_div.style.width =response.progress+'%';
        progress_div.innerHTML = response.progress+'%';
        progress_div.classList.add('progress-bar','bg-warning');

      }

      table_data_progress.appendChild(progressBig_div);
      progressBig_div.appendChild(progress_div);
       //edit btn
  let btn_edit = document.createElement("a");
  btn_edit.setAttribute("href", href);
  btn_edit.classList.add("btn-gradient-danger","btn");
  btn_edit.innerHTML="Edit";
  let table_data_edit = document.createElement("td");
  table_data_edit.appendChild(btn_edit);
  //del btn
  let btn_delete = document.createElement("button");
  btn_delete.innerHTML="Delete";
  btn_delete.classList.add("btn-gradient-danger","btn")

  let table_data_delete = document.createElement("td");
  table_data_delete.appendChild(btn_delete);

  //Error div
  let errorDiv = document.createElement('div');
  errorDiv.classList.add('alert','alert-danger','print-error-msg-sub');
  errorDiv.style.display = 'none';
  let errorUl=document.createElement('ul');
  errorDiv.appendChild(errorUl);

    
  table_row.appendChild(table_data_target);
  table_row.appendChild(table_data_amount);
  table_row.appendChild(table_data_progress);
  table_row.appendChild(table_data_edit);
  table_row.appendChild(table_data_delete);
  table_body.appendChild(table_row);
  
  //delete with ajax
  ajaxDelete(btn_delete,response.id);
  }
  
  //delete fn
  function ajaxDelete(btn_delete,target_id){
    btn_delete.addEventListener("click",function(){
      let isConfirm=confirm("Do you want to delete this Budget Goal?");
      if(isConfirm){
        let url= "{{route('targets.destroy',['target_id'=>':target.id'])}}";
      url=url.replace(':target.id',target_id);
      $.ajax({
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
      type:"DELETE",
      dataType : "json",
      url : url,
      success : function (response){
        deleteRecord(response,btn_delete);
      }
  
       });
      }
      
    });
  }
  
  //delete action fn
  function deleteRecord(isDeleted,chiledElement){
    if(isDeleted){
      chiledElement.parentElement.parentElement.remove();
    }
  }
  function printErrorMsg (msg) {
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display','block');

    $.each( msg, function( key, value ) {
        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
    });
    setTimeout(function() {
        $(".print-error-msg").css('display','none');
        }, 4000);
}
  </script>
 @endsection
@extends('layouts.app')
@section('content')
<div class="col-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Add your Budget Goals</h4>
        
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
          </div>
     </div>
    </div>
</div>
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Your Budget Goals</h4>
      <table class="table table-striped " id="incomeTable">
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
            <td></td>
            <td><a class="btn btn-danger btn-sm" href="{{route('targets.edit',['target_id'=>$target->id])}}" >Edit</a>
            </td>
            <td class="project-actions text-center">
                    <button class="btn btn-danger btn-sm"  onclick='ajaxDelete(this,"{{$target->id}}");' >
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
        console.log(response);
        createRecord(response);
      }
  
    });
  });
  
  
 //create DOM elements
  function createRecord (response){
  
  let href= "{{route('targets.edit',['target_id'=>':response.id'])}}";
  href=href.replace(':response.id',response.id);
  console.log(href);
  let table_body = document.getElementById("target_table");
  let table_row = document.createElement("tr");
  //target amount
  let table_data_target = document.createElement("td");
  table_data_target.innerHTML=response.target_name;
  //target name
  let table_data_amount = document.createElement("td");
  table_data_amount.innerHTML=response.target_amount;
  //egit btn
  let btn_edit = document.createElement("a");
  btn_edit.setAttribute("href", href);
  btn_edit.innerHTML="Edit";
  let table_data_edit = document.createElement("td");
  table_data_edit.appendChild(btn_edit);
  //del btn
  let btn_delete = document.createElement("button");
  btn_delete.innerHTML="Delete";
  let table_data_delete = document.createElement("td");
  table_data_delete.appendChild(btn_delete);

  table_row.appendChild(table_data_target);
  table_row.appendChild(table_data_amount);
  table_row.appendChild(table_data_edit);
  table_row.appendChild(table_data_delete);
  table_body.appendChild(table_row);
  
  //delete with ajax
  ajaxDelete(btn_delete,response.id);
  }
  
  //delete fn
  function ajaxDelete(btn_delete,target_id){
    btn_delete.addEventListener("click",function(){
      let isConfirm=confirm("Do you want to delete this saving?");
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
  </script>
 @endsection
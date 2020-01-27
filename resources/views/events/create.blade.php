@extends('layouts.app')
 @section('content')
 <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Add your Event</h4>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Event Name</label>
                <div class="col-sm-9">
                  <input type="text"  id="category" name="category" class="form-control" />
                </div>
              </div>
            </div>
            <button  class="btn btn-gradient-danger btn-fw" id="addEvent">Add Event</button>

            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" id="subCategoryNameLabel"></label>
                <div class="col-sm-9" id="subCategoryName">
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row fluid">
                <label class="col-sm-3 col-form-label" id="subCategoryAmountLabel"></label>
                <div class="col-md-9" id="subCategoryAmount">
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row fluid">
                <label class="col-sm-3 col-form-label" id="subCategoryDateLabel"></label>
                <div class="col-md-9" id="subCategoryDate">
                </div>
              </div>
            </div>
          </div>
          <div id="buttonSubCategory">

          </div>
      </div>
    </div>
  </div>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Your Event Expenses</h4>
        <table class="table table-striped " id="eventsTable">
          <thead>
            <tr>
            <th> Category </th>
              <th> Type </th>
              <th> Amount </th>
              <th> Date </th>
              <th> Edit </th>
              <th> Delete </th>
            </tr>
          </thead>
          <tbody>
            <tr>
            
               
            </tr>
          </tbody>
        </table>

        <a class="btn btn-lg btn-gradient-success mt-4" href="/expenses/create">+ Add new expense</a>
      </div>
    </div>
  </div>
  <script >
  
  document.getElementById('addEvent').addEventListener('click',function(){
      
let eventName = document.getElementById('category').value;
if(eventName && eventName != ""){
    let urlEvent = `{{route('events.store')}}`;
$.ajax({
    headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
  type: 'POST',
   url:urlEvent,
   data:{'eventName':eventName},
       success:function(data){
       checkResponse(data);
       }
    });  
}
function checkResponse(data){
    if(data.isStored){
    let eventName = document.createElement('input');
        eventName.setAttribute('type','text');
        document.getElementById('subCategoryNameLabel').innerHTML = 'Event Expense';
    let eventSubCategoryAmount = document.createElement('input');
        eventSubCategoryAmount.setAttribute('type','number');
        eventSubCategoryAmount.setAttribute('step','0.01');
        document.getElementById('subCategoryAmountLabel').innerHTML ='Amount'; 
    let eventSubCategoryDate = document.createElement('input');
        eventSubCategoryDate.setAttribute('type','date');
        document.getElementById('subCategoryDateLabel').innerHTML ='Date'; 
        let addSubCategoryButton = document.createElement('button');
        addSubCategoryButton.innerHTML ="Add Sub-Expense";
        let subCategoryNameParent = document.getElementById('subCategoryName');
        subCategoryNameParent.appendChild(eventName);
        let subCategoryAmountParent = document.getElementById('subCategoryAmount');
        subCategoryAmountParent.appendChild(eventSubCategoryAmount);
        let subCategoryDateParent = document.getElementById('subCategoryDate');
        subCategoryDateParent.appendChild(eventSubCategoryDate);
        document.getElementById('addEvent').disabled =true;
        document.getElementById('category').disabled = true;
        document.getElementById('buttonSubCategory').appendChild(addSubCategoryButton);
        subCategoryAjax(addSubCategoryButton,eventName,eventSubCategoryAmount,eventSubCategoryDate,data.categoryId);
    }   
}
function subCategoryAjax(addButton,subName,amount,date,categoryId){
addButton.addEventListener('click',function(){
    if(subName && amount && date){

        let urlSubCategory = `{{route('events.subStore')}}`;
        let subCategoryInfo={'subName':subName.value,'amount':amount.value,'date':date.value,'categoryId':categoryId};
        $.ajax({
    headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
  url:urlSubCategory,
  type: 'POST',
   data:subCategoryInfo,
       success:function(data){
      console.log(data);
       }
    }); 
    }else{
        console.log(false);
    }
});
}
});</script>
 @endsection
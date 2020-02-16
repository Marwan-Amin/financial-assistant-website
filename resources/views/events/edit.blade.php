@extends('layouts.app')
 @section('content')
 <div class="main-panel">
          <div class="content-wrapper">
 <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Edit your Event</h4>
        @isset($customCategory)

          <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Your Event Expenses</h4>
        <table class="table table-striped " >
          <thead>
            <tr>
              <th> Type </th>
            </tr>
          </thead>
          <tbody >
            <tr>
           <td> <input type="text" id="customCategoryName" class="form-control" value="{{$customCategory->name}}"/></td> 
           <td> <button id="customEventCategory" class="btn btn-gradient-danger btn-fw" value="{{$customCategory->id}}" onclick="editEvent(`{{route('events.update',['id'=>$customCategory->id])}}`);">Edit Event</button></td>
          <td><div class="alert alert-success" id="categorySuccess" role="alert" style="display:none">The Event Successfully Updated</div></td>  
          </tr>
          <tr>
              <td>
              <label class="col-sm-12 col-form-label">Sub-Event Name</label>
                <div class="col-sm-9">
                  <input type="text"  id="subCategoryName" name="subCategoryName" class="form-control" />
                </div>
              </td>
            <td>
            
              
                <label class="col-sm-12 col-form-label" id="subCategoryAmountLabel">Sub-Event Amount</label>
                <div class="col-md-9" id="subCategoryAmount">
                <input type="number"  id="subEventAmount"  class="form-control" />  
             
              </div>
            
          </div>
            </td>
              <td>
              <div id="eventActionButtons">
            <button  class="btn btn-gradient-danger btn-fw"  id="addSubEvent">Add Sub-Event</button>
            </div>
            <div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>
              </td>
           
            
            </tr>
          </tbody>
          <a class="btn btn-lg btn-gradient-success mt-4" href="/events/create">+ Add new Event</a>
            
        </table>
      </div>
    </div>
  </div>
         
          
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Your Sub-Event Expenses</h4>

       
        <table class="table table-striped " >
          <thead>
           
          <tr>
              <th> Type </th>
              <th> Amount </th>
            </tr>
          </thead>
          <tbody id="event_table_body">
          @isset($customCategory->customSubCategories)
          @foreach($customCategory->customSubCategories as $customSubCategory)
            <tr>
           <td> <input type="text" name="customSubCategoryName" class="form-control" value="{{ $customSubCategory->name }}"/></td>

              <td> <input type="number" step="0.01" name="amount" class="form-control" value="{{ $customSubCategory->amount }}"/></td> 
           <td><button  class="btn btn-gradient-danger btn-fw" onclick='editSubEvent(this,`{{$customSubCategory->id}}`)'>Edit Sub-Event</button></td>
          <td><div class="alert alert-success" id="subCategorySuccess" role="alert" style="display:none">The Sub-Event Successfully Updated</div></td>  
          </tr>
          @endforeach
         @else
         <tr>
           <td> <input type="text" name="customSubCategoryName" class="form-control" value="{{ $customSubCategory->name }}"/></td>
          </tr>
         @endisset 
        </tbody>
        </table>
      </div>
    </div>
  </div>

        @else
        @endisset
      </div>
    </div>
  </div>
  </div>
  </div>
  <script>
           let subEventUrl = "{{route('subEvent.update',['id'=>':customSubCategoryId'])}}";
           let urlSubCategory = `{{route('events.subStore')}}`;

      
  </script>
      <script src="{{asset('js/events/edit.js')}}"></script>

  <script src="{{asset('js/events/create.js')}}">
        

  </script>
 
  <script>
      
     

         
        

        
  </script>

 @endsection


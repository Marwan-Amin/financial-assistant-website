@extends('layouts.app')
 @section('content')

 <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Edit your Event</h4>
        @isset($customCategory)

          <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Your Event Expenses</h4>
        <table class="table table-striped " id="eventsTable">
          <thead>
            <tr>
              <th> Type </th>
              <th> Date </th>
            </tr>
          </thead>
          <tbody id="event_table_body">
            <tr>
           <td> <input type="text" id="customCategoryName" class="form-control" value="{{$customCategory->name}}"/></td> 
           <td> <input type="date" id="customCategoryDate" class="form-control" placeholder="dd/mm/yyyy" value="{{ $customCategory->date }}" /></td> 

           <td> <button id="customEventCategory" class="btn btn-gradient-danger btn-fw" onclick='editEvent("{{$customCategory->id}}");'>Edit Event</button></td>
          <td><div class="alert alert-success" id="categorySuccess" role="alert" style="display:none">The Event Successfully Updated</div></td>  
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
         
          
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Your Sub-Event Expenses</h4>
        <table class="table table-striped " id="subEventsTable">
          <thead>
          @isset($customCategory->customSubCategories)
          @foreach($customCategory->customSubCategories as $customSubCategory) 
          <tr>
              <th> Type </th>
              <th> Amount </th>
            </tr>
          </thead>
          <tbody id="event_table_body">
            <tr>
           <td> <input type="text" name="customSubCategoryName" class="form-control" value="{{ $customSubCategory->name }}"/></td>

              <td> <input type="number" step="0.01" name="amount" class="form-control" value="{{ $customSubCategory->amount }}"/></td> 
           <td><button  class="btn btn-gradient-danger btn-fw" onclick='editSubEvent(this,"{{$customSubCategory->id}}")'>Edit Sub-Event</button></td>
          <td><div class="alert alert-success" id="subCategorySuccess" role="alert" style="display:none">The Sub-Event Successfully Updated</div></td>  
          </tr>
          @endforeach
         @else
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
  <script>
       let mainEventUrl = "{{route('events.update',['id'=>':customCategoryId'])}}";
       let subEventUrl = "{{route('subEvent.update',['id'=>':customSubCategoryId'])}}";

  </script>
    <script src="{{asset('UI/PurpleAdmin/assets/js/events/edit.js')}}"></script>

 @endsection


@extends('layouts.app')
 @section('content')
 <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
        <i class="mdi mdi-cake-variant menu-icon"></i>
        </span> Create your own event</h3>
    </div>
 <div class="col-12">
    <div class="card">
      <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
              <div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>
                <label class="col-sm-3 col-form-label">Event Name</label>
                <div class="col-sm-9">
                  <input type="text"  id="category" name="category" class="form-control" />
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row fluid">
                <label class="col-sm-4 col-form-label" id="subCategoryDateLabel">Event Date</label>
                <div class="col-md-8" id="subCategoryDate">
                <input type="date"  id="date" name="date" class="form-control" />  
              </div>
              </div>
            </div>
          </div>
            <div id="eventActionButtons">
            <button  class="btn btn-gradient-danger btn-fw" id="addEvent">Add Event</button>
            </div>
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
         
          <div id="buttonSubCategory">

          </div>
      </div>
    </div>
  </div>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Your Event Expenses</h4>
        <table class="table table-striped " >
          <thead>
            <tr>
              <th> Type </th>
              <th> Amount </th>
            </tr>
          </thead>
          <tbody id="event_table_body">
            <tr>
            
               
            </tr>
          </tbody>
        </table>
        <a class="btn btn-lg btn-gradient-success mt-4" href="/expenses/create">+ Add new expense</a>
      </div>
    </div>
  </div>
  <script>
    let urlEvent = `{{route('events.store')}}`;
    let urlSubCategory = `{{route('events.subStore')}}`;
    let editHref = "{{route('events.edit',['id'=>':data.categoryId'])}}";
    let addEventHref ="{{route('events.create')}}";
  </script>
  <script src="{{asset('UI/PurpleAdmin/assets/js/events/create.js')}}"></script>
  
 @endsection
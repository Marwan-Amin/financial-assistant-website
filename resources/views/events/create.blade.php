@extends('layouts.app')
 @section('content')
 <div class="main-panel">
 <div class="content-wrapper">
 <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">

        <i class="mdi mdi-cake-variant menu-icon"></i>
      </span> 
      Create your own event
  </h3>
</div>
<div class="card my-4 p-4">
      <span>
            <span class="text-primary mr-2">
           <strong> Guide tip </strong> <i class="mdi mdi-arrow-right-bold"></i>
      </span> <span style="letter-spacing:0.5px"> If you wish to save money, you can set your savings budget and track your budget goals</span></span>

              
          
      </div>
<div class="row">

<!--add new card-->
<div class="col-6 mb-4">
    <div class="card">
    <div class="card-header">
            <div class="text-center p-1">
            <strong><span> Add to your events </span></strong>
          </div>
          </div>
      <div class="card-body">        
          <div class="row">
          <div class="alert alert-danger print-error-msg w-100" style="display:none">
                      <ul></ul>
                      </div>
            <div class="col-md-12">
              <div class="form-group row">
                <strong><label class="col-sm-12">Event Name</label></strong>
                <div class="col-sm-12">
                  <input id="category" name="category" class="form-control"  placeholder="Enter your event name">
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group row">
                <strong><label class="col-sm-12">Date</label></strong>
                <div class="col-sm-12">
                  <input type="date" id="date" name="date" class="form-control">
                </div>
              </div>
            </div>
            <div class="col-md-12 text-center">
                <div class="col-sm-12" id="eventActionButtons">
                    <button id="addEvent" class="btn btn-gradient-success">Submit</button>
                </div>
            </div>
          </div>
     </div>
     
    </div>
</div>
<!--add new card-->
<!-- <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                  <div class="alert alert-danger print-error-msg" style="display:none">
                      <ul></ul>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Event Name</label>
                        <div class="col-sm-9">
                          <input type="text" id="category" name="category" class="form-control"  placeholder="Enter your event name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Date</label>
                        <div class="col-sm-9">
                          <input type="date" id="date" name="date" class="form-control"  >
                        </div>
                      </div>
                      <div id="eventActionButtons">
                      <button  id="addEvent" class="btn btn-gradient-success">Submit</button>
                    </div>

            

                  </div>
                </div>
</div> -->

<div class="col-lg-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <table class="table table-striped ">
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
      </div>
    </div>
  </div>



</div>
<div class="row">
<div class="col-6">
                <div class="card">
                  <div class="card-body">
                 

                    <div class="row">
            <div class="col-md-12">
              
              
            <div class="col-md-12">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" id="subCategoryNameLabel"></label>
                <div class="col-sm-9" id="subCategoryName">
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group row fluid">
                <label class="col-sm-3 col-form-label" id="subCategoryAmountLabel"></label>
                <div class="col-md-9" id="subCategoryAmount">
                </div>
              </div>
            </div>

          <div id="buttonSubCategory"></div>
      </div>
    </div>

  <script>
    let urlEvent = `{{route('events.store')}}`;
    let urlSubCategory = `{{route('events.subStore')}}`;
    let editHref = "{{route('events.edit',['id'=>':data.categoryId'])}}";
    let addEventHref ="{{route('events.create')}}";
  </script>
  <script src="{{asset('js/events/create.js')}}"></script>
 @endsection
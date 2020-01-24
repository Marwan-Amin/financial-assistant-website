@extends('layouts.app')
 @section('content')

 <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Add your Incomes</h4>
        <form class="form-sample">
            @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Amount</label>
                <div class="col-sm-9">
                  <input type="number" class="form-control" />
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Add Saving</label>
                <div class="col-sm-9">
                  <input type="number" class="form-control" />
                </div>
              </div>
            </div>
          </div>
          <div class="row">
          
            <div class="col-md-6">
              <div class="form-group row fluid">
                <label class="col-sm-3 col-form-label">Date</label>
                <div class="col-md-9">
                  <input class="form-control" placeholder="dd/mm/yyyy" />
    
                </div>
              </div>
            </div>
          </div>
          <div class="row">
             
          </div>
        </form>
      </div>
    </div>
  </div>

 @endsection
@extends('layouts.app')
 @section('content')
 @if ($errors->any())
 <div class="alert alert-danger">
     <ul>
         @foreach ($errors->all() as $error)
             <li>{{ $error }}</li>
         @endforeach
     </ul>
 </div>
@endif
 <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Add your Budget Goals</h4>
        <form class="form-sample" method="POST" action="/incomes">
            @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Amount</label>
                <div class="col-sm-9">
                  <input type="number" step="0.01" name="amount" class="form-control" />
                </div>
              </div>
            </div>
            
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row fluid">
                <label class="col-sm-3 col-form-label">Date</label>
                <div class="col-md-9">
                  <input type="date" name="date" class="form-control" placeholder="dd/mm/yyyy" />
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label"></label>
                <div class="col-sm-9">
                  <button type="submit" class="btn btn-gradient-danger btn-lg ">+ Add Budget Goal</button>
                </div>
              </div>
            </div>
          </div>
          
        </div> 
      </form>
    </div>
  </div>

 @endsection
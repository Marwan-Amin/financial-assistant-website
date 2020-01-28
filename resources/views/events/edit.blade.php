@extends('layouts.app')
 @section('content')

 <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Edit your Event</h4>
        @isset($customCategory)
        <form class="form-sample" method="POST" action="{{route('events.update',['id'=>$customCategory->id])}}">
            @csrf 
            @method('put')
            <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Your Category</label>
                <div class="col-sm-9">
                  <input type="text" name="customCategoryName" class="form-control" value="{{$customCategory->name}}"/>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-6 col-form-label">Category's Information </label>
               
              </div>
            </div>
          </div>
          @isset($customCategory->customSubCategories)
          @foreach($customCategory->customSubCategories as $customSubCategory)
          
          <div class="row mt-5">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Custom Sub-Category</label>
                <div class="col-sm-9">
                  <input type="text" name="customSubCategory" class="form-control" value="{{ $customSubCategory->name }}"/>
                </div>
              </div>
            </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Amount</label>
                <div class="col-sm-9">
                  <input type="number" step="0.01" name="amount" class="form-control" value="{{ $customSubCategory->amount }}"/>
                </div>
              </div>
            </div>
          
          <div class="row">
            <div class="col-md-12">
              <div class="form-group row fluid">
                <label class="col-sm-3 col-form-label">Date</label>
                <div class="col-md-9">
                  <input type="date" name="date" class="form-control" placeholder="dd/mm/yyyy" value="{{ $customSubCategory->date }}" />
                </div>
              </div>
            </div>
          </div>
          @endforeach
         @else
         @endisset
          
          <button type="submit" class="btn btn-gradient-danger btn-fw">Add Expense</button>

        </form>
        @else
        @endisset
      </div>
    </div>
  </div>
  
 @endsection
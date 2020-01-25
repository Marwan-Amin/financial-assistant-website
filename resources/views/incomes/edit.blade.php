@extends('layouts.app')
 @section('content')

 <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Edit your Income</h4>
        <form class="form-sample" method="POST" action="{{Route('incomes.update',['income_id'=>$income->id])}}">
          @csrf
          @method('PATCH')
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Amount</label>
                <div class="col-sm-9">
                  <input type="number" name="amount" class="form-control" value="{{$income->amount}}" />
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Add Saving</label>
                <div class="col-sm-9">
                  <input type="number" name="saving" class="form-control" />
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row fluid">
                <label class="col-sm-3 col-form-label">Date</label>
                <div class="col-md-9">
                  <input type="date" name="date" value="{{$income->Date}}" class="form-control" placeholder="dd/mm/yyyy" />
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Type</label>
                  <div class="col-sm-9">
                    <select name="type" class="form-control">
                      <option value='1'>Salary</option>
                      <option value='2'>Bank interest</option>
                      <option value='3'>free lancing</option>
                      <option value='4'>Rent money</option>
                    </select>
                  </div>
                </div>
            </div>  
          </div>
          <button type="submit" class="btn btn-gradient-danger btn-fw">Edit Income</button>

        </form>
      </div>
    </div>
  </div>

 @endsection
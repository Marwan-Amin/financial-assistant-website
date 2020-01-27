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
 @endsection
@extends('layouts.app')
@section('content')

  <div class="main-panel">
          <div class="content-wrapper">
          <div class="alert alert-danger print-error-msg" style="display:none">
  <ul></ul>
  </div>
<div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
        <i class="mdi mdi-run-fast menu-icon"></i>
        </span> Your Budget Goals</h3>
    </div>
<div class="col-12">
    <div class="card">
      <div class="card-body">        
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
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-12 col-form-label">Total Savings : <span>{{$savings}}</span></label>
                
              </div>
            </div>
          </div>
          </div>
          
     </div>
    </div>
</div>
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body" id="tableDiv">

      <table class="table table-striped ">

        <thead>
          <tr>
            <th> Goal </th>
            <th> Amount </th>
            <th> Progress </th>
            <th> Action </th>
            
          </tr>
        </thead>
        <tbody id="target_table">
          @isset($targets)
          @foreach ($targets as $target)
          <tr>
            <td>{{$target->target_name}}</td>
            <td>{{$target->target_amount}}</td>
            <td>
            @if($target->progress > 100||$target->progress ==100)
              <div class="progress" style="height: 15px;position: relative;text-align: center;">
              <span style="position: absolute;left: 50%;transform: translateX(-50%);top: 1px;">100% completed</span>
                <div class="progress-bar bg-success" role="progressbar" style="width: 100%" ></div>
              </div>
              
            @else 
            <div class="progress" style="height: 15px;position: relative;text-align: center;">
            
            <span style="position: absolute;left: 50%;transform: translateX(-50%);top: 1px;">{{$target->progress}}% completed</span>
              <div class="progress-bar bg-warning" role="progressbar" style="width: {{$target->progress}}%" ></div>
            </div>
            @endif
            </td>
            <td><a class="btn btn-inverse-info btn-fw " href="{{route('targets.edit',['target_id'=>$target->id])}}" >Edit&nbsp;<i class="mdi mdi-file-check btn-icon-append"></i></a>
            &nbsp;&nbsp; 
            <button class="btn btn-inverse-danger btn-fw"  onclick='ajaxUrl(this,"{{$target->id}}",false);' >
            Delete&nbsp;<i class="mdi mdi-delete"></i>
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
</div>
</div>
<script src="{{asset('js/functions/delete.js')}}"></script>
<script>
 let deleteTargetUrl ="{{route('targets.destroy',['target_id'=>':target.id'])}}";
 let editTargetUrl ="{{route('targets.edit',['target_id'=>':response.id'])}}";
 let storeTargetUrl = "{{route('targets.store')}}";
</script>
<script src="{{asset('js/targets/create.js')}}"></script>

 @endsection
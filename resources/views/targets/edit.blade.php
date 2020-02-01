@extends('layouts.app3')
@section('content')
<div class="main-panel">
          <div class="content-wrapper">
<div class="col-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Edit your Budget Goal</h4>
        <form class="form-sample" method="POST" action="{{Route('targets.update',['target_id'=>$target->id])}}">
            @method('PATCH')
            @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Goal</label>
                <div class="col-sm-9">
                  <input id="target_name" type="text" value="{{$target->target_name}}" name="target_name" class="form-control" />
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Amount</label>
                <div class="col-sm-9">
                  <input id="target_amount" type="number" value="{{$target->target_amount}}" name="target_amount" class="form-control" />
                </div>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label"></label>
                <div class="col-sm-9">
                    <button id="add_target_btn" class="btn btn-gradient-danger btn-lg ">+ Edit Budget Goal</button>
                </div>
              </div>
            </div>
          </div>
        </form>
     </div>
    </div>
</div>
</div>
</div>
@endsection
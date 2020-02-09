@extends('layouts.app')
@section('content')

<div class="main-panel">
          <div class="content-wrapper">
<div class="col-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Edit your Savings</h4>
        <form class="form-sample" method="POST" action="{{Route('savings.update',['saving_id'=>$saving->id])}}">
            @method('PATCH')
            @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Amount</label>
                <div class="col-sm-9">
                  <input type="number" name="amount" value="{{$saving->amount}}" class="form-control" />
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label"></label>
                <div class="col-sm-9">
                    <button type="submit" class="btn btn-gradient-danger btn-lg ">+ Edit Saving</button>
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
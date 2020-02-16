@extends('layouts.app')
@section('content')

<div class="main-panel">
<div class="content-wrapper">
<div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
        <i class="mdi mdi-key menu-icon"></i>
        </span> Savings manager</h3>
    </div>
        @isset($saving)
        <form
    class="form-sample"
    method="POST"
    action="{{Route('savings.update',['saving_id'=>$saving->id])}}">
    @method('PATCH') @csrf
    <div class="row ">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="text-center p-1">
                        <strong>
                            <span>
                                Add to your savings
                            </span>
                        </strong>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <strong>
                                    <label class="col-sm-12">Amount</label>
                                </strong>
                                <div class="col-sm-12">
                                    <input
                                        type="number"
                                        name="amount"
                                        value="{{$saving->amount}}"
                                        class="form-control"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 text-center">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-outline-dark">Confirm Editing</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</form>
        @else
        @endisset
  
</div>
</div>
@endsection
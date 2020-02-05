@extends('layouts.app3')
@section('content')
<div class="alert alert-danger print-error-msg" style="display:none">
  <ul></ul>
  </div>
  <div class="main-panel">
          <div class="content-wrapper">  
<div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
        <i class="mdi mdi-key menu-icon"></i>
        </span> Your Savings</h3>
    </div>
<div class="col-12">
    <div class="card">
      <div class="card-body">        
          <div class="row">
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Amount</label>
                <div class="col-sm-9">
                  <input id="saving_amount" type="number" name="amount" class="form-control" />
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label"></label>
                <div class="col-sm-9">
                    <button id="add_savings_btn" class="btn btn-gradient-info btn-lg ">+ Add Saving</button>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-12 col-form-label">Total : <span id="total">{{$sum}}</span></label>
                 
                
              </div>
            </div>
          </div>
     </div>
    </div>
</div>
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <table class="table table-striped " >
        <thead>
          <tr>
            <th> Amount </th>
            <th> Action </th>
            
          </tr>
        </thead>
        <tbody id="saving_table">
          @isset($savings)
          @foreach ($savings as $saving)
          <tr>
            <td>{{$saving->amount}}</td>
            <td><a class="btn btn-inverse-info btn-fw" href="{{route('savings.edit',['saving_id'=>$saving->id])}}" >Edit&nbsp;<i class="mdi mdi-file-check btn-icon-append"></i></a>
            <button class="btn btn-inverse-danger btn-fw" onclick='ajaxDelete(this,"{{$saving->id}}");' >
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
<script> let savingUrl = "{{route('savings.store')}}";
        let delurl= "{{route('savings.destroy',['saving_id'=>':saving.id'])}}";
        let href= "{{route('savings.edit',['saving_id'=>':response.id'])}}";

 </script>
<script src="{{asset('UI/PurpleAdmin/assets/js/savings/create.js')}}"></script>
@endsection
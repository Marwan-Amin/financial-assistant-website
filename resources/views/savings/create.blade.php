@extends('layouts.app')
@section('content')
<div class="col-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Add your Savings</h4>
        
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Amount</label>
                <div class="col-sm-9">
                  <input id="saving_amount" type="number" name="amount" class="form-control" />
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label"></label>
                <div class="col-sm-9">
                    <button id="add_savings_btn" class="btn btn-gradient-danger btn-lg ">+ Add Saving</button>
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
      <h4 class="card-title">Your Savings</h4>
      <table class="table table-striped " id="incomeTable">
        <thead>
          <tr>
            <th> Amount </th>
            <th> Edit </th>
            <th> Delete </th>
          </tr>
        </thead>
        <tbody id="saving_table">
          @isset($savings)
          @foreach ($savings as $saving)
          <tr>
            <td>{{$saving->amount}}</td>
            <td><a class="btn btn-danger btn-sm" href="{{route('savings.edit',['saving_id'=>$saving->id])}}" >Edit</a>
            </td>
            <td class="project-actions text-center">
                    <button class="btn btn-danger btn-sm"  onclick='ajaxDelete(this,"{{$saving->id}}");' >
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
<script src="{{asset('UI/PurpleAdmin/assets/js/savings/create.js')}}"></script>
@endsection
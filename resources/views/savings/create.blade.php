@extends('layouts.app')
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

    <div class="card my-4 p-4">
      <span>
            <span class="text-primary mr-2">
           <strong> Guide tip </strong> <i class="mdi mdi-arrow-right-bold"></i>
      </span> <span style="letter-spacing:0.5px"> If you wish to save money, you can set your savings budget and track your budget goals</span></span>

              </span>
          
      </div>

      <div class="row">
      <div class="col-4">
    <div class="card">
      <div class="card-body">        
          <div class="row">
            <div class="col-md-12">
              <div class="form-group row">
                <strong><label class="col-sm-12">Amount</label></strong>
                <div class="col-sm-12">
                  <input id="saving_amount" type="number" name="amount" class="form-control" />
                </div>
              </div>
            </div>
            <div class="col-md-12 text-center">
                <div class="col-sm-12">
                    <button id="add_savings_btn" class="btn btn-outline-dark">Submit</button>
                </div>
            </div>
          </div>
         
     </div>
     <section class="saving-box">
          <div class="text-center">
            <h3 class="current-savings">Your current Savings</h3>
          </div>
          <div class="saving-div text-center">
          <span class="savings-amount">{{$sum}} EGP </span>
          </div>
        </section>
    </div>
</div>

<div class="col-lg-8 ">
      <table class="table100" >
        <thead>
          <tr class="bg-gradient-info text-light">
            <th> Savings Amount </th>
            <th>Created at</th>
            <th> Action </th>
            
          </tr>
        </thead>
        <tbody id="saving_table">
          @isset($savings)
          @foreach ($savings as $saving)
          <tr>
            <td>{{$saving->amount}}</td>
            <td>{{($saving->created_at)->toDateString()}}</td>
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
<script> let savingUrl = "{{route('savings.store')}}";
        let delurl= "{{route('savings.destroy',['saving_id'=>':saving.id'])}}";
        let editUrl= "{{route('savings.edit',['saving_id'=>':response.id'])}}";

 </script>
 <script src="{{asset('js/functions/delete.js')}}"></script>
<script src="{{asset('js/savings/create.js')}}"></script>
@endsection
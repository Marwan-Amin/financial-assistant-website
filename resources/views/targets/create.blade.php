@extends('layouts.app')
@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="alert alert-danger print-error-msg" style="display:none"><ul></ul></div>
    <div class="page-header">
          <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-run-fast menu-icon"></i>
            </span> Your Budget Goals</h3>
    </div>
      <div class="card my-4 p-4">
      <span>
            <span class="text-primary mr-2">
           <strong> Guide tip </strong> <i class="mdi mdi-arrow-right-bold"></i>
      </span> <span style="letter-spacing:0.5px"> If you wish to buy new things, you can set the required budget and
            track how much you collected every day in order to 
            stick to your budgeting goals.</span></span>

              </span>
          
      </div>

    <div class="row">
      <div class="col-4">
        <div class="card">
          <div class="card-body">        
              <div class="col-md-12">
  
              <div class="form-group row">
                  <strong><label class="col-sm-12">Goal</label></strong>
                  <div class="col-sm-12">
                    <input id="target_name" type="text" name="target_name" class="form-control" />
                  </div>
              </div>
              </div>

              <div class="col-md-12">
                <div class="form-group row">
                  <strong><label class="col-sm-12">Amount</label></strong>
                  <div class= "col-sm-12">
                    <input id="target_amount" type="number" name="amount" class="form-control" />
                  </div>
                </div>
              </div>

              <div class="col-md-12 text-center">
                  <div class="col-sm-12">
                      <button id="add_target_btn" class="btn btn-outline-dark"> Sumbit</button>
                  </div>
              </div>
          </div> 
        </div>

        <section class="saving-box">
          <div class="text-center">
            <h3 class="current-savings">Your current Savings</h3>
          </div>
          <div class="saving-div text-center">
          <span class="savings-amount">{{$savings}} EGP </span>
          </div>
        </section>
      </div>
<div class="col-md-8">
  
      <table class="table100">
        <thead>
          <tr class="bg-gradient-info text-light">
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
          @if($target->target_amount <= $savings)
            <td style="font-weight:bold" class="column1">{{$target->target_name}}</td>
            <td style="font-weight:bold">{{$target->target_amount}}</td>
            @else
            <td class="column1">{{$target->target_name}}</td>
            <td>{{$target->target_amount}}</td>
            @endif
            <td width="30%" class="text-center">
            @if($target->progress > 100||$target->progress ==100)
              <div class="progress" style="height: 20px;position: relative;text-align: center;">
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success " role="progressbar" style="width: 100%" ></div>
                <span style="position: absolute;left: 40%; top:3px; color:darkslateblue">100%</span>
              
              </div>
              
            @else 
            <div class="progress" style="height: 20px;position: relative;text-align: center;">
            
              <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" style="width: {{$target->progress}}%" ></div>
              <span style="position: absolute;left: 40%; top:3px; color:darkslateblue">{{round($target->progress,2)}}%</span>
            
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

	$(document).ready(function() {
	  $('.progress .progress-bar').progressbar({display_text: 'fill', use_percentage: false});
	});

</script>
<script src="{{asset('js/targets/create.js')}}"></script>

 @endsection
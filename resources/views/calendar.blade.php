@extends('layouts.app')
@section('content')
<div class="main-panel">
          <div class="content-wrapper"> 
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                <div id='calendar'></div>
  <input id="user_incomes" type="hidden" value="{{$user->incomes}}">
  <input id="user_expenses" type="hidden" value="{{$user->subExpenses}}">

  
  <script src="{{asset('js/calendar.js')}}"></script>
          </div>
</div>

                </div>
              </div>
            </div>
  
    @endsection
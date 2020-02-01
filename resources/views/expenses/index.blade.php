@extends('layouts.app3')
@section('content')
<div class="main-panel">
          <div class="content-wrapper">
<div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
        <i class="mdi mdi-cash-usd menu-icon"></i>
        </span> Your Expenses</h3>
    </div>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <table class="table table-striped " >
          <thead>
            <tr>
            <th> Category </th>
              <th> Type </th>
              <th> Amount </th>
              <th> Date </th>
              <th> Action </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($expenses as $expense) 
            <tr>
            <td>{{$expense->category->name}}</td>
                <td>{{$expense->name}}</td>
                <td>{{$expense->pivot->amount}} EGP</td>
                <td>{{$expense->pivot->date}}</td>
                <td>
                  <a class="btn btn-inverse-info btn-fw" href="{{route('expenses.edit',$expense->pivot->id)}}" >Edit&nbsp;<i class="mdi mdi-file-check btn-icon-append"></i></a>
                  &nbsp;&nbsp;
                  <button class="btn btn-inverse-danger btn-fw"  onclick="ajaxDelete('{{$expense->pivot->id}}',this);" >Delete&nbsp;<i class="mdi mdi-delete"></i></button> 
                  
                </td>
                
            </tr>
            @endforeach
          </tbody>
        </table>

        <a class="btn btn-lg btn-gradient-success mt-4" href="/expenses/create">+ Add new expense</a>
      </div>
    </div>
  </div>
   </div>
  </div>
  <script>
       let url = `{{route('expenses.destroy',['id'=>':id'])}}`;

  </script>
  <script src="{{asset('UI/PurpleAdmin/assets/js/expenses/index.js')}}"></script>




@endsection
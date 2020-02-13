@extends('layouts.app')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
<div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
        <i class="mdi mdi-square-inc-cash menu-icon"></i>
        </span> Incomes manager</h3>
    </div>
<div class="col-lg-12 ">
  
    <div class="card">

    <div class="card-body">
        <div class="text-center">
      <a class="btn btn-lg btn-gradient-danger mb-3" href="/incomes/create">+ Add new income</a>
      </div>


    @if (count($user->user_incomes) == 0)
    <table  class="table100">
          <thead >
            <tr class="bg-gradient-danger text-light">
              <th> Type </th>
              <th> Amount </th>
              <th> Date </th>
              <th> Actions </th>
            </tr>
          </thead>
          <tbody>
          </tbody>
    </table>
    <div class="text-center mt-4">
      <h4>You have no records yet</h4>
    </div>
      @endif

      @if(count($user->user_incomes)>0)
      <div class="container">
        <table  class="table100">
          <thead>
            <tr class="bg-gradient-danger text-light">
              <th> Type </th>
              <th> Amount </th>
              <th> Date </th>
              <th> Actions </th>
              
            </tr>
          </thead>
          <tbody>
            @foreach ($user->user_incomes as $user_income) 
            <tr>
                <td>{{$user_income->income->type}}</td>
                <td>{{$user_income->amount}}</td>
                <td>{{$user_income->Date}}</td>
                <td><a class="btn btn-inverse-info btn-fw" href="{{route('incomes.edit',['income_id'=>$user_income->id])}}" >Edit <i class="mdi mdi-file-check btn-icon-append"></i></a>&nbsp;&nbsp;
                <form action="/incomes/{{$user_income->id}}" method="POST" style="display:inline-block">
                      @csrf 
                      @method('DELETE') 
                      <button class="btn btn-inverse-danger btn-fw" type=submit onclick="return confirm('Do you want to delete this income?')" >
                        Delete <i class="mdi mdi-delete"></i>
                      </button> 
                  </form>
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        </div>
        @endif

        

      </div>
    </div>
  </div>
  </div>
  </div>
@endsection
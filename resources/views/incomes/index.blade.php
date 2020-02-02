@extends('layouts.app3')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
<div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
        <i class="mdi mdi-square-inc-cash menu-icon"></i>
        </span> Your incomes</h3>
    </div>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <table class="table table-striped " id="incomeTable">
          <thead>
            <tr>
              <th> Type </th>
              <th> Amount </th>
              <th> Date </th>
              <th> Edit </th>
              <th> Delete </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($user->user_incomes as $user_income) 
            <tr>
                <td>{{$user_income->income->type}}</td>
                <td>{{$user_income->amount}}</td>
                <td>{{$user_income->Date}}</td>
                <td><a class="btn btn-inverse-info btn-fw" href="{{route('incomes.edit',['income_id'=>$user_income->id])}}" >Edit</a>
                </td>
                <td class="project-actions text-center">
                  <form action="/incomes/{{$user_income->id}}" method="POST">
                      @csrf 
                      @method('DELETE') 
                      <button class="btn btn-inverse-danger btn-fw" type=submit onclick="return confirm('Do you want to delete this income?')" >
                        Delete
                      </button> 
                  </form>
              </td> 
            </tr>
            @endforeach
          </tbody>
        </table>
        <a class="btn btn-lg btn-gradient-danger mt-4" href="/incomes/create">+ Add new income</a>

      </div>
    </div>
  </div>
  </div>
  </div>
@endsection
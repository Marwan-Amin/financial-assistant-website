@extends('layouts.app')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Your Incomes</h4>
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
                <td><button class="btn btn-danger btn-sm" href="#" >Edit
                </td>
                <td class="project-actions text-center">
                  <form action="/incomes/{{$user_income->id}}" method="POST">
                      @csrf 
                      @method('DELETE') 
                      <button class="btn btn-danger btn-sm" type=submit onclick="return confirm('Dou you want to delete this income?')" >
                        Delete
                      </button> 
                  </form>
              </td> 
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
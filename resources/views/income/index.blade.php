@extends('layouts.app')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Your Incomes</h4>
        <table class="table table-striped ">
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
            @foreach ($users->incomes as $incoome) 
            <tr>
            <td>{{$income->type}}</td> 
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            </tr>

            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
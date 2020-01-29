@extends('layouts.app')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Your Expenses</h4>
        <table class="table table-striped " id="incomeTable">
          <thead>
            <tr>
            <th> Category </th>
              <th> Type </th>
              <th> Amount </th>
              <th> Date </th>
              <th> Edit </th>
              <th> Delete </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($expenses as $expense) 
            <tr>
            <td>{{$expense->category->name}}</td>
                <td>{{$expense->name}}</td>
                <td>{{$expense->pivot->amount}} EGP</td>
                <td>{{$expense->pivot->date}}</td>
                <td><a class="btn btn-danger btn-sm" href="{{route('expenses.edit',$expense->pivot->id)}}" >Edit</a>
                </td>
                <td class="project-actions text-center">
                 
                      <button class="btn btn-danger btn-sm"  onclick="ajaxDelete('{{$expense->pivot->id}}',this);" >
                        Delete
                      </button> 
                 
              </td> 
            </tr>
            @endforeach
          </tbody>
        </table>

        <a class="btn btn-lg btn-gradient-success mt-4" href="/expenses/create">+ Add new expense</a>
      </div>
    </div>
  </div>
  <script>
       let url = `{{route('expenses.destroy',['id'=>':id'])}}`;

  </script>
  <script src="{{asset('UI/PurpleAdmin/assets/js/expenses/index.js')}}"></script>




@endsection
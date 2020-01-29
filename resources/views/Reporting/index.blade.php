@extends('layouts.app')
@section('content')
<div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
        <i class="mdi mdi-square-inc-cash menu-icon"></i>
        </span> Reportings</h3>
</div>

<div class="row">
<div class="col-lg-5 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Your incomes</h4>
          
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Income Category</th>
                        <th>Income amount</th>
                        <th>Date added</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($user->user_incomes as $user_income) 
                    <tr>
                        <td>{{$user_income->income->type}}</td>
                        <td>{{$user_income->amount}}</td>
                        <td>{{$user_income->Date}}</td>
                        <td>
                            <label class="badge badge-danger">Pending</label>
                        </td>
                    </tr>
                @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="col-lg-7 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Your Expenses</h4>
          
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Expense Category</th>
                        <th>Expense sub Category</th>
                        <th>Expense amount</th>
                        <th>Date added</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($expenses as $expense) 
                    <tr>
                    <td>{{$expense->category->name}}</td>
                <td>{{$expense->name}}</td>
                <td>{{$expense->pivot->amount}}</td>
                <td>{{$expense->pivot->date}}</td>
                        <td>
                            <label class="badge badge-danger">Pending</label>
                        </td>
                    </tr>
                @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>

@endsection
@extends('layouts.app3')
@section('content')
<div class="main-panel">
          <div class="content-wrapper">
<div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
        <i class="mdi mdi-square-inc-cash menu-icon"></i>
        </span> Reportings</h3>
</div>




<div class="row">
<div class="col-lg-12 grid-margin stretch-card">
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
                        @if ($user_income->Date < $date)
                        <td>
                            <label class="badge badge-success">current</label>
                        </td>
                        @else
                        <td>
                            <label class="badge badge-danger">Pending</label>
                        </td>
                        @endif

                    </tr>
                @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="col-lg-12 grid-margin stretch-card">
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
                @if ($expense->pivot->date < $date)
                        <td>
                            <label class="badge badge-success">current</label>
                        </td>
                        @else
                        <td>
                            <label class="badge badge-danger">Pending</label>
                        </td>
                        @endif
                    </tr>
                @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<div class="row">
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Current budget goals</h4>
          
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Target name</th>
                        <th>Target amount</th>
                        <th>Current savings</th>
                        <th>Current Progress</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($user->target as $user_target) 
                    <tr>
                        <td>{{$user_target->target_name}}</td>
                        <td>{{$user_target->target_amount}}</td>
                        <td>{{$user_target->savings}}</td>
                        <td>
            @if($user_target->progress > 100||$user_target->progress ==100)
              <div class="progress">
                <div class="progress-bar bg-success" role="progressbar" style="width: 100%" >100%</div>
                
              </div>
              
            @else 
            <div class="progress">
              <div class="progress-bar bg-warning" role="progressbar" style="width: {{$user_target->progress}}%" >{{$user_target->progress}}%</div>
              
            </div>
            @endif
            </td>
                    </tr>
                @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Your Created events</h4>
          
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Event name</th>
                        <th>total amount</th>
                        <th>date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($custom_categories as $custom_category) 
                    <tr>
                    <td>{{$custom_category->name}}</td>
                <td>{{$custom_category->customSubCategories->sum('amount')}}</td>
                <td>{{$custom_category->date}}</td>
                @if ($custom_category->date <= $date)
                        <td>
                            <label class="badge badge-success">current</label>
                        </td>
                        @else
                        <td>
                            <label class="badge badge-danger">Pending</label>
                        </td>
                        @endif
                    </tr>
                @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
</div>

</div>

@endsection
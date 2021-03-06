@extends('layouts.app')
@section('content')

<div class="main-panel">
<div class="content-wrapper">
              
<div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
        <i class="mdi mdi-square-inc-cash menu-icon"></i>
        </span> Report</h3>
</div>

<div class="row">
    <div class="col-6">
      <form action="{{route('reports.filter')}}" method="post">
      @csrf
        <div class="form-group pl-0">
            <div class="input-group">
            @isset($date)     
            <input type="date" class="form-control" placeholder="Filter by date" name="reportDate" id="reportDate" value="{{$date}}">
            @endisset 
            <div class="input-group-append">
                <button class="pl-4 pr-4 btn btn-sm btn-gradient-primary" type="submit">Filter</button>
            </div>
            </div>
        </div>
      </form>
    </div>
</div>

<div class="row">
<div class="col-12 mb-5">
      <div class="card">
        <div class="card-header">
          <div class="text-center p-1">
            <strong><span> Balance Details </span></strong>
          </div>
        </div>
        <div class="card-body text-center">
        <h1>
          @isset($currentBalance)
          {{$currentBalance}} EGP
          @else
          0 EGP
          @endisset
          </h1>
        </div>
      </div>
  </div>
  </div>

  <div class="row">

  <div class="col-lg-7 grid-margin stretch-card">
    <div class="card">
      <div class="card-header">
        <div class="text-center p-1">
          <strong><span> Balance visulaization </span></strong>
        </div>
      </div>
      
      <div class="card-body">
        <div class="chartjs-size-monitor">
          <div class="chartjs-size-monitor-expand">
            <div class=""></div></div><div class="chartjs-size-monitor-shrink">
              <div class="">
              </div>
            </div>
          </div>
          <canvas id="lineChart" style="height: 247px; display: block; width: 494px;" width="617" height="308" class="chartjs-render-monitor"></canvas>
        </div>
      </div>
    </div>

    <div class="col-5">
      <div class="card">
        <div class="card-header">
          <div class="text-center p-1">
            <strong><span> Statistics </span></strong>
          </div>
        </div>
        <div class="card-body">
        <ul>
            <li> Your average expense in {{$expenseDays}} days: <strong style="color:red"> {{round($expenseAverage,2)}} EGP</strong> </li>
            <li> Your average income in {{$interval}} months: <strong style="color:red"> {{round($incomeAverage,2)}} EGP</strong> </li>
        </ul>  
        </div>
      </div>
    </div>
      
    <div class="row" style="display:none">
      

    
      <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
          
          <div class="card-body">
          <div class="row mb-5">
            <div class="col-md-6">
              <h4 class="card-title">sub Expenses Chart</h4>
              </div>
          </div>
          <div id="pieChart3-container">
            <canvas id="pieChart3" style="height:250px"></canvas>
            </div>
          </div>
        </div>
      </div>

    </div>
</div>


<div class="row">
    
<div class="col-lg-6 grid-margin stretch-card">
    <div class="card">
    <div class="card-header">
      <div class="text-center p-1">
            <strong><span> Income Details </span></strong>
          </div>
      </div>
        <div class="card-body">          
            <table class="new-table" id="incomesTable">
                <thead>
                    <tr class="bg-gradient-danger text-light">
                        <th>Income Category</th>
                        <th>Income amount</th>
                        <th>Date added</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($incomes)
                @foreach ($incomes as $income) 
                    <tr>
                    

                        <td>{{$income->type}}</td>
                        <td>{{$income->pivot->amount}}</td>
                        <td>{{$income->pivot->Date}}</td>
                        @if ($income->pivot->Date <= $date)
                        <td>
                            <label class="badge badge-success">current</label>
                        </td>
                        @else
                        <td>
                            <label class="badge badge-info">Pending</label>
                        </td>
                        @endif
                    </tr>
                @endforeach
                @endisset

                @isset($filterIncomes)
                @foreach ($filterIncomes as $income) 
                    <tr>
                        <td>{{$income->income->type}}</td>
                        <td>{{$income->amount}}</td>
                        <td>{{$income->Date}}</td>
                        @if ($income->Date <= $currentDate)

                        <td>
                            <label class="badge badge-success">current</label>
                        </td>
                        @else
                        <td>
                            <label class="badge badge-info">Pending</label>
                        </td>
                        @endif
                    </tr>
                @endforeach
                @endisset
                    
                </tbody>
            </table>

            @isset($incomes)
            <div class="text-center mt-4"><a class="btn btn-outline-danger btn-icon-text" href="/reports/incomes/download"><i class="mdi mdi-download"></i> Download as Excel Sheet</a></div>
            @endisset

            @isset($filterIncomes)
            <div class="text-center mt-4"><a class="btn btn-outline-danger btn-icon-text" href="/reports/filterIncomes/download"><i class="mdi mdi-download"></i> Download as Excel Sheet</a></div>
            @endisset
        </div>
    </div>
</div>
<div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
        <div class="card-header">
                  <div class="text-center p-1">
                        <strong><span> Incomes' categories chart </span></strong>
                      </div>
                  </div>
          <div class="card-body">
            <canvas id="pieChart2" style="height:250px"></canvas>
          </div>
        </div>
      </div>

<div class="col-lg-6 grid-margin stretch-card">
    <div class="card">
    <div class="card-header">
      <div class="text-center p-1">
            <strong><span> Expenses Details </span></strong>
          </div>
      </div>  
        <div class="card-body">          
            <table class="new-table" id="expensesTable">
                <thead>
                    <tr class="bg-gradient-success text-light">
                        <th>Category</th>
                        <th>sub Category</th>
                        <th>amount</th>
                        <th>Date added</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                @isset($expenses)
                @foreach ($expenses as $expense) 
                    <tr>
                    <td>{{$expense->category->name}}</td>
                <td>{{$expense->name}}</td>
                <td>{{$expense->pivot->amount}}</td>
                <td>{{$expense->pivot->date}}</td>
                @if ($expense->pivot->date <= $date)
                        <td>
                            <label class="badge badge-success">current</label>
                        </td>
                        @else
                        <td>
                            <label class="badge badge-info">Pending</label>
                        </td>
                        @endif
                    </tr>
                @endforeach
                @endisset

                @isset($filterexpenses)
                @foreach ($filterexpenses as $expense) 
                    <tr>
                    <td>{{$expense->subCategory->category->name}}</td>
                <td>{{$expense->subCategory->name}}</td>
                <td>{{$expense->amount}}</td>
                <td>{{$expense->date}}</td>
                
                @if ($expense->date <= $currentDate)
                        <td>
                            <label class="badge badge-success">current</label>
                        </td>
                        @else
                        <td>
                            <label class="badge badge-info">Pending</label>
                        </td>
                        @endif
                    </tr>
                @endforeach
                @endisset
                    
                </tbody>
            </table>
            
 
            @isset($expenses)
            <div class="text-center mt-4"><a class="btn btn-outline-success btn-icon-text" href="/reports/expenses/download"><i class="mdi mdi-download"></i> Download as Excel Sheet</a></div>
            @endisset
            @isset($filterexpenses)
            <div class="text-center mt-4"><a class="btn btn-outline-success btn-icon-text" href="/reports/filterExpenses/download"><i class="mdi mdi-download"></i> Download as Excel Sheet</a></div>
            @endisset

        </div>
    </div>
</div>
<div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                <div class="card-header">
                  <div class="text-center p-1">
                        <strong><span> Expenses' categories chart </span></strong>
                      </div>
                  </div>
                  <div class="card-body">
                    <canvas id="pieChart" style="height:250px"></canvas>
                  </div>
                </div>
              </div>


</div>


<div class="row">
<div class="col-lg-6 grid-margin stretch-card">
    <div class="card">
    <div class="card-header">
      <div class="text-center p-1">
            <strong><span> Budget goals </span></strong>
          </div>
      </div>
        <div class="card-body">          
            <table class="new-table" id="budgetTable">
                <thead>
                    <tr class="bg-gradient-info text-light">
                        <th>Target name</th>
                        <th>Target amount</th>
                        <th>Current Progress</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($targets)
                @foreach ($targets as $target) 
                    <tr>
                        <td>{{$target->target_name}}</td>
                        <td>{{$target->target_amount}}</td>
                        <td class="px-1">

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
                    </tr>
                @endforeach
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="col-lg-6 grid-margin stretch-card">
    <div class="card">
    <div class="card-header">
      <div class="text-center p-1">
            <strong><span> Events details </span></strong>
          </div>
      </div>
        <div class="card-body">          
            <table class="new-table" id="eventsTable">
                <thead>
                    <tr class="bg-gradient-info text-light">
                        <th>Event name</th>
                        <th>Total amount</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($events)
                @foreach ($events as $event) 
                    <tr>
                    <td>{{$event->name}}</td>
                <td>{{$event->customSubCategories->sum('amount')}}</td>
                <td>{{$event->date}}</td>
                @if ($event->date <= $date)
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
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
</div>
</div>

<script>
        var pieChart3;
          var doughnutPieDataForIncomes={};
          var pieChartCanvas3='';
          let dataAmount=[];
          let labels=[];
          let test=[];
          @isset($chartsInfo['totalExpenses'])
         @foreach($chartsInfo['totalExpenses'] as $key=>$expense) dataAmount.push(Number("{{$chartsInfo['totalExpenses'][$key]->total}}")); labels.push("{{$chartsInfo['totalExpenses'][$key]->Category_Name}}");@endforeach
         @else
         dataAmount.push(0);
         labels.push('There is No Expenses')
         @endisset
         @isset($chartsInfo['totalCustomExpeses'])
         @foreach($chartsInfo['totalCustomExpeses'] as $key=>$customExpense) dataAmount.push(Number("{{$chartsInfo['totalCustomExpenses'][$key]->custom_total}}")); labels.push("{{$chartsInfo['totalCustomExpenses'][$key]->Custom_Category_Name}}");@endforeach
         @else
         
         dataAmount.push(0);
         labels.push('There is No Expenses')
         @endisset

              
    $(function () {
  /* ChartJS
   * -------
   * Data and config for chartjs
   */
  'use strict';
  var data = {
    labels: [ 
      @isset($chartsInfo['totalExpenses'])
         @foreach($chartsInfo['totalExpenses'] as $key=>$expense)  "{{$chartsInfo['totalExpenses'][$key]->Category_Name}}",@endforeach
         @endisset
         @isset($chartsInfo['totalCustomExpenses'])
         @foreach($chartsInfo['totalCustomExpenses'] as $key=>$customExpense) "{{$chartsInfo['totalCustomExpenses'][$key]->Custom_Category_Name}}",@endforeach
         @endisset    
    ],
    datasets: [{
      label: 'Total amount',
      data: [ 
        @isset($chartsInfo['totalExpenses'])
         @foreach($chartsInfo['totalExpenses'] as $key=>$expense) {{$chartsInfo['totalExpenses'][$key]->total}}, @endforeach
         @endisset
         @isset($chartsInfo['totalCustomExpenses'])
         @foreach($chartsInfo['totalCustomExpenses'] as $key=>$customExpense) {{$chartsInfo['totalCustomExpenses'][$key]->custom_total}},@endforeach
         @endisset      ],
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
      ],
      borderWidth: 1,
      fill: false
    }]
  };
  var incomesLineData = {
    labels: [ 
      @foreach ( $chartsInfo['userIncomeByDate'] as $income ) '{{  Carbon\Carbon::parse($income["date"])->format('d - F - Y') }}' ,  @endforeach
    ],
    datasets: [{
      label: 'Total amount',
      data: [ 
        @foreach ($chartsInfo['userIncomeByDate'] as $income) {{  $income['totalAmount'] }} ,  @endforeach
            ],
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
      ],
      borderWidth: 1,
      fill: false
    }]
  };

  
// start line chart for expenses

 //start expneses pie chart data
 var expensesLineData = {
    labels: [ 
      @isset($chartsInfo['totalExpenses'])
         @foreach($chartsInfo['totalExpenses'] as $key=>$expense)  "{{$chartsInfo['totalExpenses'][$key]->Category_Name}}",@endforeach
         @endisset
         @isset($chartsInfo['totalCustomExpenses'])
         @foreach($chartsInfo['totalCustomExpenses'] as $key=>$customExpense) "{{$chartsInfo['totalCustomExpenses'][$key]->Custom_Category_Name}}",@endforeach
         @endisset    
    ],
    datasets: [{
      label: 'Total amount',
      data: [ 
        @isset($chartsInfo['totalExpenses'])
         @foreach($chartsInfo['totalExpenses'] as $key=>$expense) {{$chartsInfo['totalExpenses'][$key]->total}}, @endforeach
         @endisset
         @isset($chartsInfo['totalCustomExpenses'])
         @foreach($chartsInfo['totalCustomExpenses'] as $key=>$customExpense) {{$chartsInfo['totalCustomExpenses'][$key]->custom_total}},@endforeach
         @endisset      ],
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
      ],
      borderWidth: 1,
      fill: false
    }]
  };
  //end expneses pie chart data
// end line chart for expenses
  

  //start data for incomes
  var dataForIcomes = {
    labels: [ @foreach ( $chartsInfo['totalIncome'] as $income ) '{{  $income->type }}' ,  @endforeach ],
    datasets: [{
      label: 'Total amount',
      data: [  @foreach ($chartsInfo['totalIncome'] as $income) {{  $income->total }} ,  @endforeach],
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
      ],
      borderWidth: 1,
      fill: false
    }]
  };
  //end data for incomes 
  
  var dataDark = {
    labels: ["2013", "2014", "2014", "2015", "2016", "2017"],
    datasets: [{
      label: 'Total amount',
      data: [10, 19, 3, 5, 2, 3],
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
      ],
      borderWidth: 1,
      fill: false
    }]
  };
  var multiLineData = {
    labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
    datasets: [{
      label: 'Dataset 1',
      data: [12, 19, 3, 5, 2, 3],
      borderColor: [
        '#587ce4'
      ],
      borderWidth: 2,
      fill: false
    },
    {
      label: 'Dataset 2',
      data: [5, 23, 7, 12, 42, 23],
      borderColor: [
        '#ede190'
      ],
      borderWidth: 2,
      fill: false
    },
    {
      label: 'Dataset 3',
      data: [15, 10, 21, 32, 12, 33],
      borderColor: [
        '#f44252'
      ],
      borderWidth: 2,
      fill: false
    }
    ]
  };
  var options = {
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true
        }
      }]
    },
    legend: {
      display: false
    },
    elements: {
      point: {
        radius: 0
      }
    }

  };
  var optionsDark = {
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true
        },
        gridLines: {
          color: '#322f2f',
          zeroLineColor: '#322f2f'
        }
      }],
      xAxes: [{
        ticks: {
          beginAtZero: true
        },
        gridLines: {
          color: '#322f2f',
        }
      }],
    },
    legend: {
      display: false
    },
    elements: {
      point: {
        radius: 0
      }
    }

  };

  //start expneses pie chart data
  var doughnutPieData = {
    labels: [ 
      @isset($chartsInfo['totalExpenses'])
         @foreach($chartsInfo['totalExpenses'] as $key=>$expense)  "{{$chartsInfo['totalExpenses'][$key]->Category_Name}}",@endforeach
         @endisset
         @isset($chartsInfo['totalCustomExpenses'])
         @foreach($chartsInfo['totalCustomExpenses'] as $key=>$customExpense) "{{$chartsInfo['totalCustomExpenses'][$key]->Custom_Category_Name}}",@endforeach
         @endisset    
    ],
    datasets: [{
      label: 'Total amount',
      data: [ 
        @isset($chartsInfo['totalExpenses'])
         @foreach($chartsInfo['totalExpenses'] as $key=>$expense) {{$chartsInfo['totalExpenses'][$key]->total}}, @endforeach
         @endisset
         @isset($chartsInfo['totalCustomExpenses'])
         @foreach($chartsInfo['totalCustomExpenses'] as $key=>$customExpense) {{$chartsInfo['totalCustomExpenses'][$key]->custom_total}},@endforeach
         @endisset      ],
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
      ],
      borderWidth: 1,
      fill: false
    }]
  };
  //end expneses pie chart data
  
    //start incomes pie chart data
    var doughnutPieDataForIncomes = {
    datasets: [{
      data: [


          @foreach ($chartsInfo['totalIncome'] as $income) {{  $income->total }} ,  @endforeach
 
      ],
      backgroundColor: [
        'rgba(255, 99, 132, 0.5)',
        'rgba(54, 162, 235, 0.5)',
        'rgba(255, 206, 86, 0.5)',
        'rgba(75, 192, 192, 0.5)',
        'rgba(153, 102, 255, 0.5)',
        'rgba(255, 159, 64, 0.5)'
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
      ],
    }],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: [


      @foreach ( $chartsInfo['totalIncome'] as $income ) '{{  $income->type }}' ,  @endforeach
    ]
  };
  //end incomes pie chart data
  var doughnutPieOptions = doughnutPieOptionsInitializer();

   //start expenses pie chart data
   subExpensePieChart(doughnutPieOptions,dataAmount,labels);
  //end sub expenses pie chart data

  




  var areaData = {
    labels: ["2013", "2014", "2015", "2016", "2017"],
    datasets: [{
      label: 'Total amount',
      data: [12, 19, 3, 5, 2, 3],
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
      ],
      borderWidth: 1,
      fill: true, // 3: no fill
    }]
  };

  var areaDataDark = {
    labels: ["2013", "2014", "2015", "2016", "2017"],
    datasets: [{
      label: 'Total amount',
      data: [12, 19, 3, 5, 2, 3],
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
      ],
      borderWidth: 1,
      fill: true, // 3: no fill
    }]
  };

  var areaOptions = {
    plugins: {
      filler: {
        propagate: true
      }
    }
  }

  var areaOptionsDark = {
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true
        },
        gridLines: {
          color: '#322f2f',
          zeroLineColor: '#322f2f'
        }
      }],
      xAxes: [{
        ticks: {
          beginAtZero: true
        },
        gridLines: {
          color: '#322f2f',
        }
      }],
    },
    plugins: {
      filler: {
        propagate: true
      }
    }
  }

  var multiAreaData = {
    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    datasets: [{
      label: 'Facebook',
      data: [8, 11, 13, 15, 12, 13, 16, 15, 13, 19, 11, 14],
      borderColor: ['rgba(255, 99, 132, 0.5)'],
      backgroundColor: ['rgba(255, 99, 132, 0.5)'],
      borderWidth: 1,
      fill: true
    },
    {
      label: 'Twitter',
      data: [7, 17, 12, 16, 14, 18, 16, 12, 15, 11, 13, 9],
      borderColor: ['rgba(54, 162, 235, 0.5)'],
      backgroundColor: ['rgba(54, 162, 235, 0.5)'],
      borderWidth: 1,
      fill: true
    },
    {
      label: 'Linkedin',
      data: [6, 14, 16, 20, 12, 18, 15, 12, 17, 19, 15, 11],
      borderColor: ['rgba(255, 206, 86, 0.5)'],
      backgroundColor: ['rgba(255, 206, 86, 0.5)'],
      borderWidth: 1,
      fill: true
    }
    ]
  };

  var multiAreaOptions = {
    plugins: {
      filler: {
        propagate: true
      }
    },
    elements: {
      point: {
        radius: 0
      }
    },
    scales: {
      xAxes: [{
        gridLines: {
          display: false
        }
      }],
      yAxes: [{
        gridLines: {
          display: false
        }
      }]
    }
  }

  var scatterChartData = {
    datasets: [{
      label: 'First Dataset',
      data: [{
        x: -10,
        y: 0
      },
      {
        x: 0,
        y: 3
      },
      {
        x: -25,
        y: 5
      },
      {
        x: 40,
        y: 5
      }
      ],
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)'
      ],
      borderColor: [
        'rgba(255,99,132,1)'
      ],
      borderWidth: 1
    },
    {
      label: 'Second Dataset',
      data: [{
        x: 10,
        y: 5
      },
      {
        x: 20,
        y: -30
      },
      {
        x: -25,
        y: 15
      },
      {
        x: -10,
        y: 5
      }
      ],
      backgroundColor: [
        'rgba(54, 162, 235, 0.2)',
      ],
      borderColor: [
        'rgba(54, 162, 235, 1)',
      ],
      borderWidth: 1
    }
    ]
  }

  var scatterChartDataDark = {
    datasets: [{
      label: 'First Dataset',
      data: [{
        x: -10,
        y: 0
      },
      {
        x: 0,
        y: 3
      },
      {
        x: -25,
        y: 5
      },
      {
        x: 40,
        y: 5
      }
      ],
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)'
      ],
      borderColor: [
        'rgba(255,99,132,1)'
      ],
      borderWidth: 1
    },
    {
      label: 'Second Dataset',
      data: [{
        x: 10,
        y: 5
      },
      {
        x: 20,
        y: -30
      },
      {
        x: -25,
        y: 15
      },
      {
        x: -10,
        y: 5
      }
      ],
      backgroundColor: [
        'rgba(54, 162, 235, 0.2)',
      ],
      borderColor: [
        'rgba(54, 162, 235, 1)',
      ],
      borderWidth: 1
    }
    ]
  }

  var scatterChartOptions = {
    scales: {
      xAxes: [{
        type: 'linear',
        position: 'bottom'
      }]
    }
  }

  var scatterChartOptionsDark = {
    scales: {
      xAxes: [{
        type: 'linear',
        position: 'bottom',
        gridLines: {
          color: '#322f2f',
          zeroLineColor: '#322f2f'
        }
      }],
      yAxes: [{
        gridLines: {
          color: '#322f2f',
          zeroLineColor: '#322f2f'
        }
      }]
    }
  }
  // Get context with jQuery - using jQuery's .get() method.
  //bar chart for expenses
  if ($("#barChart").length) {
    var barChartCanvas = $("#barChart").get(0).getContext("2d");
    // This will get the first returned node in the jQuery collection.
    var barChart = new Chart(barChartCanvas, {
      type: 'bar',
      data: data,
      options: options
    });
  }
 //end bar chart for expenses  

 //start bar chart for incomes 
  if ($("#barChart2").length) {
    var barChartCanvas = $("#barChart2").get(0).getContext("2d");
    // This will get the first returned node in the jQuery collection.
    var barChart = new Chart(barChartCanvas, {
      type: 'bar',
      data: dataForIcomes,
      options: options
    });
  }
  //end bar chart for incomes

  if ($("#barChartDark").length) {
    var barChartCanvasDark = $("#barChartDark").get(0).getContext("2d");
    // This will get the first returned node in the jQuery collection.
    var barChartDark = new Chart(barChartCanvasDark, {
      type: 'bar',
      data: dataDark,
      options: optionsDark
    });
  }

  if ($("#lineChart").length) {
    var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
    var lineChart = new Chart(lineChartCanvas, {
      type: 'line',
      data: incomesLineData,
      options: LineOptionsInitializer()
    });
  }

  if ($("#lineChart2").length) {
    var lineChartCanvas = $("#lineChart2").get(0).getContext("2d");
    var lineChart = new Chart(lineChartCanvas, {
      type: 'line',
      data: expensesLineData,
      options: options
    });
  }

  if ($("#lineChartDark").length) {
    var lineChartCanvasDark = $("#lineChartDark").get(0).getContext("2d");
    var lineChartDark = new Chart(lineChartCanvasDark, {
      type: 'line',
      data: dataDark,
      options: optionsDark
    });
  }

  if ($("#linechart-multi").length) {
    var multiLineCanvas = $("#linechart-multi").get(0).getContext("2d");
    var lineChart = new Chart(multiLineCanvas, {
      type: 'line',
      data: multiLineData,
      options: options
    });
  }

  if ($("#areachart-multi").length) {
    var multiAreaCanvas = $("#areachart-multi").get(0).getContext("2d");
    var multiAreaChart = new Chart(multiAreaCanvas, {
      type: 'line',
      data: multiAreaData,
      options: multiAreaOptions
    });
  }

  if ($("#doughnutChart").length) {
    var doughnutChartCanvas = $("#doughnutChart").get(0).getContext("2d");
    var doughnutChart = new Chart(doughnutChartCanvas, {
      type: 'doughnut',
      data: doughnutPieData,
      options: doughnutPieOptions
    });
  }

  //start expenses chart
  if ($("#pieChart").length) {
    var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
    var pieChart = new Chart(pieChartCanvas, {
      type: 'pie',
      data: doughnutPieData,
      options: doughnutPieOptions
    });
  }
  //end expenses chart

  //start income chart
  if ($("#pieChart2").length) {
    var pieChartCanvas = $("#pieChart2").get(0).getContext("2d");
    var pieChart2 = new Chart(pieChartCanvas, {
      type: 'pie',
      data: doughnutPieDataForIncomes,
      options: doughnutPieOptions
    });
  }
  //end income chart

    //start sub expenses chart

  //end expenses chart

  

  if ($("#areaChart").length) {
    var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
    var areaChart = new Chart(areaChartCanvas, {
      type: 'line',
      data: areaData,
      options: areaOptions
    });
  }

  if ($("#areaChartDark").length) {
    var areaChartCanvas = $("#areaChartDark").get(0).getContext("2d");
    var areaChart = new Chart(areaChartCanvas, {
      type: 'line',
      data: areaDataDark,
      options: areaOptionsDark
    });
  }

  if ($("#scatterChart").length) {
    var scatterChartCanvas = $("#scatterChart").get(0).getContext("2d");
    var scatterChart = new Chart(scatterChartCanvas, {
      type: 'scatter',
      data: scatterChartData,
      options: scatterChartOptions
    });
  }

  if ($("#scatterChartDark").length) {
    var scatterChartCanvas = $("#scatterChartDark").get(0).getContext("2d");
    var scatterChart = new Chart(scatterChartCanvas, {
      type: 'scatter',
      data: scatterChartDataDark,
      options: scatterChartOptionsDark
    });
  }

  if ($("#browserTrafficChart").length) {
    var doughnutChartCanvas = $("#browserTrafficChart").get(0).getContext("2d");
    var doughnutChart = new Chart(doughnutChartCanvas, {
      type: 'doughnut',
      data: browserTrafficData,
      options: doughnutPieOptions
    });
  }
});
function subExpensePieChart(doughnutPieOptions,data,labels){
    data = data.filter(d=>d!=0);
     doughnutPieDataForIncomes = {
    datasets: [{
      data: data,
      backgroundColor: [
        'rgba(255, 99, 132, 0.5)',
        'rgba(54, 162, 235, 0.5)',
        'rgba(255, 206, 86, 0.5)',
        'rgba(75, 192, 192, 0.5)',
        'rgba(153, 102, 255, 0.5)',
        'rgba(255, 159, 64, 0.5)', 
        'rgba(255, 9, 12, 0.5)',
        'rgba(54, 12, 235, 0.5)',
        'rgba(255, 106, 86, 0.5)',
        'rgba(75, 121, 192, 0.5)',
        'rgba(153, 131, 255, 0.5)',
        
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)',
        'rgba(225,99,132,1)',
        'rgba(124, 162, 235, 1)',
        'rgba(215, 206, 86, 1)',
        'rgba(35, 192, 192, 1)',
        'rgba(143, 102, 255, 1)',
       

      ],
    }],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: labels
  };
   if ($("#pieChart3").length ) {
    
     pieChartCanvas3 = $("#pieChart3").get(0).getContext("2d");
    //  pieChartCanvas3.clearRect(0, 0, canvas.width, canvas.height);
        
     pieChart3 = new Chart(pieChartCanvas3, {
      type: 'pie',
      data: doughnutPieDataForIncomes,
      options: doughnutPieOptions
    });

  }else{


  }

}

function doughnutPieOptionsInitializer(){
  var doughnutPieOptions = {
    responsive: true,
    animation: {
      animateScale: true,
      animateRotate: true
    }
  };
  return doughnutPieOptions;
}
function LineOptionsInitializer(){

var optionsForIncomeLineChart = {
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true
        }
      }]
    },
    legend: {
      display: false
    },
    elements: {
      point: {
        radius: 0
      }
    }

  };
  return optionsForIncomeLineChart;
}
    </script>

@endsection
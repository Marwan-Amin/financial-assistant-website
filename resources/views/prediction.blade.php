@extends('layouts.app3')
@section('content')


        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              
              <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Balance Estimator</h4>
                            <canvas id="scatterChart" style="height:250px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
        <script>
        var pieChart3;
          var doughnutPieDataForIncomes={};
          
         
         
    $(function () {
  /* ChartJS
   * -------
   * Data and config for chartjs
   */
  'use strict';
  

  //start data for incomes
  
  //end data for incomes 
  

 
  var scatterChartData = {
    datasets: [{
      label: 'First Dataset',
      data: [{
        x: -10,
        y: 2
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
        'yellow'
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
        y: 6
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
        x: -11,
        y: 5
      }
      ],
      backgroundColor: [
        'black',
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

  
});


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
    </script>
<script>
    var route = "{{route('predict')}}";
    var userPrediction = "{{route('predict.user')}}";
    </script>
      <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@1.0.0/dist/tf.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs-vis@1.0.2/dist/tfjs-vis.umd.min.js"></script>

    <script src="{{asset('UI/PurpleAdmin/assets/js/tensorflow.js')}}"></script>
 @endsection

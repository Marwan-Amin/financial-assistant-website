@extends('layouts.app3')
 @section('content')
 <div class="main-panel">
    <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
          <i class="mdi mdi-home"></i>
        </span> {{ Auth::user()->name }}'s Dashboard</h3>
        <style>
              *{
                  margin: 0;
                  padding: 0;
              }
              .rate {
                  float: left;
                  height: 46px;
                  padding: 0 10px;*{
                  margin: 0;
                  padding: 0;
              }
              .rate {
                  float: left;
                  height: 46px;
                  padding: 0 10px;
              }
              .rate:not(:checked) > input {
                  position:absolute;
                  top:-9999px;
              }
              .rate:not(:checked) > label {
                  float:right;
                  width:1em;
                  overflow:hidden;
                  white-space:nowrap;
                  cursor:pointer;
                  font-size:30px;
                  color:#ccc;
              }
              .rate:not(:checked) > label:before {
                  content: '★ ';
              }
              .rate > input:checked ~ label {
                  color: #ffc700;    
              }
              .rate:not(:checked) > label:hover,
              .rate:not(:checked) > label:hover ~ label {
                  color: #deb217;  
              }
              .rate > input:checked + label:hover,
              .rate > input:checked + label:hover ~ label,
              .rate > input:checked ~ label:hover,
              .rate > input:checked ~ label:hover ~ label,
              .rate > label:hover ~ input:checked ~ label {
                  color: #c59b08;
              }
              }
              .rate:not(:checked) > input {
                  position:absolute;
                  top:-9999px;
              }
              .rate:not(:checked) > label {
                  float:right;
                  width:1em;
                  overflow:hidden;
                  white-space:nowrap;
                  cursor:pointer;
                  font-size:30px;
                  color:#ccc;
              }
              .rate:not(:checked) > label:before {
                  content: '★ ';
              }
              .rate > input:checked ~ label {
                  color: #ffc700;    
              }
              .rate:not(:checked) > label:hover,
              .rate:not(:checked) > label:hover ~ label {
                  color: #deb217;  
              }
              .rate > input:checked + label:hover,
              .rate > input:checked + label:hover ~ label,
              .rate > input:checked ~ label:hover,
              .rate > input:checked ~ label:hover ~ label,
              .rate > label:hover ~ input:checked ~ label {
                  color: #c59b08;
              }
        </style>
        <form action="userHome" method="POST">
          @csrf
          <div class="rate">
            <input type="radio" id="star5" name="rate" value="5" />
            <label for="star5" title="text">5 stars</label>
            <input type="radio" id="star4" name="rate" value="4" />
            <label for="star4" title="text">4 stars</label>
            <input type="radio" id="star3" name="rate" value="3" />
            <label for="star3" title="text">3 stars</label>
            <input type="radio" id="star2" name="rate" value="2" />
            <label for="star2" title="text">2 stars</label>
            <input type="radio" id="star1" name="rate" value="1" />
            <label for="star1" title="text">1 star</label>
          </div>
          <button type="submit" class="btn btn-gradient-danger"> Rate Us</button>
        </form>
        
    </div>
    <div class="row">
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-danger card-img-holder text-white">
          <div class="card-body">
            <h4 class="font-weight-normal mb-3">Income <i class="mdi mdi-chart-line mdi-24px float-right"></i>
            </h4>
            <h2 class="mb-5">{{$sumIncome}} EGP</h2>
            <h6 class="card-text">Increased by 0%</h6>
          </div>
        </div>
      </div>
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-info card-img-holder text-white">
          <div class="card-body">
            <h4 class="font-weight-normal mb-3">Balance<i class="mdi mdi-diamond mdi-24px float-right"></i>
            </h4>
            <h2 class="mb-5">{{$sumIncome - $sumExpense}} EGP</h2>
            <h6 class="card-text">Decreased by 0%</h6>
          </div>
        </div>
      </div>
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-success card-img-holder text-white">
          <div class="card-body">
            <h4 class="font-weight-normal mb-3">Expenses <i class="mdi mdi-square-inc-cash mdi-24px float-right"></i>
            </h4>
            <h2 class="mb-5">{{$sumExpense}} EGP</h2>
            <h6 class="card-text">Increased by 0%</h6>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
        <div class="col md-4 text-center">
        <a href="/incomes/create" class="btn btn-gradient-danger btn-lg mr-3">+ Add incomes</a>

        </div>
        <div class="col md-4 text-center">
          <a href="/savings/create" class="btn btn-gradient-info btn-lg mr-3">+ Add Savings</a>
        </div>
        <div class="col md-4 text-center">
          <a href="/expenses/create" class="btn btn-gradient-success btn-lg mg-auto">+ Add Expenses</a>
        </div>
    </div>
    <div class="row mt-4">

    </div>

    
    <div class="row">
      <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Line chart</h4>
            <canvas id="lineChart" style="height:250px"></canvas>
          </div>
        </div>
      </div>
      <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Bar chart</h4>
            <canvas id="barChart" style="height:230px"></canvas>
          </div>
        </div>
      </div>
    </div>

        <div class="row">
      <div class="col-md-7 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="clearfix">
              <h4 class="card-title float-left">Main Statistics</h4>
              <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>
            </div>
            <canvas id="visit-sale-chart" class="mt-4"></canvas>
          </div>
        </div>
      </div>
      <div class="col-md-5 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Calender</h4>
            <canvas id="traffic-chart"></canvas>
            <div id="traffic-chart-legend" class="rounded-legend legend-vertical legend-bottom-left pt-4"></div>
          </div>
        </div>
      </div>
    </div>
    </div>
    </div>
  @endsection

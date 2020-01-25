@extends('layouts.app')
 @section('content')
    <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
          <i class="mdi mdi-home"></i>
        </span> {{ Auth::user()->name }}'s dashboard</h3>
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
            <h2 class="mb-5">0 EGP</h2>
            <h6 class="card-text">Decreased by 0%</h6>
          </div>
        </div>
      </div>
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-success card-img-holder text-white">
          <div class="card-body">
            <h4 class="font-weight-normal mb-3">Expenses <i class="mdi mdi-square-inc-cash mdi-24px float-right"></i>
            </h4>
            <h2 class="mb-5">0 EGP</h2>
            <h6 class="card-text">Increased by 0%</h6>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
        <div class="col md-4 text-center">
        <a href="/incomes" class="btn btn-gradient-danger btn-lg mr-3">+ Add income</a>
        </div>
        <div class="col md-4 text-center">
        </div>
        <div class="col md-4 text-center">
          <a href="#" class="btn btn-gradient-success btn-lg mg-auto">+ Add income</a>
        </div>
    </div>
    <div class="row mt-4">

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
    <div class="row">
        <div class="col grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="clearfix">
                  <h4 class="card-title text-center">Charts</h4>
                  <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>
                </div>
                <canvas id="visit-sale-chart" class="mt-4"></canvas>
              </div>
            </div>
          </div>
    </div>
  @endsection

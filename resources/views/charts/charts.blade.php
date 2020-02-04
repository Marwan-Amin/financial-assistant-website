
     @extends('layouts.app3')
     @section('content')   

        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Expense Categories</h4>
                    <canvas id="pieChart" style="height:250px"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Expense Categories</h4>
                    <canvas id="barChart" style="height:230px"></canvas>
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="row">
              <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Area chart</h4>
                    <canvas id="areaChart" style="height:250px"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Doughnut chart</h4>
                    <canvas id="doughnutChart" style="height:250px"></canvas>
                  </div>
                </div>
              </div>
            </div> -->
            <!--start expenes chart-->
            <!-- <div class="row">
              <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Scatter chart</h4>
                    <canvas id="scatterChart" style="height:250px"></canvas>
                  </div>
                </div>
              </div>
            </div> -->
            <!--end expenes chart-->

            <!--start incomes chart-->
            <div class="row">
              <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Income categories</h4>
                    <canvas id="pieChart2" style="height:250px"></canvas>
                  </div>
                </div>
              </div>

              <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Income categories</h4>
                    <canvas id="barChart2" style="height:230px"></canvas>
                  </div>
                </div>
              </div>

            </div>
            <!--end incomes chart-->

            <!--start sub Category chart-->
            <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                    <h4 class="card-title">Expenses Line Chart</h4>
                    <canvas id="lineChart2" style="height: 247px; display: block; width: 494px;" width="617" height="308" class="chartjs-render-monitor"></canvas>
                  </div>
                </div>
              </div>

              <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                    <h4 class="card-title">Incomes Line Chart</h4>
                    <canvas id="lineChart" style="height: 247px; display: block; width: 494px;" width="617" height="308" class="chartjs-render-monitor"></canvas>
                  </div>
                </div>
              </div>

            </div>
            <!--end sub Category chart-->

            <!--start sub Category chart-->
            <div class="row">
              

              <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <!--start sub category dropdown-->
                  <div class="row mb-5">
                    <div class="col-md-6">
                      <h4 class="card-title">sub Expenses Chart</h4>
                      </div>

                      <div class="col-md-6">
                          <select class="form-control form-control-lg" id="subCategoryChart">
                              <option value="" selected="">Select Sub Category</option>
                              @foreach($userCategories as $userCategory)
                              <option  value="{{$userCategory['category_id'].','.$userCategory['isCustom']}}">{{$userCategory['categoryName']}}</option>
                              @endforeach
                            </select>
                      </div>
                  </div>
                  <!--end sub category dropdown-->
                  <div id="pieChart3-container">
                    <canvas id="pieChart3" style="height:250px"></canvas>
                    </div>
                  </div>
                </div>
              </div>

            </div>
            <!--end sub Category chart-->
            
          </div>
          <!-- content-wrapper ends -->
         
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
       

      @endsection

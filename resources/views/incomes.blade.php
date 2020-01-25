@extends('layouts.app')
@section('content') 

<section class = "content" > 
  <div class="container-fluid">

    <div class="row">

        <div class="col-md-5">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add income</h3>
                </div>

                <form
                    role="form"
                    action="/incomes"
                    method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">

                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Income Type</label>
                                <div class="col-sm-9">
                                    <input type="number"  name="income" class="form-control"/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Amount</label>
                                <div class="col-sm-9">
                                    <input type="number" name="amount" class="form-control"/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Add savings</label>
                                <div class="col-sm-9">
                                    <input type="number" name="savings" class="form-control"/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group row fluid">
                                <label class="col-sm-3 col-form-label">Date</label>
                                <div class="col-md-9">
                                    <input type="date" name="date" class="form-control"/>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Add income</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>

        <div class="col-7">
            <table class="table table-hover table-light" id="incomeTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Income type</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Date Added</th>
                    </tr>
                </thead>
                <tbody>
@foreach ($UserIncomes as $index => $UserIncome)
                    <tr>
                        <th scope="row">{{$UserIncome->id}}</th>
                        <td>{{$UserIncome->income_id}}</td>
                        <td>{{$UserIncome->amount}}</td>
                        <td>{{$UserIncome->Date}}</td>
                        <td class="project-actions text-center">
                          <form action="/incomes/{{$UserIncome->id}}" method="POST">
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
</section>

@endsection
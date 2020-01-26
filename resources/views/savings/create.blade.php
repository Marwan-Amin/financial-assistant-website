@extends('layouts.app')
@section('content')
<div class="col-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Add your Savings</h4>
        <form class="form-sample" method="POST" action="/savings/create">
            @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Amount</label>
                <div class="col-sm-9">
                  <input type="number" name="amount" class="form-control" />
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label"></label>
                <div class="col-sm-9">
                    <button type="submit" class="btn btn-gradient-danger btn-lg ">+ Add Saving</button>
                </div>
              </div>
            </div>
          </div>
        </form>
        
     </div>
    </div>
</div>

<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Your Savings</h4>
      <table class="table table-striped " id="incomeTable">
        <thead>
          <tr>
            <th> Amount </th>
            <th> Edit </th>
            <th> Delete </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td></td>
            <td><a class="btn btn-danger btn-sm" href="#" >Edit</a>
            </td>
            <td class="project-actions text-center">
                <form action="#" method="POST">
                    @csrf 
                    @method('DELETE') 
                    <button class="btn btn-danger btn-sm" type=submit onclick="return confirm('Do you want to delete this Saving ?')" >
                      Delete
                    </button> 
                </form>
            </td> 
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
@extends('layouts.app3')
@section('content')
<div class="main-panel">
          <div class="content-wrapper">
<div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
        <i class="mdi mdi-key menu-icon"></i>
        </span> Your Savings</h3>
    </div>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <table class="table table-striped " id="incomeTable">
          <thead>
            <tr>
              <th> Amount </th>
              <th> Edit </th>
              <th> Delete </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($savings as $saving)
            <tr>
              <td>{{$saving->amount}}</td>
              <td><a class="btn btn-danger btn-sm" href="{{route('savings.edit',['saving_id'=>$saving->id])}}" >Edit</a>
              </td>
              <td class="project-actions text-center">
                  <form action="/savings/{{$saving->id}}" method="POST">
                      @csrf 
                      @method('DELETE') 
                      <button class="btn btn-danger btn-sm" type=submit onclick="return confirm('Do you want to delete this Saving ?')" >
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
  </div>
  </div>
@endsection
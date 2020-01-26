@extends('layouts.app')
@section('content')
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
            @foreach ($savings as $saving)
            <tr>
              <td>{{$saving->amount}}</td>
              <td><a class="btn btn-danger btn-sm" href="#" >Edit</a>
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
@endsection
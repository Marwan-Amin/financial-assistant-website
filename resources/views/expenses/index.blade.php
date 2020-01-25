@extends('layouts.app')
@section('content') 

<section class = "content" > 
  <div class="container-fluid">

    <div class="row">

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
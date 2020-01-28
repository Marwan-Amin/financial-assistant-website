@extends('layouts.app')
@section('content')
<div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
        <i class="mdi mdi-cash-usd menu-icon"></i>
        </span> Your Expenses</h3>
    </div>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <table class="table table-striped " id="incomeTable">
          <thead>
            <tr>
            <th> Category </th>
              <th> Type </th>
              <th> Amount </th>
              <th> Date </th>
              <th> Edit </th>
              <th> Delete </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($expenses as $expense) 
            <tr>
            <td>{{$expense->category->name}}</td>
                <td>{{$expense->name}}</td>
                <td>{{$expense->pivot->amount}} EGP</td>
                <td>{{$expense->pivot->date}}</td>
                <td><a class="btn btn-danger btn-sm" href="{{route('expenses.edit',$expense->pivot->id)}}" >Edit</a>
                </td>
                <td class="project-actions text-center">
                 
                      <button class="btn btn-danger btn-sm"  onclick="ajaxDelete('{{$expense->pivot->id}}',this);" >
                        Delete
                      </button> 
                 
              </td> 
            </tr>
            @endforeach
          </tbody>
        </table>

        <a class="btn btn-lg btn-gradient-success mt-4" href="/expenses/create">+ Add new expense</a>
      </div>
    </div>
  </div>
  <script>
  function ajaxDelete(id,element){
   let isConfirmed = confirm('Do You Want To Delete This Record ?');
   if(isConfirmed){
    //  as we can't use the javascript variable into laravel blade display syntax so i used dummy string at the place of the id value and use
    //  the replace javascript function to inject into the string that produced from route() function the javascript variable
    let url = `{{route('expenses.destroy',['id'=>':id'])}}`;
        url = url.replace(':id',id);
    $.ajax({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
      type: 'DELETE',
       url:url,
           success:function(data){
           removeRecord(data,element);
           }
        });  
   }
    
  }
  function removeRecord(isRemoved,element){
    if(isRemoved){
      element.parentElement.parentElement.remove();
    }else{

    }
  }
  </script>




@endsection
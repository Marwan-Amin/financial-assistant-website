@extends('layouts.app')
@section('content')
<div class="main-panel">
          <div class="content-wrapper">
<div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
        <i class="mdi mdi-cake-variant menu-icon"></i>
        </span> Your events</h3>
    </div>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body" id="tableDiv">
        <table class="new-table dataTable no-footer" id="eventsTable" >
          <thead>
            <tr class="bg-gradient-danger text-light">
            <th> Category </th>
              <th>Total Amount </th>
              <th>Date </th>

              <th> Action </th>
             
            </tr>
          </thead>
          <tbody>
            @isset($events)
            @foreach ($events as $event) 
            <tr>
            <td>{{$event->name}}</td>
                <td>{{$event->customSubCategories->sum('amount')}}</td>
                <td>{{$event->date}}</td>

                <td><a class="btn btn-inverse-info btn-fw" href="{{route('events.edit',['id'=>$event->id])}}" >Edit&nbsp;<i class="mdi mdi-file-check btn-icon-append"></i></a>
                
                <form method="post" action="{{route('events.destroy',['id'=>$event->id])}}" class="d-inline">
                    @csrf
                    @method('DELETE')
                <button class="btn btn-inverse-danger btn-fw" >
                Delete&nbsp;<i class="mdi mdi-delete"></i>
                      </button>
                </form>
              </td>
                
                 
            </tr>
            @endforeach
            @else
            <div class="text-center mt-3">
              <h4>You Have No Records</h4>
            </div>
            @endisset
          </tbody>
        </table>

      </div>
      <a class="btn btn-lg btn-gradient-success mt-4" href="/events/create">+ Add new Event</a>

    </div>
  </div>
  </div>
  </div>
 
    <script src="{{asset('js/functions/delete.js')}}"></script>


@endsection
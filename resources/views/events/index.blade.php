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
      <div class="card-body">
        <table class="table table-striped " id="eventsTable">
          <thead>
            <tr>
            <th> Category </th>
              <th>Total Amount </th>
              <th>Date </th>

              <th> Action </th>
             
            </tr>
          </thead>
          <tbody>
            @foreach ($events as $event) 
            <tr>
            <td>{{$event->name}}</td>
                <td>{{$event->customSubCategories->sum('amount')}}</td>
                <td>{{$event->date}}</td>

                <td><a class="btn btn-inverse-info btn-fw" href="{{route('events.edit',['id'=>$event->id])}}" >Edit&nbsp;<i class="mdi mdi-file-check btn-icon-append"></i></a>
                
                <a class="btn btn-inverse-primary btn-fw" href="{{route('events.show',['id'=>$event->id])}}" >View&nbsp;<i class="mdi mdi-eye btn-icon-append"></i></a>
                <button class="btn btn-inverse-danger btn-fw"  onclick="ajaxDelete('{{$event->id}}',this);" >
                Delete&nbsp;<i class="mdi mdi-delete"></i>
                      </button>
              </td>
                
                 
            </tr>
            @endforeach
          </tbody>
        </table>

        <a class="btn btn-lg btn-gradient-success mt-4" href="/events/create">+ Add new Event</a>
      </div>
    </div>
  </div>
  </div>
  </div>
  <script>
      let url = `{{route('events.destroy',['id'=>':id'])}}`;

  </script>
  <script src="{{asset('js/events/index.js')}}"></script>

@endsection
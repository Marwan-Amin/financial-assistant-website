@extends('layouts.app')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Your Expenses</h4>
        <table class="table table-striped " id="eventsTable">
          <thead>
            <tr>
            <th> Category </th>
              <th>Total Amount </th>
              <th>Date </th>

              <th> Edit </th>
              <th> Delete </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($events as $event) 
            <tr>
            <td>{{$event->name}}</td>
                <td>{{$event->customSubCategories->sum('amount')}}</td>
                <td>{{$event->date}}</td>

                <td><a class="btn btn-danger btn-sm" href="{{route('events.edit',['id'=>$event->id])}}" >Edit</a>
                </td>
                <td><a class="btn btn-danger btn-sm" href="{{route('events.show',['id'=>$event->id])}}" >View</a>
                </td>
                <td class="project-actions text-center">
                 
                      <button class="btn btn-danger btn-sm"  onclick="ajaxDelete('{{$event->id}}',this);" >
                        Delete
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
  <script src="{{asset('UI/PurpleAdmin/assets/js/events/index.js')}}"></script>

@endsection
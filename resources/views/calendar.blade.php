@extends('layouts.app3')
@section('content')
<div class="main-panel">
          <div class="content-wrapper"> 
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                <div id='calendar'></div>
  <input id="user_incomes" type="hidden" value="{{$user->incomes}}">
  <input id="user_expenses" type="hidden" value="{{$user->subExpenses}}">

  
  <script>

document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');
  let userIncomes =document.getElementById('user_incomes').value;
  let userExpenses = document.getElementById('user_expenses').value;
        userIncomes = JSON.parse(userIncomes);
        userExpenses = JSON.parse(userExpenses);
 let userData=[];
      
  for (let userIncome of userIncomes) {
      userData.push({"title":userIncome.type+':'+userIncome.pivot.amount,'start':userIncome.pivot.Date,'color':"#257e4a",'overlap':true});
  }
 
  for (let userExpense of userExpenses) {
    
      userData.push({"title":userExpense.name+':'+userExpense.pivot.amount,'start':userExpense.pivot.date,'color':"#930000",'overlap':true});
  }
  //add cuurent date
  var today = new Date();
  var dd = today.getDate();

  var mm = today.getMonth()+1; 
  var yyyy = today.getFullYear();
  if(dd<10) 
  {
      dd='0'+dd;
  } 

  if(mm<10) 
  {
      mm='0'+mm;
  } 
  // today = dd+'/'+mm+'/'+yyyy;
  today = yyyy + '-' + mm + '-' + dd;


  //add current date
  var calendar = new FullCalendar.Calendar(calendarEl, {
    plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
    },
    defaultDate: today,
    navLinks: true, // can click day/week names to navigate views
    businessHours: true, // display business hours
    editable: true,
    events: userData
  });

  calendar.render();
});

</script>
          </div>
</div>
<!-- [



//         @foreach ( $user->user_incomes as $user_income ) 

// {{ $user_income->income->type }} 
// {{ $user_income->amount }}
// {{ $user_income->Date }}

// @endforeach

// <?php 

// foreach( $user->user_incomes as $user_income ){

//   echo "{ title :'". $user_income->income->type."'  , start : $user_income->Date } , ";
// }
// ?>
      
      // <?php
      //   echo "{ title : 'Business Lunch'  , start : '2019-08-03' } , ";
      //   echo "{ title : 'Meeting'  , start : '2019-08-04' } , ";
      //   echo "{ title : 'Conference'  , start : '2019-08-05' } , ";
      //   ?>
      // {
      //   title: 'Business Lunch',
      //   start: '2019-08-03T13:00:00',
      //   constraint: 'businessHours'
      // },
      // {
      //   title: 'Meeting',
      //   start: '2019-08-13T11:00:00',
      //   constraint: 'availableForMeeting', // defined below
      //   color: '#257e4a'
      // },
      // {
      //   title: 'Conference',
      //   start: '2019-08-18',
      //   end: '2019-08-20'
      // },
      // {
      //   title: 'Party',
      //   start: '2019-08-29T20:00:00'
      // },

      // // areas where "Meeting" must be dropped
      // {
      //   groupId: 'availableForMeeting',
      //   start: '2019-08-11T10:00:00',
      //   end: '2019-08-11T16:00:00',
      //   rendering: 'background'
      // },
      // {
      //   groupId: 'availableForMeeting',
      //   start: '2019-08-13T10:00:00',
      //   end: '2019-08-13T16:00:00',
      //   rendering: 'background'
      // },

      // // red areas where no events can be dropped
      // {
      //   start: '2019-08-24',
      //   end: '2019-08-28',
      //   overlap: false,
      //   rendering: 'background',
      //   color: '#ff9f89'
      // },
      // {
      //   start: '2019-08-06',
      //   end: '2019-08-08',
      //   overlap: false,
      //   rendering: 'background',
      //   color: '#ff9f89'
      // } -->
    <!-- ] -->
                </div>
              </div>
            </div>
  
    @endsection
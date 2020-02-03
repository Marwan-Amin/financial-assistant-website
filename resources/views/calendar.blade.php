<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />

<link href="{{asset('UI/fullcalendar-4.3.1/packages/core/main.css')}}" rel='stylesheet' />
<link href="{{asset('UI/fullcalendar-4.3.1/packages/daygrid/main.css')}}" rel='stylesheet' />
<link href="{{asset('UI/fullcalendar-4.3.1/packages/timegrid/main.css')}}" rel='stylesheet' />
<link href="{{asset('UI/fullcalendar-4.3.1/packages/list/main.css')}}" rel='stylesheet' />
<script src="{{asset('UI/fullcalendar-4.3.1/packages/core/main.js')}}"></script>
<script src="{{asset('UI/fullcalendar-4.3.1/packages/interaction/main.js')}}"></script>
<script src="{{asset('UI/fullcalendar-4.3.1/packages/daygrid/main.js')}}"></script>
<script src="{{asset('UI/fullcalendar-4.3.1/packages/timegrid/main.js')}}"></script>
<script src="{{asset('UI/fullcalendar-4.3.1/packages/list/main.js')}}"></script>

<style>

  body {
    margin: 40px 10px;
    padding: 0;
    font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
    font-size: 14px;
  }

  #calendar {
    max-width: 900px;
    margin: 0 auto;
  }

</style>
</head>
<body>

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
  var calendar = new FullCalendar.Calendar(calendarEl, {
    plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
    },
    defaultDate: '2019-08-12',
    navLinks: true, // can click day/week names to navigate views
    businessHours: true, // display business hours
    editable: true,
    events: userData
  });

  calendar.render();
});

</script>
</body>
</html>
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
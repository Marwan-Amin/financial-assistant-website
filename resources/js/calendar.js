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
    today = yyyy + '-' + mm + '-' + dd;
  
  
    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
      },
      defaultDate: today,
      navLinks: true, 
      businessHours: true, 
      editable: true,
      events: userData
    });
  
    calendar.render();
  });
  
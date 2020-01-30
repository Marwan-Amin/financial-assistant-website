

  document.getElementById('addEvent').addEventListener('click',function(){
      
let eventName = document.getElementById('category').value;
let eventDate = document.getElementById('date').value;
if(/*(eventName && eventName != "") &&(eventDate && eventDate!="")*/true ){
$.ajax({
    headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
  type: 'POST',
   url:urlEvent,
   data:{'eventName':eventName,'eventDate':eventDate},
       success:function(response){
        if($.isEmptyObject(response.error)){
            console.log(response);
            renderResponse(response);
            // alert(response.success);
        }else{
            printErrorMsgEvent(response.error);
        }
       }
    });  
}


});
//render the inputs needed for the event that user has entered
function renderResponse(data){
    if(data.isStored){
    let eventActionContainer= document.getElementById('eventActionButtons');
   
    //set the href for the edit anchor tag 
        editHref = editHref.replace(':data.categoryId',data.categoryId);

    let editEvent = document.createElement('a');
        editEvent.innerHTML = 'Edit Event';
        editEvent.setAttribute('href',editHref);
        editEvent.setAttribute('class',"btn btn-gradient-success");

               //create anchor tag for create new event
    let addEvent = document.createElement('a');
        addEvent.setAttribute('href',addEventHref); 
        addEvent.innerHTML = "Add Event";
        addEvent.setAttribute('class',"btn btn-gradient-success");
        //append the anchor tags into the eventActionContainer Div
        eventActionContainer.appendChild(editEvent);
        eventActionContainer.appendChild(addEvent);
        
        //create input and set event name into that input 
    let eventName = document.createElement('input');
        eventName.setAttribute('type','text');
        document.getElementById('subCategoryNameLabel').innerHTML = 'Event Expense';
        
        //create input and set event amount into that input 
    let eventSubCategoryAmount = document.createElement('input');
        eventSubCategoryAmount.setAttribute('type','number');
        eventSubCategoryAmount.setAttribute('step','0.01');

        document.getElementById('subCategoryAmountLabel').innerHTML ='Amount'; 
    //     <div class="alert alert-danger print-error-msg" style="display:none">
    //     <ul></ul>
    // </div>
    let errorDiv = document.createElement('div');
        errorDiv.classList.add('alert','alert-danger','print-error-msg-sub');
        errorDiv.style.display = 'none';
        let errorUl=document.createElement('ul');
        errorDiv.appendChild(errorUl);
          //create add custom sub expents button
    let addSubCategoryButton = document.createElement('button');
        addSubCategoryButton.innerHTML ="Add Sub-Expense";
        addSubCategoryButton.setAttribute('class',"btn btn-gradient-success");
         // append the rest of the elements
    let subCategoryNameParent = document.getElementById('subCategoryName');
        subCategoryNameParent.appendChild(eventName);
    let subCategoryAmountParent = document.getElementById('subCategoryAmount');
        subCategoryAmountParent.appendChild(eventSubCategoryAmount);
        subCategoryAmountParent.appendChild(errorDiv);
        //disabled the input and add button of event after the user enter one to stop him of enter more than one event at a time
        document.getElementById('addEvent').disabled =true;
        document.getElementById('category').disabled = true;
        document.getElementById('date').disabled = true;

        document.getElementById('buttonSubCategory').appendChild(addSubCategoryButton);

        // this function will store custoSubCategory By Ajax and it will send data and elements needed to support this operation
        subCategoryAjax(addSubCategoryButton,eventName,eventSubCategoryAmount,data.categoryId);
    }   
}

function subCategoryAjax(addButton,subName,amount,categoryId){
    addButton.addEventListener('click',function(){
      //check if the three fields is full and not empty and if it is it will alert an error
    sendSubCategoryAjax(subName,amount,categoryId,false);
           
    });
    }
   function sendSubCategoryAjax(subName,amount,categoryId,isInUpdate){
    let subCategoryInfo={'subName':subName.value,'amount':amount.value,'categoryId':categoryId};
    $.ajax({
headers: {
   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
url:urlSubCategory,
type: 'POST',
data:subCategoryInfo,
   success:function(response){
     //create information record about the event 
     if($.isEmptyObject(response.error)){
        alert(response.success);
        if(isInUpdate){
            createEventInfoRecordForUpdate(response.data,response.isUpdated);
        }else{
            createEventInfoRecord(response.data,response.isUpdated);
        }
    }else{
        printErrorMsgSub(response.error);
    }
   }
}); 

    }
function printErrorMsgSub (msg) {
    $(".print-error-msg-sub").find("ul").html('');
    $(".print-error-msg-sub").css('display','block');
    $.each( msg, function( key, value ) {
        $(".print-error-msg-sub").find("ul").append('<li>'+value+'</li>');
    });
    setTimeout(function() {
        $(".print-error-msg-sub").css('display','none');
        }, 2000);
}
function createEventInfoRecord(eventData,isUpdated){
    let table_body = document.getElementById('event_table_body');

    if(isUpdated){
        table_body.querySelectorAll('td').forEach(function(element){
            if(element.innerHTML == eventData.name){
                element.nextSibling.innerHTML = eventData.amount+" EGP";
            }
        });
    }else{
        let table_row = document.createElement("tr");
        let table_data_amount = document.createElement("td");
            table_data_amount.innerHTML=eventData.amount+" EGP";
        let table_data_event_type = document.createElement("td");
            table_data_event_type.innerHTML = eventData.name;
            table_row.appendChild(table_data_event_type);
            table_row.appendChild(table_data_amount);
            table_body.appendChild(table_row);
    }
      
          document.getElementById('subCategoryName').querySelector('input').value="";
          document.getElementById('subCategoryAmount').querySelector('input').value="";
}

function createEventInfoRecordForUpdate(eventData,isUpdated){
    let table_body = document.getElementById('event_table_body');

    if(isUpdated){
        table_body.querySelectorAll('input').forEach(function(element){
            if(element.value == eventData.name){
                element.parentElement.parentElement.querySelector("td input[name='amount']").value = eventData.amount;
            }
        });
    }else{
        let table_row = document.createElement("tr");
        let table_data_amount = document.createElement("td");
        let table_data_amount_input = document.createElement('input');
            table_data_amount_input.setAttribute('type','number');
            table_data_amount_input.setAttribute('name','amount');
            table_data_amount_input.classList.add('form-control');
            table_data_amount_input.setAttribute('step','0.01');
            table_data_amount_input.value = eventData.amount;
        let table_data_event_type = document.createElement("td");
        let table_data_event_type_input = document.createElement('input');
            table_data_event_type_input.classList.add('form-control');
            table_data_event_type_input.setAttribute('type','text');
            table_data_event_type_input.setAttribute('name','customSubCategoryName');
            table_data_event_type_input.value = eventData.name;
        let editBtn = document.createElement('button');
            editBtn.classList.add('btn','btn-gradient-danger','btn-fw');
            editBtn.innerHTML ="Edit Sub-Event";
            table_data_amount.appendChild(table_data_amount_input);
            table_data_event_type.appendChild(table_data_event_type_input);
            table_row.appendChild(table_data_event_type);
            table_row.appendChild(table_data_amount);
            table_row.appendChild(editBtn);
            table_body.appendChild(table_row);
            editBtn.addEventListener('click',function(){
                console.log(editBtn,eventData.id);
                editSubEvent(editBtn,eventData.id);
            }); 
    }
      
          document.getElementById('subCategoryName').value="";
          document.getElementById('subEventAmount').value="";
}
function printErrorMsgEvent (msg) {
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display','block');

    $.each( msg, function( key, value ) {
        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
    });
    setTimeout(function() {
        $(".print-error-msg").css('display','none');
        }, 2000);
}
let  previousId ;
document.getElementById("add_savings_btn").addEventListener('click',function(){
    let saving_amount = document.getElementById("saving_amount").value;
    $.ajax({
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
      type:"POST",
      data : {saving_amount},
      dataType : "json",
      url :savingUrl,
      success : function (response){
        if($.isEmptyObject(response.error)){
          console.log(response);
          previousId = response.id;
          createRecord(response);
        }else{
          printErrorMsg(response.error);
        }

      }
  
    });
  });
  
  
  //create DOM elements
  function createRecord (response){
  
  href=href.replace(':response.id',response.id);
  let table_body = document.getElementById("saving_table");
  let table_row = document.createElement("tr");
  //amount td
  let table_data_amount = document.createElement("td");
  table_data_amount.innerHTML=response.amount;
  //edit btn
  let btn_edit = document.createElement("a");
  btn_edit.setAttribute("href", href);
  btn_edit.innerHTML="Edit";
  let table_data_edit = document.createElement("td");
  table_data_edit.appendChild(btn_edit);
  //delete btn
  let btn_delete = document.createElement("button");
  btn_delete.innerHTML="Delete";
  btn_delete.setAttribute("id",response.id)
  let table_data_delete = document.createElement("td");
  table_data_delete.appendChild(btn_delete);
  //Error div
  let errorDiv = document.createElement('div');
  errorDiv.classList.add('alert','alert-danger','print-error-msg-sub');
  errorDiv.style.display = 'none';
  let errorUl=document.createElement('ul');
  errorDiv.appendChild(errorUl);

  table_row.appendChild(table_data_amount);
  table_row.appendChild(table_data_edit);
  table_row.appendChild(table_data_delete);
  table_body.appendChild(table_row);
  //delete with ajax
  let isRefreshed=true;
  ajaxDelete(btn_delete,response.id,isRefreshed);
  }
  
  //delete fn
  function ajaxDelete(btn_delete,id,isRefreshed){
if(isRefreshed){
 

    btn_delete.addEventListener("click",function(){
      let isConfirm=confirm("Do you want to delete this saving?");
      if(isConfirm){
        excuteDelete(btn_delete,id);
      
      }
          });
  }else{
    let isConfirm=confirm("Do you want to delete this saving?");
      if(isConfirm){
        excuteDelete(btn_delete,id);
      
      }
  }
  }
  function excuteDelete(btn_delete,id){
    if(delurl.includes(':saving.id')){
      delurl=delurl.replace(':saving.id',id);
      previousId=id;
    }
    else{
      console.log(previousId,id);

      delurl=delurl.replace('/savings/'+previousId,'/savings/'+id);
      previousId = btn_delete.getAttribute('id');
    }

    console.log(delurl);
    

    $.ajax({
    headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
    type:"DELETE",
    dataType : "json",
    url : delurl,
    success : function (response){
      //console.log(response);
      
      deleteRecord(response,btn_delete);
    }

     });
    
    

  }
  //delete action fn
  function deleteRecord(isDeleted,chiledElement){
    if(isDeleted){
      chiledElement.parentElement.parentElement.remove();
    }
  }
  //print error msg
  function printErrorMsg (msg) {
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display','block');

    $.each( msg, function( key, value ) {
        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
    });
    setTimeout(function() {
        $(".print-error-msg").css('display','none');
        }, 4000);
}
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
          previousId = response.saving.id;
          createRecord(response.saving,response.sum);
        }else{
          printErrorMsg(response.error);
        }

      }
  
    });
  });
  
  
  //create DOM elements
  function createRecord (response,sum){
    if(editUrl.includes(':response.id')){
      editUrl=editUrl.replace(':response.id',response.id);
      previousId=response.id;
    }
    else{
      editUrl=editUrl.replace('/savings/'+previousId+'/edit','/savings/'+response.id+'/edit');
      previousId = response.id;
    }    
  let table_body = document.getElementById("saving_table");
  let table_row = document.createElement("tr");
  //amount td
  let table_data_amount = document.createElement("td");
      table_data_amount.innerHTML=response.amount;
  //edit btn
  let btn_edit = document.createElement("a");
      btn_edit.setAttribute("href", editUrl);
      btn_edit.innerHTML="Edit";
      btn_edit.classList.add("btn-inverse-info", "btn-fw","btn","m-1");
  let edit_icon = document.createElement("i");
      edit_icon.classList.add("mdi" ,"mdi-file-check" ,"btn-icon-append","m-1");
      btn_edit.appendChild(edit_icon);
  let table_data = document.createElement("td");
      table_data.appendChild(btn_edit);
  //delete btn
  let btn_delete = document.createElement("button");
      btn_delete.innerHTML="Delete";
      btn_delete.classList.add("btn-inverse-danger","btn-fw","btn");
      btn_delete.setAttribute("id",response.id)
  let delete_icon = document.createElement("i");
      delete_icon.classList.add("mdi" ,"mdi-delete" ,"btn-icon-append","m-1");
      btn_delete.appendChild(delete_icon);
  //let table_data_delete = document.createElement("td");
      table_data.appendChild(btn_delete);
  //Error div
  let errorDiv = document.createElement('div');
      errorDiv.classList.add('alert','alert-danger','print-error-msg-sub');
      errorDiv.style.display = 'none';
  let errorUl=document.createElement('ul');
      errorDiv.appendChild(errorUl);
  //total savings
  let total = document.getElementById("total");
      total.innerHTML = sum + "EGP";
      table_row.appendChild(table_data_amount);
      table_row.appendChild(table_data);
      table_body.appendChild(table_row);
  //delete with ajax
  let isRefreshed=true;
  confirmDelete(btn_delete,response.id,isRefreshed);
  }
  
  //delete fn
  function confirmDelete(btn_delete,id,isRefreshed){
if(isRefreshed){
    btn_delete.addEventListener("click",function(){
        excuteDelete(btn_delete,id);
      
          });
  }else{
        excuteDelete(btn_delete,id);
  }
  }
  function excuteDelete(btn_delete,id){
    if(delurl.includes(':saving.id')){
      delurl=delurl.replace(':saving.id',id);
      previousId=id;
    }
    else{
      delurl=delurl.replace('/savings/'+previousId,'/savings/'+id);
      previousId = id;
    }    
        ajaxDelete(btn_delete,delurl);
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
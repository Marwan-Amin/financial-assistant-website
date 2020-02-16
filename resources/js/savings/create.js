// document.getElementById("add_savings_btn").addEventListener('click',function(){
//     let saving_amount = document.getElementById("saving_amount").value;
//     $.ajax({
//       headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             },
//       type:"POST",
//       data : {saving_amount},
//       dataType : "json",
//       url :savingUrl,
//       success : function (response){
//         if($.isEmptyObject(response.error)){
//           previousId = response.saving.id;
//           createRecord(response.saving,response.sum);
//         }else{
//           printErrorMsg(response.error);
//         }

//       }
  
//     });
//   });
  
  
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
  let table_body = document.getElementById("tableDiv");
      table_body.querySelectorAll('div h4').forEach(function(element){
        element.parentElement.remove();
      });
  let table_row = document.createElement("tr");
  table_row.setAttribute('role' , 'row');
  //amount td
  let table_data_amount = document.createElement("td");
      table_data_amount.innerHTML=response.amount;
      let table_data_created_at = document.createElement("td");
      table_data_created_at.innerHTML=response.created_at;
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
      table_row.appendChild(table_data_created_at);
      table_row.appendChild(table_data);
      table_body.appendChild(table_row);
  //delete with ajax
  let isRefreshed=false;
  confirmDelete(btn_delete,response.id,isRefreshed);
  }
  
  //delete fn
 window.confirmDelete = function (btn_delete,id,isRefreshed){
if(!isRefreshed){
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
    }
    else{
      delurl=delurl.substring(0,delurl.indexOf('/savings/'))+'/savings/'+id;
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
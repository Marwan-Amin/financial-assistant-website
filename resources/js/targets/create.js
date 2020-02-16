let oldDeletedId,oldEditedId;
// document.getElementById("add_target_btn").addEventListener('click',function(){
//   let target_amount = document.getElementById("target_amount").value;
//   let target_name = document.getElementById("target_name").value;
//   $.ajax({
//     headers: {
//           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//           },
//     type:"POST",
//     data : {target_amount , target_name},
//     dataType : "json",
//     url :storeTargetUrl,
//     success : function (response){
//       if($.isEmptyObject(response.error)){
//         createRecord(response.targetData);
//       }else{
//         printErrorMsg(response.error);
//       } 
//     }
//     ,
//     error : function (error){
//       // alert(error)
//     }

//   });
// });


//create DOM elements
function createRecord (response){
  if(editTargetUrl.includes(':response.id')){
    editTargetUrl = editTargetUrl.replace(':response.id',response.id);
    oldEditedId = response.id;
  }else{
    editTargetUrl = editTargetUrl.replace('/targets/'+oldEditedId+'/edit','/targets/'+response.id+'/edit');
    oldEditedId = response.id;
  }
let table_body = document.getElementById("tableDiv");
    let element = table_body.querySelector('tr td.dataTables_empty');
        if(element){
          element.parentElement.remove();
        }
        
    table_body.querySelectorAll('div h4').forEach(function(element){
     element.parentElement.remove();
    });
let table_row = document.createElement("tr");
    table_row.setAttribute('role','row');
//target amount
let table_data_target = document.createElement("td");
    table_data_target.classList.add('column1')
    table_data_target.innerHTML=response.target_name;
    table_data_target.style="text-align: left; padding-left: 20px;";

//target name
let table_data_amount = document.createElement("td");
    table_data_amount.classList.add('sorting_1')
    table_data_amount.innerHTML=response.target_amount;

//progress 
let table_data_progress = document.createElement("td");
let progressBig_div =document.createElement('div');
    progressBig_div.classList.add('progress');
    progressBig_div.style ="height:20px; position:relative; text-align:center;";
let progress_div =document.createElement('div');
    progress_div.setAttribute('role','progressbar');
    let span = document.createElement('span');
        span.setAttribute('style','position: absolute;left: 40%; top:3px; color:darkslateblue');
if(response.progress >= 100){
    table_data_amount.style = "font-weight:bold";
    table_data_target.style = "font-weight:bold";
    table_data_target.style="text-align: left; padding-left: 20px;";

    span.innerHTML =  100 + '%';
    progressBig_div.classList.add('bg-success');
    progress_div.classList.add('progress-bar', 'progress-bar-striped', 'progress-bar-animated','bg-warning');

}else{
  
    progress_div.style.width =response.progress+'%';
    span.innerHTML =  Math.floor(response.progress * 100) / 100 + '%';

    progress_div.classList.add('progress-bar', 'progress-bar-striped', 'progress-bar-animated','bg-warning');
    }
    table_data_progress.appendChild(progressBig_div);
    progressBig_div.appendChild(progress_div);
    progressBig_div.appendChild(span);
     //edit btn
let table_data = document.createElement("td");

let btn_edit = document.createElement("a");
    btn_edit.setAttribute("href", editTargetUrl);
    btn_edit.classList.add("btn-inverse-info", "btn-fw","btn","m-1");
    btn_edit.innerHTML="Edit";
let edit_icon = document.createElement("i");
    edit_icon.classList.add("mdi" ,"mdi-file-check" ,"btn-icon-append","m-1");
    btn_edit.appendChild(edit_icon);
    table_data.appendChild(btn_edit);
//del btn

let btn_delete = document.createElement("button");
    btn_delete.innerHTML="Delete";
    btn_delete.setAttribute('type','submit');
    btn_delete.classList.add("btn-inverse-danger","btn-fw","btn");
let delete_icon = document.createElement("i");
    delete_icon.classList.add("mdi" ,"mdi-delete" ,"btn-icon-append","m-1");
    btn_delete.appendChild(delete_icon);

    let form = document.createElement('form');
    form.setAttribute('method','post');
    form.setAttribute('action',`/targets/${response.id}`);
    form.classList.add('d-inline');
    let hiddenInputCsrf = document.createElement('input');
        hiddenInputCsrf.setAttribute('type','hidden');
        hiddenInputCsrf.setAttribute('name','_token')
        hiddenInputCsrf.value = csrf;
    let hiddenInputMethod = document.createElement('input');
        hiddenInputMethod.setAttribute('type','hidden');
        hiddenInputMethod.value = 'DELETE'
        hiddenInputMethod.setAttribute('name','_method')
    
    form.appendChild(hiddenInputCsrf);
    form.appendChild(hiddenInputMethod);
    form.appendChild(btn_delete);

    table_data.appendChild(form);

//Error div
let errorDiv = document.createElement('div');
    errorDiv.classList.add('alert','alert-danger','print-error-msg-sub');
    errorDiv.style.display = 'none';
let errorUl=document.createElement('ul');
    errorDiv.appendChild(errorUl);
    table_row.appendChild(table_data_target);
    table_row.appendChild(table_data_amount);
    table_row.appendChild(table_data_progress);
    table_row.appendChild(table_data);
    table_body.appendChild(table_row);
    let elements = table_body.querySelectorAll('tr');
    if(elements.length % 2 == 0){
      elements[elements.length-1].classList.add('even');

    }else{
      elements[elements.length -1].classList.add('odd');
    }
let isAjax = true;
//delete with ajax
// ajaxUrl(btn_delete,response.id,isAjax);
}

//delete fn
window.ajaxUrl = function (btn_delete,target_id,isAjax){
  if(isAjax){
    btn_delete.addEventListener("click",function(){
        setUrl(target_id);
  ajaxDelete(btn_delete,deleteTargetUrl); 
});
  }else{
    setUrl(target_id);
    ajaxDelete(btn_delete,deleteTargetUrl);
  }
}

function setUrl(id){
  if(deleteTargetUrl.includes(':target.id')){
    deleteTargetUrl = deleteTargetUrl.replace(':target.id',id);
  }else{
    deleteTargetUrl = deleteTargetUrl.substring(0,deleteTargetUrl.indexOf('/targets/'))+'/targets/'+id;
    
  }
}

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
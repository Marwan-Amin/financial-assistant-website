document.getElementById("add_savings_btn").addEventListener('click',function(){
    let saving_amount = document.getElementById("saving_amount").value;
    $.ajax({
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
      type:"POST",
      data : {saving_amount},
      dataType : "json",
      url :"{{route('savings.store')}}",
      success : function (response){
        //console.log(response);
        createRecord(response);
      }
  
    });
  });
  
  
  //create DOM elements
  function createRecord (response){
  
  let href= "{{route('savings.edit',['saving_id'=>':response.id'])}}";
  href=href.replace(':response.id',response.id);
  let table_body = document.getElementById("saving_table");
  let table_row = document.createElement("tr");
  let table_data_amount = document.createElement("td");
  table_data_amount.innerHTML=response.amount;
  let btn_edit = document.createElement("a");
  btn_edit.setAttribute("href", href);
  btn_edit.innerHTML="Edit";
  let table_data_edit = document.createElement("td");
  table_data_edit.appendChild(btn_edit);
  let btn_delete = document.createElement("button");
  btn_delete.innerHTML="Delete";
  let table_data_delete = document.createElement("td");
  table_data_delete.appendChild(btn_delete);
  table_row.appendChild(table_data_amount);
  table_row.appendChild(table_data_edit);
  table_row.appendChild(table_data_delete);
  table_body.appendChild(table_row);
  
  //delete with ajax
  ajaxDelete(btn_delete,response.id);
  }
  
  //delete fn
  function ajaxDelete(btn_delete,saving_id){
    btn_delete.addEventListener("click",function(){
      let isConfirm=confirm("Do you want to delete this saving?");
      if(isConfirm){
        let url= "{{route('savings.destroy',['saving_id'=>':saving.id'])}}";
      url=url.replace(':saving.id',saving_id);
      $.ajax({
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
      type:"DELETE",
      dataType : "json",
      url : url,
      success : function (response){
        deleteRecord(response,btn_delete);
      }
  
       });
      }
      
    });
  }
  
  //delete action fn
  function deleteRecord(isDeleted,chiledElement){
    if(isDeleted){
      chiledElement.parentElement.parentElement.remove();
    }
  }
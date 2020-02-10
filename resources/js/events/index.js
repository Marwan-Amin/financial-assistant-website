  let previousId;
  function ajaxDelete(id,element){
   let isConfirmed = confirm('Do You Want To Delete This Event ?');
   if(isConfirmed){
     if(url.includes(':id')){
      url = url.replace(':id',id);
      previousId = id;
     }else{
      url = url.replace('/events/'+previousId,'/events/'+id);
      previousId = id;
     }
       
    $.ajax({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
      type: 'DELETE',
       url:url,
           success:function(data){
           removeRecord(data,element);
           }
        });  
   }
    
  }
  function removeRecord(isRemoved,element){
    if(isRemoved){
      element.parentElement.parentElement.remove();
    }else{

    }
  }
  
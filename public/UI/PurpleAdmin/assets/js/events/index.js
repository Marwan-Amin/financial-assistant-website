  function ajaxDelete(id,element){
   let isConfirmed = confirm('Do You Want To Delete This Event ?');
   if(isConfirmed){
    let url = `{{route('events.destroy',['id'=>':id'])}}`;
        url = url.replace(':id',id);
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
  
function ajaxDelete(id,element){
    let isConfirmed = confirm('Do You Want To Delete This Record ?');
    if(isConfirmed){
     //  as we can't use the javascript variable into laravel blade display syntax so i used dummy string at the place of the id value and use
     //  the replace javascript function to inject into the string that produced from route() function the javascript variable
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
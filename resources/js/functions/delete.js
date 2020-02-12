
window.ajaxDelete = function (element,url){
    let isConfirmed = confirm('Do You Want To Delete This Record ?');
    if(isConfirmed){
     
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
      let parent = element.parentElement.parentElement;
      if(parent.previousElementSibling || parent.nextElementSibling){
        alert(true);
        element.parentElement.parentElement.remove();

      }else{
       element.parentElement.parentElement.remove();
       let div = document.createElement('div');
        let h4 = document.createElement('h4');
             h4.innerHTML = "You Have No Records";
             div.classList.add('text-center','mt-3');
             div.appendChild(h4);
             document.getElementById('tableDiv').appendChild(div);
      }
    }else{
       alert('something went wrong!!');
    }
  }
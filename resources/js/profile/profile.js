document.getElementById('country').addEventListener('change',function(){
    //     
            let countryName = $(this).val();
                url = url.replace(':countryName',countryName);
            if(previousValue != this.value ){
    
              $.ajax({
               type:'GET',
               url:url,
              dataType:'json',
               success:function(data){
                previousValue=countryName;
                renderStates(data);
               }
            });  
            }else if(this.value == "" || previousValue == this.value){
                renderStates(this.value);
            }
    
        });
    function renderStates(states){
     let selectDropDown = document.getElementById('state');
     if(states){
        selectDropDown.innerHTML='';
        for(let i = 0 ;i<states.length;i++){
        let optionItem = document.createElement('option');
        optionItem.value = states[i];
        optionItem.innerHTML = states[i];
        selectDropDown.appendChild(optionItem);
     }
     }else if(states == ""){
        selectDropDown.innerHTML='';
        let optionItem = document.createElement('option');
        optionItem.value = "";
        optionItem.innerHTML = 'No Country Selected';
        optionItem.setAttribute('id','defaultCity');
        selectDropDown.appendChild(optionItem);
     }
     
    }
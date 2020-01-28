 // hold the base value of the dropDownList of countries
 let previousValue = document.getElementById('category').value;
 document.getElementById('category').addEventListener('change',function(){
//     
     let categoryId = $(this).val();
     let url = `{{route('subCategory.ajax',['categoryId'=>':categoryId'])}}`;
     url = url.replace(':categoryId',categoryId);
     // check if the previous or base value is not equal the value changed because if it's the same value then no need to make ajax request as the value desn't changed
     if(previousValue != this.value ){
       $.ajax({
        type:'GET',
        url:url,
       dataType:'json',
        success:function(data){
         //  function to render the data of the response 
         renderStates(data);
        }
     });  
     }
     // check here  the value of dropDownlist which here is empty string which mean that the user has choosed the default value which is "Select Country" 
     else if(this.value == ""){
       // i send it to render and don't stop it as i will check there if it's empty and if it is i will create option tag element with no country was selected
         renderStates(this.value);
     }

 });
function renderStates(subCategories){
let selectDropDown = document.getElementById('subCategories');

if(subCategories){
 selectDropDown.innerHTML='';
 for(let i = 0 ;i<subCategories.length;i++){
 let optionItem = document.createElement('option');
 optionItem.value = subCategories[i].id;
 optionItem.innerHTML = subCategories[i].name;
 selectDropDown.appendChild(optionItem);
}
}else if(subCategories == ""){
 selectDropDown.innerHTML='';
 let optionItem = document.createElement('option');
 optionItem.value = "";
 optionItem.innerHTML = 'No Category Selected';
 optionItem.setAttribute('id','defaultSubCategory');
 selectDropDown.appendChild(optionItem);
}

}
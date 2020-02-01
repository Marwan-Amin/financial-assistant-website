 // hold the base value of the dropDownList of countries
 let previousValue ;

 document.getElementById('selectCategory').querySelectorAll('div input').forEach(function(element){

   element.addEventListener('change',function(){//     
     let categoryId =this.value;
     if(url.includes(':categoryId')){
      url = url.replace(':categoryId',categoryId);
     }else{
      url = url.replace('ajax/'+previousValue,'ajax/'+categoryId);
   }
     // check if the previous or base value is not equal the value changed because if it's the same value then no need to make ajax request as the value desn't changed
     if(previousValue != this.value ){
       $.ajax({
        type:'GET',
        url:url,
       dataType:'json',
        success:function(data){
         //  function to render the data of the response 
         if(data){
            renderSubCategories(data);
         }else{
            alert('Something Went Wrong Please Refresh The Page');
         }
        }
     });  
     previousValue=categoryId;
     }
     // check here  the value of dropDownlist which here is empty string which mean that the user has choosed the default value which is "Select Country" 
    else if(this.value == "others"){

       // i send it to render and don't stop it as i will check there if it's empty and if it is i will create option tag element with no country was selected
         alert('others');
      } 

 });
});
function renderSubCategories(subCategories){
let selectModal = document.getElementById('subCategoriesIcons');


if(subCategories){
   selectModal.innerHTML='';
 for(let i = 0 ;i<subCategories.length;i++){
    let divBox=document.createElement('div');
    let spanName=document.createElement('span');
        spanName.innerHTML=subCategories[i].name;
        divBox.classList.add('cat-box')
    let divIcon=document.createElement('div');
        divIcon.classList.add('glyph-icon',subCategories[i].sub_category_icon);
    let label = document.createElement('label');
        label.setAttribute('for',subCategories[i].name);
    let radioItem = document.createElement('input');
         radioItem.setAttribute('type','radio');
         radioItem.setAttribute('name','subCategory');
         radioItem.setAttribute('id',subCategories[i].name);
        radioItem.value = subCategories[i].id;
        label.appendChild(divIcon);
        label.appendChild(spanName);
        divBox.appendChild(radioItem);
        divBox.appendChild(label);
        selectModal.appendChild(divBox);
}
}else if(subCategories == ""){
 selectDropDown.innerHTML='';
 let optionItem = document.createElement('option');
 optionItem.value = "";
 optionItem.innerHTML = 'No Category Selected';
 selectDropDown.appendChild(optionItem);
}

}
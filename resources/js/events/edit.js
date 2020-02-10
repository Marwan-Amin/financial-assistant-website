let previouseCustomSubCategoryId;
window.editEvent = function (customCategoryId){
    let customCategoryName = document.getElementById('customCategoryName').value;
    let customCategoryDate = document.getElementById('customCategoryDate').value;
      mainEventUrl = mainEventUrl.replace(':customCategoryId',customCategoryId);
    $.ajax({
    headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
 url: mainEventUrl,
 data:{'customCategoryName':customCategoryName,'customCategoryDate':customCategoryDate},
 type: 'PUT',
 success: function(response) {
   ensureResponse(response);
 }
});
  }
  function ensureResponse(isEdited){
    if(isEdited){
        document.getElementById('categorySuccess').style.display = 'block';
        setTimeout(function() {
          document.getElementById('categorySuccess').style.display = 'none';

          }, 2000);
    }
  }
window.editSubEvent =function (chiledElement,customSubCategoryId){
  let customSubCategoryName='';
  let customSubCategoryAmount=0;
  let subCategoryName = chiledElement.parentElement.parentElement.querySelector('td input[name="customSubCategoryName"]');
  let subCategoryAmount = chiledElement.parentElement.parentElement.querySelector('td input[name="amount"]');

            customSubCategoryName=subCategoryName.value;
            customSubCategoryAmount=subCategoryAmount.value;
            console.log(customSubCategoryName,customSubCategoryAmount);
    if(subEventUrl.includes(':customSubCategoryId')){
      subEventUrl = subEventUrl.replace(':customSubCategoryId',customSubCategoryId);
    }else{
      subEventUrl = subEventUrl.replace(previouseCustomSubCategoryId+'/update',customSubCategoryId+'/update');
    }
  $.ajax({
    headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
 url: subEventUrl,
 type: 'PUT',
 data:{'customSubCategoryName':customSubCategoryName,'customSubCategoryAmount':customSubCategoryAmount},
 success: function(response) {
  previouseCustomSubCategoryId = customSubCategoryId;
   renderSuccess(response,chiledElement);
 }
});
}
function renderSuccess(isStored,chiledElement){
  if(isStored){
    chiledElement.parentElement.parentElement.querySelector('#subCategorySuccess').style.display = 'block';
        setTimeout(function() {
          chiledElement.parentElement.parentElement.querySelector('#subCategorySuccess').style.display = 'none';

          }, 2000);
  }
}
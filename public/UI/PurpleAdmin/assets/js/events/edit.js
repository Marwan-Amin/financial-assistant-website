function editEvent(customCategoryId){
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
function editSubEvent(chiledElement,customSubCategoryId){
  let customSubCategoryName='';
  let customSubCategoryAmount=0;
  let subCategoryName = chiledElement.parentElement.querySelector('td input[name="customSubCategoryName"]');
  let subCategoryAmount = chiledElement.parentElement.querySelector('td input[name="amount"]');

            customSubCategoryName=subCategoryName.value;
            customSubCategoryAmount=subCategoryAmount.value;
            console.log(customSubCategoryName,customSubCategoryId);

    
      subEventUrl = subEventUrl.replace(':customSubCategoryId',customSubCategoryId);
  $.ajax({
    headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
 url: subEventUrl,
 type: 'PUT',
 data:{'customSubCategoryName':customSubCategoryName,'customSubCategoryAmount':customSubCategoryAmount},
 success: function(response) {
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
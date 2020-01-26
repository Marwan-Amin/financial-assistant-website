@extends('layouts.app')
 @section('content')

 <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Add your Expenses</h4>
        @isset($subExpenseUser)
        <form class="form-sample" method="POST" action="{{route('expenses.edit',['id'=>$subExpenseUser->id])}}">
        @else
        <form class="form-sample" method="POST" action="{{route('expenses.store')}}">
        @endisset
            @csrf
            @isset($subExpenseUser)
            @method('put')
            @endisset
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Amount</label>
                <div class="col-sm-9">
                  <input type="number" step="0.01" name="amount" class="form-control" 
                  @isset($subExpenseUser)
                  value="{{ $amount= $subExpenseUser?$subExpenseUser->amount:''}}" 
                  @endisset
                  />
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Add Saving</label>
                <div class="col-sm-9">
                  <input type="number" name="saving" class="form-control" />
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row fluid">
                <label class="col-sm-3 col-form-label">Date</label>
                <div class="col-md-9">
                  <input type="date" name="date" class="form-control" placeholder="dd/mm/yyyy"
                  @isset($subExpenseUser)
                  value="{{ $date= $subExpenseUser?$subExpenseUser->date:''}}" 
                  @endisset
                  />
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Type</label>
                  <div class="col-sm-9">
                    <select name="category" class="form-control" id="category">
                    @isset($subExpenseUser)
                 <option  value="{{ $subExpenseUser->subCategory->category->id}}" selected>{{ $subExpenseUser->subCategory->category->name}}</option>
                    @else
                    <option value="" selected>Select Category</option>
                    @endisset
                    
                    @foreach($expensesCategories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                     
                    </select>
                  </div>
                  <div class="col-sm-9">
                  <label for="subCategories" class="col-md-4 col-form-label text-md-right">Sub-Category</label>
                <select class="form-control" name="subCategory" id="subCategories" value="Select Sub-Category">
                @isset($subExpenseUser)
                <option value="{{$subExpenseUser->id}}" selected id="defaultSubCategory">{{$subExpenseUser->subCategory->name}}</option>
                @foreach($subExpenseUser->subCategory->category->subCategories as $subCategory)
                <option value="$subCategory->id"  >{{$subCategory->name}}</option>
                @endforeach
                @else
                <option value="" selected id="defaultSubCategory">No Category Selected</option>

                @endisset
                </select> 
                </div>   

                </div>
            </div>  
          </div>
          <button type="submit" class="btn btn-gradient-danger btn-fw">Add Expense</button>

        </form>
      </div>
    </div>
  </div>
  <script>
    let previousValue = document.getElementById('category').value;
    document.getElementById('category').addEventListener('change',function(){
//     
        let categoryId = $(this).val();
        let url = `{{route('subCategory.ajax',['categoryId'=>':categoryId'])}}`;
        url = url.replace(':categoryId',categoryId);
        if(previousValue != this.value ){
          $.ajax({
           type:'GET',
           url:url,
          dataType:'json',
           success:function(data){
            renderStates(data);
           }
        });  
        }else if(this.value == ""){
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
</script>
 @endsection
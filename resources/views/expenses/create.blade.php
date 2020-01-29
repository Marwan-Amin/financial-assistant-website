@extends('layouts.app')
 @section('content')

 <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Add your Expenses</h4>
        <!-- check if the variable subExpenseUser is send if it is it will be an update action if not so it's normal create  -->
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
                    <select name="category" class="form-control" id="category" value="">
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
                <option value="{{$subExpenseUser->id}}" selected >{{$subExpenseUser->subCategory->name}}</option>
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
          <!-- category icons -->
          <div class="flat_icons row">  
                       
            <div class="cat-box">
              <input type="radio" name="category" id="dish" value="Food" checked="" data-toggle="modal" data-target="#myModal">
              <label for="dish"><div class="glyph-icon flaticon-dish"></div><span>Food</span></label>
            </div>

            <div class="cat-box">
              <input type="radio" name="category" id="champagne" value="Drinks" data-toggle="modal" data-target="#myModal">
              <label for="champagne"><div class="glyph-icon flaticon-champagne"></div><span>Drinks</span></label>
            </div>

            <div class="cat-box">
              <input type="radio" name="category" id="bill" value="Bills" data-toggle="modal" data-target="#myModal">
              <label for="bill"><div class="glyph-icon flaticon-bill"></div><span>Bills</span></label>
            </div>

            <div class="cat-box">
              <input type="radio" name="category" id="bus" value="Transportation" data-toggle="modal" data-target="#myModal">
              <label for="bus"><div class="glyph-icon flaticon-bus"></div><span>Transport</span></label>
            </div>

            <div class="cat-box">
              <input type="radio" name="category" id="house" value="Home" data-toggle="modal" data-target="#myModal">
              <label for="house"><div class="glyph-icon flaticon-house"></div><span>Home</span></label>
            </div>

            <div class="cat-box">
              <input type="radio" name="category" id="car" value="Car" data-toggle="modal" data-target="#myModal">
              <label for="car"><div class="glyph-icon flaticon-car"></div><span>Car<span></label>
            </div>

            <div class="cat-box">
              <input type="radio" name="category" id="playstation" value="Entertainment" data-toggle="modal" data-target="#myModal">
              <label for="playstation"><div class="glyph-icon flaticon-playstation"></div><span>Entertainment</span></label>
            </div>

            <div class="cat-box">
              <input type="radio" name="category" id="fashion" value="Clothing" data-toggle="modal" data-target="#myModal">
              <label for="fashion"><div class="glyph-icon flaticon-fashion"></div><span>Clothing</span></label>
            </div>

            <div class="cat-box">
              <input type="radio" name="category" id="shield" value="Insurance" data-toggle="modal" data-target="#myModal">
              <label for="shield"><div class="glyph-icon flaticon-shield"></div><span>Insurance</span></label>
            </div>

            <div class="cat-box">
              <input type="radio" name="category" id="stethoscope" value="Health" data-toggle="modal" data-target="#myModal">
              <label for="stethoscope"><div class="glyph-icon flaticon-stethoscope"></div><span>Health</span></label>
            </div>

            <div class="cat-box">
              <input type="radio" name="category" id="dumbbell" value="Sport" data-toggle="modal" data-target="#myModal">
              <label for="dumbbell"><div class="glyph-icon flaticon-dumbbell"></div><span>Sport</span></label>
            </div>

            <div class="cat-box">
              <input type="radio" name="category" id="baby" value="Baby" data-toggle="modal" data-target="#myModal">
              <label for="baby"><div class="glyph-icon flaticon-baby"></div><span>Baby</span></label>
            </div>

            <div class="cat-box">
              <input type="radio" name="category" id="icon_13" value="Pet" data-toggle="modal" data-target="#myModal">
              <label for="icon_13"><div class="glyph-icon flaticon-happy"></div><span>Pet</span></label>
            </div>

            <div class="cat-box">
              <input type="radio" name="category" id="salon" value="Beauty" data-toggle="modal" data-target="#myModal">
              <label for="salon"><div class="glyph-icon flaticon-salon"></div><span>Beauty</span></label>
            </div>

            <div class="cat-box">
              <input type="radio" name="category" id="computer" value="Electronics" data-toggle="modal" data-target="#myModal">
              <label for="computer"><div class="glyph-icon flaticon-computer"></div><span>Electronics</span></label>
            </div>

            <div class="cat-box">
              <input type="radio" name="category" id="gift" value="Gifts" data-toggle="modal" data-target="#myModal">
              <label for="gift"><div class="glyph-icon flaticon-gift"></div><span>gift</span></label>
            </div>

            <div class="cat-box">
              <input type="radio" name="category" id="airplane" value="Travel" data-toggle="modal" data-target="#myModal">
              <label for="airplane"><div class="glyph-icon flaticon-airplane"></div><span>Travel</span></label>
            </div>

            <div class="cat-box">
              <input type="radio" name="category" id="book" value="Education" data-toggle="modal" data-target="#myModal">
              <label for="book"><div class="glyph-icon flaticon-book"></div><span>Education</span></label>
            </div>

            <div class="cat-box">
              <input type="radio" name="category" id="book-1" value="Books" data-toggle="modal" data-target="#myModal">
              <label for="book-1"><div class="glyph-icon flaticon-book-1"></div><span>Books</span></label>
            </div>

            <div class="cat-box">
              <input type="radio" name="category" id="work" value="Office" data-toggle="modal" data-target="#myModal">
              <label for="work"><div class="glyph-icon flaticon-work"></div><span>office</span></label>
            </div>

            <div class="cat-box">
              <input type="radio" name="category" id="add" value="Others">
              <label for="add"><div class="glyph-icon flaticon-add"></div><span>Others</span></label>
            </div>
   
          </div>
          <!-- category icons -->





            <!--pop up-->
              <!-- The Modal -->
              <div class="modal fade" id="myModal">
                <div class="modal-dialog">
                  <div class="modal-content">
                  
                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Select Sub Category</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
                    <!-- Modal body -->
                    <div class="modal-body">
                      <!--sub category icons -->
                      <div class="flat_icons row">  


                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="vegetable" value="Vegtables">
                          <label for="vegetable"><div class="glyph-icon flaticon-vegetable"></div><span>vegetables</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="grapes" value="Fruits">
                          <label for="grapes"><div class="glyph-icon flaticon-grapes"></div><span>Fruits</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="pizza" value="Fast Foood">
                          <label for="pizza"><div class="glyph-icon flaticon-pizza"></div><span>Fast Food</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="meat" value="Meat">
                          <label for="meat"><div class="glyph-icon flaticon-meat"></div><span>Meat</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="chicken" value="Chicken">
                          <label for="chicken"><div class="glyph-icon flaticon-chicken"></div><span>Chicken</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="fish" value="Fish">
                          <label for="fish"><div class="glyph-icon flaticon-fish"></div><span>Fish</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="popcorn" value="Snacks">
                          <label for="popcorn"><div class="glyph-icon flaticon-popcorn"></div><span>Snacks</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="olive-oil" value="Oils">
                          <label for="olive-oil"><div class="glyph-icon flaticon-olive-oil"></div><span>Oils</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="grocery" value="Groceries">
                          <label for="grocery"><div class="glyph-icon flaticon-grocery"></div><span>Groceries</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="fork" value="Restaurants">
                          <label for="fork"><div class="glyph-icon flaticon-fork"></div><span>Restaurants</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="water" value="Water">
                          <label for="water"><div class="glyph-icon flaticon-water"></div><span>Water</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="milk-tank" value="Milk">
                          <label for="milk-tank"><div class="glyph-icon flaticon-milk-tank"></div><span>Milk</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="coffee-cup" value="Coffee">
                          <label for="coffee-cup"><div class="glyph-icon flaticon-coffee-cup"></div><span>Coffee</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="tea" value="Tea">
                          <label for="tea"><div class="glyph-icon flaticon-tea"></div><span>Tea</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="diet" value="Juice">
                          <label for="diet"><div class="glyph-icon flaticon-diet"></div><span>Juice</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="plug" value="Electricity bill">
                          <label for="plug"><div class="glyph-icon flaticon-plug"></div><span>Electricity bill</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="valve" value="Natural gas bill">
                          <label for="valve"><div class="glyph-icon flaticon-valve"></div><span>Natural gas bill</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="bill-1" value="water bill">
                          <label for="bill-1"><div class="glyph-icon flaticon-bill-1"></div><span>water bill</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="lan" value="Internet connection bill">
                          <label for="lan"><div class="glyph-icon flaticon-lan"></div><span>Internet bill</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="call" value="Land line bill">
                          <label for="call"><div class="glyph-icon flaticon-call"></div><span>Land line bill</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="air-freight" value="Plane">
                          <label for="air-freight"><div class="glyph-icon flaticon-air-freight"></div><span>Plane</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="bus-1" value="Bus">
                          <label for="bus-1"><div class="glyph-icon flaticon-bus-1"></div><span>Bus</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="taxi" value="Taxi">
                          <label for="taxi"><div class="glyph-icon flaticon-taxi"></div><span>Taxi</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="subway" value="Train">
                          <label for="subway"><div class="glyph-icon flaticon-subway"></div><span>Train</span></label>
                        </div>

                        </div>
                        
                      </div>
                      <!--sub category icons -->
                    
                    <!-- Modal footer -->
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                    
                  </div>
                </div>
              </div>

            <!--pop up-->      






          <button type="submit" class="btn btn-gradient-danger btn-fw">Add Expense</button>

        </form>
      </div>
    </div>
  </div>
  <script>
       let url = `{{route('subCategory.ajax',['categoryId'=>':categoryId'])}}`;

  </script>
  <script src="{{asset('UI/PurpleAdmin/assets/js/expenses/create.js')}}"></script>
 @endsection
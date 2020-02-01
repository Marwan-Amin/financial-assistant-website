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
                <option value="{{$subExpenseUser->subCategory->id}}" selected >{{$subExpenseUser->subCategory->name}}</option>
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
                      <div class="flat_icons row" ">  


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

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="uber" value="Uber">
                          <label for="uber"><div class="glyph-icon flaticon-uber"></div><span>Uber</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="route" value="Careem">
                          <label for="route"><div class="glyph-icon flaticon-route"></div><span>Careem</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="roller" value="houshold Repairs">
                          <label for="roller"><div class="glyph-icon flaticon-roller"></div><span>houshold Repairs</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="lamp" value="Lamps">
                          <label for="lamp"><div class="glyph-icon flaticon-lamp"></div><span>Lamps</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="bed" value="Furniture">
                          <label for="bed"><div class="glyph-icon flaticon-bed"></div><span>Furniture</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="adornment" value="Rugs">
                          <label for="adornment"><div class="glyph-icon flaticon-adornment"></div><span>Rugs</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="necklace" value="Accessories">
                          <label for="necklace"><div class="glyph-icon flaticon-necklace"></div><span>Accessories</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="key" value="Renting">
                          <label for="key"><div class="glyph-icon flaticon-key"></div><span>Renting</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="fuel" value="Fuel/Gas">
                          <label for="fuel"><div class="glyph-icon flaticon-fuel"></div><span>Fuel/Gas</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="car-service" value="Car wash">
                          <label for="car-service"><div class="glyph-icon flaticon-car-service"></div><span>Car wash</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="fee" value="Parking fees">
                          <label for="fee"><div class="glyph-icon flaticon-fee"></div><span>Parking fees</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="mechanic" value="Mechanic">
                          <label for="mechanic"><div class="glyph-icon flaticon-mechanic"></div><span>Mechanic</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="car-service-1" value="Oil changes">
                          <label for="car-service-1"><div class="glyph-icon flaticon-car-service-1"></div><span>Oil changes</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="options" value="Games">
                          <label for="options"><div class="glyph-icon flaticon-options"></div><span>Games</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="play-button" value="Movies">
                          <label for="play-button"><div class="glyph-icon flaticon-play-button"></div><span>Movies</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="microphone" value="Concerts">
                          <label for="microphone"><div class="glyph-icon flaticon-microphone"></div><span>Concerts</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="pricing" value="Website Subscriptions">
                          <label for="pricing"><div class="glyph-icon flaticon-pricing"></div><span>Website Subscriptions</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="tshirt" value="T-Shirts">
                          <label for="tshirt"><div class="glyph-icon flaticon-tshirt"></div><span>T-Shirts</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="jeans" value="Jeans">
                          <label for="jeans"><div class="glyph-icon flaticon-jeans"></div><span>Jeans</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="dress" value="Shirts and dresses">
                          <label for="dress"><div class="glyph-icon flaticon-dress"></div><span>Shirts and dresses</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="jacket" value="Jackets and Coats">
                          <label for="jacket"><div class="glyph-icon flaticon-jacket"></div><span>Jackets and Coats</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="suit" value="Suits">
                          <label for="suit"><div class="glyph-icon flaticon-suit"></div><span>Suits</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="socks" value="Footware">
                          <label for="socks"><div class="glyph-icon flaticon-socks"></div><span>Footware</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="knickers" value="Underware">
                          <label for="knickers"><div class="glyph-icon flaticon-knickers"></div><span>Underware</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="mortgage" value="Home insurance">
                          <label for="mortgage"><div class="glyph-icon flaticon-mortgage"></div><span>Home insurance</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="car-insurance" value="Car insurance">
                          <label for="car-insurance"><div class="glyph-icon flaticon-car-insurance"></div><span>Car insurance</span></label>
                        </div>

                        <div class="cat-box" >
                          <input type="radio" name="subCategory" id="life-insurance" value="life insurance">
                          <label for="life-insurance"><div class="glyph-icon flaticon-life-insurance"></div><span>life insurance</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="health-insurance" value="Medical insurance">
                          <label for="health-insurance"><div class="glyph-icon flaticon-health-insurance"></div><span>Medical insurance</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="travel-insurance" value="Travel insurance">
                          <label for="travel-insurance"><div class="glyph-icon flaticon-travel-insurance"></div><span>Travel insurance</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="medicine" value="Medicines">
                          <label for="medicine"><div class="glyph-icon flaticon-medicine"></div><span>Medicines</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="first-aid-kit" value="Hospitals">
                          <label for="first-aid-kit"><div class="glyph-icon flaticon-first-aid-kit"></div><span>Hospitals</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="doctor" value="Doctors">
                          <label for="doctor"><div class="glyph-icon flaticon-doctor"></div><span>Doctors</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="muscle" value="Gym">
                          <label for="muscle"><div class="glyph-icon flaticon-muscle"></div><span>Gym</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="badge" value="Club Training">
                          <label for="badge"><div class="glyph-icon flaticon-badge"></div><span>Club Training</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="diaper" value="Diapers">
                          <label for="diaper"><div class="glyph-icon flaticon-diaper"></div><span>Diapers</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="baby-food" value="Baby food">
                          <label for="baby-food"><div class="glyph-icon flaticon-baby-food"></div><span>Baby food</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="scooter" value="Toys">
                          <label for="scooter"><div class="glyph-icon flaticon-scooter"></div><span>Toys</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="onesie" value="Baby Clothes">
                          <label for="onesie"><div class="glyph-icon flaticon-onesie"></div><span>Baby Clothes</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="mittens" value="Baby accessories">
                          <label for="mittens"><div class="glyph-icon flaticon-mittens"></div><span>Baby accessories</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="pet-food" value="Pet food">
                          <label for="pet-food"><div class="glyph-icon flaticon-pet-food"></div><span>Pet food</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="bed-1" value="Bed">
                          <label for="bed-1"><div class="glyph-icon flaticon-bed-1"></div><span>Bed</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="pet-friendly" value="Vet">
                          <label for="pet-friendly"><div class="glyph-icon flaticon-pet-friendly"></div><span>Vet</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="veterinary" value="Pet medicine">
                          <label for="veterinary"><div class="glyph-icon flaticon-veterinary"></div><span>Pet medicine</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="lipstick" value="Makeup">
                          <label for="lipstick"><div class="glyph-icon flaticon-lipstick"></div><span>Makeup</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="shampoo" value="Shampo">
                          <label for="shampoo"><div class="glyph-icon flaticon-shampoo"></div><span>Shampo</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="cream" value="Lotions">
                          <label for="cream"><div class="glyph-icon flaticon-cream"></div><span>Lotions</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="bottle" value="Perfumes">
                          <label for="bottle"><div class="glyph-icon flaticon-bottle"></div><span>Perfumes</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="cosmetic" value="Skincare">
                          <label for="cosmetic"><div class="glyph-icon flaticon-cosmetic"></div><span>Skincare</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="comb" value="Haircare">
                          <label for="comb"><div class="glyph-icon flaticon-comb"></div><span>Haircare</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="computer-1" value="TV">
                          <label for="computer-1"><div class="glyph-icon flaticon-computer-1"></div><span>TV</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="mobile-phone-back-with-a-hanging-tool" value="Mobile Accessories">
                          <label for="mobile-phone-back-with-a-hanging-tool"><div class="glyph-icon flaticon-mobile-phone-back-with-a-hanging-tool"></div><span>Mobile Accessories</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="keyboard" value="Computer Accessories">
                          <label for="keyboard"><div class="glyph-icon flaticon-keyboard"></div><span>Computer Accessories</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="mainboard" value="Computer components">
                          <label for="mainboard"><div class="glyph-icon flaticon-mainboard"></div><span>Computer components</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="gift-1" value="Gift">
                          <label for="gift-1"><div class="glyph-icon flaticon-gift-1"></div><span>Gift</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="airplane-1" value="travel">
                          <label for="airplane-1"><div class="glyph-icon flaticon-airplane-1"></div><span>travel</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="elearning" value="Courses">
                          <label for="elearning"><div class="glyph-icon flaticon-elearning"></div><span>Courses</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="university" value="university feess">
                          <label for="university"><div class="glyph-icon flaticon-university"></div><span>university fees</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="book-2" value="Book">
                          <label for="book-2"><div class="glyph-icon flaticon-book-2"></div><span>Book</span></label>
                        </div>

                        <div class="cat-box">
                          <input type="radio" name="subCategory" id="process" value="Office fees">
                          <label for="process"><div class="glyph-icon flaticon-process"></div><span>Office fee</span></label>
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
          @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        </form>
      </div>
    </div>
  </div>
  <script>
       let url = `{{route('subCategory.ajax',['categoryId'=>':categoryId'])}}`;
  </script>
  <script src="{{asset('UI/PurpleAdmin/assets/js/expenses/create.js')}}"></script>
 @endsection
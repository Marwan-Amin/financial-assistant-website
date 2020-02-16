@extends('layouts.app')
 @section('content')
 
<div class="main-panel">
    <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
        <i class="mdi mdi-square-inc-cash menu-icon"></i>
        </span> Incomes manager</h3>
    </div>
    
 <div class="col-12">
    <div class="card">
      <div class="card-header">
      <div class="text-center p-1">
            <strong><span> Edit Income </span></strong>
          </div>
      </div>
      
      <div class="card-body">

 @if ($errors->any())
 <div class="alert alert-danger">
     <ul>
         @foreach ($errors->all() as $error)
             <li>{{ $error }}</li>
         @endforeach
     </ul>
 </div>
@endif 

<div class="container">
          <form class="form-sample" method="POST" action="{{Route('incomes.update',['income_id'=>$income->id])}}">
          @csrf
          @method('PATCH')
            <div class="row">
                  <h4 class="card-title">Select Your Income Type</h4>
                  
                  <div class="template-demo">
                    <div class="flat_icons row">  
                      <div class="cat-box">
                        <input type="radio" name="type" id="icon_27" {{$isChecked=$income->income_id==1?"checked":""}} value="1"  />
                        <label for="icon_27"><div class="glyph-icon flaticon-salary"></div>
                        <span>Salary</span></label>
                      </div>
                    
                      <div class="cat-box">
                        <input type="radio" name="type" id="icon_28" {{$isChecked=$income->income_id==2?"checked":""}} value="2"  />
                        <label for="icon_28"><div class="glyph-icon flaticon-quality"></div>
                          <span>Awards</span></label>
                      </div>

                      <div class="cat-box">
                        <input type="radio" name="type" id="icon_29" {{$isChecked=$income->income_id==3?"checked":""}} value="3"  />
                        <label for="icon_29"><div class="glyph-icon flaticon-scholarship"></div>
                          <span>Grants</span></label>
                      </div>

                      <div class="cat-box">
                        <input type="radio" name="type" id="icon_30" {{$isChecked=$income->income_id==4?"checked":""}} value="4"  />
                        <label for="icon_30"><div class="glyph-icon flaticon-rental"></div>
                          <span>Rental</span></label>
                      </div>

                      <div class="cat-box">
                        <input type="radio" name="type" id="icon_31" {{$isChecked=$income->income_id==5?"checked":""}} value="5"  />
                        <label for="icon_31"><div class="glyph-icon flaticon-refund"></div>
                          <span>Refunds</span></label>
                      </div>

                      <div class="cat-box">
                        <input type="radio" name="type" id="icon_32" {{$isChecked=$income->income_id==6?"checked":""}} value="6"  />
                        <label for="icon_32"><div class="glyph-icon flaticon-investment"></div>
                        <span>Investments</span></label>
                      </div>

                      <div class="cat-box">
                        <input type="radio" name="type" id="icon_33" {{$isChecked=$income->income_id==7?"checked":""}} value="7"  />
                        <label for="icon_33"><div class="glyph-icon flaticon-coupon"></div>
                          <span>Sale</span></label>
                      </div>

                      <div class="cat-box">
                        <input type="radio" name="type" id="icon_34" {{$isChecked=$income->income_id==8?"checked":""}} value="8"  />
                        <label for="icon_34"><div class="glyph-icon flaticon-add"></div>
                          <span>Others</span></label>
                      </div>
                     
                    </div>                         
                  </div>
              
          </div>

          <div class="row mt-5">
            <div class="col-md-5 mx-auto">
              
              <div class="form-group row fluid">
                <strong><label>Amount</label></strong>
                
                  <input type="number" name="amount" class="form-control" value="{{$income->amount}}" />
               
              </div>
            </div>
           

            <div class="col-md-2 pl-0 pr-0 mx-auto">
            <button type="submit" class="btn-block btn btn-gradient-danger btn-lg ">Update</button>
            </div>
          </div>
        </div> 
      </form>
      </div>
    </div>
  </div>
  </div>
  </div>
 @endsection
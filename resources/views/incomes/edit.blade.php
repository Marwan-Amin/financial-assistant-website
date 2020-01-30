@extends('layouts.app3')
 @section('content')
 @if ($errors->any())
 <div class="alert alert-danger">
     <ul>
         @foreach ($errors->all() as $error)
             <li>{{ $error }}</li>
         @endforeach
     </ul>
 </div>
@endif
<div class="main-panel">
    <div class="content-wrapper">
 <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Edit your Income</h4>
        <form class="form-sample" method="POST" action="{{Route('incomes.update',['income_id'=>$income->id])}}">
          @csrf
          @method('PATCH')
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
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
              </div>
            </div>
          </div>


          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Amount</label>
                <div class="col-sm-9">
                  <input type="number" name="amount" class="form-control" value="{{$income->amount}}" />
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row fluid">
                <label class="col-sm-3 col-form-label">Date</label>
                <div class="col-md-9">
                  <input type="date" name="date" value="{{$income->Date}}" class="form-control" placeholder="dd/mm/yyyy" />
                </div>
              </div>
            </div>
          </div>
          
          <button type="submit" class="btn btn-gradient-danger btn-fw">Edit Income</button>

        </form>
      </div>
    </div>
  </div>
  </div>
  </div>
 @endsection
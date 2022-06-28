@extends('front.layouts.master')
@section('content')

    <section class="as_breadcrum_wrapper">
        <div class="ast_img_overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>My Account</h1>

                    <ul class="breadcrumb">
                        <li><a href="{{ url('/') }}">Home</a></li>

                        <li>My Account</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>


    <!-- my account wrapper start -->
    <div class="my-account-wrapper as_padderTop80 as_padderBottom80">
        <div class="container">
            <div class="section-bg-color">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- My Account Page Start -->
                        <div class="myaccount-page-wrapper">
                            <!-- My Account Tab Menu Start -->
                            <div class="row">
                                <div class="col-lg-3 col-md-4">
                                    <div class="myaccount-tab-menu nav" role="tablist">
                                        <a href="#dashboad" class="active" data-toggle="tab"><i class="fa fa-dashboard"></i>
                                            Dashboard</a>
                                        <a href="#orders" class="" data-toggle="tab"><i class="fa fa-cart-arrow-down"></i>
                                            Orders</a>


             <a href="#book" class="" data-toggle="tab"><i class="fa fa-map-marker"></i>
                                            Book Appointment</a>

                                        <a href="#profile" class="" data-toggle="tab"><i class="fa fa-map-marker"></i>
                                            Profile</a>

                                        <a href="#changePassword" class="" data-toggle="tab"><i class="fa fa-user-secret"></i> Change Password</a>
                                        <a class="nav-link"  href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">                                      
                                    <i class="fas fa-sign-out-alt"></i> Logout</a>  
                                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
              </li>
                                    </div>
                                </div>
                                <!-- My Account Tab Menu End -->

                                <!-- My Account Tab Content Start -->
                                <div class="col-lg-9 col-md-8">
                                    <div class="tab-content" id="myaccountContent">
                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade  active  in " id="dashboad" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h5>Dashboard</h5>
                                                <div class="welcome">
                     <p>Hello, <strong>{{Auth()->user()->name }} </strong></p>
                                                </div>
                                                <p class="mb-0">From your account dashboard. you can easily check &
                                                    view your recent orders, edit your password and account details.</p>
                                                    

@php
$total_orders=App\Models\Order::where('user_id',Auth()->user()->id)->get();
$pending_orders=App\Models\Order::where('user_id',Auth()->user()->id)->where('status','pending')->get();
$completed_orders=App\Models\Order::where('user_id',Auth()->user()->id)->where('status','completed')->get();
$total_appos=App\Models\Appointment::where('user_id',Auth()->user()->id)->get();
$pending_appos=App\Models\Appointment::where('user_id',Auth()->user()->id)->where('status','pending')->get();
$reply_appos=App\Models\Appointment::where('user_id',Auth()->user()->id)->where('status','reply')->get();
@endphp

                                               <div class="row">
                                              
                                              <div class="col-sm-6">

<div class="panel panel-default">
  <div class="panel-heading text-center">Order items</div>
  <div class="panel-body">
      
<p>Pending Orders:{{ $pending_orders->count() }}</p>
<p>Success Orders:{{ $completed_orders->count() }}</p>
<p>Total Orders:{{ $total_orders->count() }}</p>
<p style="color:blue"><a href="#orders" class="" data-toggle="tab">View Orders</a></p>


  </div>
</div>


                                              </div>
                                               <div class="col-sm-6">
<div class="panel panel-default">
  <div class="panel-heading text-center">Book Appointments</div>
  <div class="panel-body">
      
<p>Pending Appointment:{{ $pending_appos->count() }}</p>
<p>Reply Appointment:{{ $reply_appos->count() }}</p>
<p>Total Appointments:{{ $total_appos->count() }}</p>
<p style="color:blue"><a href="#book" class="" data-toggle="tab"> View Appointment</a></p>


  </div>
</div>


                                              </div>
                                             
                                           

                                               </div>

                                               <div class="row">

  <div class="col-sm-6">
<div class="panel panel-default">
  <div class="panel-heading text-center">Change Profile</div>
  <div class="panel-body">
      

<p style="color:blue"><a href="#profile" class="" data-toggle="tab">Manage Profile</a>

  </div>
</div>


                                              </div>
                                                <div class="col-sm-6">
<div class="panel panel-default">
  <div class="panel-heading text-center">Update Password</div>
  <div class="panel-body">
      

<p style="color:blue"><a href="#changePassword" class="" data-toggle="tab">Update Password</a>

  </div>
</div>


                                              </div>

                                               </div>
                                            
                                            </div>
                                        </div>
                                        <!-- Single Tab Content End -->


@php

$new_orders=App\Models\Order::where('user_id',Auth()->user()->id)->OrderBy('id','desc')->get();

$i=1;
@endphp
                                        <!-- Single Tab Content Start -->
                                        
                                        <div class="tab-pane fade" id="orders" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h5>Orders  <div class="advance" style="float:right">
                                  
                                            <form class="form-inline">
                                            
  <div class="form-group">
<label>Start Date</label>
    <input type="date"  class="form-control" id="start_orderdate" placeholder="start date" required>
  </div>
  <div class="form-group">
   <label>End Date</label>
    <input type="date"  class="form-control" id="end_orderdate" placeholder="end date">
  </div>

  <button type="button" class="btn btn-success" style="padding:9px" id="search_order">Search</button>
</form>
</div>                                   </h5><h5>              <div class="advance" style="float:right">
                                  
                                            <form class="form-inline">
                                            

  <div class="form-group">
   <label>Search Date</label>
    <input type="date" name="search_date" class="form-control" id="search_date" placeholder="end date">
  </div>

  <button type="button" class="btn btn-success" style="padding:9px" id="search_singleorder">Search</button>
</form>
</div>                                    </h5>
                
                                                <div class="myaccount-table table-responsive text-center">
                                                    <div id="search_ord">
                                                    <table class="table table-bordered">
                                                        <thead class="thead-light">
                                                        <tr>
                                                            <th>Order</th>
                                                            <th>Date</th>
                                                            <th>Status</th>
                                                            <th>Total</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>                                                       
                                               
                                             @foreach($new_orders as $new_order)  

                                             @php

                                          $new_order_id=$new_order->id;
                                             @endphp
                                                <tr>
                                                <td>{{ $i++ }}</td>
                                         <td>{{ $new_order->created_at }}</td>
                                        <td>{{ $new_order->status }}</td>
                                        <td>{{ $new_order->grand_total }}</td>
                                <td><a data-toggle="collapse" href="#{{ $new_order->id }}" role="button" class="as_link">View</a>
                                 </td>
                                </tr>
                               

                               

                                         <tr>
                                        <td colspan="5" style="background-color: #eeeeee">
                            <div class="collapse" id="{{ $new_order->id }}">
                         <div class="card-body pt-0">
                        <table class="table-cart-summary table-striped " style="width: 100%">
                                                                            <thead>
                         
                         
                         
                                <tr class="mb-4">                   
                                
                                                             <th class="product-name" style="font-weight: bold">Product</th>
                                         
                                                             <th class="product-name" style="font-weight: bold">Quantity</th>
                                                             <th class="product-name" style="font-weight: bold">Price</th>
                                                  
                                           <th class="product-total text-right" style="font-weight: bold">Sub-Total</th>
                                              </tr>
                                           


                                            </thead>
                                                       <tbody >

@php

$order_products=App\Models\Cart::where('user_id',Auth()->user()->id)->where('order_id',$new_order_id)->OrderBy('id','desc')->get();

@endphp


@foreach($order_products as $order_product)
@php

$product_name=App\Models\Product::where('id',$order_product->product_id)->first();

@endphp

                                            <tr class="cart_item " >
              <td  class="product-name pl-1" style="text-align: left">
                <figure class="mr-2 " style="display: inline-block">                                                                     
                                        </figure>
                                         {{ $product_name->name }}  
                                                    

                                                                                            </td>
                                                                                <td class="product-total text-right">
                                                                                {{ $order_product->quantity }} 

                                                                                </td>                      <td class="product-total text-right">
                                                                                {{ $order_product->price }} 

                                                                                </td>

                                                                                <td class="product-total text-right">
                                                                                    <span class="pl-4">Rs.  {{ $order_product->sub_total }} </span>

                                                                                </td>


                                                                            </tr>

                                                               @endforeach


                                                                            </tbody>
                                          </table>
                                            </div>
                                <div class="row">
                            <div class="col-lg-5 " style="float:right; margin-right: 10px">
                                                                            <!-- Cart Calculation Area -->
                                                                            <div class="cart-calculator-wrapper mt-0">
                                                                                <div class="cart-calculate-items">
                                                                                    <div class="table-responsive">
                                                                                        <table class="table">
                                                                                            <tr>
                                                                                                <td>Sub Total</td>
                                                                                                <td>Rs{{ $new_order->grand_total }}</td>
                                                                                            </tr>

                                                                                            <tr>
                                                                                                <td>Shipping</td>
                                                                                                <td>Rs.0.00</td>
                                                                                            </tr>
                                                                                            <tr class="total">
                                                                                                <td>Grand Total</td>
                                                                                                <td class="total-amount">
                                                                                                    Rs{{ $new_order->grand_total }} </td>
                                                                                            </tr>


                                                                                        </table>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endforeach



                                                        </tbody>
                                                    </table>
                                                     </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single Tab Content End -->

                                        @php
                      
                      $gender=Auth()->user()->gender; 
                      
                      $user_info=App\Models\Address::where('user_id',Auth()->user()->id)->first();
                                        @endphp

                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade" id="profile" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h5>Profile</h5>
              <form method="post" action="{{ route('user.update',Auth()->user()->id) }}">
                                                    @csrf
                  <div class="row">
                             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                      <label>Name</label>
                         <div class="form-group">
                  <input class="form-control" name="name" type="text" placeholder="*Name" value="{{ Auth()->user()->name }}">
                                                        </div>
                                                    </div>
                               <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Email</label>
                           <div class="form-group">
             <input class="form-control" type="email" name="email" placeholder="*Email" value="{{ Auth()->user()->email }}">
                                                        </div>
                                                    </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                         <label>Mobile number</label>

                           <div class="form-group">
                      <input class="form-control" name="number" type="text" placeholder="*Mobile Number" value="{{ Auth()->user()->number }}">
                      </div>
                                                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                         <label>Gender</label>
                       <div class="form-group as_select_box">
                           <select class="form-control" name="gender" data-placeholder="*Gender">
                        <option value="male"  @if ($gender = 'male') selected="selected" @endif >Male</option>
                        <option value="female" @if ($gender = 'female') selected="selected" @endif >Female</option>     
                         </select>
                        </div>
                      </div>

                                             
                                                  
                                                    
                                                     
                     <div class="col-lg-6 col-md-6 col-sm-6 .pcol-xs-12">
                        <label>State of Birth</label>
                       <div class="form-group as_select_box">
                        <select class="form-control" data-placeholder="State of Birth" name="state">
                         <option value="state1"  @if ($user_info->state == 'state1') selected="selected" @endif >Province 1</option>
                <option value="state2" @if ($user_info->state == 'state2') selected="selected" @endif>Province 2</option>
         <option value="state3" @if ($user_info->state == 'state3') selected="selected" @endif>Province 3</option>
         <option value="state4" @if ($user_info->state == 'state4') selected="selected" @endif>Province 4</option>
          <option value="state5" @if ($user_info->state == 'state5') selected="selected" @endif>Province 5</option>
                                                              
                                                           
               </select>
                                                        </div>
                                                    </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                         <label>City Living In</label>
                        <div class="form-group as_select_box">
                        <input type="text" class="form-control" name="city" value="{{ $user_info->city }}">
                                                        </div>
                                                    </div>
                       <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <label>Country Living In</label>
                       <div class="form-group as_select_box">
                        <select  name="country" class="form-control">
                          <option value="nepal">Nepal</option>
                                                                                                    
                                                          
                        </select>
                         </div>
                           </div>

                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <label>Occupation</label>
                       <div class="form-group">
                <input class="form-control" name="occupation" type="text" placeholder="Occupation" value="{{  $user_info->occupation }}">
                                                        </div>
                                                    </div>

                   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <label>Date Of Birth</label>
                    <div class="form-group">
                      <input class="form-control" type="date" name="dob" placeholder="Occupation" value="{{ $user_info->dob }}">
                                                        </div>
                                                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                       <label>Address</label>
                           <div class="form-group">
                            <input class="form-control" type="text" name="address" placeholder="Address" value="{{  $user_info->address }}">
                                                        </div>
                                                    </div>

                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                       <label>Postal Code</label>
                        <div class="form-group">
                          <input class="form-control" type="text" name="postal_code" placeholder="Postal code" value="{{ $user_info->postal_code }}">
                                                        </div>
                                                    </div>


                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center as_padderTop20">
                       <button type="submit"  class="as_btn">Save Changes</button>
                                                    </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                        <!-- Single Tab Content End -->

                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade" id="changePassword" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h5>Account Details</h5>
                                                @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                                                <div class="account-details-form">

                                                <form   method="post" action="{{ route('user.password.change') }}" enctype="multipart/form-data">
                                                    @csrf
                                                <div class="row">
                                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                       <label>Current Password</label>
                                         <div class="form-group">
                                    <input class="form-control" name="current_password" type="password" placeholder="*current password">
                                       </div>
                                            </div>
                                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                       <label>New Password</label>
                                          <div class="form-group">
                                     <input class="form-control"  name="new_password" type="password" placeholder="*new password">
                                                  </div>
                                                            </div>
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Confirm Password</label>

                                   <div class="form-group">
                              <input class="form-control" type="password" placeholder="*confirm password" name="new_confirm_password">
                                     </div>
                                                            </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                       <button class="as_link" name="formType" type="submit" id="formType" value="changePasswordForm" >Save Changes</button>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                    <div class="col-lg-12 p-2">
                            <div id="formMsg" class="alert alert-success" style="display: none">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>

                                        </div> <!-- Single Tab Content End -->
                                        <div class="tab-pane fade" id="book" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h5>Appointment <div class="advance" style="float:right">
                                  
                                            <form class="form-inline">
                                            
  <div class="form-group">
<label>Start Date</label>
    <input type="date" name="start_date" class="form-control" id="start_date" placeholder="start date" required>
  </div>
  <div class="form-group">
   <label>End Date</label>
    <input type="date" name="end_date" class="form-control" id="end_date" placeholder="end date">
  </div>

  <button type="button" class="btn btn-success" style="padding:9px" id="search_appointment">Search</button>
</form>
</div>                                   </h5><h5>              <div class="advance" style="float:right">
                                  
                                            <form class="form-inline">
                                            

  <div class="form-group">
   <label>Search Date</label>
    <input type="date" name="single_date" class="form-control" id="single_date" placeholder="end date">
  </div>

  <button type="button" class="btn btn-success" style="padding:9px" id="search_app">Search</button>
</form>
</div>                                    </h5></h5>
                                                <div class="myaccount-table table-responsive">
    
    @php
$user_appointments=App\Models\Appointment::where('user_id',Auth()->user()->id)->get();
$i=1;
@endphp

     
                  
                                                   
                                                     <div class="panel-group" id="accordion">
                                                           <div id="search_appo" class="hello">
                                                                     
                                                                                                                  
 @foreach($user_appointments as $key=> $user_appointment)  
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1{{ $user_appointment->id  }}">Book  Appointment By {{ Auth()->user()->name }} at {{ $user_appointment->created_at->format('M d Y') }}</a>
        </h4>
      </div>
      <div id="collapse1{{ $user_appointment->id }}" class="panel-collapse collapse">
        <div class="panel-body">
                      
   <div class="panel panel-default">
  <div class="panel-heading">Appointment By:{{ Auth()->user()->name }} </div>


<div class="panel-body">
<div class="row">
<div class="col-sm-3">
<p>Name:</p>
<p>Email</p>
<p>Phone:</p>
<p>Gender:</p>
<p>Country of Birth:</p>
</div>

<div class="col-sm-3">
<p>{{ $user_appointment->name }}</p>
<p>{{ $user_appointment->email }}</p>
<p>{{ $user_appointment->phone }}</p>
<p>{{ $user_appointment->gender }}</p>
<p>{{ $user_appointment->country_birth }}</p>
</div>

<div class="col-sm-3">


<p>Prefered Date:</p>
<p>Prefered Time:</p>
<p>Date Of Birth:</p>
<p>Time Of Birth:</p>
<p>Status</p>
</div>

<div class="col-sm-3">
<p>{{ $user_appointment->preferred_date }}</p>
<p>{{ $user_appointment->preferrred_time }}</p>
<p>{{ $user_appointment->dob }}</p>
<p>{{ $user_appointment->tob }}</p>
<p>{{ $user_appointment->status }}</p>
</div>
</div>


@php
$replies=App\Models\ReplyAppointment::where('user_id',Auth()->user()->id)->where('orderappointment_id',$user_appointment->id)->get();
@endphp

@if($user_appointment->status=="Reply")
@php
$admin=App\Models\User::where('is_admin',1)->first();
@endphp

<div class="panel panel-default">
  <div class="panel-heading">Reply By:{{ $admin->name }}</div>
  <div class="panel-body">

<div class="row">
<div class="col-sm-3">
<p>Name:</p>
<p>Email:</p>
<p>Phone</p>
</div>

<div class="col-sm-3">
<p>{{ $admin->name }}</p>
<p>{{ $admin->email }}</p>
<p>{{ $admin->number }}</p>

</div>



<div class="col-sm-3">
<p>Prefered Date:</p>
<p>Prefered Time:</p>
<p>Status</p>
</div>
@foreach($replies as $key=> $reply)
<div class="col-sm-3">
<p>{{ $reply->preferred_date }}</p>
<p>{{ $reply->preferrred_time }}</p>
</div>
@endforeach
</div>
  </div>
</div>
@endif
  </div>
</div>
            
        </div>
      </div>
    </div>

    
   @endforeach
  </div>
 </div>
  


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- My Account Tab Content End -->
                            </div>
                        </div> <!-- My Account Page End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- my account wrapper end -->




@endsection
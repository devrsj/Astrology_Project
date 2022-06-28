


 @extends('front.layouts.master')
@section('content')

  

    <section class="as_breadcrum_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>Checkout</h1>

                    <ul class="breadcrumb">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li>Checkout</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="as_appointment_wrapper as_padderTop80 as_padderBottom80">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
      <div class="panel panel-default">
  <div class="panel-heading">Shipping Details</div>
  <div class="panel-body">
    <form method="post" action="{{ route('checkout.place.order') }}"> 
  
@csrf
  <div class="row">
     
<div class="col-sm-6">
    <div class="form-group">
    <label>Name</label>
    @if(session('shippment'))
    @auth
    <input type="text" class="form-control" value="{{ Auth()->user()->name }}" name="name">
    @else
<input type="text" class="form-control" name="name" value="{{ session('shippment')['name'] }}">
@endauth
    @else

    <input type="text" class="form-control" name="name" value="">
  
   
    @endif
</div>
</div>

<div class="col-sm-6">
  <div class="form-group">
    <label>Email</label>
    
   
    @auth
    <input type="email" class="form-control" value="{{ Auth()->user()->email }}" name="email">
    @else
   <input type="email" class="form-control" value="" name="email" required>
   
 @endauth
 
 
  
</div>

</div>

</div>

  <div class="row">
     
<div class="col-sm-6">
      <div class="form-group">
    <label>Phone Number</label>
  
  @auth
    <input type="number" class="form-control" name="phone_number" value="{{ Auth()->user()->number }}">
   @else
   <input type="number" class="form-control" name="phone_number" required>
    @endauth

</div>
</div>

<div class="col-sm-6">
  <div class="form-group">
    <label>
        City
    </label>
    <input type="text" class="form-control" name="city" required>
</div>
</div>

</div>

  <div class="row">
     
<div class="col-sm-6">
    <div class="form-group">
    <label>Country</label>
    <input type="text" class="form-control" name="country">
</div>
</div>

<div class="col-sm-6">
   <div class="form-group">
    <label>Post Code</label>
    <input type="text" class="form-control" name="post_code">
</div>
</div>

<div class="col-sm-6">
   <div class="form-group">
    <label>Address</label>
    <input type="text" class="form-control" name="address" required>
</div>
</div>




</div>
 
<a href="{{ url('/') }}" style="color:#FF7F00;font-weight:500;float:right " class="btn btn-sqr"><i class="fa fa-angle-left"></i> Continue Shopping </a>
<button type="submit" class="btn btn-success" style="float:left">Delivery</button>

</form>

</div>
</div>
                   
                </div>


<div class="col-lg-4">               
  <div class="panel panel-default">
  <div class="panel-heading">Your Order</div>
  <div class="panel-body">
      

<div class="row">

    @php
    $total=0;
     @endphp 

  @if(session('cart'))
  <div class="cart-table">
       <table border="1" width="100%" class="table" >
      <thead>
           <tr>
  <th>Name</th>
  
  <th>Sub Total</th>
  </tr>
      </thead>
      <tbody>
 
 @foreach(session('cart') as $id => $product)
@php
$sub_total=$product['sp'] * $product['quantity'];
$total +=$sub_total;
 @endphp

     <tr>
 <td> {{ $product['name'] }}x {{ $product['quantity'] }} </td>
 <td>{{ $sub_total }}</td>
 </tr>
 
 


 @endforeach
 </tbody>
</table>
  </div>
 
</div>

<div style="margin:10px 0; float:right">
    <p style="font-weight:500">Total : {{ $total }} </p>
  
</div>


@else

<p>Your Product is Empty</p>
  @endif

  </div>
</div>
                   
                </div>




            </div>
        </div>
    </section>

    @endsection
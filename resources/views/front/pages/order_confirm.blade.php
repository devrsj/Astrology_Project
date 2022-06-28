 @extends('front.layouts.master')
@section('content')

<style>

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
  @php

 $order_code=App\Models\Order::OrderBY('id','desc')->take(1)->first();
 $guest_id=$order_code->guest_id;
 $order_id=$order_code->id;

@endphp

    <section class="as_breadcrum_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>Order Confirm</h1>

                    <ul class="breadcrumb">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li>Order Code: {{ $order_code->order_number }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="as_appointment_wrapper as_padderTop80 as_padderBottom80">
        <div class="container">


            <div class="row">
             <div class="panel panel-default">
  <div class="panel-body">



                <div class="col-lg-11">
  <h3 style="text-align:center">Thank you for order confirmation</h3>
  <p style="text-align:center">Order Code: {{ $order_code->order_number }}</p>
  <hr>
</div>


   <div class="row">
                <div class="col-lg-11">
  <h5>Order Summary</h5>
  <hr>
 </div>
 </div>


   <div class="row">
                <div class="col-lg-3">
  <p>Order Code:</p>
   <p>Name:</p>
    <p>Email:</p>
     <p>Shipping Address:</p>
  
 </div>
            <div class="col-lg-3">
  <p>{{ $order_code->order_number }}</p>
  <p>{{ $order_code->name }}</p>
  <p>{{ $order_code->email }}</p>
  <p>{{ $order_code->address }}</p>
  
 </div>

                 <div class="col-lg-3">
  <p>Order date:</p>
 <p>Order status:</p>
  <p>Total order amount:</p>
   <p>Payment method:</p>
  
 </div>
            <div class="col-lg-3">
 
  <p>{{ $order_code->created_at }}</p>
 <p> {{ $order_code->status }}</p>
  <p>रू{{ $order_code->grand_total }}</p>
   <p>{{ $order_code->payment_method }}</p>

 </div>
 </div>
<hr>


@php
$i=1;
$carts=App\Models\Cart::where('order_id',$order_id)->get();
@endphp


   <div class="row">
                <div class="col-lg-11">
  <h5>Order Details</h5>
  <a href="{{ route('generate.pdf') }}" class="as_link">Download Order</a>
  <hr>
  <table>
  <tr>
    <th>Sn</th>
    <th>Product</th>
    <th>Price</th>
     <th>Quantity</th>
    <th>Total</th>
  </tr>



  @foreach($carts as $cart)

  @php
$product_name=App\Models\Product::where('id',$cart->product_id)->first();


@endphp
  <tr>
    <td>{{ $i++ }}</td>
    <td>
  {{ $product_name->name }}
    </td>
    <td>{{ $cart->price }}</td>
    <td>{{ $cart->quantity }}</td>
    <td>{{ $cart->sub_total }}</td>
  </tr>
@endforeach






</table>
<div style="margin:10px 0; float:right">
    <p style="font-weight:500">Total: {{ $order_code->grand_total }} </p>
  
</div>

 </div>
 </div>


</div>
 </div>
 </div>
 
 



        </div>
    </section>

    @endsection
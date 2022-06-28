<!DOCTYPE html>
<html lang="en">
<head>
  <title>Receipt Order</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

  @php

$order_code=App\Models\Order::OrderBY('id','desc')->take(1)->first();
 $guest_id=$order_code->guest_id;
 $order_id=$order_code->id;
$header_contact=App\Models\Contactus::first();
    @endphp

  <div class="card">

<h4>Invoice Number:{{ $order_code->order_number }}</h4>
<h4>
Date Of Issue Invoice:{{ $order_code->created_at }} 
</h4>

<div class="card-body">
<div class="row mb-4">
<div class="col-sm-6">
<h6>From:</h6>
<div>
<strong>{{ $header_contact->name }}</strong>
</div>
<div>Address: {{ $header_contact->address }}</div>
<div>Email:{{ $header_contact->email }}</div>

<div>Phone:{{ $header_contact->number }}</div>
<div>
{{ $header_contact->telephone_number }}</div>

</div>


<div class="col-sm-6">
<h6 class="mb-3">To:</h6>
<div>
<strong>{{ $order_code->name }}</strong>
</div>

<div>Email: {{ $order_code->email }}</div>
<div>Phone:{{ $order_code->phone_number }} </div>
<div>Shipping Address: {{ $order_code->address }}</div>
<div>City:{{ $order_code->city }}</div>
<div>Country:{{ $order_code->country }}</div>

<div>Payment method: {{ $order_code->payment_method }}</div>
<div>Status: {{ $order_code->status }}</div>
</div>
</div>
@php
$i=1;
$carts=App\Models\Cart::where('order_id',$order_id)->get();
@endphp

<div class="table-responsive-sm">
<table class="table" border="1" style="width:100%">
<thead>
<tr>
<th class="center">SN</th>
<th>Product</th>

<th class="right">Unit Cost</th>
  <th class="center">Quantity</th>
<th class="right">Total</th>
</tr>
</thead>
<tbody>
    
@foreach($carts as $cart)
  @php
$product_name=App\Models\Product::where('id',$cart->product_id)->first();
@endphp
<tr>
<td>{{ $i++ }}</td>
<td>{{ $product_name->name }}</td>
<td>{{ $cart->price }}</td>

<td>{{ $cart->quantity }}</td>
 
<td>{{ $cart->sub_total }}</td>
</tr>
@endforeach

</tbody>
</table>
</div>
<div class="row">
<div class="col-lg-4 col-sm-5">

</div>

<div class="col-lg-4 col-sm-5 ml-auto">
<table class="table table-clear" border="1">
<tbody>
<tr>
<td class="left">
<strong>Subtotal</strong>
</td>
<td class="right">NPR {{ $order_code->grand_total }}</td>
</tr>

<tr>
<td class="left">
 <strong>VAT (0%)</strong>
</td>
<td class="right">NPR 0</td>
</tr>
<td class="left">
 <strong>Shipping (0%)</strong>
</td>
<td class="right">NPR 0</td>
</tr>

<tr>
<td class="left">
<strong>Total</strong>
</td>
<td class="right">
<strong>NPR {{ $order_code->grand_total }}</strong>
</td>
</tr>
</tbody>
</table>
<strong>Thanks For Orderng Products</strong>
</div>

</div>

</div>
</div>

</body>
</html>

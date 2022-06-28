<!DOCTYPE html>
<html lang="en">
<head>
  <title>Receipt  Question Order</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    
      @php

$order_code=App\Models\OrderAskQuestion::OrderBY('id','desc')->take(1)->first();
$header_contact=App\Models\Contactus::first();
 $guest_id=$order_code->guest_id;
 $order_id=$order_code->id;
@endphp

  <div class="card">

<h4>Invoice Number:{{ $order_code->number }}</h4>
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
<div>Phone:{{ $order_code->phone_number }}</div>

<div>Payment method: {{ $order_code->payment_method }}</div>
<div>Status: {{ $order_code->status }}</div>
</div>
</div>


@php
$i=1;
$questions=App\Models\CustomerQuestion::where('orderquestion_id',$order_id)->get();
@endphp

<div class="table-responsive-sm">
<table border="1" style="width:100%" >
  <tr>
    <th>Sn</th>
    <th>Question</th>
    <th>Price</th>
    
  </tr>


  @foreach($questions as $question)
  <tr>
    <td>{{ $i++ }}</td>
    <td> {{ $question->question }}</td>
    <td>{{ $question->price }}</td>
  
  </tr>
@endforeach






</table>
<p style="float:right;margin-right:34px">Total: {{ $order_code->grand_total }}</p>
</div>
<div class="row">


<div class="col-lg-4 col-sm-5 ml-auto">

<strong>Thanks For Orderng Question</strong>
</div>

</div>

</div>
</div>

</body>
</html>

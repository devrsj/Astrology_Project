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
  

    <section class="as_breadcrum_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>OrderAskQuestion</h1>

                    <ul class="breadcrumb">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li>OrderAskQuestion</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    @php

$order_code=App\Models\OrderAskQuestion::OrderBY('id','desc')->take(1)->first();

 $guest_id=$order_code->guest_id;
 $order_id=$order_code->id;
@endphp

    <section class="as_appointment_wrapper as_padderTop80 as_padderBottom80">
        <div class="container">


            <div class="row">
             <div class="panel panel-default">
  <div class="panel-body">


                <div class="col-lg-11">
  <h3 style="text-align:center">Thank you for order asking question</h3>
  <p style="text-align:center">Order Code: {{ $order_code->order_code }}</p>
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
    <p>Number</p>
    
  
 </div>
            <div class="col-lg-3">
  <p>{{ $order_code->order_code }}</p>
  <p>{{ $order_code->name }}</p>
  <p>{{ $order_code->email }}</p>
  <p>{{ $order_code->number }}</p>

  
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
$questions=App\Models\CustomerQuestion::where('orderquestion_id',$order_id)->get();
@endphp




   <div class="row">
                <div class="col-lg-11">
  <h5>Order Details</h5>
  <h5><a href="{{ route('question.pdf') }}" class="as_link">Download OrderQuestion</a></h5>
  <hr>
  <table>
  <tr>
    <th>Sn</th>
    <th>Question</th>
    <th>Price</th>
    
  </tr>


  @foreach($questions as $question)
  <tr>
    <td>{{ $i++ }}</td>
    <td>{{ $question->question }} </td>
    <td>{{ $question->price }}</td>
  
  </tr>
@endforeach






</table>
<p style="float:right;margin-right:34px">Total: {{ $order_code->grand_total }}</p>
 </div>
 </div>


</div>
 </div>
 </div>
 
 



        </div>
    </section>

    @endsection
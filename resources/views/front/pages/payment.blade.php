 @extends('front.layouts.master')
@section('content')

  

    <section class="as_breadcrum_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>Payment</h1>

                    <ul class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li>Payment</li>
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
  <div class="panel-heading">Select Payment Methods</div>
  <div class="panel-body">
    

<div class="row">
  <div class="col-lg-12">
      <div class="payment_option">
          <div class="form-group">
    <label class="">

   
    <a href="{{ route('payment.store') }}" class="btn btn-success">
         <img src="{{ asset('front_assets/assets/images/cash.png') }}" alt="">
        Cash on Delivery
        </a>
   
   </label>
  </div>
  
 
 
  <div class="form-group">
  <form action="https://uat.esewa.com.np/epay/main" method="POST">
    <input value="{{ $ptotal }}" name="tAmt" type="hidden">
    <input value="{{ $ptotal }}" name="amt" type="hidden">
    <input value="0" name="txAmt" type="hidden">
    <input value="0" name="psc" type="hidden">
    <input value="0" name="pdc" type="hidden">
    <input value="EPAYTEST" name="scd" type="hidden">
    <input value="{{ $random }}" name="pid" type="hidden">
    <input value="{{ url('/payment-product')}}" type="hidden" name="su">
    <input value="{{ url('/') }}" type="hidden" name="fu">
    <button type="submit" class="btn btn-success">
        <img src="{{ asset('front_assets/assets/images/esewa.jpg') }}" alt="">
        Pay Through Esewa</button>
    <!--<input value="PAy From Esewa" type="submit" class="btn btn-success">-->
    </form>
  </div>
  <div class="form-group">
    <label class="">
    <a href="{{ url('/directpaypal') }}" class="btn btn-success">
        <img src="{{ asset('front_assets/assets/images/paypal-payment.png') }}" alt="">
        Pay  Through Paypal
        </a>
    </label>
  </div>
  
  
  
   <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" href="#collapse1">Other Payment Method</a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse">
          @php
          $pay=App\Models\Page::where('name','Pay Now')->first();
          @endphp
        <div class="panel-body">
            {!! $pay->description !!}
             </div>
        
      </div>
    </div>
  </div>
  
  
  
  
  
  
  
  
  
  
      </div>
</div>

</div>


  
<a href="{{ url('/') }}" style="color:#FF7F00;font-weight:500;float:left" class="btn btn-sqr"><i class="fa fa-angle-left"></i> Continue Shopping </a>



</div>
</div>
                   
                </div>


                <div class="col-lg-4">               
  <div class="panel panel-default">
  <div class="panel-heading">Your Order</div>
  <div class="panel-body">
      

<div class="row">



  @if(session('cart'))
  <div class="cart-table">
 
  <table border="1" width="100%" class="table">
      <thead>
  <tr>
  <th>Name</th>
  <th>Sub Total</th>
  </tr>
  </thead>
  <tbody>
    @php
    $total=0;
     @endphp 

 @foreach(session('cart') as $id => $product)
@php
$sub_total=$product['sp'] * $product['quantity'];
$total +=$sub_total;
 @endphp
 <tr>
 <td> {{ $product['name'] }} x {{ $product['quantity'] }} </td>
 <td>{{ $sub_total }}</td>
 </tr>


 @endforeach
 <tbody></tbody>
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
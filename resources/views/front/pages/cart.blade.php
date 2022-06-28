@extends('front.layouts.master')
@section('content')
<section class="as_breadcrum_wrapper">

        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>Cart</h1>

                    <ul class="breadcrumb">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li>Cart</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    
    <section class="as_appointment_wrapper as_padderTop80 as_padderBottom80">
        <div class="container">
            <div class="row">
                <div class="col-lg-1">

                </div>
                <div class="col-lg-12">
                  <!-- cart main wrapper start -->
                  <div class="cart-main-wrapper " >
                    <div class="container">
                        <div class="section-bg-color" style="padding: 20px 0">
                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- Cart Table Area -->
                                    <div class="cart-table table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th class="pro-thumbnail">Thumbnail</th>
                                                <th class="pro-title">Product/Services</th>
                                                <th class="pro-price">Price</th>
                                                <th class="pro-quantity">Quantity</th>
                                                <th class="pro-subtotal">Total</th>
                                                <th class="pro-remove">Remove</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                               $total=0;
                                                  @endphp    
                                                  @if(session('cart'))
                                               
                                                  @foreach(session('cart') as $id => $product)
                                                
                                                  @php
                                                  $sub_total=$product['sp'] * $product['quantity'];
                                                  $total +=$sub_total;
                                                  @endphp
                                            <tr>
                                                <td class="pro-thumbnail">


                                                   <div class="as_cart_img">
                 <img src="{{ url('/') }}/storage/posts/{{ $product['photo'] }}"  class="img-responsive">

                                                </td>
                                                <td class="pro-title"><a href="#">{{ $product['name'] }}</a></td>
                                                <td class="pro-price"><span>Nrs.{{ $product['sp'] }}</span></td>
                                                <td class="pro-quantity">
                                                   
                                                    
                                                    <form method="" action="{{ route('change_qty',$id) }}">

                                                    @if($product['category_id']==null)
                                          <input type="number" value="{{ $product['quantity'] }}" disabled>
                                          @else


                                                    @if($product['quantity']===1)<button type="submit" class="btn btn-default" name="change_to" value="down" disabled>x
                                                    </button>
                                                    @else 
                                                    <button type="submit" class="btn btn-default" name="change_to" value="down">-
                                                    </button>
                                                     @endif
                                                    <input type="number" value="{{ $product['quantity'] }}" disabled>
                                                    <button type="submit" class="btn btn-default" name="change_to" value="up">+</button>
                                                   @endif
                                                   
                                                    </form>
                                                   
                                                  
                                                </td>
                                                <td class="pro-subtotal"><span>Nrs.{{ $sub_total }}</span></td>
                                                <td class="pro-remove"><a href="{{ route('remove.cart',[$id]) }}"><i class="fas fa-trash-alt"></i></a></td>
                                            </tr>
                                            @endforeach
                                          

                                            @endif

                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Cart Update Option -->
                                    <div class="cart-update-option ">
                                        <div class="cart-update">
                                            <a href="{{ url('/') }}" style="color:#FF7F00;font-weight: 500 " class="btn btn-sqr"><i class="fa fa-angle-left"></i> Continue Shopping </a>
                                        </div>

                                        @if(session('cart'))
                                        <div class="total-amount">
                                            <b>
                                             Grand Total: NPR {{ $total }}
                                            </b>
                                        </div>
                                        <div class="cart-update">
 
@auth

<a href="{{ route('checkout.index') }}" class="as_link">continue shipping</a>
@else
<a href="" class="as_link" data-toggle="modal" data-target="#myModal">continue shipping</a>
@endauth

                                         </div>
@else
<p>Your cart is empty</p>
@endif

                                    </div>

                                    
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- cart main wrapper end -->
                </div>
                </div>

                </div>
                </section>







@endsection
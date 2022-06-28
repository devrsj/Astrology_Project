@extends('front.layouts.master')
@include('front.layouts.seo')

@section('content')


 <section class="as_breadcrum_wrapper"  @if(isset($product)) style="background-image: url({{ url('/') }}/storage/posts/{{ $product->banner }})"  @else
    style="background-image:url({{ asset('front_assets/assets/img/banner/1.jpg') }})"
    @endif>
        <div class="ast_img_overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>{{ $product->name }}</h1>

                    <ul class="breadcrumb">
                        <li><a href="{{ url('/') }}">Home</a></li>

                        <li>{{ $product->name }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="as_shopsingle_wrapper as_padderBottom80 as_padderTop80">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="as_shopsingle_slider">
                        <div class="as_shopsingle_for">
                            <div class="as_prod_img pro-large-img img-zoom">
                                <img src="{{ url('/') }}/storage/posts/{{ $product->image }}" alt="" class="img-responsive">
                            </div>
                            <div class="as_prod_img pro-large-img img-zoom">
                                <img src="{{ url('/') }}/storage/posts/{{ $product->image1 }}" alt="" class="img-responsive">
                            </div>
                            <div class="as_prod_img pro-large-img img-zoom">
                                <img src="{{ url('/') }}/storage/posts/{{ $product->image2 }}" alt="" class="img-responsive">
                            </div>
                            <div class="as_prod_img pro-large-img img-zoom">
                                <img src="{{ url('/') }}/storage/posts/{{ $product->image3 }}" alt="" class="img-responsive">
                            </div>
                        </div>
                        <div class="as_shopsingle_nav">
                            <div class="as_prod_img ">
                                <img src="{{ url('/') }}/storage/posts/{{ $product->image }}" alt="" class="img-responsive">
                            </div>
                            <div class="as_prod_img">
                                <img src="{{ url('/') }}/storage/posts/{{ $product->image1 }}" alt="" class="img-responsive">
                            </div>
                            <div class="as_prod_img">
                                <img src="{{ url('/') }}/storage/posts/{{ $product->image2 }}" alt="" class="img-responsive">
                            </div>
                            <div class="as_prod_img">
                                <img src="{{ url('/') }}/storage/posts/{{ $product->image3 }}" alt="" class="img-responsive">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <div class="as_product_description">
                        <h3 class="as_subheading as_margin0 as_padderBottom10">{{ $product->name }}</h3>
                        <h2 class="as_price">NPR {{ $product->mp }} <del>NPR {{ $product->sp }}</del></h2>

                        <p class="as_font14 as_padderBottom10">
                           {{ $product->short_description }}
                        </p>
                        <div class="stock_details as_padderBottom10"><span>{{ $product->quantity }} In Stock</span></div>
                        <div class="prod_quantity as_padderBottom40">
                            Quantity
                            <div class="quantity">

                        <form method="get" action="{{ route('addto.cart',$product->id) }}">    
                                <button type="button" class="qty_button minus">
                                    -                </button>
                                <input type="text" id="quantity_6041ce9eca5d6" class="input-text form-control qty text" step="1" min="1" max="100" name="quantity" value="1" title="Qty" inputmode="numeric">

                                <button type="button" class="qty_button plus">
                                    +                </button>
                            </div>
                        </div>
                        <input type="hidden" value="{{ $product->id }}" name="id">
                        <div class="product_buy">
                         <button type="submit" class="buy_btn as_btn"
                          value="Buy Now">Buy Now</button>
                        </div>
                                </form>


                    </div>
                </div>

                <div class="col-lg-12 col-md-12">
               
                    
                    <div class="as_tab_wrapper as_padderTop80">
                           <ul class="nav nav-pills" style="width: 100%;text-align: center;display: flex;align-items: center;justify-content:center">
                            <li style="font-weight: 600;font-size: 20px"><a style="font-size: 20px" class="active" data-toggle="pill" href="#product">Product Description</a></li>
                        <li style="font-weight: 600;font-size: 20px"><a style="font-size: 20px" class="" data-toggle="pill" href="#review">Product Review</a></li>
                       
                       
                        </ul>

                        <div class="tab-content">
                             <div id="product" class="tab-pane fade">
   
         <p>{!! $product->description !!}</p>
    </div>
    
    <div id="review" class="tab-pane fade in active">
      @php
                  
                  $replies=App\Models\Service_provider::where('product',$product->name)->where('status',1)->get();
                 @endphp
                 
    <div class="row">
        <div clas="col-sm-4">
       <div class="as_comment_section as_padderTop80">
                        <h1 class="as_heading">Comments ( {{ $replies->count() }} )</h1>
                        <ul>
                             @if(session()->has('success'))
                

             <div class="alert alert-success alert-dismissible">
           <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>{{ session()->get('success') }}</strong> 
             </div>
                            
                 
                 @endif
               
                 @if($replies->count() > 0)
                 @foreach($replies as $reply)
                            <li>
                                @if($reply->image==null)
                                 <div class="as_comnt_img">
                                    <img src="{{ asset('front_assets/assets/images/avatar-website.jpg') }}" alt="" class="img-responsive" style="margin-right:12px">
                                </div>
                                @else
                            
                                 <div class="as_comnt_img">
                                    <img src="{{ url('/') }}/storage/posts/{{  $reply->image  }}" alt="" class="img-responsive">
                                </div>
                                @endif
                               
                                
                                <div class="as_comnt_detail">
                                    <h4 class="as_subheading as_margin0">{{ $reply->name }}</h4>
                                    <span class="as_font14"><img src="{{ asset('front_assets/assets/images/svg/calender1.svg') }}" alt="">{{ $reply->created_at }}</span>
                                    <p class="as_font14">{{ $reply->description }}</p>
                      
                                </div>
                                
                            </li>
                            
                            @endforeach
                            @else
                              <div class="alert alert-success alert-dismissible">
           <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>No Review for this Product</strong> 
             </div>
                            
                            @endif
                            
                         

                        </ul>
                    </div>
                    
                      <div class="as_comment_form">
                        <h1 class="as_heading">Leave A Comments</h1>
                        <p class="as_font14 as_padderBottom40">Your email address will not be published. Required fields are marked *</p>

                        <div class="row">
                            <form method="post" action="{{ url('/product-review') }}" enctype="multipart/form-data">
                                @csrf
                                
                                <input type="hidden" value="{{ $product->name }}" name="product_name">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control" id="" placeholder="Enter Name Here...">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" id="" placeholder="Enter Email Here...">
                                    </div>
                                    <div class="form-group">
                                        <textarea name="message" id="" class="form-control" placeholder="Message Here..."></textarea>
                                    </div>
                                   
                                   <input type="file"  name="image"> 
                                   <br>
                                  
                                </div>
                              
                                <div class="col-lg-12 col-md-12">
                                    <input type="submit" class="as_btn" value="post comment">
                   
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>
                    </div>
                    
    </div>
    </div>
    </div>
                    
                    
                    
                    
                    
                    
                </div>
            </div>
        </div>
    </section>
 @php
$customerr=App\Models\Page::where('name','What Our Customers Say')->where('status',1)->first();
    @endphp

       <section class="as_customer_wrapper as_padderBottom80 as_padderTop80">
            <div class="container">
                <div class="row">

                    <div class="col-lg-12 text-center">

         

                        <h1 class="as_heading as_heading_center">{{ $customerr->name }}</h1>
                        <p class="as_font14 as_margin0 as_padderBottom50">
                        {{ $customerr->short_description }}
                        </p>

                        <div class="row">
                                @php
                    $textss=App\Models\People::where('people_type','text')->where('status',1)->OrderBy('weight','asc')->limit(4)->get();            
                                    @endphp
                            <div class="col-lg-6">
                                <div class="row as_customer_slider">
                                
                                   
                                   @foreach($textss as $textt)
                                    <div class="col-lg-6 col-md-6">
                                        <div class="as_customer_box ">

                                            <div class="as_margin0" style="display: flex">
                                                <p style="color: #e66712;font-size: 20px;margin-right: 5px;flex: 1"><i class="fas fa-quote-left"></i></p>
                                                <p>{{ Str::limit($textt->description,294, '...') }} </p>
                                            </div>

                                            <div style="display: flex;justify-content: space-between; align-items: center">
                                                <div class="ast_whywe_info_box client" style="margin-top: 20px">
 <span><img src="{{ url('/') }}/storage/posts/{{ $textt->image }}" alt=""></span>
                                                    <div class="ast_whywe_info_box_info" >
                                                        <b style="font-weight: 600">{{ $textt->name }}</b>
                                                        <b style="color: #4a4a4a; font-weight: 400">{{ $textt->post }}</b>
                                                    </div>
                                                </div>
                                                <a  href="{{ url('/text-testimonals.html') }}" class="as_link" tabindex="0">Read more</a>

                                            </div>


                                        </div>
                                    </div>
                                   
                                   @endforeach


                                </div>
                            </div>
                                 @php

                    $videoss=App\Models\People::where('people_type','video')->where('status',1)->OrderBy('weight','asc')->limit(4)->get();

                                    
                                    @endphp
                            <div class="col-lg-6">
                                <div class="row as_customer_slider">
                                  
                                    @foreach($videoss as $videoo)
                                    <div class="col-lg-6 col-md-6">
                                        <div class="as_customer_box text-center">
                                            <iframe  width="100%" height="300" src="https://www.youtube.com/embed/{{ $videoo->video_url }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                      @endforeach
                                   

                                </div>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </section>



@endsection
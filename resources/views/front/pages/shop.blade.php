@extends('front.layouts.master')

@include('front.layouts.seo')
@section('content')


@if(isset($search_product))
 <section class="as_breadcrum_wrapper">
        <div class="ast_img_overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>{{ $search_product }}</h1>

                    <ul class="breadcrumb">
                        <li><a href="{{ url('/') }}">Home</a></li>

                        <li>Product</li>
                        <li>{{ $search_product }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if(isset($product_category))
 <section class="as_breadcrum_wrapper" @if(isset($product_category)) style="background-image: url({{ url('/') }}/storage/posts/{{ $product_category->banner }})"  @else
    style="background-image:url({{ asset('front_assets/assets/img/banner/1.jpg') }})"
    @endif>
        <div class="ast_img_overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>{{ $product_category->name }}</h1>

                    <ul class="breadcrumb">
                        <li><a href="{{ url('/') }}">Home</a></li>

                        <li>Product</li>
                        <li>{{ $product_category->name }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    @endif

 <section class="as_product_single_wrapper as_padderBottom80 as_padderTop80">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <div class="as_shop_sidebar">
                       
                    <form method="get" action="{{ route('search_product') }}">
                        <div class="as_search_widget">

                            <input type="text" name="search_product" class="form-control" id="" placeholder="Search...">
                            <a href="#"><img src="{{ asset('front_assets/assets/images/svg/search.svg') }}" alt=""></a>
                        </div>
                    </form>



                        <div class="as_service_widget as_padderBottom40">
                            <h3 class="as_heading">Categories</h3>

                            <ul>
                                @php
                              
                              $categories_products=App\Models\Category::where('status',1)->where('position','product')->get();
                                @endphp
                                
                                @foreach($categories_products as $category_product)
                                <li>

                                    <a href="{{ route('product.category',$category_product->slug) }}">
                                        <span>{{ $category_product->name }}</span>
                                        <span>( {{ $category_product->products()->count() }})</span>
                                    </a>
                                </li>
                                @endforeach
                              

                            </ul>
                        </div>

                    </div>
                </div>


                 @if(isset($search_products))  
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                    <div class="as_shop_topbar" data-select2-id="select2-data-19-ak51" style="margin-top: 10px;margin-bottom: 20px">
                        @if($search_products->count() >7)
                        <span class="as_result_text">Showing 1–6 of 15 results</span>
                      @endif
                    </div>
                    <div class="row">
                          
                          @if($search_products->count() > 0)
                        @foreach($search_products as $product)
                        <div class="col-lg-4 col-md-6">
                            <div class="as_product_box">
                                <div class="as_product_img">
        <a href="{{ route('product.slug',$product->slug) }}">  
         <img src="{{ url('/') }}/storage/posts/{{ $product->image }}" alt="" class="img-responsive"></a>

                                    <ul>
                                        <li>
                                            <a href="{{ route('addto.cart',$product->id) }}"><img src="{{ asset('front_assets/assets/images/svg/cart.svg') }}" alt=""><span>Add To Card</span></a>
                                        </li>
                                    </ul>
                                </div>

                                <h4 class="as_subheading"><a href="{{ route('product.slug',$product->slug) }}">{{ $product->name }}</a> </h4>
                                <span class="as_price">NPR {{ $product->sp }} <del>NPR {{ $product->mp }}</del></span>
                            </div>
                        </div>
                        @endforeach
                        @else
                         
                          <div class="alert alert-warning">
  <strong>Oops!! sorry your </strong> {{ $search_product }}  Product doesnot  found 
</div>
                        @endif
                    </div>
                    
                          
                    @if($search_products->count() > 0)
                    {{ $search_products->links('pagination::simple-default') }}
                    @endif
                </div>
                  
              
                  @endif




                   @if(isset($product_categories))  
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                    <div class="as_shop_topbar" data-select2-id="select2-data-19-ak51" style="margin-top: 10px;margin-bottom: 20px">
                        @if($product_categories->count() >7)
                        <span class="as_result_text">Showing 1–6 of 15 results</span>
                      @endif
                    </div>
                    <div class="row">
                          
                          @if($product_categories->count() > 0)
                        @foreach($product_categories as $product)
                        <div class="col-lg-4 col-$product_categories md-6">
                            <div class="as_product_box">
                                <div class="as_product_img">
                                  <a href="{{ route('product.slug',$product->slug) }}">  <img src="{{ url('/') }}/storage/posts/{{ $product->image }}" alt="" class="img-responsive"></a>

                                    <ul>
                                        <li><a href="{{ route('addto.cart',$product->id) }}"><img src="{{ asset('front_assets/assets/images/svg/cart.svg') }}" alt=""><span>Add To Card</span></a></li>
                                    </ul>
                                </div>

                                <h4 class="as_subheading"><a href="{{ route('product.slug',$product->slug) }}">{{ $product->name }}</a> </h4>
                                <span class="as_price">NPR {{ $product->sp }} <del>NPR {{ $product->mp }}</del></span>
                            </div>
                        </div>
                        @endforeach


                        @else
                         
                          <div class="alert alert-warning">
  <strong>Oops!! sorry your </strong> {{ $product_category->name }}  Product doesnot  found 
</div>
                        @endif
                    </div>
                    {{ $product_categories->links('pagination::simple-default') }}
                    @endif


                 
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
                    $textss=App\Models\People::where('people_type','text')->where('status',1)->get();            
                                    @endphp
                            <div class="col-lg-6">
                                <div class="row as_customer_slider">
                                
                                   
                                   @foreach($textss as $textt)
                                    <div class="col-lg-6 col-md-6">
                                        <div class="as_customer_box ">

                                            <div class="as_margin0" style="display: flex">
                                                <p style="color: #e66712;font-size: 20px;margin-right: 5px;flex: 1"><i class="fas fa-quote-left"></i></p>
                                                <p>{{ $textt->description }} </p>
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

                    $videoss=App\Models\People::where('people_type','video')->where('status',1)->get();

                                    
                                    @endphp
                            <div class="col-lg-6">
                                <div class="row as_customer_slider">
                                  
                                    @foreach($videoss as $videoo)
                                    <div class="col-lg-6 col-md-6">
                                        <div class="as_customer_box text-center">
                                            <iframe  width="100%" height="300" src="{{ $videoo->video_url }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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

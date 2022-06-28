
@extends('front.layouts.master')

@include('front.layouts.seo')
@section('content')
@php
$blogs=App\Models\Blog::where([['status',1]])->OrderBy('weight','asc')->simplePaginate(18);
$footer_contactt=App\Models\Contactus::first();
 $products=App\Models\Product::where([['status',1]])->OrderBy('weight','asc')->where('subcategory_id','=',null)->simplePaginate(18);
 $testimonals=App\Models\People::where('people_type','text')->OrderBy('weight','asc')->where('status',1)->simplePaginate(15);
 $videoss=App\Models\People::where('people_type','video')->OrderBy('weight','asc')->where('status',1)->simplePaginate(18); 
  $albums=App\Models\Category::where('position','gallery')->OrderBy('weight','asc')->where('status',1)->simplePaginate(18);
   $videos=App\Models\Media::where('gallery_type','video')->OrderBy('weight','asc')->where('status',1)->simplePaginate(18);
   $customerr=App\Models\Page::where('name','What Our Customers Say')->where('status',1)->first();
   
   $sub_pages =App\Models\Page::where([['parent_id',$page->id],['status',1],['position','header']])->orderBy('weight', 'ASC')->get();
@endphp
 

 <section class="as_breadcrum_wrapper" @if(isset($page)) style="background-image: url({{ url('/') }}/storage/posts/{{ $page->banner }})"  @else
  style="background-image:url({{ asset('front_assets/assets/img/banner/1.jpg') }})"
    @endif>
     
        <div class="ast_img_overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>{{ $page->name }}</h1>

                    <ul class="breadcrumb">
                        <li><a href="{{ url('/') }}">Home</a></li>

                        <li>{{ $page->name }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
        
         @if($page->name !="Text Testimonals" && $page->name !=="Video Testimonials")
         @if($page->name !="Shop")
         @if($page->name !="Contact" && $page->name !="Blog")
        @if($page->name !=="Video" && $page->name !=="Photo")
        
        
        <section class="as_blog_wrapper as_padderTop80 as_padderBottom80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

              <h2>{{ $page->name }}</h2>
              <hr>

                      @if($page->thumbnail=="")
                      @else
                         <img src="{{ url('/') }}/storage/posts/{{ $page->thumbnail }}" class="img-responsive " style="width: 60%">
                        @endif
                       @if($page->description=="")
                       @else
                       <p> {!! $page->description  !!}</p>
                       @endif
                        
                        
     
     @if($page->name=="Pay Now")
          
    
      <div class="payment-option">
          <div class="form-group">
       <p><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#e-sewa">  <img src="{{ asset('front_assets/assets/images/esewa.jpg') }}" alt="">Esewa</button></p>
      <p><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#paypal"><img src="{{ asset('front_assets/assets/images/paypal-payment.png') }}" alt=""> Pay pal</button></p>
      </div>
      </div>
      @endif

                </div>
            </div>
        </div>
    </section>
        
 
@endif       
 @endif
@endif
@endif





@if($page->name=="Blog")
 @if(isset($blogs))
<section class="as_blog_wrapper as_padderTop80 as_padderBottom80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <div class="row">
                    
                      @foreach($blogs as $blog)
                      @php
                      
                      $category_name=App\Models\BlogCategory::where('id',$blog->category_id)->first();
                     
                      @endphp

                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="as_blog_box">
                                <div class="as_blog_img">
                                    <a href="{{ route('blog.detail',$blog->slug) }}"><img src="{{ url('/') }}/storage/posts/{{ $blog->image }}" alt="" class="img-responsive"></a>
                        
                                </div>
                                <div class="blog-text">
                                 
                               <a href="{{ route('blog.detail',$blog->slug) }}">     <h4 class="as_subheading"> {{ $blog->heading }}</h4></a>
                                    <p class="as_font14 ">{{ Str::limit($blog->short_description,220, '...') }}</p>
                                </div>

                            </div>
                        </div>
                        @endforeach
                    
                        {{ $blogs->links('pagination::simple-default') }}

                    


                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
@endif

@if($page->name=="Contact")

 <section class="as_contact_section as_padderTop80 as_padderBottom80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="as_contact_info">
                            <h1 class="as_heading">Contact <span>Information</span></h1>
                            <p class="as_font14 as_margin0">Consectetur adipiscing elit sed do eiusmod tr incididunt<br> ut labore et dolore magna aliquauis ipsum.</p>

                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="as_info_box">
                                        <span class="as_icon"><img src="{{ asset('front_assets/assets/images/svg/mail.svg') }}" alt=""></span>
                                        <div class="as_info">
                                            <h5>Address</h5>
                            <p class="as_margin0 as_font14"> {{ $footer_contactt->address }}</p>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="as_info_box">
                                        <span class="as_icon"><img src="{{ asset('front_assets/assets/images/svg/call1.svg') }}" alt=""></span>
                                        <div class="as_info">
                                            <h5>Call Us</h5>
                                            <p class="as_margin0 as_font14">+{{ $footer_contactt->number }}</p>
                                            <p class="as_margin0 as_font14">{{ $footer_contactt->telephone_number }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="as_info_box">
                                        <span class="as_icon"><img src="{{ asset('front_assets/assets/images/svg/mail1.svg') }}" alt=""></span>
                                        <div class="as_info">
                                            <h5>Mail Us</h5>
                                            <p class="as_margin0 as_font14"><a href="javascript:;"> {{ $footer_contactt->email }}</a></p>
                                            <p class="as_margin0 as_font14"><a href="javascript:;"></a>{{ $footer_contactt->description }}</a></p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="as_contact_form">
                            <h4 class="as_subheading">Have A Question?</h4>
                            <form action="{{ url('/create') }}" method="post">
                                @csrf

                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input type="text" name="name" id="" class="form-control" required >
                                </div>
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input type="email" name="address" id="" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Message</label>
                                    <textarea name="message" id="" class="form-control" required></textarea>
                                </div>
                                <button type="submit" class="as_btn">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<section class="as_map_section">
            <iframe src="{{ $footer_contactt->google_map }}" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </section>
@endif

@if($page->name=="Shop")
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
                              
                              $categories_products=App\Models\Category::where('status',1)->OrderBy('weight','asc')->where('position','product')->get();
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

                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                    <div class="as_shop_topbar" data-select2-id="select2-data-19-ak51" style="margin-top: 10px;margin-bottom: 20px">
                        <span class="as_result_text">Showing 1–6 of 15 results</span>

                    </div>

                    <div class="row">
                        @foreach($products as $product)
                        <div class="col-lg-4 col-md-6">
                            <div class="as_product_box">
                                <div class="as_product_img">
                               <img src="{{ url('/') }}/storage/posts/{{ $product->image }}" alt="" class="img-responsive">

                                    <ul>
                                        <li><a href="{{ route('addto.cart',$product->id) }}"><img src="{{ asset('front_assets/assets/images/svg/cart.svg') }}" alt=""><span>Add To Card</span></a></li>
                                    </ul>
                                </div>

                                <h4 class="as_subheading"><a href="{{ route('product.slug',$product->slug) }}">{{ $product->name }}</a> </h4>
                                 <span class="as_price">NPR {{ $product->sp }} <del>NPR {{ $product->mp }}</del></span>
                          
                            </div>
                        </div>
                        @endforeach
                    </div>
                    {{ $products->links('pagination::simple-default') }}
                </div>

            </div>
        </div>
    </section>
 @endif 


@if($page->name=="Video Testimonials")
<section class="video_gallery  as_padderTop80 as_padderBottom80" style="background-color: #eeeeee">
        <div class="container">
            <div class="row">
                     
                @foreach($videoss as $videoo)
                  <div class="col-lg-4 col-md-6">
                    <div class="as_customer_box text-center">
                        <iframe  width="100%" height="300" src="https://www.youtube.com/embed/{{ $videoo->video_url }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
@endforeach
            </div>

            {{ $videoss ->links('pagination::simple-default') }}
        </div>
    </section>
@endif



@if($page->name=="Text Testimonals")
@if(isset($testimonals))
<section class="single_service_wrapper details  as_padderTop80 as_padderBottom80" style="background-color: #eeeeee">
        <div class="container">
            <div class="row">
                @foreach($testimonals as $testimonal)
                <div class="col-lg-12">
                    <div class="as_customer_box ">

                        <div class="as_margin0" style="display: flex">
                            <p style="color: #e66712;font-size: 20px;margin-right: 5px;flex: 1"><i class="fas fa-quote-left"></i></p>
                            <p>{{ $testimonal->description }} </p>
                        </div>

                        <div style="display: flex;justify-content: space-between; align-items: center">
                            <div class="ast_whywe_info_box client" style="margin-top: 20px">
                                <span>
                                    
                                      @if($testimonal->image=="")
                                    
                                        <img src="{{ asset('front_assets/assets/images/avatar-website.jpg') }}">
                                    @else
                                    
                                    <img src="{{ url('/') }}/storage/posts/{{ $testimonal->image }}" alt="">
                                    @endif
                                    
                                    
                                </span>
                                <div class="ast_whywe_info_box_info" >
                                    <b style="font-weight: 600">{{ $testimonal->name }}</b>
                                    <b style="color: #4a4a4a; font-weight: 400">{{
                                        $testimonal->post
                                    }}</b>
                                </div>
                            </div>

                        </div>


                    </div>
                </div>

                @endforeach
                

            </div>
            {{ $testimonals->links('pagination::simple-default') }}
        </div>
    </section>
@endif
@endif

@if($page->name=="Photo")
<section class="photo_gallery  as_padderTop80 as_padderBottom80" style="background-color: #eeeeee">
        <div class="container">
            <div class="row">
                 
                 @foreach($albums as $album)
                <div class="col-lg-3 col-md-6">
                    <div class="single_album">
                        <figure>
                            <img src="{{ url('/') }}/storage/posts/{{ $album->thumbnail }}" alt="" class="img-responsive">
                        </figure>
                        <div class="album_title">
                            <h4><a href="{{ route('single.photo',$album->id) }}">{{ $album->name }}</a></h4>
                            <a  href="{{ route('single.photo',$album->id) }}" class="as_link" tabindex="0">View Photos</a>
                        </div>
                    </div>
                </div>
                @endforeach

              
            </div>

            {{ $albums ->links('pagination::simple-default') }}

        
        </div>

    </section>
@endif

@if($page->name=="Video")
<section class="video_gallery  as_padderTop80 as_padderBottom80" style="background-color: #eeeeee">
        <div class="container">
            <div class="row">
              
              @foreach($videos as $video)
                <div class="col-lg-4 col-md-6">
                    <div class="as_customer_box text-center">
                        <iframe  width="100%" height="300" src="https://www.youtube.com/embed/{{ $video->video_url }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>

                @endforeach
               

            </div>
            
            {{ $videos ->links('pagination::simple-default') }}
        </div>

    </section>
@endif

@if(isset($sub_pages))
<section class="as_product_wrapper as_padderBottom80 as_padderTop80">
            <div class="container">
                <div class="row">
                      @foreach($sub_pages as $sub_page)
                        <div class="col-lg-4 col-md-6 col-sm-6 ">
                    <div class="as_service_box text-center">
                        <figure >
                            <img src="{{ url('/') }}/storage/posts/{{ $sub_page->thumbnail }}" alt="">
                        </figure>
                        <div class="text-part">
                            <h4 class="as_subheading">{{ $sub_page->name }}</h4>
                           
                          
                          
                            <div class="button_part">
                    
 <a href="{{ route('page.slug',$sub_page->slug) }}" class="as_link" style="width:100%">Read more</a>

                        
                            </div>
                        </div>
                    </div>
                </div>
                    @endforeach
                    </div>
                    </div>
                    </section>
@endif

@if($page->service=="on")
<section class="as_product_wrapper as_padderBottom80 as_padderTop80">
            <div class="container">
                <div class="row">
                                @php
           $latestservice=App\Models\Page::where('name','Our Latest Services')->where('status',1)->first();
                  @endphp
                    <div class="col-lg-12 text-center">
                        @if(isset($latestservice))
                        <h1 class="as_heading as_heading_center"> <span>{{ $latestservice->name }}</span></h1>
                        <p class="as_font14 as_margin0 as_padderBottom20"><br>{!! $latestservice->description !!}</p>
                   
                        @endif

                        <div class="row as_product_slider">
                     @php
                      $services=App\Models\Product::where('status',1)->OrderBy('id','desc')->where('category_id','=',null)->take(6)->get();
                          @endphp
                           @foreach($services as $service)
                            <div class="col-lg-3 col-md-6">
                                <div class="as_product_box">
                                    <div class="as_product_img">
               <img src="{{ url('/') }}/storage/posts/{{  $service->image  }}" alt="" class="img-responsive">
                                        <ul>
                               <input type="hidden" value="" name="cart">
                                            <li>
                                            <a href="{{ route('addto.cart',$service->id) }}" class="">Add to Cart</a>
                                        </li>
                                        </ul>
                                    </div>
     <h4 class="as_subheading"><a href="{{ route('page.slug',$service->slug) }}">{{ $service->name }}</a> </h4>
                                  
                               <span class="as_price">NPR {{ $service->mp }} <del>NPR {{ $service->sp }}</del></span>
                                </div>
                            </div>
                            @endforeach
                    

                        </div>
                    </div>
                </div>
            </div>
            
        </section>
@endif
        
    
@if($page->product=="on")
<section class="as_product_wrapper as_padderBottom80 as_padderTop80">
            <div class="container">
                <div class="row">
                                @php
           $latestproduct=App\Models\Page::where('name','Our Latest Products')->where('status',1)->first();
                  @endphp
                    <div class="col-lg-12 text-center">
                        @if(isset($latestproduct))
                        <h1 class="as_heading as_heading_center"> <span>{{ $latestproduct->name }}</span></h1>
                        <p class="as_font14 as_margin0 as_padderBottom20"><br>{!! $latestproduct->description !!}</p>
                   
                        @endif

                        <div class="row as_product_slider">
                     @php
                      $products=App\Models\Product::where('status',1)->OrderBy('id','desc')->where('subcategory_id','=',null)->take(6)->get();
                          @endphp
                           @foreach($products as $product)
                            <div class="col-lg-3 col-md-6">
                                <div class="as_product_box">
                                    <div class="as_product_img">
          <img src="{{ url('/') }}/storage/posts/{{  $product->image  }}" alt="" class="img-responsive">

                                        <ul>
                                        
                               <input type="hidden" value="" name="cart">

                                            <li>

                                            <a href="{{ route('addto.cart',$product->id) }}" class="">Add to Cart</a>



                                        </li>
                                        
                                           
                                        </ul>
                                    </div>
     <h4 class="as_subheading"><a href="{{ route('product.slug',$product->slug) }}">{{ $product->name }}</a> </h4>
                                  
                               <span class="as_price">NPR {{ $product->mp }} <del>NPR {{ $product->sp }}</del></span>
                                </div>
                            </div>
                            @endforeach
                    

                        </div>
                    </div>
                </div>
            </div>
            
        </section>
@endif

@if($page->customer_section=="on")
<section class="as_customer_wrapper as_padderBottom80 as_padderTop80">
            <div class="container">
                <div class="row">

                    <div class="col-lg-12 text-center">

         

                        <h1 class="as_heading as_heading_center"><span>{{ $customerr->name }}</span></h1>
                        <p class="as_font14 as_margin0 as_padderBottom50">
                        {!! $customerr->description !!}
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
@endif




@endsection

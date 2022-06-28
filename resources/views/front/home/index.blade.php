@extends('front.layouts.master')
@section('meta')
@php
 $seo_head =App\Models\Seo::first();
    @endphp
  @if(isset($seo_head))
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="{{ url('/') }}/storage/posts/" href="{{ url('/') }}">
    <meta name="google-site-verification" content="">
    <base href="{{ url('/') }}">
    <meta name="abstract" content="{{ url('/') }}">
    <meta http-equiv="content-type" content="text/html" charset="utf-8" />
    <link rel="alternate" href="{{ url('/') }}" hreflang="en"/>
    <link rel="canonical" href="{{ url('/') }}" />
    <meta name="copyright" content="{{ url('/') }}" />
    <meta name="author" content="{{ url('/') }}"/>
    <meta name="publisher" content="{{ url('/') }}"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="index, follow" />
    <meta name="format-detection" content="telephone=no,date=no,email=no" />
    <title>{{ $seo_head->meta_title }}</title>
    <meta name="description" content="{{ $seo_head->meta_description }}"></meta>
    <meta name="keywords" content="{{ $seo_head->meta_keyword }}"></meta>
    <!-- domain-verification Meta -->
    <meta name="google-site-verification" content="3ilHuepyXO4eaJ93NMu-EIJIgxHhJWG-KNeRqFtFcPQ" />
    <meta name="yandex-verification" content="" />
    <!-- domain-verification Meta End -->


    <!--GEO-Meta-Tags -->
    <meta name="geo.region" content="NP" />
    <meta name="geo.position" content="27.6982783, 85.2380705" />


    <!-- Facebook Meta -->
    <meta name = "og_site_name"     property = "og:site_name" content="{{ url('/') }}" />
    <meta name = "og:url"         property = "og:url"     content="{{ url('/') }}" />
    <meta name = "og:type"        property = "og:type"    content="website" />
    <meta name = "og:image:secure_url"  property = "og:image:secure_url" content="{{ url('/') }}" />
    <meta name = "og:image:alt"     property = "og:image:alt"   content="{{ $seo_head->meta_title }}" />
  
    
   

    <meta name = "og:image:type"    property = "og:image:type"  content="image/jpeg" />
    <meta name = "og:image:hright"    property = "og:image:height" content="300" />
    <meta name = "og:title"       property = "og:title"   content="{{ $seo_head->meta_title }}" />
    <meta name = "og:description"     property = "og:description" content="{{ $seo_head->meta_description }}" />
    <!-- Facebook Meta End -->
   
    <!-- Twitter Meta -->
    <meta name="twitter:card"           content="summary_large_image" />
    <meta name="twitter:site"           content="{{ url('/') }}" />
    <meta name="twitter:title"          content="{{ $seo_head->meta_title }}"/>
    <meta name="twitter:description"    content="{{ $seo_head->meta_description }}" />
    <meta name="twitter:image"          content="{{ url('/') }}" />
    <!-- Twitter Meta End -->
    @endif
@endsection

@section('content')
    <!-- //end of Navbar section -->
 @php
        
       $service=App\Models\Category::where('name','Services')->where('position','navbar')->first();
        $sliders=App\Models\Media::where('gallery_type','slider')->get();
                @endphp
              
                           

        <section class="as_banner_wrapper">
            <div class="as_banner_slider">
               
  @if(isset($sliders))
  @foreach($sliders as $slider)
                <div class="as_banner_detail {{ $loop->first ? 'active' : '' }}" >
                    <img src="{{ url('/') }}/storage/posts/{{ $slider->image }}" class="img-responsive " style="width: 60%">
                </div>
                @endforeach
                      @endif
               

            </div>
        </section>
@if(isset($service))
                        @php
           $our_service=App\Models\Page::where('name','Our Services')->where('status',1)->first();
                  @endphp
                          
<section class="as_service_wrapper as_padderTop80 as_padderBottom80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h1 class="as_heading as_heading_center"><span>{{ $our_service->name }}</span> </h1>
                        <p class="as_font14 as_padderBottom1">
                        {!! $our_service->description !!}
                        </p>
                    </div>
                </div>
               @php
              $subservices=App\Models\SubCategory::where('category_id',$service->id)->where('status',1)->get();
                  @endphp
                <div class="row as_service_slider">
                    @foreach($subservices as $subservice)
                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                        <div class="as_service_box_service text-center">
                            <figure class="as_icon">
                                <img src="{{ url('/') }}/storage/posts/{{  $subservice->thumbnail  }}" class="img-responsive" alt="">
                            </figure>

                            <h4 class="as_subheading">{{ $subservice->name }}</h4>
                            <p>{{ Str::limit($subservice->short_description,100) }}</p>
                            <a href="{{ route('page.slug',$subservice->slug) }}" class="as_link">read more</a>
                        </div>
                    </div>

                    @endforeach



                </div>
            </div>
        </section>

   @endif



   @php
        $about=App\Models\Page::where('name','Introduction-of-Guru-Ji')->where('status',1)->first();
              @endphp
        <section class="as_about_wrapper as_padderTop80 as_padderBottom80">
            <div class="container">
                <div class="row">
           
              @if(isset($about))
                    <div class="col-lg-6 col-md-6">
                        <h1 class="as_heading"><span>{{ $about->name }}</span></h1>
                        
                         <p>
                             <img src="{{ asset('front_assets/assets/images/quote-l.png') }}" alt="">
                             {{ $about->short_description }} <img src="{{ asset('front_assets/assets/images/quote-l.png') }}" alt=""></p>
                        <p class="text-justify">{!! Str::limit($about->description,1890) !!}</p>
                        
         <a href="{{ route('page.slug',$about->slug) }}"><button type="submit" class="as_btn">read more</button></a>

                   
                    </div>
                    <div class="col-lg-6 col-md-6">
                                                
                            <div>
                                <div class="as_aboutimg text-right">
                                    <img src="{{ url('/') }}/storage/posts/{{  $about->thumbnail  }}" alt="" class="img-responsive">
                                </div>
                            
                        </div>
                    </div>


                    @endif
                </div>
            </div>
        </section>
          <section class="as_zodiac_sign_wrapper as_padderTop80 as_padderBottom80">
              
            <div class="container">
                <div class="row">
                <div style="text-align:center;">
                     <div id="fortune-widget" ft_type="dailyHoroscope" ft_bgcolor="ffffff" ft_fgcolor="000000" ft_width="auto" ft_height="auto" ft_imagetype="1" ft_data="None"></div><script src="https://www.free-fortuneteller.com/widgets/fabulous_en.js" type="text/javascript"></script>
                </div>
                   
                  

                  
                </div>
                
            </div>
        </section>
        <section class="widgets as_padderBottom80 as_padderTop80" style="background-color: #eeeeee">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 widget-inner">
                        <div id="np_widget_wiz1" widget="day" style="width: auto;"></div>
                        <script async src="https://nepalipatro.com.np/np-widgets/nepalipatro.js" id="wiz1"></script>
                    </div>


                    <div class="col-lg-4 widget-inner">
                        <div id="np_widget_wiz2" widget="holidays" style="width: auto; height: 320px;background-color: #ffffff;overflow: hidden"></div>
                        <script async src="https://nepalipatro.com.np/np-widgets/nepalipatro.js" id="wiz2"></script>
                    </div>

                    <div class="col-lg-4 widget-inner">
                        <div id="np_widget_wiz3" widget="month-sm" style="width: auto;"></div>
                        <script async src="https://nepalipatro.com.np/np-widgets/nepalipatro.js" id="wiz3"></script>
                    </div>
                </div>
            </div>
        </section>

        <section class="as_sub_service_wrapper  as_padderTop80 as_padderBottom80">
            <div class="container">
                <div class="row">
              @php
              $kundali=App\Models\SubCategory::where('name','Kundali Services')->where('status',1)->first();
               $kundali_name=App\Models\Category::where('id',$kundali->category_id)->first();
                  @endphp

                    <div class="col-lg-12 ">
                        <h1 class="as_heading as_heading_center"><span>{{ $kundali->name }}</span></h1>
                        <p class="as_font14 as_padderBottom5">   
                        {!! Str::limit($kundali->description,550) !!}
                        </p>
                    </div>
                </div>
            
                <div class="row service_slider">

@php
$subundercats=App\Models\Product::where('subundercategory_id',$kundali->id)->orderBy('weight','asc')->get();
@endphp
            @foreach($subundercats as $subundercat)
                    <div class="col-lg-3 col-md-6 col-sm-6 ">
                        <div class="as_service_box text-center">
                            <figure >
                                <img src="{{ url('/') }}/storage/posts/{{  $subundercat->image  }}" alt="">
                            </figure>
                            <div class="text-part">
                                <h4 class="as_subheading">{{  $subundercat->name }}</h4>
                                <p>
                                {{ Str::limit($subundercat->short_description,50) }}
                                
                      </p>
                                <div class="price">
                                    <b>NPR {{ $subundercat->sp }}</b>
                                </div>
                                <div class="button_part">
                                    <a href="{{ route('page.slug',$subundercat->slug) }}" class="as_link">Read more</a>
                                    <a href="{{ route('addto.cart',$subundercat->id) }}" class="as_link">Add to Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
        @endforeach
                </div>
                
            </div>
        </section>

           @php
    $customer=App\Models\Page::where('name','What Our Customers Say')->where('status',1)->first();
      @endphp
    
        <section class="as_customer_wrapper as_padderBottom80 as_padderTop80">
            <div class="container">
                <div class="row">

                    <div class="col-lg-12 text-center">
                        <h1 class="as_heading as_heading_center"><span>{{ $customer->name }}</span></h1>
                        <p class="as_font14 as_margin0 as_padderBottom50">
                        
                        {!! $customer->description !!}
                        </p>

                        <div class="row">
                                @php
                    $texts=App\Models\People::where('people_type','text')->where('status',1)->OrderBy('weight','asc')->limit(4)->get();            
                                    @endphp
                            <div class="col-lg-6">
                                <div class="row as_customer_slider">
                                
                                   
                                   @foreach($texts as $text)
                                    <div class="col-lg-6 col-md-6">
                                        <div class="as_customer_box ">

                                            <div class="as_margin0" style="display: flex">
                                                <p style="color: #e66712;font-size: 20px;margin-right: 5px;flex: 1"><i class="fas fa-quote-left"></i></p>
                                                   {{ Str::limit($text->description,294, '...') }}
                                            </div>

                                            <div class="client-content" style="display: flex;justify-content: space-between; align-items: center;">
                                                <div class="ast_whywe_info_box client" style="margin-top: 20px">
                                                    <span><img src="{{ url('/') }}/storage/posts/{{  $text->image  }}" alt=""></span>
                                                    <div class="ast_whywe_info_box_info" >
                                                        <b style="font-weight: 600">{{ $text->name }}</b>
                                                        <b style="color: #4a4a4a; font-weight: 400">{{ $text->post }}</b>
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
                    $videos=App\Models\People::where('people_type','video')->where('status',1)->OrderBy('weight','asc')->limit(4)->get();
                                    @endphp
                            <div class="col-lg-6">
                                <div class="row as_customer_slider">
                                  
                                    @foreach($videos as $video)
                                    <div class="col-lg-6 col-md-6">
                                        <div class="as_customer_box text-center">
                                            <iframe  width="100%" height="300" src="https://www.youtube.com/embed/{{ $video->video_url }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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



        <section class="as_sub_service_wrapper  as_padderTop80 as_padderBottom80">
            <div class="container">
                <div class="row">
                     @php

              $spirtual=App\Models\SubCategory::where('name','Spirtual Services')->where('status',1)->first();
  $spirtual_name=App\Models\Category::where('id',$spirtual->category_id)->first();

                  @endphp
                    <div class="col-lg-12 ">
                        <h1 class="as_heading as_heading_center"><span>{{ $spirtual->name }}</span></h1>
                        <p class="as_font14 as_padderBottom5">
                        {!! Str::limit($spirtual->description,700) !!}
                       </p>
                    </div>
                </div>

                <div class="row service_slider">

@php

$spirtuals=App\Models\Product::where('subundercategory_id',$spirtual->id)->orderBy('weight','asc')->get();
@endphp
            @foreach($spirtuals as $spirtuall)
                    <div class="col-lg-3 col-md-6 col-sm-6 ">
                        <div class="as_service_box text-center">
                            <figure >
                                <img src="{{ url('/') }}/storage/posts/{{  $spirtuall->image  }}" alt="">
                            </figure>
                            <div class="text-part">
                                <h4 class="as_subheading">{{ $spirtuall->name }}</h4>
                                <p>         {!! Str::limit($spirtuall->description,555) !!}</p>
                                <div class="price">
                                    <b>NPR {{ $spirtuall->sp }}</b>
                                </div>
                                <div class="button_part">
                                    <a href="{{ route('page.slug',$spirtuall->slug) }}" class="as_link">Read more</a>
                                    <a href="{{ route('addto.cart',$spirtuall->id) }}" class="as_link">Add to Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                   @endforeach

                </div>
            </div>
        </section>
       
       
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


<!--<button type="button" class="he" value="{{ $product->id }}">Add</button>-->

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

    


@endsection

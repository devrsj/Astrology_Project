@extends('front.layouts.master')

@php
$sub_services=App\Models\SubCategory::where('category_id',$service_page->id)->OrderBy('weight','asc')->where('status',1)->simplePaginate(17);
@endphp

@include('front.layouts.seo')
@section('content')


 @if(isset($service))
 <section class="as_breadcrum_wrapper" @if(isset($service)) style="background-image: url({{ url('/') }}/storage/posts/{{ $service_page->banner }})"  @else
    style="background-image:url({{ asset('front_assets/assets/img/banner/1.jpg') }})"
    @endif>
        <div class="ast_img_overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>{{ $service_page->name }}</h1>

                    <ul class="breadcrumb">
                        <li><a href="{{ url('/') }}">Home</a></li>
                      
                        <li>{{ $service_page->name }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    @endif


    <section class="as_sub_service_wrapper  as_padderTop80 as_padderBottom80">
        <div class="container">
           
<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <h4>{{ $service_page->name }}</h4>
        <hr>
        <p>{!! $service_page->description !!}</p>
    </div>
</div>
            <div class="row">
                
                    
                  @if($sub_services->count() > 0)  
                  @foreach($sub_services as $subundercat)

               
                <div class="col-lg-4 col-md-6 col-sm-6 ">
                    <div class="as_service_box text-center">
                        <figure >
                            <img src="{{ url('/') }}/storage/posts/{{ $subundercat->thumbnail }}" alt="">
                        </figure>
                        
                        <div class="text-part">
                            <h4 class="as_subheading">{{ $subundercat->name }}</h4>
                      
                           
                            <div class="button_part">
                                
                     
 <a href="{{ route('page.slug',$subundercat->slug) }}" class="as_link" style="width:100%">Read more</a>
                           
                            </div>
                        </div>
                        
                        
                        
                    </div>
                </div>
                @endforeach
     
                @endif
            </div>
            @if($sub_services->count() > 0)
            {{ $sub_services->links('pagination::simple-default') }}
            @endif



        </div>
    </section>


     @php
$customerr=App\Models\Page::where('name','What Our Customers Say')->where('status',1)->first();
    @endphp

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

@endsection
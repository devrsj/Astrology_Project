 @extends('front.layouts.master')
@php

$name=App\Models\Category::where('id',$subunder_cat->subcategory_id)->first();


$related_services=App\Models\Product::where('subundercategory_id',$subunder_cat->subundercategory_id)->where('status',1)->OrderBy('weight','asc')->get();

@endphp

@include('front.layouts.seo')
@section('content')


  <section class="as_breadcrum_wrapper"   @if(isset($subunder_cat)) style="background-image: url({{ url('/') }}/storage/posts/{{ $subunder_cat->thumbnail }})"  @else
    style="background-image:url({{ asset('front_assets/assets/img/banner/1.jpg') }})"
    @endif>
        <div class="ast_img_overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>{{ $subunder_cat->name }}</h1>

                    <ul class="breadcrumb">
                        <li><a href="{{ url('/') }}">Home</a></li>
    <li><a href="">{{ $name->name }}</a></li>

    
    <li>{{ $subunder_cat->name }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="single_service_wrapper  as_padderTop80 as_padderBottom80">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="single_service">
                        <figure class="big-img">
                            <img src="{{ url('/') }}/storage/posts/{{ $subunder_cat->image }}" alt="" class="img-responsive" style="width:100%">
                        </figure> 
                        <h4>{{ $subunder_cat->name }}</h4>
                        <div class="buttons" style="padding: 10px 0">
                        @if($subunder_cat->subcategory_id==2)

                        @else
                            <div>
                                <p class="as_link" style="margin-right: 20px;background-color: #e66712">{{ $subunder_cat->sp }}/-</p>
                               
                                <a href="{{ route('addto.cart',$subunder_cat->id) }}" class="as_link">Add to Cart</a>
                            </div>
                            <div>
                                <a href="{{ route('book.appointment') }}" class="as_link book_appointment">Book Appointment</a>
                            </div>
                            @endif
                        </div>
                        <p class="text-justify">
                           {!! $subunder_cat->description !!}
                        </p>

                        <section class="as_sub_service_wrapper  as_padderTop80 as_padderBottom80">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12 ">
                                        <h1 class="as_heading as_heading_center">Related <span>{{ $name->name }}</span></h1>
                                       
                                    </div>
                                </div>

                                <div class="row service_slider">
                                  
                                  @foreach($related_services as $related_service)
                                    <div class="col-lg-3 col-md-6 col-sm-6 ">
                                        <div class="as_service_box text-center">
                                            <figure >
                                    <img src="{{ url('/') }}/storage/posts/{{ $related_service->image }}" alt="">
                                            </figure>
                                            <div class="text-part">
                                                <h4 class="as_subheading">{{ $related_service->name }}</h4>
                                                <p>{!! Str::limit($related_service->description, 80) !!}</p>
                                              
                     @if($related_service->subcategory_id==2)
         <a href="{{ route('page.slug',$related_service->slug) }}" class="as_link" style="width:100%">Read more</a>
                                              @else


                                                <div class="price">
                                                    <b>NPR {{ $related_service->sp }}</b>
                                                </div>
                                                <div class="button_part">
     <a href="{{ route('page.slug',$related_service->slug) }}" class="as_link">Read more</a>
                                                    <a href="{{ route('addto.cart',$related_service->id) }}" class="as_link">Add to Cart</a>
                                                </div>
                                              @endif
                                            </div>
                                        </div>
                                    </div>
                                   @endforeach


                                </div>
                            </div>
                        </section>

                     

                    </div>
                </div>
            </div>
        </div>

    </section>




@endsection
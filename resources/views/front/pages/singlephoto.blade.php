@extends('front.layouts.master')


@include('front.layouts.seo')
@section('content')


 <section class="as_breadcrum_wrapper"  @if(isset($category_name)) style="background-image: url({{ url('/') }}/storage/posts/{{ $category_name->banner }})"  @else
    style="background-image:url({{ asset('front_assets/assets/img/banner/1.jpg') }})"
    @endif>
        <div class="ast_img_overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>{{ $category_name->name }}</h1>

                    <ul class="breadcrumb">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="">Photo</a></li>
                        <li>{{ $category_name->name }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>


   @if($single_photos->count() > 0)
    <section class="photo_gallery_single  as_padderTop80 as_padderBottom80" style="background-color: #eeeeee">
        <div class="container">
            <div class="row gallery-grid ">
                <div class="gallery-grid-sizer"></div>
            
            @foreach($single_photos as $single_photo)
                <div class="gallery-grid-item">
                    <a  data-fancybox="gallery"
                            href="{{ url('/') }}/storage/posts/{{ $single_photo->image }}"
                            data-caption=""
                            title="">

                        <img
                                src="{{ url('/') }}/storage/posts/{{ $single_photo->image }}" alt="" >
                    </a>
                </div>
                @endforeach
            </div>
            {{ $single_photos ->links('pagination::simple-default') }}
        </div>

       
    </section>
    @else
     <section class="photo_gallery_single  as_padderTop80 as_padderBottom80" style="background-color: #eeeeee">
        <div class="container">
            <div class="row gallery-grid ">
                <div class="gallery-grid-sizer"></div>
   
<div class="alert alert-success" role="alert">
 <p class="lead">!!Oops Sorry No Images Found in {{ $category_name->name }}</p>
  
</div>
              
            </div>
        </div>

    </section>

    @endif


@endsection
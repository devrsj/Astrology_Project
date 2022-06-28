
@section('meta')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="{{ url('/') }}/storage/" href="{{ url('/') }}">
    <meta name="google-site-verification" content="">
    <base href="{{ url('/') }}">
    <meta name="abstract" content="{{ url('/') }}">
    <meta http-equiv="content-type" content="text/html" charset="utf-8" />
    <link rel="alternate" href="{{ url('/') }}" hreflang="en"/>
   
       @if(isset($page))
    <link rel="canonical" href="{{ url ('/') }} /
        {{ $page->slug }}" />
       @endif

         @if(isset($service))
    <link rel="canonical" href="{{ url ('/') }} /
        {{ $service->slug }}" />
       @endif

       @if(isset($subunder_cat))
       <link rel="canonical" href="{{ url ('/') }} /
        {{ $subunder_cat->slug }}" />
       @endif

       @if(isset($category_name))
       <link rel="canonical" href="{{ url ('/') }} /
        {{ $category_name->slug }}" />
       @endif
       @if(isset($blog_detail))
    <link rel="canonical" href="{{ url ('/') }} /
        {{ $blog_detail->slug }}" />
       @endif

       @if(isset($product_category))
    <link rel="canonical" href="{{ url ('/') }} /
        {{ $product_category->slug }}" />
       @endif

       @if(isset($product))
    <link rel="canonical" href="{{ url ('/') }} /
        {{ $product->slug }}" />
       @endif


    <meta name="copyright" content="{{ url('/') }}" />
    <meta name="author" content="{{ url('/') }}"/>
    <meta name="publisher" content="{{ url('/') }}"/>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="index, follow" />
    <meta name="format-detection" content="telephone=no,date=no,email=no" />

    
    @if(isset($page))
    <title>{{ $page->meta_title }}</title>
      <meta name="description" content="{{ $page->meta_description }}"></meta>
    <meta name="keywords" content="{{ $page->meta_keyword }}"></meta>
     @endif

       @if(isset($service))
    <title>{{ $service->meta_title }}</title>
      <meta name="description" content="{{ $service->meta_description }}"></meta>
    <meta name="keywords" content="{{ $service->name }}"></meta>
     @endif

     @if(isset($subunder_cat))
    <title>{{ $subunder_cat->meta_title }}</title>
      <meta name="description" content="{{ $subunder_cat->meta_description }}"></meta>
    <meta name="keywords" content="{{ $subunder_cat->meta_keyword }}"></meta>
     @endif

     @if(isset($category_name))
    <title>{{ $category_name->meta_title }}</title>
      <meta name="description" content="{{ $category_name->meta_description }}"></meta>
    <meta name="keywords" content="{{ $category_name->meta_keyword }}"></meta>
     @endif

     @if(isset($blog_detail))
    <title>{{ $blog_detail->meta_title }}</title>
      <meta name="description" content="{{ $blog_detail->meta_description }}"></meta>
    <meta name="keywords" content="{{ $blog_detail->meta_keyword }}"></meta>
     @endif

     @if(isset($product_category))
    <title>{{ $product_category->meta_title }}</title>
      <meta name="description" content="{{ $product_category->meta_description }}"></meta>
    <meta name="keywords" content="{{ $product_category->meta_keyword }}"></meta>
     @endif
     @if(isset($product))
    <title>{{ $product->meta_title }}</title>
      <meta name="description" content="{{ $product->meta_description }}"></meta>
    <meta name="keywords" content="{{ $product->meta_title }}"></meta>
     @endif


    <!-- domain-verification Meta -->
    <meta name="google-site-verification" content="3ilHuepyXO4eaJ93NMu-EIJIgxHhJWG-KNeRqFtFcPQ" />
    <meta name="yandex-verification" content="" />
    <!-- domain-verification Meta End -->


    <!--GEO-Meta-Tags -->
    <meta name="geo.region" content="NP" />
    <meta name="geo.position" content="27.6982783, 85.2380705" />


    <!-- Facebook Meta -->
    <meta name = "og_site_name" 		property = "og:site_name"	content="{{ url('/') }}" />
    <meta name = "og:url" 				property = "og:url"			content="{{ url('/') }}" />
    <meta name = "og:type" 				property = "og:type"		content="website" />
    <meta name = "og:image:secure_url" 	property = "og:image:secure_url" content="{{ url('/') }}" />
    @if(isset($page))
    <meta name = "og:image:alt"         property = "og:image:alt"   content="{{ $page->meta_title }}" />
    @endif
    @if(isset($subunder_cat))
    <meta name = "og:image:alt"         property = "og:image:alt"   content="{{ $subunder_cat->meta_title }}" />
    @endif
    @if(isset($service))
    <meta name = "og:image:alt"         property = "og:image:alt"   content="{{ $service->meta_title }}" />
    @endif
    @if(isset($category_name))
    <meta name = "og:image:alt"         property = "og:image:alt"   content="{{ $category_name->meta_title }}" />
    @endif

    @if(isset($blog_detail))
    <meta name = "og:image:alt"         property = "og:image:alt"   content="{{ $blog_detail->meta_title }}" />
    @endif

    @if(isset($product_category))
    <meta name = "og:image:alt"         property = "og:image:alt"   content="{{ $product_category->meta_title }}" />
    @endif
    @if(isset($product))
    <meta name = "og:image:alt"         property = "og:image:alt"   content="{{ $product->meta_title }}" />
    @endif
    <meta name = "og:image:type"		property = "og:image:type" 	content="image/jpeg" />
    <meta name = "og:image:hright"		property = "og:image:height" content="300" />


@if(isset($page))
    <meta name = "og:title"             property = "og:title"       content="{{ $page->meta_title }}" />
    <meta name = "og:description"       property = "og:description" content="{{ $page->meta_description }}" />
    <!-- Facebook Meta End -->
@endif
@if(isset($subunder_cat))
    <meta name = "og:title"             property = "og:title"       content="{{ $subunder_cat->meta_title }}" />
    <meta name = "og:description"       property = "og:description" content="{{ $subunder_cat->meta_description }}" />
    <!-- Facebook Meta End -->
@endif


@if(isset($service))
    <meta name = "og:title"             property = "og:title"       content="{{ $service->meta_title }}" />
    <meta name = "og:description"       property = "og:description" content="{{ $service->meta_description }}" />
    <!-- Facebook Meta End -->
@endif


@if(isset($category_name))
<meta name = "og:title"             property = "og:title"       content="{{ $category_name->meta_title }}" />
    <meta name = "og:description"       property = "og:description" content="{{ $category_name->meta_description }}" />
    <!-- Facebook Meta End -->

@endif

@if(isset($blog_detail))
<meta name = "og:title"             property = "og:title"       content="{{ $blog_detail->meta_title }}" />
    <meta name = "og:description"       property = "og:description" content="{{ $blog_detail->meta_description }}" />
@endif
@if(isset($product_category))
<meta name = "og:title"             property = "og:title"       content="{{ $product_category->meta_title }}" />
    <meta name = "og:description"       property = "og:description" content="{{ $product_category->meta_description }}" />
@endif

@if(isset($product))
<meta name = "og:title"             property = "og:title"       content="{{ $product->meta_title }}" />
    <meta name = "og:description"       property = "og:description" content="{{ $product->meta_description }}" />
@endif





    <!-- Twitter Meta -->
    <meta name="twitter:card"         	content="summary_large_image" />
    <meta name="twitter:site"           content="{{ url('/') }}" />
    
     @if(isset($page))
    <meta name="twitter:title"          content="{{ $page->meta_title }}"/>
    <meta name="twitter:description"    content="{{ $page->meta_description }}" />
    @endif

    @if(isset($subunder_cat))
    <meta name="twitter:title"          content="{{ $subunder_cat->meta_title }}"/>
    <meta name="twitter:description"    content="{{ $subunder_cat->meta_description }}" />
    @endif
    


     @if(isset($service))
    <meta name="twitter:title"          content="{{ $service->meta_title }}"/>
    <meta name="twitter:description"    content="{{ $service->meta_description }}" />
    @endif

    @if(isset($category_name))
    <meta name="twitter:title"          content="{{ $category_name->meta_title }}"/>
    <meta name="twitter:description"    content="{{ $category_name->meta_description }}" />
    @endif

    @if(isset($blog_detail))
    <meta name="twitter:title"          content="{{ $blog_detail->meta_title }}"/>
    <meta name="twitter:description"    content="{{ $blog_detail->meta_description }}" />
    @endif

    @if(isset($product_category))
    <meta name="twitter:title"          content="{{ $product_category->meta_title }}"/>
    <meta name="twitter:description"    content="{{ $product_category->meta_description }}" />
    @endif

    @if(isset($product))
    <meta name="twitter:title"          content="{{ $product->meta_title }}"/>
    <meta name="twitter:description"    content="{{ $product->meta_description }}" />
    @endif



    <meta name="twitter:image"          content="{{ url('/') }}" />
    <!-- Twitter Meta End -->

@endsection

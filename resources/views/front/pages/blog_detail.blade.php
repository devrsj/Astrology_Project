@extends('front.layouts.master')
@section('content')
@php
$blog_categories=App\Models\BlogCategory::where('status',1)->get();
@endphp

@include('front.layouts.seo')
@if(isset($tag_blog))

 <section class="as_breadcrum_wrapper"   @if(isset($tag_blog)) style="background-image: url({{ url('/') }}/storage/posts/{{ $tag_blog->banner }})"  @else
    style="background-image:url({{ asset('front_assets/assets/img/banner/1.jpg') }})"
    @endif>
        <div class="ast_img_overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>{{ $tag_blog->name }}</h1>

                    <ul class="breadcrumb">
                        <li><a href="{{ url('/') }}">Home</a></li>

                        <li>{{ $tag_blog->name }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    @endif


@if(isset($category_blogs))

 <section class="as_breadcrum_wrapper"   @if(isset($category)) style="background-image: url({{ url('/') }}/storage/posts/{{ $category->banner }})"  @else
    style="background-image:url({{ asset('front_assets/assets/img/banner/1.jpg') }})"
    @endif>
        <div class="ast_img_overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>{{ $category->name }}</h1>

                    <ul class="breadcrumb">
                        <li><a href="{{ url('/') }}">Home</a></li>

                        <li>{{ $category->name }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    @endif



@if(isset($blog_detail))
 <section class="as_breadcrum_wrapper"   @if(isset($blog_detail)) style="background-image: url({{ url('/') }}/storage/posts/{{ $blog_detail->banner }})"  @else
    style="background-image:url({{ asset('front_assets/assets/img/banner/1.jpg') }})"
    @endif>
        <div class="ast_img_overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>{{ $blog_detail->heading }}</h1>

                    <ul class="breadcrumb">
                        <li><a href="{{ url('/') }}">Home</a></li>

                        <li>{{ $blog_detail->heading }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    @endif
    @if(isset($blogs))

<section class="as_breadcrum_wrapper">
        <div class="ast_img_overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>{{ $search }}</h1>

                    <ul class="breadcrumb">
                        <li><a href="{{ url('/') }}">Home</a></li>

                        <li>{{ $search }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endif


    <section class="as_servicedetail_wrapper as_padderBottom80 as_padderTop80">
        <div class="container">
            <div class="row">

               @if(isset($blog_detail))
                 @php
                      
                      $category_name=App\Models\BlogCategory::where('id',$blog_detail->category_id)->first();
                     
                      @endphp
                <div class="col-lg-9 col-md-8">
                    <div class="as_blog_box as_blog_single ">
                        <div class="as_blog_img">
                            <img src="{{ url('/') }}/storage/posts/{{ $blog_detail->image }}" alt="" class="img-responsive" style="width:90%">
                            <span class="as_btn">Published at: {{ $blog_detail->updated_at->diffForhumans() }}</span>
                        </div>
                      
                   
                        <p class="as_font14 as_margin0 as_padderBottom20">
                            {!! $blog_detail->description !!}
                        </p>
                   

                       
                    </div>


                 <div id="disqus_thread"></div>

                </div>
                @endif

                @if(isset($blogs))
                @if($blogs->count() > 0)
                  <div class="col-lg-9 col-md-8">
                    <div class="row">
                 @foreach($blogs as $blog)
  @php
                      
                      $category_name=App\Models\BlogCategory::where('id',$blog->category_id)->first();
                     
                      @endphp
                      
                        <div class="col-lg-11 col-md-11">
                            <div class="as_blog_box">
                                <div class="as_blog_img">
                                    <a href="{{ route('blog.detail',$blog->slug) }}"><img src="{{ url('/') }}/storage/posts/{{ $blog->image }}" alt="" class="img-responsive" style="width:100%;max-height:233px"></a>
                                    <span class="as_btn">{{ $blog->updated_at->diffForhumans() }}</span>
                                </div>
                                <div class="blog-text">
                                    <ul>
                                <li><a href="{{ route('blog.detail',$blog->id) }}"><img src="{{ asset('front_assets/assets/images/svg/user.svg') }}" alt="">By - {{ $blog->published_by }}</a></li>
                                        <li><a href="javascript:;">Category :{{ $category_name->name }}</a></li>
                                    </ul>
                                    <h4 class="as_subheading"><a href="{{ route('blog.detail',$blog->slug) }}"> {{ $blog->heading }}</a></h4>
                                    <p class="as_font14 ">{{ Str::limit($blog->short_description, 100, '...') }}</p>
                                </div>

                            </div>
                          </div>
                      
                        @endforeach

                        </div>

                                   
                        {{ $blogs->appends(['search' => request()->query('search')]) ->links('pagination::simple-default') }}
                                 
 </div>
 @else

                  <div class="col-lg-9 col-md-8">
                              
 <div class="alert alert-warning">
  <strong>Oops!! sorry your </strong> {{ $search }}  blog doesnot  found 
</div>

</div>

 @endif
 @endif

     @if(isset($category_blogs))
                @if($category_blogs->count() > 0)
                  <div class="col-lg-9 col-md-8">
                    <div class="row">
                 @foreach($category_blogs as $category_blog)

                       @php
                      
                      $category_name=App\Models\BlogCategory::where('id',$category_blog->category_id)->first();
                     
                      @endphp
                        <div class="col-lg-11 col-md-11">
                            <div class="as_blog_box">
                                <div class="as_blog_img">
                                    <a href="{{ route('blog.detail',$category_blog->slug) }}"><img src="{{ url('/') }}/storage/posts/{{ $category_blog->image }}" alt="" class="img-responsive" style="width:100%;max-height:233px"></a>
                                    <span class="as_btn">{{ $category_blog->updated_at->diffForhumans() }}</span>
                                </div>
                                <div class="blog-text">
                                    <ul>
                                <li><a href="{{ route('blog.detail',$category_blog->slug) }}"><img src="{{ asset('front_assets/assets/images/svg/user.svg') }}" alt="">By - {{ $category_blog->published_by }}</a></li>
                                             <li><a href="javascript:;">Category :{{ $category_name->name }}</a></li>
                                    </ul>
                                    <h4 class="as_subheading"><a href="{{ route('blog.detail',$category_blog->slug) }}"> {{ $category_blog->heading }}</a></h4>
                                    <p class="as_font14 ">{{ Str::limit($category_blog->short_description, 100, '...') }}</p>
                                </div>

                            </div>
                          </div>
                      
                        @endforeach

                        </div>

                                    
                        {{ $category_blogs->appends(['search' => request()->query('search')]) ->links('pagination::simple-default') }}
                                 
 </div>
 @else

                  <div class="col-lg-9 col-md-8">
                              
 <div class="alert alert-warning">
  <strong>Oops!! sorry your </strong> {{ $category->name }}  blog doesnot  found 
</div>

</div>

 @endif
                 
                @endif


                  @if(isset($tags))
                @if($tags->count() > 0)
                  <div class="col-lg-9 col-md-8">
                    <div class="row">
                 @foreach($tags as $tag)
                    @php
                      $category_name=App\Models\BlogCategory::where('id',$tag->category_id)->first();
                      @endphp
                      
                        <div class="col-lg-11 col-md-11">
                            <div class="as_blog_box">
                                <div class="as_blog_img">
                                    <a href="{{ route('blog.detail',$tag->slug) }}"><img src="{{ url('/') }}/storage/posts/{{ $tag->image }}" alt="" class="img-responsive" style="width:100%;max-height:233px"></a>
                                    <span class="as_btn">{{ $tag->updated_at->diffForhumans() }}</span>
                                </div>
                                <div class="blog-text">
                                    <ul>
                                <li><a href="{{ route('blog.detail',$tag->slug) }}"><img src="{{ asset('front_assets/assets/images/svg/user.svg') }}" alt="">By - {{ $tag->published_by }}</a></li>
                                               <li><a href="javascript:;">Category :{{ $category_name->name }}</a></li>
                                    </ul>
                                    <h4 class="as_subheading"><a href="{{ route('blog.detail',$tag->slug) }}"> {{ $tag->heading }}</a></h4>
                                    <p class="as_font14 ">{{ Str::limit($tag->short_description, 100, '...') }}</p>
                                </div>

                            </div>
                          </div>
                      
                        @endforeach

                        </div>

                                     {{ $tags->appends(['search' => request()->query('search')]) ->links('pagination::simple-default') }}

                                 
 </div>
 @else

                  <div class="col-lg-9 col-md-8">
                              
 <div class="alert alert-warning">
  <strong>Oops!! sorry your </strong> {{ $tag_blog->name }}  blog doesnot  found 
</div>

</div>

 @endif
                 
                @endif


                <div class="col-lg-3 col-md-4">
                    <div class="as_blog_sidebar">
                          <form method="get" action="{{ url('/search') }}">
                        <div class="as_search_widget">

                            <input type="text" name="search" class="form-control" id="" placeholder="Search...">
                            <a href="#"><img src="{{ asset('front_assets/assets/images/svg/search.svg') }}" alt=""></a>
                        </div>
                            </form>

                        <div class="as_service_widget as_padderBottom40">
                            <h3 class="as_heading">Categories</h3>

                            <ul>
                               @foreach($blog_categories as $blog_category)
                                <li>
                                    <a href="{{ route('category.slug',$blog_category->id) }}">
                                        <span>{{ $blog_category->name }}</span>
                                        <span>( {{ $blog_category->blogs()->count() }} )</span>
                                    </a>
                                </li>
@endforeach
                            </ul>
                        </div>

                        <div class="as_service_widget as_padderBottom40">
                            <h3 class="as_heading">Tags</h3>

                            <div class="as_tag_wrapper">
                                @foreach(App\Models\Tag::all() as $tag)
                                <a href="{{ route('tags.group',$tag->id) }}" class="as_btn">{{ $tag->name }}</a>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>



  <script>
    /**
    *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
    *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
    
    var disqus_config = function () {
    this.page.url = '{{ Request::url() }}';
    this.page.identifier =
    
    @if(isset($blog_detail))
     {{ $blog_detail->id }}; 
     @endif
     // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };
    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://https-www-kailashguru-com.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
</script>



  
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
@endsection
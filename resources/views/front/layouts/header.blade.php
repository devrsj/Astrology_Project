<!DOCTYPE html>
<html lang="en">
<head>
  

@yield('meta')

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- stylesheet -->
    <link rel="stylesheet" href="{{ asset('front_assets/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front_assets/assets/css/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front_assets/assets/css/datepicker.min.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="{{ asset('front_assets/assets/fancybox/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('front_assets/assets/css/style.css') }}">
    <!-- favicon -->
    @php
 $seo_head =App\Models\Seo::first();
    @endphp
<script src="//code-eu1.jivosite.com/widget/QtZrEEonbc" async></script>
    
    <link rel="shortcut icon" href="{{ url('/') }}/storage/posts/{{  $seo_head->favicon  }}" type="image/x-icon">
    
    <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v10.0" nonce="79m7ZuXG"></script>

  <!--Start of Tawk.to Script-->
<!--<script type="text/javascript">-->
<!--var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();-->
<!--(function(){-->
<!--var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];-->
<!--s1.async=true;-->
<!--s1.src='https://embed.tawk.to/60c7ac2c65b7290ac635edee/1f85vh40m';-->
<!--s1.charset='UTF-8';-->
<!--s1.setAttribute('crossorigin','*');-->
<!--s0.parentNode.insertBefore(s1,s0);-->
<!--})();-->
<!--</script>-->
<!--End of Tawk.to Script-->

</head>
<body>

  

  @php

$header_setting=App\Models\Setting::first();
$header_contact=App\Models\Contactus::first();
    @endphp

    <!-- Preloader Start -->
 
    <!--<div class="as_loader">
        <img src="assets/images/loader.png" alt="" class="img-responsive">
    </div> -->
  

    <div class="as_main_wrapper">
        <div class="ast_top_header">
            <div class="container">
                <div class="row">

 
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="ast_contact_details">
                              @if(isset($header_contact))
                            <ul>
                                <li><a href="" ><i class="fa fa-phone-alt" aria-hidden="true"></i>

                             {{ $header_contact->number }}
                                </a></li>
                                <li class="d-none"><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i>{{ $header_contact->email }}</a></li>
                            </ul>
                                @endif
                        </div>

                        <div class="ast_autho_wrapper" style="margin-top: -28px">
                            <div id="google_translate_element"></div>
                            <script type="text/javascript">
                                function googleTranslateElementInit() {
                                    new google.translate.TranslateElement({
                                        pageLanguage: 'en',
                                        // includedLanguages: 'de,es,hi,fr,ja,ne,mt,hr,ta,el,sv,ka',
                                        layout: google.translate.TranslateElement.InlineLayout.SIMPLE
                                    }, 'google_translate_element');
                                }
                            </script>

                            <script type="text/javascript"
                                    src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <section class="as_header_wrapper ">

            <div class="as_header_detail" style="width: 100%">
              <div class="top_bar">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="as_logo">
                                    <a href="{{ url('/') }}"><h2 style="font-weight: 800;color: #e66712;text-align: center;font-size: 22px">Astro Guru<br> Kailash</h2></a>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="as_info_detail">
                                    <ul>
                                        <li>
                                            <a href="{{ route('book.appointment') }}">
                                                <div class="as_infobox">
                                    <span class="as_infoicon" style="background-color: #4793E1;color: #ffffff">
                                        <img src="{{ asset('front_assets/assets/images/svg/headphone.svg') }}" alt="" style="margin-right: 5px; "> Book Appointment
                                    </span>
                                                </div>

                                            </a>
                                        </li>
                                        <li >
                                            <a href="{{ route('ask.question') }}">
                                                <div class="as_infobox" >
                                    <span class="as_infoicon" style="background-color: #ffffff;color: #4793E1;border: solid 1px #4793E1">
                                        <img src="{{ asset('front_assets/assets/images/svg/call3.svg') }}" alt="" style="margin-right: 5px"> Ask Question ?
                                    </span>

                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="as_right_info">
                                        <a href="javascript:;">
                                            <div class="as_infobox">
                                <span class="as_infoicon">
                             <img src="{{ asset('front_assets/assets/images/svg/login.svg') }}" alt="">
                                </span>
                                    @auth
                                     <span><a href="{{ route('user.dashboard') }}">{{ Auth()->user()->name }}</a>/<a class="nav-link"  href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                  Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                  </span>

@else
   <span class="as_logintext" data-toggle="modal" data-target="#as_login">Log in / Register</span>
@endauth
</div>
   </a>
   
   
   <div id="tcart">
   @php
$htotal=0;
@endphp  
@if(session('cart'))
@foreach(session('cart') as $id => $product)
@php
$hsub_total=$product['sp'] * $product['quantity'];
$htotal +=$hsub_total;
@endphp
@endforeach
@endif
                                        <div id="cart_ajax">
                                        <div class="as_cart">
                                            <div class="as_cart_wrapper">
                                                
                                                <span><img src="{{ asset('front_assets/assets/images/svg/cart.svg') }}" alt=""><span class="as_cartnumber">
                                                    
                                                     @if(session('cart'))
                                             {{   count(Session('cart')) }}
                                            @else
                                            0
                                           @endif
                                                </span></span>
                                             NPR {{ $htotal }}
                                                
                                            </div>
 
                                            <div class="as_cart_box">
                              @if(session('cart'))
                                      <div class="as_cart_list">
                                                    <ul>
                                                $total=0;
                                                  @endphp  
                                                
                                @foreach(session('cart') as $id => $product)
                                               @php
                                        $sub_total=$product['sp'] * $product['quantity'];
                                          $total +=$sub_total;
                                                  @endphp
                                                        
                             <li>
                                <div class="as_cart_img">
                            <img src="{{ url('/') }}/storage/posts/{{ $product['photo'] }}"  class="img-responsive">
                          </div>
                          <div class="as_cart_info">
                             <a href="#">{{ $product['name'] }}</a>
                            <p> {{ $product['sp'] }} *{{ $product['quantity'] }} </p>
                         <a href="{{ route('remove.cart',[$id]) }}"><i class="fas fa-trash-alt"></i></a>
                            </div>
                          </li>
                                                        
                           @endforeach
                                                      
                                                        
                                                    </ul>
                                                </div>
                                                <div class="as_cart_total">
                                                    <p>total<span>NPR  {{ $total }}</span></p>
                                                </div>
                                                <div class="as_cart_btn">
                                                <a href="{{ route('cart') }}"><button type="button" id="view_cart" data-toggle="modal" data-target=".bd-example-modal-lg" class="as_btn">view cart</button></a>
                                                   @auth
       <a href="{{ route('cart') }}"><button type="button" class="as_btn">checkout</button></a>
                                              @else
                                                  <button type="button" class="as_btn" data-toggle="modal" data-target="#myModal">checkout</button>
                                              @endauth
                                                </div>
                                             @else
                                                <p>Empty Carts</p>
                                                @endif
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

                                    @php
                                     $pagelists =App\Models\Page::where([['parent_id',0],['status',1],['position','header']])->orderBy('weight','ASC')->get();
                                     $navbar_categories=App\Models\Category::where('status',1)->where('position','navbar')->get();
                                     $nabout =Arr::pull($pagelists,0);
                                     $pages= Arr::except($pagelists,[0]);
                                      @endphp
                                 

                
                <div class="menu_section">
                    <div class="container">
                        <div class="row">
                            <div class="as_menu_wrapper">
                                <span class="as_toggle">
                                    <img src="{{ asset('front_assets/assets/images/svg/menu.svg') }}" alt="">
                                </span>



                                <div class="as_menu">
                                <ul>
                                    <li><a href="{{ url('/') }}" class="active" style="color:white">home</a></li>

                                    <li><a   @if($nabout->link==null)   href="{{ route('page.slug',$nabout->slug) }}"@else   href="{{ $nabout->link }}" target="_blank"   @endif
                                    
      >{{ $nabout->name }} <i class="fa fa-angle-down"></i></a>
                                    @php
$subabouts =App\Models\Page::where([['parent_id',$nabout->id],['status',1],['position','header']])->orderBy('weight', 'ASC')->get();
                                            @endphp
                                      
                                            @if(sizeof($subabouts) != 0 )
      <ul class="as_submenu">
      
  @foreach($subabouts as $key=> $sublist)
 <li>
<a  @if($sublist->link==null)  href="{{ route('page.slug',$sublist->slug) }}"
            @else href="{{ $sublist->link }}" @endif >{{ $sublist->name }}</a>
                                     </li>
                        @endforeach
                                            </ul>
                                            @endif

                                    </li>


                                    @foreach($navbar_categories as $navbar_category)
                                       <li><a href="{{ route('page.slug',$navbar_category->slug) }}">{{ $navbar_category->name }} <i class="fa fa-angle-down"></i>  </a>
                                          
                                        <ul class="as_submenu">
                                    @if($navbar_category->subcategories()->count() > 0)
                                              @foreach($navbar_category->subcategories as $subcat)
                        <li><a href="{{ route('page.slug',$subcat->slug) }}">{{ $subcat->name }}</a></li>
                                            @endforeach
                                           @endif
                                        </ul>
                                    </li>
                                    @endforeach
                               
                                    @foreach($pages as $pagelist)
                                             @php
$sublists =App\Models\Page::where([['parent_id',$pagelist->id],['status',1],['position','header']])->orderBy('weight', 'ASC')->get();
                                            @endphp
                                
                                        <li>
     <a @if(sizeof($sublists) != 0 )   @if($pagelist->link==null)
  href="{{ route('page.slug',$pagelist->slug) }}" @else
 href="{{ $pagelist->link }}" target="_blank" 
  @endif  @else 
  @if($pagelist->link==null)
  href="{{ route('page.slug',$pagelist->slug) }}" @else
 href="{{ $pagelist->link }}"  target="_blank"
  @endif 
  @endif>{{ $pagelist->name }}                                     
@if(sizeof($sublists) != 0 )   
<i class="fa fa-angle-down"></i>                                   
@endif  
</a>


 @if(sizeof($sublists) != 0 )
      <ul class="as_submenu">

  @foreach($sublists as $key=> $sublist)
 <li>
<a  @if($sublist->link==null)  href="{{ route('page.slug',$sublist->slug) }}" 
            @else href="{{ $sublist->link }}" target="_blank" @endif >{{ $sublist->name }}</a>
                                     </li>
                        @endforeach
                                            </ul>
                                            @endif
                                        </li>
                                        @endforeach
                            </div>


                                <div class="as_search_wrapper">
                                    <img src="{{ asset('front_assets/assets/images/search.png') }}" alt="" class="as_search">

                                    <div class="as_search_boxpopup">
                                        <a href="javascript:;" class="as_cancel"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="25px" height="25px" x="0px" y="0px" viewBox="0 0 511.76 511.76" style="enable-background:new 0 0 511.76 511.76;" xml:space="preserve"> <g> <g> <path d="M436.896,74.869c-99.84-99.819-262.208-99.819-362.048,0c-99.797,99.819-99.797,262.229,0,362.048 c49.92,49.899,115.477,74.837,181.035,74.837s131.093-24.939,181.013-74.837C536.715,337.099,536.715,174.688,436.896,74.869z M361.461,331.317c8.341,8.341,8.341,21.824,0,30.165c-4.16,4.16-9.621,6.251-15.083,6.251c-5.461,0-10.923-2.091-15.083-6.251 l-75.413-75.435l-75.392,75.413c-4.181,4.16-9.643,6.251-15.083,6.251c-5.461,0-10.923-2.091-15.083-6.251 c-8.341-8.341-8.341-21.845,0-30.165l75.392-75.413l-75.413-75.413c-8.341-8.341-8.341-21.845,0-30.165 c8.32-8.341,21.824-8.341,30.165,0l75.413,75.413l75.413-75.413c8.341-8.341,21.824-8.341,30.165,0 c8.341,8.32,8.341,21.824,0,30.165l-75.413,75.413L361.461,331.317z"/> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg></a>
                                        <div class="as_search_inner">
                                            <div class="as_search_widget">
                                                <input type="text" name="" class="form-control" id="" placeholder="Search...">
                                                <a href="#"><img src="{{ asset('front_assets/assets/images/svg/search.svg') }}" alt=""></a>
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

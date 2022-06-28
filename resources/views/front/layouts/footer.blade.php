
 <section class="as_whychoose_wrapper as_padderTop80 as_padderBottom50" style="background-color: #eeeeee">
            <div class="container">
                <div class="row ">
                    <div class="col-lg-12 text-center">

                                 @php
           $choose=App\Models\Page::where('name','Why Choose Us')->where('status',1)->first();
                  @endphp
                        <h1 class="as_heading as_heading_center"><span>{{ $choose->name }}</span></h1>
                        <p class="as_font14 as_margin0 as_padderBottom50">{!! $choose->description !!}</p>
                        <div class="ast_whywe_info">
                         
                         @php
                     $chooseus=App\Models\Media::where('gallery_type','why choose us')->where('status',1)->take(4)->get();
                         @endphp
                            @foreach($chooseus as $chooseu)
                            <div class="col-lg-3 col-md-4 col-sm-6 ">
                                <div class="ast_whywe_info_box">
                                 
                                    <span><img src="{{ url('/') }}/storage/posts/{{ $chooseu->image }}" alt=""></span>
                                 
                         
                                    <div class="ast_whywe_info_box_info">
                                        <p>{{ $chooseu->name }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                          


                        </div>
                    </div>
                </div>
            </div>
        </section>


<!-- <--//Footer section--> 
        <section class="as_footer_wrapper " style="padding-top: 50px">
            <div class="container">
                <div class="row">
                    <div class="as_newsletter_wrapper as_verticle_center " style="padding-bottom: 40px;border-bottom: solid 1px #8c8c8c">
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="as_share_box" style="margin-bottom:20px">
              @php
           $follow=App\Models\Page::where('name','Follow Us On')->where('status',1)->first();
                  @endphp
                                <h1 class="as_heading " style="color: #eeeeee">{{ $follow->name }}</h1>
                               @php
           $setting=App\Models\Setting::first();
                  @endphp
                                <ul style="padding: 0">
                                    <li><a href="{{ $setting->facebook_link }}" target="#"><img src="{{ asset('front_assets/assets/images/svg/facebook.svg') }}" alt=""></a></li>
                                    <li><a href="{{ $setting->twitter_link }}" target="#" ><img src="{{ asset('front_assets/assets/images/svg/twitter.svg') }}" alt=""></a></li>
                                    <li><a href="{{ $setting->instagram_link }}" target="#"><img src="{{ asset('front_assets/assets/images/svg/google.svg') }}" alt=""></a></li>
                                    <li><a href="{{ $setting->youtube_link }}" target="#"><img src="{{ asset('front_assets/assets/images/svg/youtube.svg') }}" alt=""></a></li>
                                </ul>


                            </div>
                        </div>
                        <div class="col-lg-7 col-md-6 col-sm-12">
                             @php
           $newsletter=App\Models\Page::where('name','Our Newsletter')->where('status',1)->first();
                  @endphp
                            <h1 class="as_heading as_heading_center text-center" style="color: #eeeeee"> <span>{{ $newsletter->name }}</span></h1>
                            <!--<p class="text-center">Get Your Daily Horoscope, Daily Lovescope and Daily<br> Tarot Directly In Your Inbox</p>-->
                            <div class="as_newsletter_box">
                                
                                <form method="post" action="{{ route('newsletter.store') }}">
                                @csrf

                                <input type="email" name="email"  class="form-control" placeholder="Enter your Email Here...">
                                <button type="submit" class="as_btn">subscribe now</button>
                                  
                                  </form>

                            </div>
                        </div>
                    </div>
                    

                    <div class="as_footer_inner " style="padding-bottom: 30px">

                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="as_footer_widget">
                                        @php
           $our_service=App\Models\Page::where('name','Our Services')->where('status',1)->first();
                  @endphp
                               <h3 class="as_footer_heading">  {{ $our_service->name }}</h3>

                               <ul>

       @php
       $service=App\Models\Category::where('name','Services')->where('status',1)->first();
       @endphp
@if(isset($service))
@php
              $subservices=App\Models\SubCategory::where('category_id',$service->id)->where('status',1)->inRandomOrder()
                ->limit(5)->get();
             
                  @endphp
                  @if(isset($subservices))
                  @foreach($subservices as $subservice)
<li><a href="{{ route('page.slug',$subservice->slug) }}"><span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="8" height="12" viewBox="0 0 8 12"> <path d="M8.000,5.998 L-0.002,11.997 L1.292,5.998 L-0.002,-0.001 L8.000,5.998 ZM1.265,9.924 L6.502,5.998 L1.265,2.071 L2.112,5.998 L1.265,9.924 ZM5.451,5.998 L2.496,8.213 L2.974,5.998 L2.496,3.783 L5.451,5.998 Z" class="cls-1"/> </svg></span> {{ $subservice->name }}</a></li>


  @endforeach
                    @endif
                    
                             @endif

                                   


                               </ul>
                            </div>
                        </div>

                                          @php

$quick_link=App\Models\Page::where([['name','Quick Links'],['position','footer'],['status',1]])->orderBy('weight','asc')->limit(1)->first();
@endphp

     @if(isset($quick_link))

     @php

$quick_links= $subservices=App\Models\Page::where([['parent_id',$quick_link->id],['position','footer'],['status',1]])->orderBy('weight','asc')->limit(5)->get();
@endphp
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="as_footer_widget">

                     

                               <h3 class="as_footer_heading">{{ $quick_link->name }}</h3>

                               <ul>
      
@foreach($quick_links as $quicklink)
                                  
                                   <li><a href="{{ $quicklink->link }}"><span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="8" height="12" viewBox="0 0 8 12"> <path d="M8.000,5.998 L-0.002,11.997 L1.292,5.998 L-0.002,-0.001 L8.000,5.998 ZM1.265,9.924 L6.502,5.998 L1.265,2.071 L2.112,5.998 L1.265,9.924 ZM5.451,5.998 L2.496,8.213 L2.974,5.998 L2.496,3.783 L5.451,5.998 Z" class="cls-1"/> </svg></span> {{ $quicklink->name }}</a></li>
                                   @endforeach

                               </ul>
                            </div>
                        </div>
                        @endif
    @php             
    $footer_contact=App\Models\Contactus::first();
    @endphp
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="as_footer_widget">
                                         @php

$contact=App\Models\Page::where('name','Contact Us')->where('status',1)->first();


    @endphp
                               <h3 class="as_footer_heading">{{ $contact->name }}</h3>

                               <ul class="as_contact_list">
                                   <li>
                                       <img src="{{ asset('front_assets/assets/images/svg/map.svg') }}" alt="">
                                        <p>{{ $footer_contact->address }}</p>
                                    </li>
                                   <li>
                                       <img src="{{ asset('front_assets/assets/images/svg/address.svg') }}" alt="">
                                        <p>
                                            <a href="javascript:;">{{ $footer_contact->email }}</a>
                                            <a href="javascript:;">{{ $footer_contact->description }}</a>
                                        </p> 
                                    </li> 
                                   <li>
                                       <img src="{{ asset('front_assets/assets/images/svg/call.svg') }}" alt="">
                                        <p>
                                            <a href="javascript:;">{{ $footer_contact->number }}</a><br>
                                            <a href="javascript:;">{{ $footer_contact->telephone_number }}</a>
                                        </p>
                                    </li>
                               </ul>
                            </div>
                        </div>
                        
                        
                            <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="as_footer_widget">
                                
                                 <div class="fb-page" data-href="{{ $footer_contact->facebookpage_link }}" data-tabs="timeline" data-width="300" data-height="250" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="{{ $footer_contact->facebookpage_link }}" class="fb-xfbml-parse-ignore"><a href="{{ $footer_contact->facebookpage_link }}">Guru</a></blockquote></div>
                               
                               
                            </div>
                        </div>
                  
                  
                        
                    </div>
                </div>
            </div>
        </section>

        <section class="as_copyright_wrapper text-center">
            <div class="container">
                <div class="row">
                                 @php
           $bottom_footers=App\Models\Page::where('position','bottom')->where('status',1)->get();
                  @endphp
                    <div class="col-lg-12">
                        <div class="footer_bottom_link">
                            <ul>

                                @foreach($bottom_footers as $bottom_footer)
                                <li>
                                    <a href="{{ $bottom_footer->link }}">{{ $bottom_footer->name }} </a>
                                </li>
                                @endforeach
                               
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <p style="color: #eeeeee">Copyright &copy; 2021 Astro kailash Guru. All Right Reserved.</p>
                        <p style="color: #eeeeee">Powered By : <a href="https://www.weblinknepal.com">Weblink Nepal</a> </p>
                    </div>
                </div>
            </div>
        </section> 
    </div>
    
    
    
    
    
    
    
    @include('front.layouts.modal')
    
    
    
      <!-- login  Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header" style="border-bottom:solid 1px #ccc">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Login</h4>
        </div>
        <div class="modal-body">
        <form action="{{ route('login') }}" method="post">
          @csrf
          <div class="form-group">
 <label>Email</label>
          <input type="email" class="form-control" name="email">
          </div>
  <div class="form-group">
 <label>Password</label>
          <input type="password" class="form-control" name="password">
          </div>
               @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
<button type="submit" class="btn btn-success">Login</button>
          </form>
         <div class="or"><span>OR</span></div>
          
<a href="{{ route('login.google')  }}" style="margin-bottom:10px"><button type="button" class="btn btn-success" style="width:100%; margin-bottom:10px"><i class="fab fa-facebook" style="margin-right:5px"> </i>Login With Google</button></a>
                 <a href="{{ route('login.facebook') }}"></a>   <button type="button" class="btn btn-primary" style="width:100%"><i class="fab fa-google" style="margin-right:5px"></i>Login With Facebook</button></a>
<br>
<div class="or"><span>OR</span></div>
<hr>
<a href="{{ route('checkout.index') }}" class="as_link">Guest Checkout
</a>
</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


<!-- Modal -->
    <div id="as_login" class="modal fade" role="dialog">
        <div class="modal-dialog">
    
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Login</h4>
                </div>
                <div class="modal-body">
                    <div class="as_login_box active">
                        <form action="{{ route('login') }}" method="post">
                        @csrf
                            <div class="form-group">
                                <input type="email" name="email" placeholder="Enter email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" placeholder="Enter password here" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <div class="as_login_data">
                                    <label>Remember me
                                         <input type="checkbox" name="as_remember_me" value="">
                                         <span class="checkmark"></span>
                                    </label>
                                    <p><a href="#">Forgot password ?</a></p>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="as_btn">Login</button>
                            </div>
                        </form>
                        
                        <div class="or"><span>OR</span></div>
                        
                <a href="{{ route('login.google')  }}" style="margin-bottom:10px"><button type="button" class="btn btn-success" style="width:100%; margin-bottom:10px"><i class="fab fa-facebook" style="margin-right:5px"> </i>Login With Google</button></a>
                 <a href="{{ route('login.facebook') }}"></a>   <button type="button" class="btn btn-primary" style="width:100%"><i class="fab fa-google" style="margin-right:5px"></i>Login With Facebook</button></a>
           
                            
                        <p class="text-center as_margin0 as_padderTop20">Create An Account ? <a href="javascript:;" class="as_orange as_signup">SignUp</a></p>
                    </div>
                    <div class="as_signup_box">
                        <form action="{{ route('register') }}" method="post">
                                  @csrf
                            <div class="form-group">
                                <input type="text" name="name" placeholder="Enter name" class="form-control" required >
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" placeholder="Enter email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" placeholder="Enter password here" class="form-control" required >
                            </div>
                            <div class="form-group">
                                <input type="password" name="password_confirmation" placeholder="Enter your confirm password here" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <input type="number" name="number" placeholder="Enter mobile number" class="form-control" required >
                            </div>
                            <div class="form-group">
                                <select name="gender" class="form-control" required>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <input type="hidden" value="0" name="is_admin">

                            <input type="hidden" value="0" name="status">
                            

                            <div class="text-center">
                                <button type="submit" class="as_btn">Sign Up</button>
                            </div>
                        </form>
                        <p class="text-center as_margin0 as_padderTop20">Have An Account ? <a href="javascript:;" class="as_orange as_login">Login</a></p>
                      <div class="or"><span>OR</span></div>
          
<a href="{{ route('login.google')  }}" ><button type="button" class="btn btn-success" style="width:100%; margin-bottom:10px"><i class="fab fa-facebook" style="margin-right:5px"> </i>Login With Google</button></a>
                 <a href="{{ route('login.facebook') }}"></a>   <button type="button" class="btn btn-primary" style="width:100%"><i class="fab fa-google" style="margin-right:5px"></i>Login With Facebook</button></a>
           
                    </div> 
                </div>
            </div>
    
        </div>
    </div>


    <!-- Modal -->
  <div class="modal fade" id="e-sewa" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Payment For Esewa</h4>
        <hr>
        </div>
        <div class="modal-body">
          
             
             <form action="https://uat.esewa.com.np/epay/main" method="POST">
               
                  
                  <div class="form-group">
                      <label><strong>Name</strong></label>
                      <input type="text" class="form-control" name="name" placeholder="Name" required>
                  </div>
                  
                    <div class="form-group">
                      <label><strong>Email</strong></label>
                      <input type="email" class="form-control" name="email" placeholder="Email" required>
                  </div>
                  
                   <div class="form-group">
                      <label><strong>Number</strong></label>
                      <input type="number"  min="0" class="form-control" name="number" placeholder="number" required>
                  </div>
                   
                    <div class="form-group">
                      <label><strong>Country</strong></label>
                   
                                    <select id="country" name="country" class="form-control">
                                        <option value="Afghanistan">Afghanistan</option>
                                        <option value="Åland Islands">Åland Islands</option>
                                        <option value="Albania">Albania</option>
                                        <option value="Algeria">Algeria</option>
                                        <option value="American Samoa">American Samoa</option>
                                        <option value="Andorra">Andorra</option>
                                        <option value="Angola">Angola</option>
                                        <option value="Anguilla">Anguilla</option>
                                        <option value="Antarctica">Antarctica</option>
                                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                        <option value="Argentina">Argentina</option>
                                        <option value="Armenia">Armenia</option>
                                        <option value="Aruba">Aruba</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Austria">Austria</option>
                                        <option value="Azerbaijan">Azerbaijan</option>
                                        <option value="Bahamas">Bahamas</option>
                                        <option value="Bahrain">Bahrain</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Barbados">Barbados</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Belgium">Belgium</option>
                                        <option value="Belize">Belize</option>
                                        <option value="Benin">Benin</option>
                                        <option value="Bermuda">Bermuda</option>
                                        <option value="Bhutan">Bhutan</option>
                                        <option value="Bolivia">Bolivia</option>
                                        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                        <option value="Botswana">Botswana</option>
                                        <option value="Bouvet Island">Bouvet Island</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                        <option value="Brunei Darussalam">Brunei Darussalam</option>
                                        <option value="Bulgaria">Bulgaria</option>
                                        <option value="Burkina Faso">Burkina Faso</option>
                                        <option value="Burundi">Burundi</option>
                                        <option value="Cambodia">Cambodia</option>
                                        <option value="Cameroon">Cameroon</option>
                                        <option value="Canada">Canada</option>
                                        <option value="Cape Verde">Cape Verde</option>
                                        <option value="Cayman Islands">Cayman Islands</option>
                                        <option value="Central African Republic">Central African Republic</option>
                                        <option value="Chad">Chad</option>
                                        <option value="Chile">Chile</option>
                                        <option value="China">China</option>
                                        <option value="Christmas Island">Christmas Island</option>
                                        <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                        <option value="Colombia">Colombia</option>
                                        <option value="Comoros">Comoros</option>
                                        <option value="Congo">Congo</option>
                                        <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                                        <option value="Cook Islands">Cook Islands</option>
                                        <option value="Costa Rica">Costa Rica</option>
                                        <option value="Cote D'ivoire">Cote D'ivoire</option>
                                        <option value="Croatia">Croatia</option>
                                        <option value="Cuba">Cuba</option>
                                        <option value="Cyprus">Cyprus</option>
                                        <option value="Czech Republic">Czech Republic</option>
                                        <option value="Denmark">Denmark</option>
                                        <option value="Djibouti">Djibouti</option>
                                        <option value="Dominica">Dominica</option>
                                        <option value="Dominican Republic">Dominican Republic</option>
                                        <option value="Ecuador">Ecuador</option>
                                        <option value="Egypt">Egypt</option>
                                        <option value="El Salvador">El Salvador</option>
                                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                                        <option value="Eritrea">Eritrea</option>
                                        <option value="Estonia">Estonia</option>
                                        <option value="Ethiopia">Ethiopia</option>
                                        <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                        <option value="Faroe Islands">Faroe Islands</option>
                                        <option value="Fiji">Fiji</option>
                                        <option value="Finland">Finland</option>
                                        <option value="France">France</option>
                                        <option value="French Guiana">French Guiana</option>
                                        <option value="French Polynesia">French Polynesia</option>
                                        <option value="French Southern Territories">French Southern Territories</option>
                                        <option value="Gabon">Gabon</option>
                                        <option value="Gambia">Gambia</option>
                                        <option value="Georgia">Georgia</option>
                                        <option value="Germany">Germany</option>
                                        <option value="Ghana">Ghana</option>
                                        <option value="Gibraltar">Gibraltar</option>
                                        <option value="Greece">Greece</option>
                                        <option value="Greenland">Greenland</option>
                                        <option value="Grenada">Grenada</option>
                                        <option value="Guadeloupe">Guadeloupe</option>
                                        <option value="Guam">Guam</option>
                                        <option value="Guatemala">Guatemala</option>
                                        <option value="Guernsey">Guernsey</option>
                                        <option value="Guinea">Guinea</option>
                                        <option value="Guinea-bissau">Guinea-bissau</option>
                                        <option value="Guyana">Guyana</option>
                                        <option value="Haiti">Haiti</option>
                                        <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                                        <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                        <option value="Honduras">Honduras</option>
                                        <option value="Hong Kong">Hong Kong</option>
                                        <option value="Hungary">Hungary</option>
                                        <option value="Iceland">Iceland</option>
                                        <option value="India">India</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                        <option value="Iraq">Iraq</option>
                                        <option value="Ireland">Ireland</option>
                                        <option value="Isle of Man">Isle of Man</option>
                                        <option value="Israel">Israel</option>
                                        <option value="Italy">Italy</option>
                                        <option value="Jamaica">Jamaica</option>
                                        <option value="Japan">Japan</option>
                                        <option value="Jersey">Jersey</option>
                                        <option value="Jordan">Jordan</option>
                                        <option value="Kazakhstan">Kazakhstan</option>
                                        <option value="Kenya">Kenya</option>
                                        <option value="Kiribati">Kiribati</option>
                                        <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                        <option value="Korea, Republic of">Korea, Republic of</option>
                                        <option value="Kuwait">Kuwait</option>
                                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                                        <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                        <option value="Latvia">Latvia</option>
                                        <option value="Lebanon">Lebanon</option>
                                        <option value="Lesotho">Lesotho</option>
                                        <option value="Liberia">Liberia</option>
                                        <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                        <option value="Liechtenstein">Liechtenstein</option>
                                        <option value="Lithuania">Lithuania</option>
                                        <option value="Luxembourg">Luxembourg</option>
                                        <option value="Macao">Macao</option>
                                        <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                                        <option value="Madagascar">Madagascar</option>
                                        <option value="Malawi">Malawi</option>
                                        <option value="Malaysia">Malaysia</option>
                                        <option value="Maldives">Maldives</option>
                                        <option value="Mali">Mali</option>
                                        <option value="Malta">Malta</option>
                                        <option value="Marshall Islands">Marshall Islands</option>
                                        <option value="Martinique">Martinique</option>
                                        <option value="Mauritania">Mauritania</option>
                                        <option value="Mauritius">Mauritius</option>
                                        <option value="Mayotte">Mayotte</option>
                                        <option value="Mexico">Mexico</option>
                                        <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                        <option value="Moldova, Republic of">Moldova, Republic of</option>
                                        <option value="Monaco">Monaco</option>
                                        <option value="Mongolia">Mongolia</option>
                                        <option value="Montenegro">Montenegro</option>
                                        <option value="Montserrat">Montserrat</option>
                                        <option value="Morocco">Morocco</option>
                                        <option value="Mozambique">Mozambique</option>
                                        <option value="Myanmar">Myanmar</option>
                                        <option value="Namibia">Namibia</option>
                                        <option value="Nauru">Nauru</option>
                                        <option value="Nepal">Nepal</option>
                                        <option value="Netherlands">Netherlands</option>
                                        <option value="Netherlands Antilles">Netherlands Antilles</option>
                                        <option value="New Caledonia">New Caledonia</option>
                                        <option value="New Zealand">New Zealand</option>
                                        <option value="Nicaragua">Nicaragua</option>
                                        <option value="Niger">Niger</option>
                                        <option value="Nigeria">Nigeria</option>
                                        <option value="Niue">Niue</option>
                                        <option value="Norfolk Island">Norfolk Island</option>
                                        <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                        <option value="Norway">Norway</option>
                                        <option value="Oman">Oman</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="Palau">Palau</option>
                                        <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                        <option value="Panama">Panama</option>
                                        <option value="Papua New Guinea">Papua New Guinea</option>
                                        <option value="Paraguay">Paraguay</option>
                                        <option value="Peru">Peru</option>
                                        <option value="Philippines">Philippines</option>
                                        <option value="Pitcairn">Pitcairn</option>
                                        <option value="Poland">Poland</option>
                                        <option value="Portugal">Portugal</option>
                                        <option value="Puerto Rico">Puerto Rico</option>
                                        <option value="Qatar">Qatar</option>
                                        <option value="Reunion">Reunion</option>
                                        <option value="Romania">Romania</option>
                                        <option value="Russian Federation">Russian Federation</option>
                                        <option value="Rwanda">Rwanda</option>
                                        <option value="Saint Helena">Saint Helena</option>
                                        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                        <option value="Saint Lucia">Saint Lucia</option>
                                        <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                        <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                                        <option value="Samoa">Samoa</option>
                                        <option value="San Marino">San Marino</option>
                                        <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                        <option value="Saudi Arabia">Saudi Arabia</option>
                                        <option value="Senegal">Senegal</option>
                                        <option value="Serbia">Serbia</option>
                                        <option value="Seychelles">Seychelles</option>
                                        <option value="Sierra Leone">Sierra Leone</option>
                                        <option value="Singapore">Singapore</option>
                                        <option value="Slovakia">Slovakia</option>
                                        <option value="Slovenia">Slovenia</option>
                                        <option value="Solomon Islands">Solomon Islands</option>
                                        <option value="Somalia">Somalia</option>
                                        <option value="South Africa">South Africa</option>
                                        <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                                        <option value="Spain">Spain</option>
                                        <option value="Sri Lanka">Sri Lanka</option>
                                        <option value="Sudan">Sudan</option>
                                        <option value="Suriname">Suriname</option>
                                        <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                        <option value="Swaziland">Swaziland</option>
                                        <option value="Sweden">Sweden</option>
                                        <option value="Switzerland">Switzerland</option>
                                        <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                        <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                                        <option value="Tajikistan">Tajikistan</option>
                                        <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                        <option value="Thailand">Thailand</option>
                                        <option value="Timor-leste">Timor-leste</option>
                                        <option value="Togo">Togo</option>
                                        <option value="Tokelau">Tokelau</option>
                                        <option value="Tonga">Tonga</option>
                                        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                        <option value="Tunisia">Tunisia</option>
                                        <option value="Turkey">Turkey</option>
                                        <option value="Turkmenistan">Turkmenistan</option>
                                        <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                        <option value="Tuvalu">Tuvalu</option>
                                        <option value="Uganda">Uganda</option>
                                        <option value="Ukraine">Ukraine</option>
                                        <option value="United Arab Emirates">United Arab Emirates</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="United States">United States</option>
                                        <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                        <option value="Uruguay">Uruguay</option>
                                        <option value="Uzbekistan">Uzbekistan</option>
                                        <option value="Vanuatu">Vanuatu</option>
                                        <option value="Venezuela">Venezuela</option>
                                        <option value="Viet Nam">Viet Nam</option>
                                        <option value="Virgin Islands, British">Virgin Islands, British</option>
                                        <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                        <option value="Wallis and Futuna">Wallis and Futuna</option>
                                        <option value="Western Sahara">Western Sahara</option>
                                        <option value="Yemen">Yemen</option>
                                        <option value="Zambia">Zambia</option>
                                        <option value="Zimbabwe">Zimbabwe</option>
                                    </select>
                  </div>
                  
                  
                   <div class="form-group">
                      <label><strong>Address</strong></label>
                      <input type="address" class="form-control" name="address" placeholder="Address" required>
                  </div>
                  
                    @php
                     $random = rand(1000000000000,9999999999999);
                  @endphp
                  
                   <div class="form-group">
                      <label><strong>Amount</strong></label>
                      <input type="number" class="form-control" name="tAmt" min="20" placeholder="Amount should not be less than 20" required>
                  </div>
                <div class="alert alert-danger">
  <strong>Amout</strong> and Retype Amount should be equal otherwise it goes to fail response...
</div>
             <div class="form-group">
                      <label><strong>ReType Amount</strong></label>
    <input  name="amt" type="number" class="form-control" min="20" placeholder="Amount should not be les than 20" required>
                  </div>
                  
    
    <input value="0" name="txAmt" type="hidden">
    <input value="0" name="psc" type="hidden">
    <input value="0" name="pdc" type="hidden">
    <input value="EPAYTEST" name="scd" type="hidden">
    <input value="{{ $random }}" name="pid" type="hidden">
    
    
    <input value="{{ url('/esewa-verify')}}" type="hidden" name="su">
    <input value="{{ url('/') }}" type="hidden" name="fu">
              
              <input type="submit" class="as_link" value="Pay Now">    
              </form>
              
       
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
  
    <!-- Modal -->
  <div class="modal fade" id="paypal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Payment For PayPal</h4>
          <hr>
        </div>
        <div class="modal-body">
        
           
                 <form method="GET" action="{{ url('/direct-paypal') }}">
                  @csrf
                  <div class="form-group">
                      <label><strong>Name</strong></label>
                      <input type="text" class="form-control" name="name" placeholder="Name" required>
                  </div>
                  
                    <div class="form-group">
                      <label><strong>Email</strong></label>
                      <input type="email" class="form-control" name="email" placeholder="Email" required>
                  </div>
                  
                   <div class="form-group">
                      <label><strong>Number</strong></label>
                      <input type="number" class="form-control" min="0" name="number" placeholder="number" required>
                  </div>
                  
                    <div class="form-group">
                      <label><strong>Country</strong></label>
                   
                                    <select id="country" name="country" class="form-control">
                                        <option value="Afghanistan">Afghanistan</option>
                                        <option value="Åland Islands">Åland Islands</option>
                                        <option value="Albania">Albania</option>
                                        <option value="Algeria">Algeria</option>
                                        <option value="American Samoa">American Samoa</option>
                                        <option value="Andorra">Andorra</option>
                                        <option value="Angola">Angola</option>
                                        <option value="Anguilla">Anguilla</option>
                                        <option value="Antarctica">Antarctica</option>
                                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                        <option value="Argentina">Argentina</option>
                                        <option value="Armenia">Armenia</option>
                                        <option value="Aruba">Aruba</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Austria">Austria</option>
                                        <option value="Azerbaijan">Azerbaijan</option>
                                        <option value="Bahamas">Bahamas</option>
                                        <option value="Bahrain">Bahrain</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Barbados">Barbados</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Belgium">Belgium</option>
                                        <option value="Belize">Belize</option>
                                        <option value="Benin">Benin</option>
                                        <option value="Bermuda">Bermuda</option>
                                        <option value="Bhutan">Bhutan</option>
                                        <option value="Bolivia">Bolivia</option>
                                        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                        <option value="Botswana">Botswana</option>
                                        <option value="Bouvet Island">Bouvet Island</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                        <option value="Brunei Darussalam">Brunei Darussalam</option>
                                        <option value="Bulgaria">Bulgaria</option>
                                        <option value="Burkina Faso">Burkina Faso</option>
                                        <option value="Burundi">Burundi</option>
                                        <option value="Cambodia">Cambodia</option>
                                        <option value="Cameroon">Cameroon</option>
                                        <option value="Canada">Canada</option>
                                        <option value="Cape Verde">Cape Verde</option>
                                        <option value="Cayman Islands">Cayman Islands</option>
                                        <option value="Central African Republic">Central African Republic</option>
                                        <option value="Chad">Chad</option>
                                        <option value="Chile">Chile</option>
                                        <option value="China">China</option>
                                        <option value="Christmas Island">Christmas Island</option>
                                        <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                        <option value="Colombia">Colombia</option>
                                        <option value="Comoros">Comoros</option>
                                        <option value="Congo">Congo</option>
                                        <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                                        <option value="Cook Islands">Cook Islands</option>
                                        <option value="Costa Rica">Costa Rica</option>
                                        <option value="Cote D'ivoire">Cote D'ivoire</option>
                                        <option value="Croatia">Croatia</option>
                                        <option value="Cuba">Cuba</option>
                                        <option value="Cyprus">Cyprus</option>
                                        <option value="Czech Republic">Czech Republic</option>
                                        <option value="Denmark">Denmark</option>
                                        <option value="Djibouti">Djibouti</option>
                                        <option value="Dominica">Dominica</option>
                                        <option value="Dominican Republic">Dominican Republic</option>
                                        <option value="Ecuador">Ecuador</option>
                                        <option value="Egypt">Egypt</option>
                                        <option value="El Salvador">El Salvador</option>
                                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                                        <option value="Eritrea">Eritrea</option>
                                        <option value="Estonia">Estonia</option>
                                        <option value="Ethiopia">Ethiopia</option>
                                        <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                        <option value="Faroe Islands">Faroe Islands</option>
                                        <option value="Fiji">Fiji</option>
                                        <option value="Finland">Finland</option>
                                        <option value="France">France</option>
                                        <option value="French Guiana">French Guiana</option>
                                        <option value="French Polynesia">French Polynesia</option>
                                        <option value="French Southern Territories">French Southern Territories</option>
                                        <option value="Gabon">Gabon</option>
                                        <option value="Gambia">Gambia</option>
                                        <option value="Georgia">Georgia</option>
                                        <option value="Germany">Germany</option>
                                        <option value="Ghana">Ghana</option>
                                        <option value="Gibraltar">Gibraltar</option>
                                        <option value="Greece">Greece</option>
                                        <option value="Greenland">Greenland</option>
                                        <option value="Grenada">Grenada</option>
                                        <option value="Guadeloupe">Guadeloupe</option>
                                        <option value="Guam">Guam</option>
                                        <option value="Guatemala">Guatemala</option>
                                        <option value="Guernsey">Guernsey</option>
                                        <option value="Guinea">Guinea</option>
                                        <option value="Guinea-bissau">Guinea-bissau</option>
                                        <option value="Guyana">Guyana</option>
                                        <option value="Haiti">Haiti</option>
                                        <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                                        <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                        <option value="Honduras">Honduras</option>
                                        <option value="Hong Kong">Hong Kong</option>
                                        <option value="Hungary">Hungary</option>
                                        <option value="Iceland">Iceland</option>
                                        <option value="India">India</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                        <option value="Iraq">Iraq</option>
                                        <option value="Ireland">Ireland</option>
                                        <option value="Isle of Man">Isle of Man</option>
                                        <option value="Israel">Israel</option>
                                        <option value="Italy">Italy</option>
                                        <option value="Jamaica">Jamaica</option>
                                        <option value="Japan">Japan</option>
                                        <option value="Jersey">Jersey</option>
                                        <option value="Jordan">Jordan</option>
                                        <option value="Kazakhstan">Kazakhstan</option>
                                        <option value="Kenya">Kenya</option>
                                        <option value="Kiribati">Kiribati</option>
                                        <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                        <option value="Korea, Republic of">Korea, Republic of</option>
                                        <option value="Kuwait">Kuwait</option>
                                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                                        <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                        <option value="Latvia">Latvia</option>
                                        <option value="Lebanon">Lebanon</option>
                                        <option value="Lesotho">Lesotho</option>
                                        <option value="Liberia">Liberia</option>
                                        <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                        <option value="Liechtenstein">Liechtenstein</option>
                                        <option value="Lithuania">Lithuania</option>
                                        <option value="Luxembourg">Luxembourg</option>
                                        <option value="Macao">Macao</option>
                                        <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                                        <option value="Madagascar">Madagascar</option>
                                        <option value="Malawi">Malawi</option>
                                        <option value="Malaysia">Malaysia</option>
                                        <option value="Maldives">Maldives</option>
                                        <option value="Mali">Mali</option>
                                        <option value="Malta">Malta</option>
                                        <option value="Marshall Islands">Marshall Islands</option>
                                        <option value="Martinique">Martinique</option>
                                        <option value="Mauritania">Mauritania</option>
                                        <option value="Mauritius">Mauritius</option>
                                        <option value="Mayotte">Mayotte</option>
                                        <option value="Mexico">Mexico</option>
                                        <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                        <option value="Moldova, Republic of">Moldova, Republic of</option>
                                        <option value="Monaco">Monaco</option>
                                        <option value="Mongolia">Mongolia</option>
                                        <option value="Montenegro">Montenegro</option>
                                        <option value="Montserrat">Montserrat</option>
                                        <option value="Morocco">Morocco</option>
                                        <option value="Mozambique">Mozambique</option>
                                        <option value="Myanmar">Myanmar</option>
                                        <option value="Namibia">Namibia</option>
                                        <option value="Nauru">Nauru</option>
                                        <option value="Nepal">Nepal</option>
                                        <option value="Netherlands">Netherlands</option>
                                        <option value="Netherlands Antilles">Netherlands Antilles</option>
                                        <option value="New Caledonia">New Caledonia</option>
                                        <option value="New Zealand">New Zealand</option>
                                        <option value="Nicaragua">Nicaragua</option>
                                        <option value="Niger">Niger</option>
                                        <option value="Nigeria">Nigeria</option>
                                        <option value="Niue">Niue</option>
                                        <option value="Norfolk Island">Norfolk Island</option>
                                        <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                        <option value="Norway">Norway</option>
                                        <option value="Oman">Oman</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="Palau">Palau</option>
                                        <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                        <option value="Panama">Panama</option>
                                        <option value="Papua New Guinea">Papua New Guinea</option>
                                        <option value="Paraguay">Paraguay</option>
                                        <option value="Peru">Peru</option>
                                        <option value="Philippines">Philippines</option>
                                        <option value="Pitcairn">Pitcairn</option>
                                        <option value="Poland">Poland</option>
                                        <option value="Portugal">Portugal</option>
                                        <option value="Puerto Rico">Puerto Rico</option>
                                        <option value="Qatar">Qatar</option>
                                        <option value="Reunion">Reunion</option>
                                        <option value="Romania">Romania</option>
                                        <option value="Russian Federation">Russian Federation</option>
                                        <option value="Rwanda">Rwanda</option>
                                        <option value="Saint Helena">Saint Helena</option>
                                        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                        <option value="Saint Lucia">Saint Lucia</option>
                                        <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                        <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                                        <option value="Samoa">Samoa</option>
                                        <option value="San Marino">San Marino</option>
                                        <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                        <option value="Saudi Arabia">Saudi Arabia</option>
                                        <option value="Senegal">Senegal</option>
                                        <option value="Serbia">Serbia</option>
                                        <option value="Seychelles">Seychelles</option>
                                        <option value="Sierra Leone">Sierra Leone</option>
                                        <option value="Singapore">Singapore</option>
                                        <option value="Slovakia">Slovakia</option>
                                        <option value="Slovenia">Slovenia</option>
                                        <option value="Solomon Islands">Solomon Islands</option>
                                        <option value="Somalia">Somalia</option>
                                        <option value="South Africa">South Africa</option>
                                        <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                                        <option value="Spain">Spain</option>
                                        <option value="Sri Lanka">Sri Lanka</option>
                                        <option value="Sudan">Sudan</option>
                                        <option value="Suriname">Suriname</option>
                                        <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                        <option value="Swaziland">Swaziland</option>
                                        <option value="Sweden">Sweden</option>
                                        <option value="Switzerland">Switzerland</option>
                                        <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                        <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                                        <option value="Tajikistan">Tajikistan</option>
                                        <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                        <option value="Thailand">Thailand</option>
                                        <option value="Timor-leste">Timor-leste</option>
                                        <option value="Togo">Togo</option>
                                        <option value="Tokelau">Tokelau</option>
                                        <option value="Tonga">Tonga</option>
                                        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                        <option value="Tunisia">Tunisia</option>
                                        <option value="Turkey">Turkey</option>
                                        <option value="Turkmenistan">Turkmenistan</option>
                                        <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                        <option value="Tuvalu">Tuvalu</option>
                                        <option value="Uganda">Uganda</option>
                                        <option value="Ukraine">Ukraine</option>
                                        <option value="United Arab Emirates">United Arab Emirates</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="United States">United States</option>
                                        <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                        <option value="Uruguay">Uruguay</option>
                                        <option value="Uzbekistan">Uzbekistan</option>
                                        <option value="Vanuatu">Vanuatu</option>
                                        <option value="Venezuela">Venezuela</option>
                                        <option value="Viet Nam">Viet Nam</option>
                                        <option value="Virgin Islands, British">Virgin Islands, British</option>
                                        <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                        <option value="Wallis and Futuna">Wallis and Futuna</option>
                                        <option value="Western Sahara">Western Sahara</option>
                                        <option value="Yemen">Yemen</option>
                                        <option value="Zambia">Zambia</option>
                                        <option value="Zimbabwe">Zimbabwe</option>
                                    </select>
                  </div>
                  
                  
                   <div class="form-group">
                      <label><strong>Address</strong></label>
                      <input type="address" class="form-control" name="address" placeholder="Address" required>
                  </div>
                  
                   <div class="form-group">
                      <label><strong>Amount</strong></label>
                      <input type="number" class="form-control" name="grand_total" min="20" placeholder="Amount should not be less than 20" required>
                  </div>
              
              <input type="submit" class="as_link" value="Pay Now">    
              </form>
              
           
 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
  


<!-- Pixel Code for https://www.widgetsquad.com/ -->
<script async src="https://www.widgetsquad.com/pixel/7xoeryc3yr9nvho42jmj5kekynjm0t5b" ></script>
<style>

    .altumcode-all-in-one-chat-position-bottom_right .altumcode-all-in-one-chat-bubble-icon-holder{
        
    bottom:20px!important;
    }
    
    
</style>
<!-- END Pixel Code -->


    <!-- Messenger Chat plugin Code -->
    <div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            xfbml            : true,
            version          : 'v10.0'
          });
        };

        (function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
      </script>


<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v11.0" nonce="kTzHTfcX"></script>



      <!-- Your Chat plugin code -->
      <div class="fb-customerchat"
        attribution="biz_inbox"
        page_id="106209101657299">
      </div>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@php

$seo_footer=App\Models\Seo::first();

@endphp



<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "Organization",
  "name": "Namaste Cargo Nepal",
  "url": "{{ url('/') }}",
  "logo": "{{ url('/') }}/files/pics/logo.png",
  "sameAs": [
    "https://www.facebook.com/gurukailash/",
    "https://www.instagram.com/gurukaialsh/"
    ],
  "contactPoint":{
        "@type":"ContactPoint",
        "contactType": "customer service",
        "telephone":"+9779851006432",
        "email":"mailto:info@namastecargonepal.com"
     }
}
</script>

<!-- Global site tag (gtag.js) - Google Analytics -->

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-121044113-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());
    gtag('config', '');
</script>


<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5N7DQH2');</script>
<!-- End Google Tag Manager -->





    <!-- javascript -->
    <script src="{{ asset('front_assets/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('front_assets/assets/js/bootstrap.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('front_assets/assets/js/slick.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front_assets/assets/js/jquery.countTo.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front_assets/assets/js/datepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front_assets/assets/js/datepicker.en.js') }}"></script>
    <script src="{{ asset('front_assets/assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('front_assets/assets/js/image-zoom.min.js') }}"></script>
    <script src="{{ asset('front_assets/assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('front_assets/assets/fancybox/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('front_assets/assets/js/custom.js') }}"></script>  

<link rel="stylesheet" type="text/css" 
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
      <script>
 @if(Session::has('success'))
  toastr.options =
  {
    "closeButton" : true,
    "progressBar" : true
  }
        toastr.warning("{{ session('success') }}");
  @endif
</script>


<script>
$(document).ready(function(){ 
    
    
    
$("#search_appointment").click(function(){
    $start_date=$("#start_date").val();
     $end_date=$("#end_date").val();
   
 
     
    if($("#start_date").val() !="" && $("#end_date").val() !=""){
     $.ajax({ 
 method:'GET',
 url:'{{ url("/search_appointment") }}'+"/"+$start_date+"/"+$end_date,
 success: function(data){
     console.log(data);
    $("#search_appo").html(data);
 }
});
   }else if($("#start_date").val() ==="" && $("#end_date").val() !=""){
         toastr.warning("start date is missing");
   }else if($("#start_date").val() !="" && $("#end_date").val() ===""){
      toastr.warning("end date is missing");
   }else{
         toastr.warning("start date and end date is missing");
   }
     
     
           

        
});

$("#search_app").click(function(){
    $single_date=$("#single_date").val();
     
      if($("#single_date").val() !=""){
             $.ajax({ 
 method:'GET',
 url:'{{ url("/single_appointment") }}'+"/"+$single_date,
 success: function(data){
     console.log(data);
     
        
    $("#search_appo").html(data);
 }
});

          
      }else{
         toastr.warning("search date is missing"); 
          
      }
 
});



});
</script>

<script>
    $(document).ready(function(){ 

    $("#search_order").click(function(){
    $start_orderdate=$("#start_orderdate").val();
     $end_orderdate=$("#end_orderdate").val();
     
     
        if($("#start_orderdate").val() !="" && $("#end_orderdate").val() !=""){
    $.ajax({ 
    method:'GET',
    url:'{{ url("/search_order") }}'+"/"+$start_orderdate+"/"+$end_orderdate,
    success: function(data){
    $("#search_ord").html(data);
    }
    });
        }else if($("#start_orderdate").val() ==="" && $("#end_orderdate").val() !=""){
         toastr.warning("start date is missing");
   }else if($("#start_orderdate").val() !="" && $("#end_orderdate").val() ===""){
      toastr.warning("end  date is missing");
   }else{
         toastr.warning("start  date and end  date is missing");
   }
     
    });

 $("#search_singleorder").click(function(){
    $search_date=$("#search_date").val();
   if($("#search_date").val() !=""){
      $.ajax({ 
    method:'GET',
    url:'{{ url("/search_singleorder") }}'+"/"+$search_date,
    success: function(data){
    console.log(data);
    $("#search_ord").html(data);
    }
    });
     
       
   }else{
    toastr.warning("search  date  is missing");
   }
    
    });
    });
</script>

 <script>
//     $(document).ready(function(){
//      $(".he").click(function(){
//          $id=$(this).val();
//      $quantity=1;
      
//          $.ajax({ 
//     method:'GET',
//     url:'{{ url("/cartt") }}'+"/"+$id+"/"+$quantity,
//     success: function(data){
//         alert('product added to cart');
//       $("#cart_ajax").html(data);
//     }
//   });
//   });
    
//     });
 </script>
   
 

</body>


</html>
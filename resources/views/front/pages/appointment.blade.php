 @extends('front.layouts.master')
@section('content')

  

    <section class="as_breadcrum_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>Appointment</h1>

                    <ul class="breadcrumb">
                        <li><a href="{{url('/') }}">Home</a></li>
                        <li>Appointment</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>


    <section class="as_appointment_wrapper as_padderTop80 as_padderBottom80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">


                    <div class="as_journal_box_wrapper" style="border: solid 1px #cccccc">
                        <form method="post" action="{{ route('appointment') }}">
                            @csrf
                            <h2 style="font-weight: 600" class="text-center as_subheading">Appointment Form</h2>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>name</label>
                                <div class="form-group">
                                @auth
                                <input class="form-control" type="text" placeholder="*Name" name="name" value="{{ Auth()->user()->name }}">
                                @else
                                <input class="form-control" type="text" placeholder="*Name" name="name" required>
                                @endauth
                               
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>email</label>
                                <div class="form-group">
                                @auth
                                
                                <input class="form-control" type="text" placeholder="*Email"  name="email" value="{{ Auth()->user()->email }}">
                                @else
                                
                                <input class="form-control" type="text" placeholder="*Email"  name="email" required>
                                @endauth
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>mobile number</label>

                                <div class="form-group">
                                      
                                      @auth
                                      <input class="form-control" type="number" placeholder="*Mobile Number" min="1"  name="phone" value="{{ Auth()->user()->number }}">
                                      @else
                                      <input class="form-control" type="number" placeholder="*Mobile Number" name="phone" required>
                                      @endauth
                                   
                                </div>
                            </div>


                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>gender</label>
                                <div class="form-group as_select_box">
                                    <select class="form-control" data-placeholder="*Gender" name="gender">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>

                          <div id="">

                             @php
       $service=App\Models\Category::where('name','Services')->where('status',1)->first();
       @endphp

@php
              $subservices=App\Models\SubCategory::where('category_id',$service->id)->where('status',1)->limit(5)->get();
             
                  @endphp
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Service</label>
                                <div class="form-group as_select_box">
      <select class="form-control" data-placeholder="*Service" name="service" id="service">
        <option value="0">Select Service</option>
       @foreach($subservices as $subservice)
                                        <option value="{{ $subservice->id }}">{{ $subservice->name }}</option>

                                        @endforeach
                                       
                                    </select>
                                </div>
                            </div>

                            
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Sub Service</label>
                                <div class="form-group as_select_box">
                                    <select class="form-control" data-placeholder="*Sub Service" name="sub_service" id="subct">
                                        

                                    </select>
                                </div>
                            </div>

                            </div>
                       

                      


                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label> Date of Birth</label>

                                <div class="form-group">
                                    <input class="form-control" type="date" placeholder="*Mobile Number"  name="dob" required>
                                </div>
                            </div>


                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Time of Birth</label>

                                <div class="form-group">
                                    <input class="form-control" type="time" placeholder="*Mobile Number"  name="tob">
                                </div>
                            </div>
                         
                     


                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Place of Birth</label>
                                <div class="form-group as_select_box">
                                    
                                    <input type="text" class="form-control" name="birth_place" placeholder="Place of Birth">
                           
                                      
                                 
                                </div>
                            </div>

                           
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Country of Birth</label>
                                <div class="form-group as_select_box">
                                    <select id="country" name="country_birth" class="form-control">
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
                            </div>


                          
                        


@auth

<input type="hidden" value="{{ Auth()->user()->id }}" name="auth_id">

@else

<input type="hidden" value="0" name="auth_id">

@endauth


<input type="hidden" value="UnReply" name="status">
 

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>Reason for appointment</label>
                                <div class="form-group">
                                    <textarea placeholder="Message" class="form-control" name="remarks"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center as_padderTop20">
                                <button type="submit" class="as_btn">make an appointment</button>
                            </div>
                        </form>
                    </div>
                </div>
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

         

                        <h1 class="as_heading as_heading_center">{{ $customer->name }}</h1>
                        <p class="as_font14 as_margin0 as_padderBottom50">
                        {{ $customer->short_description }}
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
                                                <p>{{ Str::limit($text->description,294, '...') }} </p>
                                            </div>

                                            <div style="display: flex;justify-content: space-between; align-items: center">
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


 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
$(document).ready(function(){ 
$("#service").change(function(){
    $service=$(this).val();
 

    $.ajax({ 
 method:'GET',
 url:'{{ url("/sub_service") }}'+"/"+$service,
 success: function(data){
     console.log(data);
 
    $("#subct").html(data);
 }
});

});
});
</script>





@endsection
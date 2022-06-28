@extends('front.layouts.master')
@section('content')

  

    <section class="as_breadcrum_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>Ask Question</h1>

                    <ul class="breadcrumb">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li>Ask Question</li>
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
                    <form method="post" action="{{ route('ask.question') }}">
                           @csrf
                         
                            <h2 style="font-weight: 600" class="text-center as_subheading">Ask Question Form</h2>
                            
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>name</label>
                                <div class="form-group">
                                @auth
                                <input class="form-control" type="text" placeholder="*Name" name="name" value="{{ Auth()->user()->name }}">
                                @else
                                <input class="form-control"  type="text" placeholder="*Name" name="name" required>
                                @endauth
                                   
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>email</label>
                                <div class="form-group">
                                @auth
                                <input class="form-control" type="text" placeholder="*Email" name="email" value="{{ Auth()->user()->email }}" >
                                @else
                                <input class="form-control" type="email" placeholder="*Email" name="email" required>
                                @endauth
                               
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>mobile number</label>

                                <div class="form-group">
                                @auth
                                
                                <input class="form-control" type="text" placeholder="*Mobile Number" name="number" value="{{ Auth()->user()->number }}">
                                @else
                                
                                <input class="form-control" type="text" placeholder="*Mobile Number" name="number" required>
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
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Occupation</label>
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Occupation" name="occupation">
                                </div>
                            </div>


                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Category question</label>
                                <div class="form-group as_select_box">
                                    <select class="form-control" data-placeholder="Gender" id="category_id" name="category_id">
                                    @php
            $categories=App\Models\Category::where('position','question')->get();
             @endphp
             <option value="0">Select Category </option>   
             @foreach($categories as $category)
         
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach   
                    <option value="0">Other </option>     
                                    </select>
                                </div>
                            </div>
                           
                           <div class="hello" id="subct">    


                           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
        <label style="color:red">Price Can Included Through Contact Number Means Negotation</label>

      </div>
</div>

                           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="form-group">
                <label>Question</label>
 <textarea  name="question[]"   rows="5" style="width:100%" required="required" multiple></textarea>
                </div>
    </div>

 
<input type="hidden" value="0" name="price">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <label>Total Price</label>
    <div class="form-group">
        <input class="form-control" readonly="readonly" name="total" type="number" placeholder="price" value="0">
    </div>
</div>
                          
                            </div>
                           
                         

                         
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center as_padderTop20">
                           <button type="submit" class="as_btn">Pay Now</button> 
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
                           <span><img src=" {{ url('/') }}/storage/posts/{{  $text->image  }}" alt=""></span>
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
$("#category_id").change(function(){
    $catgeory_id=$(this).val();
    
    $.ajax({ 
 method:'GET',
 url:'{{ url("/askquestion") }}'+"/"+$catgeory_id,
 success: function(data){
 
 
    $("#subct").html(data);
 }
});
});
});
</script>


@endsection
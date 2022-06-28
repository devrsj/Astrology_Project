@extends('front.layouts.master')
@section('content')

  

    <section class="as_breadcrum_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>Ask Question Pay Now</h1>

                    <ul class="breadcrumb">
                        <li><a href="{{ url('/') }}">Home</a></li>
                         <li>Ask Question</li>
                        <li>Pay Now</li>
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
                
                        
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                            <h2>Select Payment method</h2>
                            <hr>
                            <div class="form-group">
    <label class="radio-inline">
    <a href="{{ route('cash') }}" class="btn btn-success">Pay through cash</a>
    </label>
  </div>



  <div class="payment-option">
          <div class="form-group">
       <p><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#e-sewa">Esewa</button></p>
      <p><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#paypal">Pay pal</button></p>
      </div>
      </div>
 
 
    
    
    
    
   <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" href="#collapse1">Other Payment Method</a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse">
          @php
          $pay=App\Models\Page::where('name','Pay Now')->first();
          @endphp
        <div class="panel-body">
            {!! $pay->description !!}
             </div>
        
      </div>
    </div>
  </div>
  
  
  
  
                    </div>
                </div>
            </div>
        </div>
    </section>



   
 @php
$customerr=App\Models\Page::where('name','What Our Customers Say')->where('status',1)->first();
    @endphp

       <section class="as_customer_wrapper as_padderBottom80 as_padderTop80">
            <div class="container">
                <div class="row">

                    <div class="col-lg-12 text-center">

         

                        <h1 class="as_heading as_heading_center">{{ $customerr->name }}</h1>
                        <p class="as_font14 as_margin0 as_padderBottom50">
                        {{ $customerr->short_description }}
                        </p>

                        <div class="row">
                                @php
                    $textss=App\Models\People::where('people_type','text')->where('status',1)->get();            
                                    @endphp
                            <div class="col-lg-6">
                                <div class="row as_customer_slider">
                                
                                   
                                   @foreach($textss as $textt)
                                    <div class="col-lg-6 col-md-6">
                                        <div class="as_customer_box ">

                                            <div class="as_margin0" style="display: flex">
                                                <p style="color: #e66712;font-size: 20px;margin-right: 5px;flex: 1"><i class="fas fa-quote-left"></i></p>
                                                <p>{{ $textt->description }} </p>
                                            </div>

                                            <div style="display: flex;justify-content: space-between; align-items: center">
                                                <div class="ast_whywe_info_box client" style="margin-top: 20px">
         <span><img src="{{ url('/') }}/storage/{{ $textt->image }}" alt=""></span>
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

                    $videoss=App\Models\People::where('people_type','video')->where('status',1)->get();

                                    
                                    @endphp
                            <div class="col-lg-6">
                                <div class="row as_customer_slider">
                                  
                                    @foreach($videoss as $videoo)
                                    <div class="col-lg-6 col-md-6">
                                        <div class="as_customer_box text-center">
                                            <iframe  width="100%" height="300" src="{{ $videoo->video_url }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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
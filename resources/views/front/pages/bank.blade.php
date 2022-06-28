@extends('front.layouts.master')
@section('content')

  

    <section class="as_breadcrum_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>Ask Question</h1>

                    <ul class="breadcrumb">
                        <li><a href="#">Home</a></li>
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
                
                        
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <form method="post" action="{{ route('cash.payment') }}">
                            @csrf
                  <input type="text" class="form-control" name="bank" value="Bank"> 
                           
              
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center as_padderTop20">
                            <button type="submit" class="as_btn">Pay Now</button> 
                            </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="as_customer_wrapper as_padderBottom80 as_padderTop80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="as_heading as_heading_center">What Our <span>Customers Say</span></h1>
                    <p class="as_font14 as_margin0 as_padderBottom50">Consectetur adipiscing elit, sed do eiusmod tempor incididuesdeentiut labore <br>etesde dolore magna aliquapspendisse and the gravida.</p>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row as_customer_slider">
                                <div class="col-lg-6 col-md-6">
                                    <div class="as_customer_box ">

                                        <div class="as_margin0" style="display: flex">
                                            <p style="color: #e66712;font-size: 20px;margin-right: 5px;flex: 1"><i class="fas fa-quote-left"></i></p>
                                            <p>Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravidaesdisus commodo viverra maecenas accumsan lacus vel facilisis.commodo viverra maecenas accumsan lacus vel facilisis. </p>
                                        </div>

                                        <div style="display: flex;justify-content: space-between; align-items: center">
                                            <div class="ast_whywe_info_box client" style="margin-top: 20px">
                                                <span><img src="{{ asset('front_assets/assets/images/customer1.jpg') }}" alt=""></span>
                                                <div class="ast_whywe_info_box_info" >
                                                    <b style="font-weight: 600">Full Name</b>
                                                    <b style="color: #4a4a4a; font-weight: 400">Doctor</b>
                                                </div>
                                            </div>
                                            <a  href="service_detail.html" class="as_link" tabindex="0">Read more</a>

                                        </div>


                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="as_customer_box ">

                                        <div class="as_margin0" style="display: flex">
                                            <p style="color: #e66712;font-size: 20px;margin-right: 5px;flex: 1"><i class="fas fa-quote-left"></i></p>
                                            <p>Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravidaesdisus commodo viverra maecenas accumsan lacus vel facilisis.commodo viverra maecenas accumsan lacus vel facilisis. </p>
                                        </div>

                                        <div style="display: flex;justify-content: space-between; align-items: center">
                                            <div class="ast_whywe_info_box client" style="margin-top: 20px">
                                                <span><img src="{{ asset('front_assets/assets/images/customer1.jpg') }}" alt=""></span>
                                                <div class="ast_whywe_info_box_info" >
                                                    <b style="font-weight: 600">Full Name</b>
                                                    <b style="color: #4a4a4a; font-weight: 400">Doctor</b>
                                                </div>
                                            </div>
                                            <a  href="service_detail.html" class="as_link" tabindex="0">Read more</a>

                                        </div>


                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="as_customer_box ">

                                        <div class="as_margin0" style="display: flex">
                                            <p style="color: #e66712;font-size: 20px;margin-right: 5px;flex: 1"><i class="fas fa-quote-left"></i></p>
                                            <p>Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravidaesdisus commodo viverra maecenas accumsan lacus vel facilisis.commodo viverra maecenas accumsan lacus vel facilisis. </p>
                                        </div>

                                        <div style="display: flex;justify-content: space-between; align-items: center">
                                            <div class="ast_whywe_info_box client" style="margin-top: 20px">
                                                <span><img src="{{ asset('front_assets/assets/images/customer1.jpg') }}" alt=""></span>
                                                <div class="ast_whywe_info_box_info" >
                                                    <b style="font-weight: 600">Full Name</b>
                                                    <b style="color: #4a4a4a; font-weight: 400">Doctor</b>
                                                </div>
                                            </div>
                                            <a  href="service_detail.html" class="as_link" tabindex="0">Read more</a>

                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row as_customer_slider">
                                <div class="col-lg-6 col-md-6">
                                    <div class="as_customer_box text-center">
                                        <iframe  width="100%" height="300" src="https://www.youtube.com/embed/8NhqRVcPbQE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="as_customer_box text-center">
                                        <iframe  width="100%" height="300" src="https://www.youtube.com/embed/8NhqRVcPbQE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="as_customer_box text-center">
                                        <iframe  width="100%" height="300" src="https://www.youtube.com/embed/8NhqRVcPbQE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </section>

@endsection
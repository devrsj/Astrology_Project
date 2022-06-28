
@extends('front.layouts.master')
@section('content')
 <section class="as_breadcrum_wrapper">
        <div class="ast_img_overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>Login</h1>

                    <ul class="breadcrumb">
                        <li><a href="{{ url('/') }}">Home</a></li>

                        <li>Login</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

<div class="row" style="margin-top:12px">
	<div class="col-sm-2">
</div>
<div class="col-sm-8">
	<h4 style="text-align:center">Login</h4>
  <div class="as_login_box active">

  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                        <form action="{{ route('login') }}" method="post">
                        @csrf
                            <div class="form-group">
                            <input type="text" name="email" placeholder="Enter email" class=" form-control" required>

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
                                    <a href="#">Forgot password ?</a>
                                </div>
                            </div>




                            <div class="text-center">
                                <button type="submit" class="as_btn">Login</button>
                            </div>

    
                 <a href="{{ route('login.google')  }}"> <button type="button" class="btn btn-default">Google</button></a>
                  <a href="{{ route('login.facebook') }}"><button type="button" class="btn btn-default">Facebook</button></a>
           
                            
                        </form>
                        <p class="text-center as_margin0 as_padderTop20">Create An Account ? <a href="javascript:;" class="as_orange as_signup">SignUp</a></p>
               

                    </div>
</div>
                </div>
@endsection
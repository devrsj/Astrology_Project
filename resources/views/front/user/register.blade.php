
@extends('front.layouts.master')
@section('content')
 <section class="as_breadcrum_wrapper">
        <div class="ast_img_overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>Register</h1>

                    <ul class="breadcrumb">
                        <li><a href="{{ url('/') }}">Home</a></li>

                        <li>Register</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

<div class="row" style="margin-top:12px">
	<div class="col-sm-2">
</div>
<div class="col-sm-8">

	<h4 style="text-align:center">Register</h4>
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
                        <p class="text-center as_margin0 as_padderTop20">Have An Account ? <a href="{{ route('user.login.form') }}" class="as_orange as_login">Login</a></p>
                    </div>
                    
                         <a href="{{ route('login.google')  }}"> <button type="button" class="btn btn-default">Google</button></a>
                  <a href="{{ route('login.facebook') }}"><button type="button" class="btn btn-default">Facebook</button></a>
           
                            
</div>
                </div>
@endsection
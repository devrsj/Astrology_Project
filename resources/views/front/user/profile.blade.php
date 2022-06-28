@extends('front.layouts.master')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 mx-auto p-4 m-2 shadow-lg">
            <h3 class="text-center text-info">View / Update Profile</h3>
            <hr>
            <form action="{{ route('user.profile.update') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col form-group">
                        <label for="name" class="font-weight-bold">Name: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}">
                        <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                    </div>
                    <div class="col form-group">
                        <label for="name"  class="font-weight-bold">Email: <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" disabled value="{{ auth()->user()->email }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col form-group">
                        <label for="name"  class="font-weight-bold">City/State: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="city" value="{{$address->city??null}}">
                        <span class="text-danger">@error('city'){{ $message }}@enderror</span>
                    </div>
                    <div class="col form-group">
                        <label for="name"  class="font-weight-bold">Country: <span class="text-danger">*</span></label>
                        <select name="country" id="userCountryList" class="form-control" >
                            <option value="">--Select Country --</option>
                            @foreach (countryInfoList() as $country)
                            <option @if(isset($address->country)&&$address->country==$country['name']) selected @endif  value="{{ $country['name'] }}">{{ $country['name'] }} </option>
                            @endforeach
                        </select>
                        <span class="text-danger">@error('country'){{ $message }}@enderror</span>
                    </div>
                    <div class="col form-group">
                        <label for="name"  class="font-weight-bold">Postal Code: <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="postal_code" value="{{$address->postal_code??null}}">
                        <span class="text-danger">@error('postal_code'){{ $message }}@enderror</span>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Save Profile</button>
                </div>
            </form>
        </div>

    </div>
    <div class="row">
        <div class="col-md-8 mx-auto p-4 m-2 shadow-lg">
            <h3 class="text-center text-info">Change password</h3>
            <hr>
            <form   method="post" action="{{ route('user.profile.changePassword') }}" enctype="multipart/form-data">
                @csrf
                  <div class="form-group">
                    <label for="current_password">Current Password:</label>
                    <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
                    <span class="text-danger">@error('current_password'){{ $message }}@enderror</span>

                </div>

                <div class="row">
                    <div class="col form-group">
                        <label for="email">New Password:</label>
                        <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
                        <span class="text-danger">@error('new_password'){{ $message }}@enderror</span>
                    </div>


                    <div class="col form-group">
                        <label for="name">New Confirm password:</label>
                        <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
                        <span class="text-danger">@error('new_confirm_password'){{ $message }}@enderror</span>
                      </div>
                   </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-success">Update Password</button>
                  </div>
              </form>
        </div>

    </div>
</div>

@endsection

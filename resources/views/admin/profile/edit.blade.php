@extends('admin.layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->

    <!-- Main content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">


        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">My Profile</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
       <form method="post" action="{{ url('admin/profile/update',$user->id) }}">

                @csrf
                @method('PUT')
                <div class="card-body">


                  <div class="form-group">
                    <label for=""> Name:</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter the name" value="{{ $user->name  }}">
                  </div>
                  <div class="form-group">
                    <label for="company_name"> Company Name:</label>
                    <input type="text" name="company_name" class="form-control" id="company_name" placeholder="Enter the company name" value="{{ $user->company_name  }}">
                  </div>
                  <div class="form-group">
                    <label for="phone"> Phone:</label>
                    <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter phone" value="{{ $user->number  }}">
                  </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" class="form-control" id="email"  value="{{ $user->email }}">
                </div>
                <div class="form-group">
                    <label for="city">City:</label>
                    <input type="text" name="city" class="form-control" id="city"  value="{{ $user->userAddress->city }}">
                </div> 
                <div class="form-group">
                    <label for="street">Street:</label>
                    <input type="text" name="street" class="form-control" id="street"  value="{{ $user->userAddress->street }}">
                </div>

                <div class="form-group">
                    <label for="country">Country:</label>
                    <input type="text" name="country" class="form-control" id="country"  value="{{ $user->userAddress->country }}">
                </div>
                <div class="form-group">
                    <label for="postal_code">Postal Code:</label>
                    <input type="text" name="postal_code" class="form-control" id="postal_code"  value="{{ $user->userAddress->postal_code }}">
                </div>


                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>

                </div>
                <!-- /.card-body -->

            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->

          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
    <!-- /.content -->



  @endsection

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

                <div class="card-body">





                  <div class="form-group">
                    <label for=""> Name:</label>
                    <input type="text"  class="form-control"  value="{{ $user->name  }}" disabled>
                  </div>
                    <div class="form-group">
                    <label for=""> Company Name:</label>
                    <input type="text"  class="form-control"  value="{{ $user->company_name  }}" disabled>
                  </div>
                  <div class="form-group">
                    <label for=""> Phone:</label>
                    <input type="text"  class="form-control"  value="{{ $user->phone  }}" disabled>
                  </div>

                <div class="form-group">
                    <label for="post">Email:</label>
                    <input type="text"  class="form-control" value="{{ $user->email }}" disabled>
                </div>
                <div class="form-group">
                    <label for="post">City:</label>
                    <input type="text"  class="form-control" value="{{ $user->userAddress->city??null }}" disabled>
                </div>

                <div class="form-group">
                    <label for="post">Country:</label>
                    <input type="text"  class="form-control" value="{{ $user->userAddress->country??null }}" disabled>
                </div>
                <div class="form-group">
                    <label for="post">Postal Code:</label>
                    <input type="text"  class="form-control" value="{{ $user->userAddress->postal_code??null }}" disabled>
                </div>

                <a href="{{ url('/admin') }}"><button type="button" class="btn btn-primary">Back</button></a>
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

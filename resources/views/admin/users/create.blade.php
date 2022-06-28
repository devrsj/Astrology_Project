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
                <h3 class="card-title">Create new users</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form   method="post" action="{{ route('users.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">


                  <div class="form-group">
                    <label for="name">Name:</label>
                  <input type="text" name="name" class="form-control" id="name" placeholder="Enter the role name" value="{{ old('name')}} "> 
                  </div>
                
                   <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" name="email" class="form-control" id="email" placeholder="Enter the email" value="{{ old('name') }}">
                  </div>
                
                  <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="text" name="password" class="form-control" id="password" placeholder="Enter the password" value="{{ old('email') }}">
                  </div>
                
                  <div class="form-group">
                    <label for="name">Confirm password:</label>
                    <input type="text" name="confirm-password" class="form-control" id="name" placeholder="Enter the role name" value="{{ old('confirm-password') }}">
                  </div>
                
               
                  <div class="form-group">
                  <label>Role:</label>
                  <div class="select2-purple">
                    <select class="select2" multiple="multiple" data-placeholder="Select a State" data-dropdown-css-class="select2-purple" name="roles[]" style="width: 100%;">
                      @foreach($roles as $role)
                      <option value="{{ $role->id }}">{{ $role->name }}</option>
                      @endforeach
                      
                    </select>
                  </div>
                </div>
               

                  
            
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
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
  
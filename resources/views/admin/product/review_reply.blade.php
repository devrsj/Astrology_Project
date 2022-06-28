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
                <h3 class="card-title">view reply of {{ $reply->name }}</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form  method="post" action="" enctype="multipart/form-data">
                @csrf
                @method('PUT')
               
                <div class="card-body">
                <div class="row">
                <div class="col-sm-12">
                    
                    
                      <div class="form-group">
                  <label>Name</label>
<input type="text" class="form-control" value="{{ $reply->name }}" disabled>
                </div>
                
                     
                      <div class="form-group">
                  <label>Product name</label>
<input type="text" class="form-control" value="{{ $reply->product }}" disabled>
                </div>
                   <div class="form-group">
                  <label>Email</label>
<input type="text" class="form-control" value="{{ $reply->email }}" disabled>
                </div>
                
                     
                   
                
                    
                    
                       <div class="form-group">
                  <label>Description</label>
 <textarea  name="description" value="" rows="10" style="width:100%" readonly="readonly"> {{ $reply->description }}</textarea>
                </div>
                
                
                </div>
                
                </div>             
</div>



<input type="hidden" value="Reply" name="status">

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
              <!--<a href="{{ url('/admin/product/review') }}"><button type="submit" class="btn btn-primary" style="width:100%">Back</button></a>-->
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
  
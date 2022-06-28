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
                <h3 class="card-title">Appointment By {{ $appointment->name }}</h3>
                   
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form  method="post" action="{{ route('appointments.update',$appointment->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
               
                <div class="card-body">


                <div class="row">

                <div class="col-sm-6">
                    
                      <div class="form-group">
                  <label>Reply Through</label>
                  <select class="form-control select2bs4" name="reply_type" style="width: 100%;" id="reply_type" onchange="window.location.href=this.value;">
                        <option value="">Gmail</option>
                     <option value="https://api.whatsapp.com/send?phone=+977{{ $appointment->phone }}"  target="_blank">Whatsapp</option>
                   <option value="viber://chat/?number=%2B977{{ $appointment->phone }}"  target="_blank">Viber</option>
                 <option value="skype:+977{{ $appointment->phone }}?chat"  target="_blank">Skype</option>
                     
                    </select>

                </div>
                    

                <div class="form-group">
                <label for="author">Preferred Time</label>
                <input type="date" class="form-control"  name="preferred_date" required>
                </div>
                
                <div class="form-group">
                <label for="aur">Preferred Time</label>
                <input type="time" class="form-control"  name="preferred_time" required>
                </div>
                
                
                
                
                <div class="form-group">
                    
                       <button type="submit" class="btn btn-primary" style="width:100%">Reply</button>
                </div>

                </div>
                </div>             
</div>


           <input type="hidden" value="Reply" name="status">

                </div>
                <!-- /.card-body -->
              
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

<script src="https://swc.cdn.skype.com/sdk/v1/sdk.min.js"></script>

  @endsection
  
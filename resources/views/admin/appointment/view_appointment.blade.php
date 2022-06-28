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
                <h3 class="card-title">View Appointment Details :</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                <div class="row">
                <div class="col-sm-3">
                <p>Name:</p>
                <p>Email:</p>
                <p>Number:</p>
                <p>Country:</p>
                <p>Birth Place:</p> 
                 <p>Date Of Birth:</p>
                <p>Time Of Birth:</p> 
             
                </div>

                <div class="col-sm-3">
                <p>{{ $appointment->name }}</p>
                <p>{{ $appointment->email }}</p>
                <p>{{ $appointment->phone }}</p>
                <p>{{ $appointment->country_birth }}</p>
                <p>{{ $appointment->birth_place }}</p>
                <p>{{ $appointment->dob }}</p>
                <p>{{ $appointment->tob }}</p>
             
             
                </div>

                <div class="col-sm-3">
                <p>Service:</p>
                <p>Sub services:</p>
                <p>Preferred Date</p>
                <p>Preferred Time</p>
                <p>Status:</p>
                <p>Gender:</p>
             
                </div>


@php

$service=App\Models\SubCategory::where('id',$appointment->service)->first();
$sub_service=App\Models\Product::where('id',$appointment->sub_service)->first();
@endphp
                <div class="col-sm-3">
               
                    @if($appointment->service==null) <p>null</p> @else <p>   {{ $service->name }}</p>   @endif 
                 
                 
                    @if($appointment->sub_service==null) <p>null</p> @else <p>   {{ $sub_service->name }}</p>   @endif 
                 
                 
           
                <p>{{ $appointment->preferred_date }}</p>
                <p>{{ $appointment->preferrred_time}}</p>
                <p>{{ $appointment->status }}</p>
                <p>{{ $appointment->gender }}</p>
                </div>      
                </div>
             <hr>

         

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
  
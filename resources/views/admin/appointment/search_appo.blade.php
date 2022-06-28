@extends('admin.layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
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
    <div class="col-sm-12">
    
              
   <form class="form-inline" method="GET" action="{{ url('/admin/appo') }}">
  
   
  <div class="form-group mx-sm-3 mb-2">
 <label for="" style="margin-right:9px">Start Date:  </label>
    <input type="date"  name="from" class="form-control" id="" placeholder="End Of Date" required>
  </div>
  
  
  <div class="form-group mx-sm-3 mb-2">
 <label for="" style="margin-right:9px">End Date:  </label>
    <input type="date"  name="to" class="form-control" id="" placeholder="End Of Date" required>
  </div>
  
     
     @if($search_status=="pending")
     <input type="hidden" value="pending" name="search_status"> 
     @endif
     
       @if($search_status=="reply")
     <input type="hidden" value="reply" name="search_status"> 
     @endif
  <button type="submit" class="btn btn-primary mb-2">Search</button>
</form>
         
                
    </div>
    
    
       <div class="col-sm-4">
                
<form class="form-inline" method="GET" action="{{ url('/admin/search_appo') }}">
 
  <div class="form-group mx-sm-3 mb-2">
  <label for="" style="margin-right:9px">Search Date:  </label>
    <input type="date"  name="search_date" class="form-control" value="{{ $search_date }}" id="" placeholder="End Of Date" required>
  </div>
   @if($search_status=="pending")
     <input type="hidden" value="pending" name="search_status"> 
     @endif
     
       @if($search_status=="reply")
     <input type="hidden" value="reply" name="search_status"> 
     @endif
         
   
  <button type="submit" class="btn btn-primary mb-2">Search</button>
</form>
         
                
    </div>
      </div>

        <div class="row">
          <div class="col-12">
              
                 
            <div class="card">
            
           
              <!-- /.card-header -->
              <div class="card-body">
               
                  @if($seappointments->count() > 0)
                 <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>SN</th> 
                        <th>name</th>
                        <th>email</th>
                        <th>phone</th>
                        <th>Status</th>     
                        <th>Operation</th>
                  </tr>
                  </thead>
                  <tbody>
                  @php
                    $i=1;
                   @endphp
                  @foreach($seappointments as $sappointment)
                  <tr>
                  <td>{{ $i++ }}</td>
                  <td>{{ $sappointment->name }}</td>
                  <td>{{ $sappointment->email }}</td>
                  <td>{{ $sappointment->phone }}</td>
                  <td>{{ $sappointment->status }}</td>
                  <td>
                  
                  
                  
                  <a href="{{ route('appointments.show',$sappointment->id) }}"><button type="button" class="btn btn-info btn-sm">
                    Reply</button></a>

                    <a href="{{ url('/admin/appointments/view',$sappointment->id) }}"><button type="button" class="btn btn-info btn-sm">
                  View</button></a>
                
                
                    <button type="button" class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#modal-default" onclick="handleDelete({{ $sappointment->id  }})">
                    <i class="fas fa-trash-alt"></i>
                </button>
            
                  
                  </td>
                  </tr>
                  @endforeach
                </table>
                @else
                  @if($search_status=="pending")
     <div class="alert alert-success" role="alert">
  Sorry!! No Any Pending Appointment Found in {{ $search_date }}
</div>
     @endif
     
       @if($search_status=="reply")
    <div class="alert alert-success" role="alert">
  Sorry!! No Any Reply Appointment Found in {{ $search_date }}
</div>
     @endif
              
                
                @endif
                
                
                
                
                
                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
      
  <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Are you sure want to delete ?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
           <form method="post" action="" id="deleteCategoryForm">
   @method('DELETE')
   @csrf
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal" style="color:white;padding:5px;width:10%">No</button>
        <button type="submit" class="btn btn-danger" id="deleteBtn">Yes</button>
      </div>
   
</form>
        

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <script>
 function handleDelete(id){
   console.log('deleted.',id);
   var form=document.getElementById('deleteCategoryForm')
   form.action='/admin/appointments/' + id
   console.log('deleted.',form);
   $("#deleteModal").modal('show');
 }
 </script>  


 @endsection
  
  

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



</div>
      <div class="row">
    <div class="col-sm-12">
    <button type="button" class="btn btn-default" style="" disabled>
             
                
    </div>
      </div>

        <div class="row">
          <div class="col-12">
              
                 
            <div class="card">
            
           
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>SN</th> 
                        <th>Name</th>
                        <th>Email</th>
                        <th>Description</th>
                        <th>Status</th>   
                        <th>Image</th>
                        <th>Product</th>
                        <th>Operation</th>
                  </tr>
                  </thead>
                  <tbody>
                 
                 @php
                 $i=1;
                
                 @endphp
                  @foreach($products as $product)                
              
                  <tr>
                  <td>{{ $i++ }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->email }} </td>
                        <td>{!! Str::limit($product->description,160) !!}</td>
                          <form method="post" action="{{ url('admin/review/status',$product->id) }}">                     
                       @csrf
                        @if($product->status==1)
                        <td>
                       <button type="submit" class="btn btn-success  btn-sm">Publish</button>
                        </td>
                        @else
                        <td>
                       <button type="submit" class="btn btn-primary  btn-sm">UnPublish</button>
                        </td>
                        @endif
                        </form>
                        <td><img src="{{ url('/') }}/storage/posts/{{  $product->image  }}" height="50px" width="50px"></td>
                              <td>{{ $product->product }}</td>
                    

                 <td>
                       <a href="{{ url('/admin/review/reply',$product->id) }}"><button type="button" class="btn btn-info btn-sm">
                     View </button></a>
               
                    <button type="button" class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#modal-default" onclick="handleDelete({{ $product->id  }})">
                    <i class="fas fa-trash-alt"></i>
                </button>
            
               </td>
                  </tr>
                  @endforeach
             
                  
                </table>
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
   form.action='/admin/review/delete/' + id
   console.log('deleted.',form);
   $("#deleteModal").modal('show');
 }
 </script>  


 @endsection
  
  

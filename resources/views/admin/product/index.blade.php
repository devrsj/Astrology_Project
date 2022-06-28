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
         <form class="form-inline" method="GET" action="{{ url('/admin/searchproduct') }}">
 
  <div class="form-group mx-sm-3 mb-2">
  <label for="" style="margin-right:9px"></label>
<select class="form-control" name="variant_product">
    <option value="all" class="form-control">all products</option>
      <option value="low-to-high" class="form-control">lowprice to highprice</option>
    
      <option value="high-to-low" class="form-control">highprice to lowprice</option>
      <option value="latest-products" class="form-control">latest  products</option>
      <option value="older-products" class="form-control">older  products</option>
    
    
</select>
  </div>
  
  <button type="submit" class="btn btn-primary mb-2">Search</button>
</form>

               <a href="{{ route('product.create') }}"><button type="button" class="btn btn-success" style="float:right">
            Add Product</button></a>
                
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
                        <th>Category</th>
                      
                    
                        <th>Status</th>    
                        <th>Weight</th> 
                        <th>Image</th>
                        <th>Price</th>
                        <th>Operation</th>
                  </tr>
                  </thead>
                  <tbody>
                 
                  @foreach($products as $product)                
              
                  <tr>
                  <td>{{ $i++ }}</td>
                    <td>{{ $product->name }}</td>
                    <td>@if(!empty($product->category)) {{ $product->category->name }} @endif</td>
               <form method="post" action="{{ url('admin/product/status',$product->id) }}">                     
                       @csrf
                        @if($product->status==1)
                        <td>
                       <button type="submit" class="btn btn-success  btn-sm">Active</button>
                        </td>
                        @else
                        <td>
                       <button type="submit" class="btn btn-primary  btn-sm">Deactive</button>
                        </td>
                        @endif
                        </form>
                    

                        <td>{{ $product->weight }}</td>
                        <td><img src="{{ url('/') }}/storage/posts/{{  $product->image  }}" height="50px" width="50px"></td>
                           <td>{{ $product->sp }}</td>
                    <td><a href="{{ route('product.edit',$product->id) }}"><button type="button" class="btn btn-info btn-sm">
                    <i class="fas fa-pen"></i></button></a>

                 

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
   form.action='/admin/product/' + id
   console.log('deleted.',form);
   $("#deleteModal").modal('show');
 }
 </script>  


 @endsection
  
  

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
 
                
<form class="form-inline" method="GET" action="{{ url('/admin/search/service_product') }}">
 
  <div class="form-group mx-sm-3 mb-2">
  <label for="" style="margin-right:9px"></label>
<select class="form-control" name="variant_product">
   <option value="all"  @if($variant==="all") selected='selected' @endif class="form-control">all serivce products</option>
      <option value="low-to-high" @if($variant==="low-to-high") selected='selected' @endif class="form-control">lowprice to highprice</option>
    
      <option value="high-to-low" @if($variant==="high-to-low") selected='selected' @endif class="form-control">highprice to lowprice</option>
      <option value="latest-service-products" @if($variant==="latest-service-products") selected='selected' @endif class="form-control">Latest service products</option>
      <option value="older-service-products" @if($variant==="older-service-products") selected='selected' @endif class="form-control">older service products</option>
    
    
</select>
  </div>
  
  <button type="submit" class="btn btn-primary mb-2">Search</button>
</form>
         
               <a href="{{ route('subundercategory.create') }}"><button type="button" class="btn btn-primary" style="float:right">
            Add ServiceProducts</button></a>
                
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
                        <th>Category name</th>
                        <th>Subcategory name</th>
               
                       <th>Price</th>
                        <th>Weight</th> 
                        <th>Operation</th>
                  </tr>
                  </thead>
                  <tbody>
                 
                  @foreach($subundercategories as $subundercategory)
              @php
          
          $category_name=App\Models\Category::where('id', $subundercategory->subcategory_id)->first();
          $subcategory_name=App\Models\SubCategory::where('id', $subundercategory->subundercategory_id)->first();
              @endphp                    
              
                  <tr>
                  <td>{{ $i++ }}</td>
                    <td>{{ $subundercategory->name }}</td>
                    <td>
                    @if(!$category_name==null)

                    {{ $category_name->name }}
                    @endif
                    </td>
                    <td>    @if(!$subcategory_name==null)

{{ $subcategory_name->name }}
@endif </td>

               
                  


                
                    
                
                    <td>{{ $subundercategory->sp }}</td>
                        <td>{{ $subundercategory->weight }}</td>

                    <td><a href="{{ route('subundercategory.edit',$subundercategory->id) }}"><button type="button" class="btn btn-info btn-sm">
                    <i class="fas fa-pen"></i></button></a>

                

                    <button type="button" class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#modal-default" onclick="handleDelete({{ $subundercategory->id  }})">
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
   form.action='/admin/subundercategory/' + id
   console.log('deleted.',form);
   $("#deleteModal").modal('show');
 }
 </script>  


 @endsection
  
  

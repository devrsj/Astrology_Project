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
    <button type="button" class="btn btn-default" style="" disabled>
                <h5>List of pages information</h5></button>

                <a href="{{ route('page.create') }}"><button type="button" class="btn btn-primary" style="float:right">
               Add pages</button></a>
                
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
                    <th>Sn</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Type</th>
                    <th>Parent name</th>
                    <th>Status</th>
                    <th>Weight</th>
                    <th>Operation</th>
                  </tr>
                  </thead>
                  <tbody>
                  @php
                    $i=1;
                  @endphp
                  @foreach(App\Models\Page::all() as $page)
              
     @php
             $parent_id=$page->parent_id;

             $parent_name=App\Models\Page::where('id',$parent_id)->pluck('name')->first();

            
              @endphp
             

             
                  <tr>
                  <td>{{ $i++ }}</td>
                    <td>{{  $page->name }}</td>
                    <td> {{ $page->position }} </td>
                    <td>{{ $page->type }}</td>
                    <td>
                
                   @if($page->parent_id==0)
                      0

                     @else

                    {{ $parent_name }}

                     @endif




                     </td>
                    
                    <form method="post" action="{{ url('admin/page/status',$page->id) }}">                     
                       @csrf
                        @if($page->status==1)
                        <td>
                       <button type="submit" class="btn btn-success btn-sm">Active</button>
                        </td>
                        @else
                        <td>
                       <button type="submit" class="btn btn-primary btn-sm">DeActive</button>
                        </td>
                        @endif
                        </form>
                        <td>{{ $page->weight }}</td>

                    <td>  <a href="{{ route('page.edit',$page->id) }}"><button type="button" class="btn btn-info btn-sm">
                    <i class="fas fa-pen"></i></button></a>

<a href="{{ route('page.show',$page->id) }}"><button type="button" class="btn btn-info btn-sm">
                    <i class="fas fa-eye-slash"></i></button></a>


                    <button type="button" class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#modal-default" onclick="handleDelete({{ $page->id  }})">
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
   form.action='/admin/page/' + id
   console.log('deleted.',form);
   $("#deleteModal").modal('show');
 }
 </script>  


 @endsection
  
  

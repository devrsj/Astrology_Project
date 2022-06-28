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
          
<form class="form-inline" method="GET" action="{{ url('/admin/order') }}">
  <div class="form-group mx-sm-3 mb-2">
   <label for="" style="margin-right:9px">Start Date:  </label>
    <input type="date" name="from" class="form-control" id="" placeholder="Start Date" required>
  </div>
  <div class="form-group mx-sm-3 mb-2">
  <label for="" style="margin-right:9px">Start Date:  </label>
    <input type="date"  name="to" class="form-control" id="" placeholder="End Of Date" required>
  </div>
  
      <input type="hidden" value="pending" name="search_status"> 
  <button type="submit" class="btn btn-primary mb-2">Search</button>
</form>

             
                
    </div>
       <div class="col-sm-4">
                
<form class="form-inline" method="GET" action="{{ url('/admin/search_order') }}">
 
  <div class="form-group mx-sm-3 mb-2">
  <label for="" style="margin-right:9px">Search Date:  </label>
    <input type="date"  name="search_date" class="form-control" id="" placeholder="End Of Date" required>
  </div>

     <input type="hidden" value="pending" name="search_status"> 
     
  <button type="submit" class="btn btn-primary mb-2">Search</button>
</form>
         
                
    </div>
    
    
    
      </div>


        <div class="row">
          <div class="col-12">
            
            <div class="card">
              <div class="card-header">
             
               
              </div>
           
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                   <th>SN</th> 
                   <th>Order Code</th>
                   <th>Name</th>
                   <th>Email</th>
                   <th>Number</th>
                        
                        <th> Status</th>
                        <th>Operation</th>
                  </tr>
                  </thead>
                  <tbody>
                  @php
                    $i=1;
                    $order_questions=App\Models\OrderAskQuestion::where('status','pending')->get();
                  @endphp
                  @foreach($order_questions as $order_question)
              
                  <tr>

                  <td>{{ $i++ }}</td>
                  <td>{{ $order_question->order_code }}</td>
                  <td>{{ $order_question->name }}</td>
                  <td>{{ $order_question->email }}</td>
                  <td>{{ $order_question->number }}</td>
                   
                  
      
                      <td>{{ $order_question->status }}</td>
                    
                    <td> 
                    <a href="{{ route('ask_question.show',$order_question->id) }}"><button type="button" class="btn btn-info btn-sm">
                    Delivered</button></a>

                    <a href="{{ url('/admin/orderquestion/view',$order_question->id) }}"><button type="button" class="btn btn-info btn-sm">
                  View</button></a>
                    <button type="button" class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#modal-default" onclick="handleDelete({{ $order_question->id  }})">
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
   form.action='/admin/order_question/' + id
   console.log('deleted.',form);
   $("#deleteModal").modal('show');
 }
 </script>  



 @endsection
  
  

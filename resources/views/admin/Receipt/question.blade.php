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
                        <th>Payment Status</th>
                        <th> Status</th>
                        <th>Operation</th>
                  </tr>
                  </thead>
                  <tbody>
                  @php
                    $i=1;
                    $order_questions=App\Models\OrderAskQuestion::where('status','reply')->get();
                  @endphp
                  @foreach($order_questions as $order_question)
              
                  <tr>

                  <td>{{ $i++ }}</td>
                  <td>{{ $order_question->order_code }}</td>
                  <td>{{ $order_question->name }}</td>
                  <td>{{ $order_question->email }}</td>
                  <td>{{ $order_question->number }}</td>
                   
                  

                      <td>{{ $order_question->payment_status }}</td>       
                      <td>{{ $order_question->status }}</td>
                    
                    <td> 
                 
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
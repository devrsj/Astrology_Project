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
                <h3 class="card-title">View Order Details :{{ $order->order_code }}</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                <div class="row">
                <div class="col-sm-3">
                <p>Name:</p>
                <p>Email:</p>
                <p>Number:</p>   
           
                <p>Status:</p>
                </div>

                <div class="col-sm-3">
                <p>{{ $order->name }}</p>
                <p>{{ $order->email }}</p>
                <p>{{ $order->number }}</p>
                
               
                <p>{{ $order->status }}</p>
                
                </div>

                <div class="col-sm-3">
                <p>Order Number:</p>
               
             
                <p>Total:</p>
                <p>Payment Method:</p>
                <p>Payment Status:</p>
                </div>

                <div class="col-sm-3">
                <p>{{ $order->order_code }}</p>
               
                <p>{{ $order->grand_total }}</p>
                 @if($order->payment_status=="cash") 
                <p>{{ $order->payment_method }}</p>
                 @if($order->payment_status=="1") <p> unPaid </p> @else<p> paid </p> @endif
                
                @else
                  <p>{{ $order->payment_method }}</p>
               @if($order->payment_status=="1")   <p> Paid</p>  @else<p> unpaid </p>@endif
                
                
                
                @endif
                </div>      
                </div>
             <hr>

             @php
$i=1;
$carts=App\Models\CustomerQuestion::where('orderquestion_id',$order->id)->get();
@endphp
                <div class="row">
                <div class="col-sm-12">
                    
                    <a href="{{ route('questionorder.pdf',$order->id) }}" class="btn btn-primary" style="float:right;margin-left:9px">Download In PDf</a>
                    
                    
                      
                <table border="1" style="width:100%">
                <tr>
                <th>SN</th>
                <th>Question</th>   
                <th> Price</th>
              
                </tr>
             
             @foreach($carts as $cart)

                <tr>
                <td>{{ $i++ }}</td>
                <td> {{ $cart->question }}</td>
                
                <td>{{ $cart->price }}</td>
              
                </tr>
                @endforeach

               
                
                
                
                
                </table>
                
                </div> 
                </div>









                 
            
            
           
                 
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                <td style="float:right"> Grand Total: {{ $order->grand_total }}</td>
                </div>
        
              <hr>

         

             
        
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
  
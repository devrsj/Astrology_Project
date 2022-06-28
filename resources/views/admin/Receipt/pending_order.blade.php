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
                <h3 class="card-title">View Order Details :{{ $order->order_number }}</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                <div class="row">
                <div class="col-sm-3">
                <p>Name:</p>
                <p>Email:</p>
                <p>Number:</p>
                <p>Country:</p>
                <p>Address:</p> 
                <p>Delivery:</p>
                </div>

                <div class="col-sm-3">
                <p>{{ $order->name }}</p>
                <p>{{ $order->email }}</p>
                <p>{{ $order->phone_number }}</p>
                <p>{{ $order->country }}</p>
                <p>{{ $order->address }}</p>
                <p>{{ $order->delivery }}</p>
                </div>

                <div class="col-sm-3">
                <p>Order Number:</p>
                <p>Total Item:</p>
                <p>Status:</p>
                <p>Total:</p>
                <p>Payment Method:</p>
                <p>Payment Status:</p>
                </div>

                <div class="col-sm-3">
                <p>{{ $order->order_number }}</p>
                <p>{{ $order->item_count }}</p>
                <p>{{ $order->status }}</p>
                <p>{{ $order->grand_total }}</p>
                <p>{{ $order->payment_method }}</p>
                <p>
                    
                    @if($order->payment_status=="1")  Paid  @else @endif</p>
                </div>      
                </div>
             <hr>

             @php
$i=1;
$carts=App\Models\Cart::where('order_id',$order->id)->get();
@endphp
                <div class="row">
                <div class="col-sm-12">
                    
                    <a href="{{ route('orderproduct.pdf',$order->id) }}" class="btn btn-primary" style="float:right">Download In PDf</a>
                
                <table border="1" style="width:100%">
                <tr>
                <th>SN</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Sub Total Price</th>
                </tr>
             
             @foreach($carts as $cart)
@php
$product_name=App\Models\Product::where('id',$cart->product_id)->first();
@endphp
                <tr>
                <td>{{ $i++ }}</td>
                <td> {{ $product_name->name }}</td>
                <td>{{ $cart->quantity }}</td>
                <td>{{ $cart->price }}</td>
                <td>{{ $cart->sub_total }}</td> 
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
  
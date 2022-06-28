<?php

namespace App\Http\Controllers\Front;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\Address;
use App\Models\ReplyAppointment;
use App\Models\Newsletter;
use App\Models\Appointment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\FirstEmail;
use PDF;



class AppointmentController extends Controller
{


 public function index(){
     return view('admin.appointment.index');
 }
 
 
  public function single_searchappo($single_date){
    
  
        $appointments=Appointment::whereDate('created_at', '=', $single_date)->where('user_id',Auth()->user()->id)->get();;
                        $user_name=Auth()->user()->name;
                $admin=User::where('is_admin',1)->first();
       
                       $output ="";
                          
    if($appointments->count() > 0){
 
       foreach($appointments as $key=> $appointment){  
   
   $replies=ReplyAppointment::where('user_id',Auth()->user()->id)->where('orderappointment_id',$appointment->id)->get();
       
        
  
    $output .=
    
    '<div class="panel panel-default">'.
      '<div class="panel-heading">'.
        '<h4 class="panel-title">'.
          '<a data-toggle="collapse" data-parent="#accordion" href="#collapse1'.$appointment->id.'">Book  Appointment By'.$user_name.' at '.$appointment->created_at->format('M d Y').'</a>'.
        '</h4>'.
      '</div>'.
      '<div id="collapse1'.$appointment->id.'" class="panel-collapse collapse">'.
        '<div class="panel-body">'.
                      
   '<div class="panel panel-default">'.
  '<div class="panel-heading">Appointment By:'.$user_name.' </div>'.


'<div class="panel-body">'.
'<div class="row">'.
'<div class="col-sm-3">'.
'<p>Name:</p>'.
'<p>Email</p>'.
'<p>Phone:</p>'.
'<p>Gender:</p>'.
'<p>Country of Birth:</p>'.
'</div>'.

'<div class="col-sm-3">'.
'<p>'.$appointment->name.'</p>'.
'<p>'.$appointment->email.'</p>'.
'<p>'.$appointment->phone.'</p>'.
'<p>'.$appointment->gender.'</p>'.
'<p>'.$appointment->country_birth.'</p>'.
'</div>'.

'<div class="col-sm-3">'.
'<p>Prefered Date:</p>'.
'<p>Prefered Time:</p>'.
'<p>Date Of Birth:</p>'.
'<p>Time Of Birth:</p>'.
'<p>Status</p>'.
'</div>'.

'<div class="col-sm-3">'.
'<p>'.$appointment->preferred_date.'</p>'.
'<p>'.$appointment->preferrred_time.'</p>'.
'<p>'.$appointment->dob.'</p>'.
'<p>'.$appointment->tob.'</p>'.
'<p>'. $appointment->status.'</p>'.
'</div>'.
'</div>';


$replies=ReplyAppointment::where('user_id',Auth()->user()->id)->where('orderappointment_id',$appointment->id)->get();


if($appointment->status=="Reply"){

$admin=User::where('is_admin',1)->first();


$output .='<div class="panel panel-default">'.
  '<div class="panel-heading">Reply By:'.$admin->name.'</div>'.
  '<div class="panel-body">'.

'<div class="row">'.
'<div class="col-sm-3">'.
'<p>Name:</p>'.
'<p>Email:</p>'.
'<p>Phone</p>'.
'</div>'.

'<div class="col-sm-3">'.
'<p>'.$admin->name.'</p>'.
'<p>'.$admin->email.'</p>'.
'<p>'.$admin->number.'</p>'.

'</div>'.



'<div class="col-sm-3">'.
'<p>Prefered Date:</p>'.
'<p>Prefered Time:</p>'.
'<p>Status</p>'.
'</div>';
foreach($replies as $key=> $reply){
 $output .='<div class="col-sm-3">'.
'<p>'.$reply->preferred_date.'</p>'.
'<p>'.$reply->preferrred_time.'</p>'.
'</div>';
}
$output .='</div>'.
  '</div>'.
'</div>';
}
 $output .='</div>'.
'</div>'.
            
        '</div>'.
      '</div>'.
    '</div>';
    
    }
    
  
     
    
    }else{
        
        $output.='<div class="alert alert-success">'.
  '<strong>Sorry!</strong><p> We donot  Find any Appointment in '.$single_date.'</p>'.
'</div>';
    }
    return Response()->json($output);
    
   }
 
 
    public function appointment_search($start_date, $end_date){
  
        $appointments=Appointment::where('created_at', '>=', $start_date)
                        ->where('created_at', '<=', $end_date)
                        ->where('user_id',Auth()->user()->id)->get();
                        $user_name=Auth()->user()->name;
                $admin=User::where('is_admin',1)->first();
      
                       $output ="";
                         
    if($appointments->count() > 0){
                                                        
   foreach($appointments as $key=> $appointment){  
   
   $replies=ReplyAppointment::where('user_id',Auth()->user()->id)->where('orderappointment_id',$appointment->id)->get();
       
        
  
    $output .=
    
    '<div class="panel panel-default">'.
      '<div class="panel-heading">'.
        '<h4 class="panel-title">'.
          '<a data-toggle="collapse" data-parent="#accordion" href="#collapse1'.$appointment->id.'">Book  Appointment By'.$user_name.' at '.$appointment->created_at->format('M d Y').'</a>'.
        '</h4>'.
      '</div>'.
      '<div id="collapse1'.$appointment->id.'" class="panel-collapse collapse">'.
        '<div class="panel-body">'.
                      
   '<div class="panel panel-default">'.
  '<div class="panel-heading">Appointment By:'.$user_name.' </div>'.


'<div class="panel-body">'.
'<div class="row">'.
'<div class="col-sm-3">'.
'<p>Name:</p>'.
'<p>Email</p>'.
'<p>Phone:</p>'.
'<p>Gender:</p>'.
'<p>Country of Birth:</p>'.
'</div>'.

'<div class="col-sm-3">'.
'<p>'.$appointment->name.'</p>'.
'<p>'.$appointment->email.'</p>'.
'<p>'.$appointment->phone.'</p>'.
'<p>'.$appointment->gender.'</p>'.
'<p>'.$appointment->country_birth.'</p>'.
'</div>'.

'<div class="col-sm-3">'.
'<p>Prefered Date:</p>'.
'<p>Prefered Time:</p>'.
'<p>Date Of Birth:</p>'.
'<p>Time Of Birth:</p>'.
'<p>Status</p>'.
'</div>'.

'<div class="col-sm-3">'.
'<p>'.$appointment->preferred_date.'</p>'.
'<p>'.$appointment->preferrred_time.'</p>'.
'<p>'.$appointment->dob.'</p>'.
'<p>'.$appointment->tob.'</p>'.
'<p>'. $appointment->status.'</p>'.
'</div>'.
'</div>';


$replies=ReplyAppointment::where('user_id',Auth()->user()->id)->where('orderappointment_id',$appointment->id)->get();


if($appointment->status=="Reply"){

$admin=User::where('is_admin',1)->first();


$output .='<div class="panel panel-default">'.
  '<div class="panel-heading">Reply By:'.$admin->name.'</div>'.
  '<div class="panel-body">'.

'<div class="row">'.
'<div class="col-sm-3">'.
'<p>Name:</p>'.
'<p>Email:</p>'.
'<p>Phone</p>'.
'</div>'.

'<div class="col-sm-3">'.
'<p>'.$admin->name.'</p>'.
'<p>'.$admin->email.'</p>'.
'<p>'.$admin->number.'</p>'.

'</div>'.



'<div class="col-sm-3">'.
'<p>Prefered Date:</p>'.
'<p>Prefered Time:</p>'.
'<p>Status</p>'.
'</div>';
foreach($replies as $key=> $reply){
 $output .='<div class="col-sm-3">'.
'<p>'.$reply->preferred_date.'</p>'.
'<p>'.$reply->preferrred_time.'</p>'.
'</div>';
}
$output .='</div>'.
  '</div>'.
'</div>';
}
 $output .='</div>'.
'</div>'.
            
        '</div>'.
      '</div>'.
    '</div>';
    
    }
    
   
    }else{
        
        $output.='<div class="alert alert-success">'.
  '<strong>Sorry!</strong> We donot Find Appointment between '.$start_date.' and '.$end_date.''.
'</div>';
    }
    return Response()->json($output);
    
   }
 
 public function edit($id){
$appointment=Appointment::find($id);
 return view('admin.appointment.show',compact('appointment'));
 }

 public function reply(){

     return view('admin.appointment.reply');
     }
     
     public function view_appointment($id){
         $appointment=Appointment::findorfail($id);
         return view('admin.appointment.view_appointment',compact('appointment'));
     }
    

    public function appointment(Request $request){
        
        $appointment = new  Appointment();
        $appointment->user_id=$request->auth_id;
        $appointment->name=$request->name;
        $appointment->email=$request->email;
        $appointment->phone=$request->phone; 
        $appointment->gender=$request->gender; 
        $appointment->preferred_date=$request->preferred_date;
        $appointment->preferrred_time=$request->preferrred_time;
        $appointment->dob=$request->dob;
         $appointment->tob=$request->tob;
         $appointment->service=$request->service;
         $appointment->sub_service=$request->sub_service;
          $appointment->birth_place=$request->birth_place;
          $appointment->country_birth=$request->country_birth;
           $appointment->consult_service=$request->consult_service;
            $appointment->status="pending";
           $appointment->remarks=$request->remarks;
           $appointment->save();
          
           session()->flash('success','Booking Appointment Pending Succesfully');
           return redirect(url('/'));
       }


          public function update(Request $request,$id){

           $appointment=Appointment::findorfail($id);
            $reply_appo= new  ReplyAppointment();
            $reply_appo->orderappointment_id=$appointment->id;
            $reply_appo->user_id=$appointment->user_id;
            $reply_appo->preferred_date=$request->preferred_date;
             $reply_appo->preferrred_time=$request->preferred_time;
             $reply_appo->save();
            $appointment->status=$request->status;
            $appointment->save();
           
     $reply= ReplyAppointment::OrderBy('id','desc')->first();

     $data["email"] =$appointment->email;
     $data["title"] = "From ItSolutionStuff.com";
     $data["body"] = "This is Demo";
     $data["appointment_id"]=$appointment;
     $data["reply_date"]=$reply->preferred_date;
     $data['reply_time']=$reply->preferrred_time;
   
   
     Mail::send('emails.myTestMail', $data, function($message)use($data) {
         $message->to($data["email"], $data["email"])
                 ->subject($data["title"]);
     });
 


          session()->flash('success','Reply  has been sent succesfully');
               return redirect( route('appointments.index'));
              
       }


   public function email($data){


   }


       public function show($id){
       $appointment=Appointment::findorfail($id);
       return view('admin.appointment.show',compact('appointment'));
           
       }



   
        public function destroy($id){
            $appointment=Appointment::findorfail($id);
            $appointment->delete();
            session()->flash('error','Appointment Deleted Succesfully');
            return redirect()->back();
        }

        public function newsletter(Request $request){       
            Newsletter::create([
            "email"=> $request->email,
            ]);

            session()->flash('success','Subscribe succesfully');
            return redirect()->back();
        }


        public function update_profile(Request $request,$id){

            $data=$request->only(['user_id','occupation','city','state','country','postal_code','address','dob']);
            $user=User::find($id);
            $user->name=$request->name;
            $user->email=$request->email;
            $user->number=$request->number;
            $user->gender=$request->gender;
            $user->save();
           $address=Address::where('user_id',$user->id)->first();
           $address->update($data);
           return back()->with('success','Profile Updated Successfully');
        }
        
        
        public function order_search($start_orderdate,$end_orderdate){
       
        $orders=Order::where('created_at', '>=', $start_orderdate)->where('created_at', '<=', $end_orderdate)->where('user_id',Auth()->user()->id)->get();
                       $output="";
                              $i=1;
                              if($orders->count() > 0){
               $output.=
               
                '<table class="table table-bordered">'.
                    '<thead class="thead-light">'.
                                                        '<tr>'.
                                                            '<th>Order</th>'.
                                                            '<th>Date</th>'.
                                                            '<th>Status</th>'.
                                                            '<th>Total</th>'.
                                                            '<th>Action</th>'.
                                                        '</tr>'.
                                                        '</thead>'.
                                                        '<tbody>';                                                       
                                               
                                             foreach($orders as $new_order){  
                                          $new_order_id=$new_order->id;
                                             
                                              $output.='<tr>'.
                                                '<td>'.$i++.'</td>'.
                                         '<td>'.$new_order->created_at.'</td>'.
                                        '<td>'.$new_order->status.'</td>'.
                                        '<td>'.$new_order->grand_total.'</td>'.
                                '<td><a data-toggle="collapse" href="#'. $new_order->id.'" role="button" class="as_link">View</a>'.
                                 '</td>'.
                                '</tr>'.
                               
                                         '<tr>'.
                                        '<td colspan="5" style="background-color: #eeeeee">'.
                            '<div class="collapse" id="'.$new_order->id.'">'.
                         '<div class="card-body pt-0">'.
                        '<table class="table-cart-summary table-striped " style="width: 100%">'.
                                                                            '<thead>'.
                                '<tr class="mb-4">'.                   
                                '<th class="product-name" style="font-weight: bold">Product</th>'.
                            '<th class="product-name" style="font-weight: bold">Quantity</th>'.
                            '<th class="product-name" style="font-weight: bold">Price</th>'.
                                                  
    '<th class="product-total text-right" style="font-weight: bold">Sub-Total</th>'.
    '</tr>'.
                                          
'</thead>'.
'<tbody>';

$order_products=Cart::where('user_id',Auth()->user()->id)->where('order_id',$new_order_id)->OrderBy('id','desc')->get();
foreach($order_products as $order_product){
$product_name=Product::where('id',$order_product->product_id)->first();
$output .= '<tr class="cart_item">'.
'<td  class="product-name pl-1" style="text-align:left">'.
'<figure class="mr-2 " style="display: inline-block">'.                                                                     
'</figure>'. $product_name->name.'</td>'.
'<td class="product-total text-right">'. $order_product->quantity.'</td>'. 
'<td class="product-total text-right">'.$order_product->price.'</td>'.
'<td class="product-total text-right">'.
'<span class="pl-4">Rs.'.$order_product->sub_total.' </span>'.
'</td>'.
'</tr>';

}

$output.='</tbody>'.
'</table>'.
'</div>'.
'<div class="row">'.
'<div class="col-lg-5 " style="float:right; margin-right: 10px">'.
'<div class="cart-calculator-wrapper mt-0">'.
'<div class="cart-calculate-items">'.
'<div class="table-responsive">'.
'<table class="table">'.
'<tr>'.
'<td>Sub Total</td>'.
'<td>Rs'.$new_order->grand_total.'</td>'.
'</tr>'.
'<tr>'.
'<td>Shipping</td>'.
'<td>Rs.0.00</td>'.
'</tr>'.
'<tr class="total">'.
'<td>Grand Total</td>'.
'<td class="total-amount">'.
'Rs'. $new_order->grand_total.' </td>'.
'</tr>'.
'</table>'.
'</div>'.
'</div>'.
'</div>'.
'</div>'.
'</div>'.
'</div>'.
'</td>'.
'</tr>';
}
$output .='</tbody>'.
'</table>';
               
        }else{
       $output.='<div class="alert alert-success">'.
  '<strong>Sorry!</strong> We donot Find any Orders between '.$start_orderdate.' and '.$end_orderdate.''.
'</div>';
    }
                            
 return response()->json($output);

            
        }

    
         public function single_search($search_date){
         
        $orders=Order::whereDate('created_at', '=', $search_date)->where('user_id',Auth()->user()->id)->get();;
      
                       $output="";
                              $i=1;
                              if($orders->count() > 0){
               $output.=
               
                '<table class="table table-bordered">'.
                    '<thead class="thead-light">'.
                                                        '<tr>'.
                                                            '<th>Order</th>'.
                                                            '<th>Date</th>'.
                                                            '<th>Status</th>'.
                                                            '<th>Total</th>'.
                                                            '<th>Action</th>'.
                                                        '</tr>'.
                                                        '</thead>'.
                                                        '<tbody>';                                                       
                                               
                                             foreach($orders as $new_order){  
                                          $new_order_id=$new_order->id;
                                             
                                              $output.='<tr>'.
                                                '<td>'.$i++.'</td>'.
                                         '<td>'.$new_order->created_at.'</td>'.
                                        '<td>'.$new_order->status.'</td>'.
                                        '<td>'.$new_order->grand_total.'</td>'.
                                '<td><a data-toggle="collapse" href="#'. $new_order->id.'" role="button" class="as_link">View</a>'.
                                 '</td>'.
                                '</tr>'.
                               
                                         '<tr>'.
                                        '<td colspan="5" style="background-color: #eeeeee">'.
                            '<div class="collapse" id="'.$new_order->id.'">'.
                         '<div class="card-body pt-0">'.
                        '<table class="table-cart-summary table-striped " style="width: 100%">'.
                                                                            '<thead>'.
                                '<tr class="mb-4">'.                   
                                '<th class="product-name" style="font-weight: bold">Product</th>'.
                            '<th class="product-name" style="font-weight: bold">Quantity</th>'.
                            '<th class="product-name" style="font-weight: bold">Price</th>'.
                                                  
    '<th class="product-total text-right" style="font-weight: bold">Sub-Total</th>'.
    '</tr>'.
                                          
'</thead>'.
'<tbody>';

$order_products=Cart::where('user_id',Auth()->user()->id)->where('order_id',$new_order_id)->OrderBy('id','desc')->get();
foreach($order_products as $order_product){
$product_name=Product::where('id',$order_product->product_id)->first();
$output .= '<tr class="cart_item">'.
'<td  class="product-name pl-1" style="text-align:left">'.
'<figure class="mr-2 " style="display: inline-block">'.                                                                     
'</figure>'. $product_name->name.'</td>'.
'<td class="product-total text-right">'. $order_product->quantity.'</td>'. 
'<td class="product-total text-right">'.$order_product->price.'</td>'.
'<td class="product-total text-right">'.
'<span class="pl-4">Rs.'.$order_product->sub_total.' </span>'.
'</td>'.
'</tr>';

}

$output.='</tbody>'.
'</table>'.
'</div>'.
'<div class="row">'.
'<div class="col-lg-5 " style="float:right; margin-right: 10px">'.
'<div class="cart-calculator-wrapper mt-0">'.
'<div class="cart-calculate-items">'.
'<div class="table-responsive">'.
'<table class="table">'.
'<tr>'.
'<td>Sub Total</td>'.
'<td>Rs'.$new_order->grand_total.'</td>'.
'</tr>'.
'<tr>'.
'<td>Shipping</td>'.
'<td>Rs.0.00</td>'.
'</tr>'.
'<tr class="total">'.
'<td>Grand Total</td>'.
'<td class="total-amount">'.
'Rs'. $new_order->grand_total.' </td>'.
'</tr>'.
'</table>'.
'</div>'.
'</div>'.
'</div>'.
'</div>'.
'</div>'.
'</div>'.
'</td>'.
'</tr>';
}

$output .='</tbody>'.
'</table>';
               
        }else{
       $output.='<div class="alert alert-success">'.
  '<strong>Sorry!</strong><p> We donot Find any Orders in' .$search_date.' </p>'.
'</div>';
    }
                            
 return response()->json($output);

            
        }



    //
}

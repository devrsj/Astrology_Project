<?php

namespace App\Http\Controllers\Front;

use App\Models\Order;
use App\Models\Cart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;




class CheckoutController extends Controller
{

	public function getCheckout(){

         if(session('cart')){
        return view('front.pages.checkout');
         }else{

  session()->flash('success','Your Cart is Empty');
  return redirect(url('/'));
 
         }
}



         public function placeOrder(Request $request){

          $shippment=session()->get('shippment');
          $shippment=[       
            'name'=>$request->name,
            'email' => $request->email,
            "address" => $request->address,
            "city" => $request->city,
            "country" => $request->country,
            "post_code" => $request->post_code,
            "phone_number" => $request->phone_number
            
      ];

          session()->put('shippment',$shippment);

         

          session()->save();
         
          return redirect()->route('delivery');

         }



		public function delivery(Request $request){ 

    $data=$request->session()->get('shippment');
   

      if(session('cart')){
       
      return view('front.pages.delivery');
         }else{
          session()->flash('success','Your Cart is Empty');
          return redirect(url('/'));
    }
  }


    public function delivery_place(Request $request){
  

      $delivery=session()->get('delivery');
      $delivery=[
           
        'delivery'=>$request->delivery,
  ];

      session()->put('delivery',$delivery);
      session()->save();
      return redirect()->route('payment.type');

    }

    public function payment(Request $request){

      
    $dat=$request->session()->all();
  
           
      if(session('cart')){
             
    $ptotal=0;
     

 foreach(session('cart') as $id => $produc){

$psub_total=$produc['sp'] * $produc['quantity'];
$ptotal +=$psub_total;
 
      }
            $random = rand(1000000000000,9999999999999);  
       
        return view('front.pages.payment',compact('ptotal','random'));
           }else{
            session()->flash('success','Your Cart is Empty');
            return redirect(url('/'));

           }

    }


    public function payment_store(Request $request){
     
      $payment=session()->get('payment');
      $payment=[    
        'payment'=>"cash"
      ];

      session()->put('payment',$payment);
      session()->save();

      return redirect()->route('success.order');

    }


    public function success_order(Request $request){


if(session('cart')){
      $shippment=session()->get('shippment');
      $delivery=session()->get('delivery');
      $payment=session()->get('payment');
      $cart=session()->get('cart');

      $guest = rand(1000000000000,9999999999999);
      $random = rand(1000000000000,9999999999999);
     $total=0;
     $quan=0;    
$order="";

  foreach(session('cart') as $id => $produc){
     $sutotal=$produc['sp'] * $produc['quantity'];
    
     $total +=$sutotal;


   }

if(Auth::user()){
$order= new Order();
  
 
    $order->order_number =$random;
    $order->user_id =Auth()->user()->id;
    $order->guest_id=null;
    $order->grand_total =$total;
    $order->item_count = $quan;
    $order->payment_method =session('payment')['payment']; 
    $order->delivery =session('delivery')['delivery'];   
    $order->name = session('shippment')['name']; 
    $order->email=session('shippment')['email']; 
    $order->address=session('shippment')['address']; 
    $order->city = session('shippment')['city'];
    $order->country=session('shippment')['country']; 
    $order->post_code=session('shippment')['post_code']; 
    $order->phone_number=session('shippment')['phone_number']; 
    $order->save();

}else{
 

    $order= new Order();

 
    $order->order_number =$random;
    $order->user_id =null;
    $order->guest_id=$guest;
    $order->grand_total =$total;
    $order->item_count = $quan;
    $order->payment_method =session('payment')['payment']; 
    $order->delivery =session('delivery')['delivery'];   
    $order->name = session('shippment')['name']; 
    $order->email=session('shippment')['email']; 
    $order->address=session('shippment')['address']; 
    $order->city = session('shippment')['city'];
    $order->country=session('shippment')['country']; 
    $order->post_code=session('shippment')['post_code']; 
    $order->phone_number=session('shippment')['phone_number'];
    $order->save(); 
   


}

  foreach(session('cart') as $id => $product){
     $sub_total=$product['sp'] * $product['quantity'];
     $quan += $product['quantity'];
     $total +=$sub_total;
    
     if(Auth::user()){
        Cart::create([
          "order_id"=>$order->id,
         "product_id"=> $product['id'],
         "user_id" => Auth()->user()->id,
         "product_name"=>$product['name'],
         "guest_id" =>null,
         "quantity" =>$product['quantity'],
         "price" =>$product['sp'],
         "sub_total" =>$sub_total
      ]);
     }else{
      Cart::create([
           "order_id"=>$order->id,
        "product_id"=> $product['id'],
        "user_id" =>null,
          "product_name"=>$product['name'],
          "guest_id" => $guest,
          "quantity" =>$product['quantity'],
          "price" =>$product['sp'],
          "sub_total" =>$sub_total
      ]);

     }
     }

       session()->flash('success','Sucesfully order an product');

      session()->forget('shippment');
      session()->forget('delivery');
      session()->forget('payment');
      session()->forget('cart');
             
        return view('front.pages.order_confirm');




           }
           
           else{

            session()->flash('success','Your Cart is Empty');
            return redirect(url('/'));

           }



      
    }


    

	
    //
}

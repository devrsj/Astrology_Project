<?php
  
namespace App\Http\Controllers;
  
use App\Models\CustomerQuestion;
use App\Models\OrderAskQuestion;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;
use Auth;
   
class PayPalController extends Controller
{
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function payment()
    {
          $question=session()->get('question');
  $payment=session()->get('payment');
          $random = rand(1000000000000,9999999999999);
        $price=$question['price'];
  $questio=$question['question'];

    $min = min(count($price), count($questio));
  $keysOne = array_keys($price);
  $keysTwo = array_keys($questio);

        $data = [];
        
        for($i = 0; $i < $min; $i++) {
        $data['items'] = [
            
            [
                'name' =>$questio[$keysTwo[$i]],
                'price' =>$price[$keysOne[$i]],
                'desc'  => 'PAid For AskQuestion',
                'qty' =>2,
            ]
            
        ];
        }
  
        $data['invoice_id'] = $random;
        $data['invoice_description'] = "Order AskQuestion #{$data['invoice_id']} Invoice";
        $data['return_url'] = route('payment.success');
        $data['cancel_url'] = route('payment.cancel');
        $data['total'] =session('question')['grand_total'][0];
  
        $provider = new ExpressCheckout;
        $response = $provider->setExpressCheckout($data);
        $response = $provider->setExpressCheckout($data, true);
       
        return redirect($response['paypal_link']);
    }
   
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel()
    {
        return redirect(url('/'));
        dd('Your payment is canceled. You can create cancel page here.');
    }
  
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function success(Request $request)
    {
        $response = $provider->getExpressCheckoutDetails($request->token);
  
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            dd('Your payment was successfully. You can create success page here.');
            
              if(session('question')){

  $question=session()->get('question');
  $payment=session()->get('payment');
  $guest = rand(1000000000000,9999999999999);
  $random = rand(1000000000000,9999999999999);
  $price=$question['price'];
  $questio=$question['question'];


  $min = min(count($price), count($questio));
  $keysOne = array_keys($price);
 
  
$keysTwo = array_keys($questio);
  
if(Auth::user()){
  $order=OrderAskQuestion::create([
    "order_code"=>$random,
    "user_id"=>Auth::user()->id,
    "name"=> session('question')['name'], 
    "email"=> session('question')['email'], 
    "number"=>session('question')['number'],
    "gender"=> session('question')['gender'], 
    "occupation"=> session('question')['occupation'], 
    "category_id"=> session('question')['category_id'],
    "grand_total"=>session('question')['grand_total'][0],
    "payment_status"=>1, 
    "payment_method"=>"esewa", 
      "status" =>"paid",
    ]);
}else{

  $order=OrderAskQuestion::create([
    "order_code"=>$random,
    "guest_id"=>$guest,
    "user_id"=>null,
    "name"=> session('question')['name'], 
    "email"=> session('question')['email'], 
    "number"=>session('question')['number'],
    "gender"=> session('question')['gender'], 
    "occupation"=> session('question')['occupation'], 
    "category_id"=> session('question')['category_id'],
    "grand_total"=>session('question')['grand_total'][0],
    "payment_status"=>1, 
    "payment_method"=>"esewa", 
      "status" =>"paid",
    ]);
}

for($i = 0; $i < $min; $i++) {
  if(Auth::user()){
    CustomerQuestion::create([
      "orderquestion_id"=>$order->id,
      "guest_id"=>null,
      "user_id"=>Auth::user()->id,
     "price"=>$price[$keysOne[$i]],
     "question"=>$questio[$keysTwo[$i]]
    ]);
  }else{
    CustomerQuestion::create([
      "orderquestion_id"=>$order->id,
      "guest_id"=> $guest,
      "user_id"=>null,
     "price"=>$price[$keysOne[$i]],
     "question"=>$questio[$keysTwo[$i]]
    ]);
  } 
}
session()->forget('question');
session()->forget('payment');
return view('front.pages.question_order');
}else{
dd('failed');    
}
}
    dd('Something is wrong.');
    }
    
    
    
 public function payment_paypal(Request $request)
    {
       
      
           $cart=session()->get('cart');
           
          
                
           $random = rand(1000000000000,9999999999999);
          $quan=0;  
     
             
        
        $data = [];
         foreach(session('cart') as $id => $product){
     $sub_total=$product['sp'] * $product['quantity'];
     $quan += $product['quantity'];
   
     
    
        $data['items'] = [
            [
                'name' => $product['name'],
                'price' =>$product['sp'],
                'desc'  => 'Paid For Product',
                'qty' =>$product['quantity']
            ]
        ];
        
         }
         
          
  
        $data['invoice_id'] =$random ;
        $data['invoice_description'] = "Order For Product #{$data['invoice_id']} Invoice";
        $data['return_url'] = url('/payment/paypal/success');
        $data['cancel_url'] = url('/payment/paypal/cancel');
                 foreach(session('cart') as $id => $pproduct){
        $data['total'] = $pproduct['quantity'] * $pproduct['sp'];
                 }
                 
               
        $provider = new ExpressCheckout;
   
  
        $response = $provider->setExpressCheckout($data);
           
        $response = $provider->setExpressCheckout($data, true);
     
  
        return redirect($response['paypal_link']);
        
     
           
           
    }
    
     
 public function cancel_paypal()
    {
         return redirect(url('/'));
   
    }
          public function success_paypal(Request $request)
    {
        $response = $provider->getExpressCheckoutDetails($request->token);
  
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            dd('Your payment was successfully. You can create success page here.');
            
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
           }else{
            session()->flash('success','Your Cart is Empty');
            return redirect(url('/'));
           }
        }
  
        dd('Something is wrong.');
    }
   
    
  
    
    
    
    
}
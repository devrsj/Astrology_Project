<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerQuestion;
use App\Models\OrderAskQuestion;
use App\Models\ProductCategory;
use App\Models\Cart;
use Illuminate\Support\Str;
use Auth;
use Srmklive\PayPal\Services\ExpressCheckout;

   

class PaymentController extends Controller
{
    
    
    
  
    
    
    
  public function esewa_payment(){
   
  $amt=$request->amt;
  dd($amt);
  $oid=$request->oid;
  $refId=$request->refId;
 
  
if(isset($amt) && isset($refId)){
$url = "https://uat.esewa.com.np/epay/transrec";
    $data =[
    'amt'=>$amt ,
    'rid'=>$refId,
    'pid'=>$oid,
    'scd'=> 'EPAYTEST'
      ];

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);


if(strpos($response,"Success") !==False){
if(Auth::user()){
  $payment=ProductCategory::create([
    "order_code"=>$random,
    "user_id"=>Auth::user()->id,
    "name"=> $request->name,
    "email" => $request->email,
    "phone"=> $request->number,
    "address"=>$request->address,
    "grand_total"=>$amt,
    "payment_method"=>"esewa", 
      "status" =>"paid",
    ]);
}else{
 $payment=ProductCategory::create([
    "order_code"=>$random,
    "user_id"=>null,
    "name"=> $request->name,
    "email" => $request->email,
    "phone"=> $request->number,
    "address"=>$request->address,
    "grand_total"=>$amt,
    "payment_method"=>"esewa", 
      "status" =>"paid",
    ]);
}
}
else{
    dd('failed');
}
}else{
dd('transcation failed');
}
}



     public function payment_paypal(Request $request)
    {
       
    $random = rand(1000000000000,9999999999999);
    
        $data = [];
        
   
        $data['items'] = [
            [
                'name' =>"hello" ,
                'price' =>$request->grand_total,
                'desc'  => 'Paid Advance',
                'qty' =>0,
            ]
        ];
        
          
  
        $data['invoice_id'] =$random ;
        $data['invoice_description'] = "Paid Advance #{$data['invoice_id']} Invoice";
        $data['return_url'] = url('/direct-payment/paypal/success');
        $data['cancel_url'] = url('/direct-payment/paypal/cancel');
        $data['total'] =$request->grand_total;
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
            

     

      $guest = rand(1000000000000,9999999999999);
      $random = rand(1000000000000,9999999999999);

if(Auth::user()){
$order= new ProductCategory();
  
 
    $order->order_code =$random;
    $order->user_id =Auth()->user()->id;
     $order->name =$request->name; 
    $order->email =$request->email;
    $order->address=$request->address;
    $order->number=$request->number;
    $order->payment_method=$request->payment_method;
    $order->grand_total =$request->total;
    $order->status="paid";
    $order->save();

}else{
    $order= new ProductCategory();
   $order->order_code =$random;
    $order->user_id =null;
     $order->name =$request->name; 
    $order->email =$request->email;
    $order->address=$request->address;
    $order->number=$request->number;
    $order->payment_method=$request->payment_method;
    $order->grand_total =$request->total;
    $order->status="paid";
    $order->save();
}


 
     return redirect(url('/'));
          
        }
  
        dd('Something is wrong.');
    }
   
    
    
    
    
    
    //
}

<?php

namespace App\Http\Controllers\Front;

use App\Models\CustomerQuestion;
use App\Models\OrderAskQuestion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;


class QuestionController extends Controller
{

    
  public function ask_question(Request $request){
   
    return view('front.pages.ask_question');
  }


  public function fillup_question(Request $request){
 
    $question = $request->session()->get('question');

    
   
     
       $question=[       
      'name'=>$request->name,
      "email"=> $request->email,
      "number"=>$request->number,
      "gender"=>$request->gender,
      "occupation"=>$request->occupation,
      "category_id"=>$request->category_id,
     "price"=>$request->price,
     "question" => $request->question,
      "grand_total"=>$request->total
       ];
      
      
    session()->put('question',$question);
    session()->save();

 

    return redirect()->route('ask.question.paynow');
  }


  public function paynow(Request $request){
    $question = $request->session()->get('question');
    if(session('question')){
      
      $total=$question['grand_total'];
        $fix_total=$total[0];
      $random = rand(1000000000000,9999999999999);
   
  
    return view('front.pages.paynow',compact('fix_total','random'));

    }else{

      session()->flash('success','You donot select the question for asking purpose');
      return redirect()->route('ask.question');
    }

}

    public function pay_now(Request $request){
    
     
     $payment=session()->get('payment');

      $payment=[    
      'payment'=>"cash"
      ];

      session()->put('payment',$payment);
      session()->save();
   
    return redirect()->route('order.question');    

}

   public function order_question(){



         if(session('question')){

  $question=session()->get('question');
  $payment=session()->get('payment');
  $guest = rand(1000000000000,9999999999999);
  $random = rand(1000000000000,9999999999999);
  $price=$question['price'];
  $questio=$question['question'];

 if($price==0){
  $min = min(array(count($questio)));
  $keysOne =0;
 } else{
  $min = min(count($price), count($questio));
  $keysOne = array_keys($price);
 }
  
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
    "payment_method"=> session('payment')['payment'], 
      "status" =>"pending",
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
    "payment_method"=> session('payment')['payment'], 
      "status" =>"pending",
    ]);
 
}

for($i = 0; $i < $min; $i++) {

if($price==0){

  if(Auth::user()){
    CustomerQuestion::create([
      "orderquestion_id"=>$order->id,
      "guest_id"=>null,
      "user_id"=>Auth::user()->id,
     "price"=>0,
     "question"=>$questio[$keysTwo[$i]]
    ]);

  }else{
    CustomerQuestion::create([
      "orderquestion_id"=>$order->id,
      "guest_id"=> $guest,
      "user_id"=>null,
     "price"=>0,
     "question"=>$questio[$keysTwo[$i]]
    ]);
  }

}else{

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
}


  session()->forget('question');
  session()->forget('payment');
    
    return view('front.pages.question_order');
  }else{

  session()->flash('success','You donot select the question for asking purpose');
  return redirect()->back();

  }


  }






//
}

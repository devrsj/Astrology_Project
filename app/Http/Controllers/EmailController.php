<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\FirstEmail;
use App\Models\Service_provider;
use App\Models\OrderAskQuestion;
use App\Models\Order;
use PDF;
use Image;


use Illuminate\Http\Request;

class EmailController extends Controller
{

    public function sendEmail() {
        
        $to_email = "kumchaudari@gmail.com";
        Mail::to($to_email)->send(new FirstEmail);
        return "<p> Success! Your E-mail has been sent.</p>";
    }

    public function index()
    {
        $data["email"] = "kumchaudari@gmail.com";
        $data["title"] = "How r u..?";
        $data["body"] = "Hello dad";
        Mail::send('emails.myTestMail', $data, function($message)use($data, $files) {
            $message->to($data["email"], $data["email"])
                    ->subject($data["title"]);
        });
        dd('Mail sent successfully');
    }
    
    
    public function review(Request $request){
      
      
           if($request->hasFile('image')){
          
             $avatar = $request->file('image');
        $filename = time() . '.' . $avatar->getClientOriginalExtension();
        Image::make($avatar)->resize(170,154)->save( public_path('storage/posts/' . $filename ) );
        
        $review=new Service_provider();
        $review->name=$request->name;
        $review->email=$request->email;
         $review->product=$request->product_name;
        $review->description=$request->message;
        $review->status=0;
        $review->image=$filename;
        $review->save();
           }else{
               
        $review=new Service_provider();
        $review->name=$request->name;
        $review->email=$request->email;
        $review->product=$request->product_name;
        $review->description=$request->message;
        $review->status=0;
        $review->image=$request->image;
        $review->save();
               
           }
       session()->flash('success','comment will be shown after verfiy by admin');
      return redirect()->back();
    }
    
    
       public function generatePDF(Request $request){
        $pdf = PDF::loadView('front.pages.client_receipt');
        return $pdf->download('Order_Receipt.pdf');

       }
       
        public function question_pdf(Request $request){
        $pdf = PDF::loadView('front.pages.question_pdf');
        return $pdf->download('Orderquestion_Receipt.pdf');

       }
       
       
        public function orderproduct_pdf(Request $request){
         
          $id=$request->id;
         $order=Order::where('id',$id)->first();

        $pdf = PDF::loadView('admin.pdf.order_product',compact('order'));
        return $pdf->download('Order_Receipt.pdf');

       }
       
        public function questionorder_pdf(Request $request){
       
         
         $id=$request->id;
     
        $order=OrderAskQuestion::where('id',$id)->first();
     
        $pdf = PDF::loadView('admin.pdf.order_question',compact('order'));
        return $pdf->download('Orderquestion.pdf');
  

       }
       
       
       
       
    //
}

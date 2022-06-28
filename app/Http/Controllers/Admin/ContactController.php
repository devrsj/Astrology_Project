<?php

namespace App\Http\Controllers\Admin;
use App\Models\Appointment;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderAskQuestion;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts=Contact::all();
        return view('admin.contact.index',compact('contacts'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
        $contact = new Contact;
        $conact->name=$request->name;
        $contact->email= $request->email;
        $contact->number=$request->number;
        $contact->subject= $request->subject;
        $contact->message = $request->message;
        $contact->save();
        session()->flash('success','Message sucesfully sent');
        return redirect()->back();
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    
     
        public function search_appo(Request $request){
        $search_date=$request->search_date;
        $search_status=$request->search_status;
        
            if($search_status=="reply"){
            $seappointments=Appointment::whereDate('created_at', '=', $search_date)->where('status','Reply')->get();
            return view('admin.appointment.search_appo',compact('seappointments','search_status','search_date')); 
            }else if($search_status=="pending"){
            $seappointments=Appointment::whereDate('created_at', '=', $search_date)->where('status',$search_status)->get();
            return view('admin.appointment.search_appo',compact('seappointments','search_status','search_date')); 
            }else{
                abort('404');
                
            }
            
            
        
    }
    
    
    public function appo(Request $request){
      
        $start_date=$request->from;
        $end_date=$request->to;
        $search_status=$request->search_status;
         
            if($search_status=="reply"){
                  $seappointments=Appointment::where('created_at','>=', $start_date)
                        ->where('created_at','<=', $end_date)->where('status','Reply')->get();
                          return view('admin.appointment.search',compact('seappointments','search_status','start_date','end_date')); 
            }else if($search_status=="pending"){
                       
                        $seappointments=Appointment::whereDate('created_at','>=', $start_date)
                        ->whereDate('created_at','<=', $end_date)->where('status',$search_status)->orderBy('id','desc')
                        ->get();
                        
                                     
                          return view('admin.appointment.search',compact('seappointments','search_status','start_date','end_date')); 
            }else{
                abort('404');
                
            }
        
    }
    
    
    
    
    
    
    
    public function service_product(Request $request){
   
               $variant=$request->variant_product;
              $i=1;
        
             if($variant=="all"){
                   
                  
              $subundercategories=Product::where('category_id','=',null)->get();
             return view('admin.subundercategory.search',compact('subundercategories','i','variant')); 
               }else if($variant=="low-to-high"){
                   
              $subundercategories=Product::where('category_id','=',null)->orderBy('sp','asc')->get();
                       return view('admin.subundercategory.search',compact('subundercategories','i','variant')); 
               }else if($variant=="high-to-low"){
                   
              $subundercategories=Product::where('category_id','=',null)->orderBy('sp','desc')->get();
                       return view('admin.subundercategory.search',compact('subundercategories','i','variant')); 
               }else if($variant=="latest-service-products"){
                   
              $subundercategories=Product::where('category_id','=',null)->orderBy('id','desc')->get();
                       return view('admin.subundercategory.search',compact('subundercategories','i','variant')); 
              
               }else if($variant=="older-service-products"){
                   
              $subundercategories=Product::where('category_id','=',null)->orderBy('id','asc')->get();
                       return view('admin.subundercategory.search',compact('subundercategories','i','variant')); 
               }else{
                   abort('404');
    }
    
    
    }
    
    public function search_variantproduct(Request $request){
          $variant=$request->variant_product;
          
               $variant=$request->variant_product;
              $i=1;
        
             if($variant=="all"){
                   
                  
             $products=Product::where('subcategory_id','=',null)->get();
        
            return view('admin.product.variant_product',compact('i','products','variant'));
               }else if($variant=="low-to-high"){
               
              $products=Product::where('subcategory_id','=',null)->orderBy('sp','asc')->get();
                       return view('admin.product.variant_product',compact('i','products','variant'));
               }else if($variant=="high-to-low"){
                   
              $products=Product::where('subcategory_id','=',null)->orderBy('sp','desc')->get();
                      return view('admin.product.variant_product',compact('i','products','variant'));
               }else if($variant=="latest-products"){
                   
              $products=Product::where('subcategory_id','=',null)->orderBy('id','desc')->get();
                       return view('admin.product.variant_product',compact('i','products','variant'));
              
               }else if($variant=="older-products"){
                   
              $products=Product::where('subcategory_id','=',null)->orderBy('id','asc')->get();
                      return view('admin.product.variant_product',compact('i','products','variant'));
               }else{
                   abort('404');
    }
          
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
       public function  search_order(Request $request){
        $search_date=$request->search_date;
        
         $search_status=$request->search_status;
     
        
               if($search_status=="pending"){
               
        $orders=OrderAskQuestion::whereDate('created_at', '=', $search_date)->where('status',$search_status)->get();
                       return view('admin.ask_question.search_order',compact('orders','search_status','search_date')); 
               }else if($search_status=="delivered"){
                   
                   $orders=OrderAskQuestion::whereDate('created_at', '=', $search_date)->where('status',$search_status)->get();
                                 return view('admin.ask_question.search_order',compact('orders','search_status','search_date')); 
               }else{
                  abort('404'); 
               }   
               
               
    }
    
    
     public function order_question(Request $request){
        $start_date=$request->from;
        $end_date=$request->to;
         $search_status=$request->search_status;
     
        
               if($search_status=="pending"){
               
        $orders=OrderAskQuestion::where('created_at', '>=', $start_date)
                        ->where('created_at', '<=', $end_date)->where('status',$search_status)->get();
                       return view('admin.ask_question.search',compact('orders','search_status','start_date','end_date')); 
               }else if($search_status=="delivered"){
                   
                   $orders=OrderAskQuestion::where('created_at', '>=', $start_date)
                        ->where('created_at', '<=', $end_date)->where('status','Reply')->get();
                                 return view('admin.ask_question.search',compact('orders','search_status','start_date','end_date')); 
               }else{
                  abort('404'); 
               }   
               
               
    }
    
     public function search_product(Request $request){
        $start_date=$request->from;
        $end_date=$request->to;
        $search_status=$request->search_status;
        
          if($search_status=="pending"){
                $orders=Order::where('created_at', '>=', $start_date)
                        ->where('created_at', '<=', $end_date)->where('status',$search_status)->get();
                             return view('admin.product.search',compact('orders','search_status','start_date','end_date')); 
              
          }else if($search_status=="processing"){
                $orders=Order::where('created_at', '>=', $start_date)
                        ->where('created_at', '<=', $end_date)->where('status',$search_status)->get();
                        
                   return view('admin.product.search',compact('orders','search_status','start_date','end_date')); 
          }else if($search_status=="completed"){
                $orders=Order::where('created_at', '>=', $start_date)
                        ->where('created_at', '<=', $end_date)->where('status',$search_status)->get();
                             return view('admin.product.search',compact('orders','search_status','start_date','end_date')); 
              
          }else if($search_status=="decline"){
                $orders=Order::where('created_at', '>=', $start_date)
                        ->where('created_at', '<=', $end_date)->where('status',$search_status)->get();
                         return view('admin.product.search',compact('orders','search_status','start_date','end_date')); 
              
          }else{
              abort('404');
          }
          
    }
    
    
         public function searchproduct(Request $request){
        $search_date=$request->search_date;
       
        $search_status=$request->search_status;
        
          if($search_status=="pending"){
                $orders=Order::whereDate('created_at', '=', $search_date)->where('status',$search_status)->get();
                             return view('admin.product.search_product',compact('orders','search_status','search_date')); 
              
          }else if($search_status=="processing"){
                $orders=Order::whereDate('created_at', '=', $search_date)->where('status',$search_status)->get();
                        
                   return view('admin.product.search_product',compact('orders','search_status','search_date')); 
          }else if($search_status=="completed"){
                $orders=Order::whereDate('created_at', '=', $search_date)->where('status',$search_status)->get();
                             return view('admin.product.search_product',compact('orders','search_status','search_date')); 
              
          }else if($search_status=="decline"){
                $orders=Order::where('status',$search_status)->get();
                         return view('admin.product.search_product',compact('orders','search_status','search_date')); 
              
          }else{
              abort('404');
          }
          
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact=Contact::find($id);
        $contact->delete();
        session()->flash('error','Contact infromation succesfully deleted');
        return redirect()->back();
        //
    }
}

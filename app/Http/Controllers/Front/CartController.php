  <?php

  namespace App\Http\Controllers\Front;

  use App\Models\OrderAskQuestion;
  use App\Models\AskQuestion;
  use App\Models\Product;
  use App\Http\Controllers\Controller;
  use Illuminate\Http\Request;

  class CartController extends Controller
  {

      public function index(){
          return view('front.pages.cart');
      }

      public function add(Request $request,$id){

          $product=Product::find($id);
          $q=$request->quantity;
          $cart=session()->get('cart');
         
     
          if(!$cart){
             
              $cart=[
                $product->id =>[     
                    'id' => $product->id,
                    "category_id"=> $product->category_id,
                    'name'=>$product->name,
                    'quantity' => 1,
                    'sp'=>$product->sp,
                    'photo'=> $product->image,
                ]
              ];
          
     session()->put('cart',$cart);

     return redirect()->back()->with('success','Product Added To Cart');
         

  }

          if(isset($cart[$product->id])){
             if($cart[$product->id]['category_id']==null){
              return redirect()->back()->with('success','Already Added To Cart');
             }else{
              if($request->quantity > 1){
                  $p=$cart[$product->id]['quantity'];    
                 $cart[$product->id]['quantity']=$p+ $q;
              }else{
              $cart[$product->id]['quantity']++;
              }
              session()->put('cart',$cart);
            
              return redirect()->back()->with('success','Product Added To Cart');
             }
          }

        
              $cart[$product->id]=[   
              'id' => $product->id,
              'name'=>$product->name,
              "category_id"=> $product->category_id,
              'quantity' => 1,
              'sp'=>$product->sp,
              'photo'=>$product->image,
               ];
    
          session()->put('cart',$cart);
     
        return redirect()->back()->with('success','Product Added To Cart');
        
    

        
      }

  public function hello(){
          
          $output="";
       
  $htotal=0;
    
  if(session('cart')){
  foreach(session('cart') as $id => $product){

  $hsub_total=$product['sp'] * $product['quantity'];
  $htotal +=$hsub_total;

  }
  }
                                          
                                      $output .='<div class="as_cart">'.
                                              '<div class="as_cart_wrapper">'.
                                                  
                              '<span><img src="front_assets/assets/images/svg/cart.svg" alt=""><span class="as_cartnumber">';
                                                      
                                                       if(session('cart')){
                                               'count(Session(cart))';
                                                       }else{
                                              '0';
                                                       }
                                                 $output .='</span></span>NPR'.$htotal.'</div>'.
   
                                              '<div class="as_cart_box">';
                                                   if(session('cart')){
                                                  $output .='<div class="as_cart_list">'.
                                                      '<ul>';
                                                           
                                                 $total=0;
                                                      
                                                  
                                                    foreach(session('cart') as $id => $product){
                                                   
                                                    $sub_total=$product['sp'] * $product['quantity'];
                                                    $total +=$sub_total;
                                                   
                                                          
                                                          $output .='<li>'.
                                                              '<div class="as_cart_img">'.
                                                           '<img src="'.url('/').' /storage/posts/'.$product['photo'].'"  class="img-responsive">'.
                                                              '</div>'.
                                                             '<div class="as_cart_info">'.
                                                                  '<a href="#">'.$product['name'].'</a>'.
                                                                  '<p>'.$product['sp']  * $product['quantity'].'</p>'.
                                              
                                                              '</div>'.
                                                          '</li>';
                                                          
                                                          }
                                                        
                                                          
                                                      $output .='</ul>'.
                                                  '</div>'.
                                                  '<div class="as_cart_total">'.
                                                      '<p>total<span>NPR '.$total.'</span></p>'.
                                                  '</div>'.
                                                  '<div class="as_cart_btn">'.
                                                  '<a href="'.route('cart').'"><button type="button" id="view_cart" data-toggle="modal" data-target=".bd-example-modal-lg" class="as_btn">view cart</button></a>';
                                                     if(Auth::user()){
                                                   $output .='<a href="'.route('cart').'">    <button type="button" class="as_btn">checkout</button></a>';
                                                     }else{
                                                   $output .='<button type="button" class="as_btn" data-toggle="modal" data-target="#myModal">checkout</button>';
                                                     }
                                                  $output .='</div>';
                                                   }else{
                                                  $output .='<p>Empty Carts</p>';
                                                   }
                                              $output.='</div>'.
                                          '</div>';
   return Response()->json($output);
      }
      
      
      
    public function destroy($id){
     
      $cart=session()->get('cart');

      if(isset($cart[$id])){
          unset($cart[$id]);
          session()->put('cart',$cart);
          return redirect()->back()->with('success','Product Deleted From Cart');
      }

    }


    public function changeQty(Request $request,Product $product){

      $cart=session()->get('cart');

      if($request->change_to=="down"){

          if(isset($cart[$product->id])){

              $cart[$product->id]['quantity']--;
              session()->put('cart',$cart);
              return redirect()->back()->with('success','Quantity Updated');
          }
      
      }else{

          if(isset($cart[$product->id])){

              $cart[$product->id]['quantity']++;
              session()->put('cart',$cart);
              return redirect()->back()->with('success','Quantity Updated');
          }
      
      }
    }
    public function ask_question(Request $request){
     
      return view('front.pages.ask_question');
    }



    public function question($category_id){
     
      $output = "";
      $questions=AskQuestion::where('category_id',$category_id)->get();
      $total=0;
      if($questions->count() > 0){
          foreach($questions as $question){
             
              $total +=$question['price'];

              $output .= 
              '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">'.
              '<label>Price</label>'.
              '<div class="form-group">'.
                  '<input class="form-control" name="price[]" type="number" readonly="readonly" placeholder="price" value="'.$question->price.'"  multiple>'.
              '</div>'.
          '</div>'.
              '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">'.
                        '<div class="form-group">'.
                    '<label>Question</label>'.
   '<textarea  name="question[]" rows="5"'. 
   'style="width:100%" readonly="readonly"   multiple>'.$question->question.'</textarea>'.
                  '</div>'.
          '</div>';
      
          }
          $output .=  '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">'.
          '<label>Total Price</label>'.
          '<div class="form-group">'.

              '<input class="form-control" name="total[]" type="number" readonly="readonly" placeholder="price" value="'.$total.'" multiple>'.
          
              '</div>'.
      '</div>';
      }else{
          $output .= 
          
          '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">'.
          '<div class="form-group">'.
          '<label style="color:red">Price Can Included Through Contact Number Means Negotation</label>'.

        '</div>'.
  '</div>'.






          '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">'.
                    '<div class="form-group">'.
                    '<label>Question</label>'.
   '.<textarea  name="question[]"   rows="5" style="width:100%" required="required" multiple></textarea>'.
                  '</div>'.
      '</div>'.

   
  '<input type="hidden" value="0" name="price">'.
    '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">'.
      '<label>Total Price</label>'.
      '<div class="form-group">'.
          '<input class="form-control" readonly="readonly" name="total" type="number" placeholder="price" value="'.$total.'" multiple>'.
      '</div>'.
  '</div>';
      }
      return Response()->json($output);
    }







      //
  }

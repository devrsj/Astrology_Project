<?php

namespace App\Http\Controllers\Front;

use App\Mail\ReplyMail;
use Mail;

use App\Models\Category;
use App\Models\Setting;
use App\Models\Contact;
use App\Models\Blog;

use App\Models\SubCategory;
use App\Models\SubUnderCategory;
use App\Models\Media;
use App\Models\Product;
use App\Models\Page;
use App\Models\Tag;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\FranchiseRequest;
use App\Models\Shipment;
use App\Models\Shipment_status;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class IndexController extends Controller
{

    public function index(){
     return view('front.home.index');
     
    }


    public function page(){
        
    	return view('front.pages.index');
    }

    public function subservices($slug){
        
        
 $service=SubCategory::where('slug',$slug)->where('status',1)->first();
     $subunder_cat=Product::where('slug',$slug)->where('status',1)->first();
        $page=Page::where('slug',$slug)->where('status',1)->first();
       
         $service_page=Category::where('slug',$slug)->where('status',1)->first();
       
       
        if($page !==null){
           return view('front.pages.index',compact('page'));
        }else if($subunder_cat !==null) {
        
        return view('front.pages.service_detail',compact('subunder_cat'));
        }else if($service !==null){
            
          return view('front.pages.service',compact('service')); 
        }else if($service_page !==null){
                return view('front.pages.service',compact('service_page'));
          
        }else{
             abort('404');  
        }
        
        
        
        
        
        
     }
     
     
     
 
 
     
     
     
     public function subundercat_slug($name,$slug,$subundercat_slug){

    $subunder_cat=Product::where('slug',$subundercat_slug)->where('status',1)->first();
          

    }




   public function subchild_page($subchild_slug){
       
      return view('front.pages.subchild_page',compact('subchild_slug'));
      
    }

     public function readabout($slug){
 
       return view('front.pages.readmore',compact('slug'));

    }


    public function store(Request $request){


        Contact::create([
       "name" =>$request->name,
       "email" =>$request->email,
       "number"=>$request->number,
       "subject"=>$request->subject,
       "message"=>$request->message,
      ]);

        session()->flash('success','Message sucesfully sent');
        return redirect()->back();
    }





     public function blog_detail($blogslug){

        $blog_detail=Blog::where('slug',$blogslug)->where('status',1)->first();
    	return view('front.pages.blog_detail',compact('blog_detail'));

    }


      public function tags($tag){
          
            $tag_blog=Tag::findorfail($tag);
            $tags=$tag_blog->blogs()->simplePaginate(15); 
           return view('front.pages.blog_detail',compact('tags','tag_blog'));
           
    }



    public function search(){
          $search=request()->query('search');
       $blogs= Blog::where('heading','LIKE','%'.$search.'%')->OrderBy('weight','asc')->Paginate(18);
         return view('front.pages.blog_detail',compact('search','blogs'));


    }

      public function search_product(){
       
          $search_product=request()->query('search_product');
       $search_products= Product::where('name','LIKE','%'.$search_product.'%')->where('subcategory_id','=',null)->OrderBy('weight','asc')->Paginate(18);
         return view('front.pages.shop',compact('search_product','search_products'));
    }


   public function support($subchild_slug){

    return view('front.pages.support',compact('subchild_slug'));
   }


      public   function profile(){
       
       $address=Address::where('user_id',auth()->user()->id)->first();
       return view('front.user.profile',compact('address'));
       
   }
  
   function profileUpdate(Request $request){

      DB::transaction(function () use($request) {
        $validate= $this->validate($request,[
            'name'=>'required',
        ]);
        $id=auth()->user()->id;
        $user=User::find($id);
        $user->name=$request->name;
        $user->save();

        $addressValidate=$this->validate($request,[
            'city'=>'required',
            'country'=>'required',
            'postal_code'=>'numeric|min:4',
        ]);
        $address=Address::updateOrCreate(['user_id'=>auth()->user()->id],$addressValidate);
      });
      return back()->with('success','Profile Updated Successfully');

   }
   
   function changePassword(Request $request){
    $request->validate([
        'current_password' => ['required', new MatchOldPassword],
        'new_password' => ['required'],
        'new_confirm_password' => ['same:new_password'],
    ]);
    User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

    session()->flash('success','Password change succesfully');
    return redirect()->back();
   }

 

    function singlephoto($category_id){
    
    $category_name=Category::where('id',$category_id)->first();
    $single_photos=Media::where('gallerycategory_id',$category_id)->where('status',1)->OrderBy('weight','asc')->simplePaginate(18);
    return view('front.pages.singlephoto',compact('single_photos','category_name'));
    
    }

      public function categorydetail($id){
    
      $category_blogs=Blog::where('category_id',$id)->SimplePaginate(2);
      $category=Category::where('id',$id)->first();
      return view('front.pages.blog_detail',compact('category_blogs','category'));
    }

     public function product_category($slug){
    
      $i=Category::where('slug',$slug)->first();
      $id=$i->id;
     
      $product_categories=Product::where('category_id',$id)->where('subcategory_id','=',null)->OrderBy('weight','asc')->where('status',1)->SimplePaginate(18);
      $product_category=Category::where('id',$id)->where('status',1)->where('position','product')->first();
      return view('front.pages.shop',compact('product_categories','product_category'));
    }


    public function product_slug($slug){

 $product=Product::where('slug',$slug)->where('subcategory_id','=',null)->where('status',1)->first();
 return view('front.pages.shop_single',compact('product'));

    }

public function subcat_slug($name,$subcat_slug){


 $service=SubCategory::where('slug',$subcat_slug)->where('status',1)->first();
 
 if($service==null){
     abort('404');
 }else{
     return view('front.pages.service',compact('service','name')); 
 }


    }


    public function user_dashboard(){
      return view('front.user.user_dashboard');
    }

  
    public function book_appointment(){
      return view('front.pages.appointment');
    }


    public function subservice_slug($sub_service){
      $output = "";
   
  
 $subservices=Product::where('subundercategory_id',$sub_service)->where('status',1)->get();
   
   
    $total=0;
    if($subservices->count() > 0){

        foreach($subservices as $subservice){
            $output .= 
'<option value="'.$subservice->id.'">'.$subservice->name.'</option>';
        }
    }else{
        $output .='<option value="">No subservice found</option>';

    }
    return Response()->json($output);

    }

    public function sendmail(){

  
   $name="Sachin sharma";
   Mail::to(['sachintrivedi74@gmail.com'])->send(new ReplyMail($name));
  dd('sendmail');

    }

   
    //
}


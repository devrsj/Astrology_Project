<?php

namespace App\Http\Controllers\Admin;

use Image;
use App\Models\Product;
use App\Models\Service_provider;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $i=1;
         $products=Product::where('subcategory_id','=',null)->get();
        
       return view('admin.product.index',compact('i','products'));
        //
    }
    
      public function review()
    {
       $products=Service_provider::all();
   
       return view('admin.product.review',compact('products'));
        //
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          return view('admin.product.create');
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
          $this->validate(request(),[    
             "name"=> "required|min:3",
             "banner"=> "required|mimes:jpeg,png,jpg,gif",
             "image"=> "required|mimes:jpeg,png,jpg,gif",
           ]);  


   if($request->hasFile('banner') && $request->hasFile('image') && $request->hasFile('image1') && 
  $request->hasFile('image2') && $request->hasFile('image3')==null){
       
       $image0 = $request->file('banner');
            $destinationPath0= 'public/storage/posts/';
            $filename0 = date('YmdHis') . "." . $image0->getClientOriginalExtension();
            $image0->move($destinationPath0, $filename0);
       
    
             $image = $request->file('image');
            $destinationPath = 'public/storage/posts/';
            $filename = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $filename);
       

             $image1 = $request->file('image1');
            $destinationPath1 = 'public/storage/posts/';
            $filename1 = date('YmdHis') . "." . $image1->getClientOriginalExtension();
            $image1->move($destinationPath1, $filename1);
       

             $image2 = $request->file('image2');
            $destinationPath2 = 'public/storage/posts/';
            $filename2 = date('YmdHis') . "." . $image2->getClientOriginalExtension();
            $image2->move($destinationPath2, $filename2);
       

       



 
  
      Product::create([
           "name" => $request->name,
           "category_id"=>$request->category_id,
           "short_description"=> $request->short_description,
           "description"=>$request->description,

           "banner"=> $filename0,
           "image" => $filename,
           "image1"=> $filename1,
           "image2" => $filename2,
           "quantity"=>$request->quantity,
           "mp"=>$request->mp,
           "sp"=>$request->sp,
           "meta_title"=>$request->meta_title,
           "meta_description"=>$request->meta_description,
           "weight"=>$request->weight,
           "status"=> $request->status,
           "slug"=>preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.str::random(5)

         ]);

           }
           

           
if($request->hasFile('banner') && $request->hasFile('image') && $request->hasFile('image1') && 
  $request->hasFile('image2')==null && $request->hasFile('image3')){
    $image0 = $request->file('banner');
            $destinationPath0= 'public/storage/posts/';
            $filename0 = date('YmdHis') . "." . $image0->getClientOriginalExtension();
            $image0->move($destinationPath0, $filename0);
       
    
             $image = $request->file('image');
            $destinationPath = 'public/storage/posts/';
            $filename = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $filename);
       

             $image1 = $request->file('image1');
            $destinationPath1 = 'public/storage/posts/';
            $filename1 = date('YmdHis') . "." . $image1->getClientOriginalExtension();
            $image1->move($destinationPath1, $filename1);
       

       

             $image3 = $request->file('image3');
            $destinationPath3 = 'public/storage/posts/';
            $filename3 = date('YmdHis') . "." . $image3->getClientOriginalExtension();
            $image3->move($destinationPath3, $filename3);
       

        
      Product::create([
        "name" => $request->name,
        "category_id"=>$request->category_id,
        "short_description"=> $request->short_description,
        "description"=>$request->description,

        "banner"=> $filename0,
        "image" => $filename,
        "image1"=> $filename1,
        "image3" => $filename3,
        "quantity"=>$request->quantity,
        "mp"=>$request->mp,
        "sp"=>$request->sp,
        "meta_title"=>$request->meta_title,
        "meta_description"=>$request->meta_description,
        "weight"=>$request->weight,
        "status"=> $request->status,
        "slug"=>preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.str::random(5)

      ]);



}




if($request->hasFile('banner') && $request->hasFile('image') && $request->hasFile('image1')==null && 
$request->hasFile('image2') && $request->hasFile('image3')){


  $image0 = $request->file('banner');
            $destinationPath0= 'public/storage/posts/';
            $filename0 = date('YmdHis') . "." . $image0->getClientOriginalExtension();
            $image0->move($destinationPath0, $filename0);
       
    
             $image = $request->file('image');
            $destinationPath = 'public/storage/posts/';
            $filename = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $filename);
       


             $image2 = $request->file('image2');
            $destinationPath2 = 'public/storage/posts/';
            $filename2 = date('YmdHis') . "." . $image2->getClientOriginalExtension();
            $image2->move($destinationPath2, $filename2);
       

             $image3 = $request->file('image3');
            $destinationPath3 = 'public/storage/posts/';
            $filename3 = date('YmdHis') . "." . $image3->getClientOriginalExtension();
            $image3->move($destinationPath3, $filename3);
       
     
  Product::create([
    "name" => $request->name,
    "category_id"=>$request->category_id,
    "short_description"=> $request->short_description,
    "description"=>$request->description,

    "banner"=> $filename0,
    "image" => $filename,
   
    "image2" => $filename2,
    "image3"=> $filename3,
    "quantity"=>$request->quantity,
    "mp"=>$request->mp,
    "sp"=>$request->sp,
    "meta_title"=>$request->meta_title,
    "meta_description"=>$request->meta_description,
    "weight"=>$request->weight,
    "status"=> $request->status,
    "slug"=>preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.str::random(5)

  ]);

}


if($request->hasFile('banner') && $request->hasFile('image') && $request->hasFile('image1') && 
$request->hasFile('image2')==null&& $request->hasFile('image3')==null){
    
  $image0 = $request->file('banner');
            $destinationPath0= 'public/storage/posts/';
            $filename0 = date('YmdHis') . "." . $image0->getClientOriginalExtension();
            $image0->move($destinationPath0, $filename0);
       
    
             $image = $request->file('image');
            $destinationPath = 'public/storage/posts/';
            $filename = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $filename);
       

             $image1 = $request->file('image1');
            $destinationPath1 = 'public/storage/posts/';
            $filename1 = date('YmdHis') . "." . $image1->getClientOriginalExtension();
            $image1->move($destinationPath1, $filename1);
       

       
 

      
  Product::create([
    "name" => $request->name,
    "category_id"=>$request->category_id,
    "short_description"=> $request->short_description,
    "description"=>$request->description,
    "banner"=> $filename0,
    "image" => $filename,
    "image1" => $filename1,
    "quantity"=>$request->quantity,
    "mp"=>$request->mp,
    "sp"=>$request->sp,
    "meta_title"=>$request->meta_title,
    "meta_description"=>$request->meta_description,
    "weight"=>$request->weight,
    "status"=> $request->status,
    "slug"=>preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.str::random(5)

  ]);



}

if($request->hasFile('banner') && $request->hasFile('image') && $request->hasFile('image1')==null && 
$request->hasFile('image2') && $request->hasFile('image3')==null){

    $image0 = $request->file('banner');
            $destinationPath0= 'public/storage/posts/';
            $filename0 = date('YmdHis') . "." . $image0->getClientOriginalExtension();
            $image0->move($destinationPath0, $filename0);
       
    
             $image = $request->file('image');
            $destinationPath = 'public/storage/posts/';
            $filename = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $filename);
       


             $image2 = $request->file('image2');
            $destinationPath2 = 'public/storage/posts/';
            $filename2 = date('YmdHis') . "." . $image2->getClientOriginalExtension();
            $image2->move($destinationPath2, $filename2);
       

       

  Product::create([
    "name" => $request->name,
    "category_id"=>$request->category_id,
    "short_description"=> $request->short_description,
    "description"=>$request->description,
    "banner"=> $filename0,
    "image" => $filename,
    "image2" => $filename2,
    "quantity"=>$request->quantity,
    "mp"=>$request->mp,
    "sp"=>$request->sp,
    "meta_title"=>$request->meta_title,
    "meta_description"=>$request->meta_description,
    "weight"=>$request->weight,
    "status"=> $request->status,
    "slug"=>preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.str::random(5)

  ]);


}

if($request->hasFile('banner') && $request->hasFile('image') && $request->hasFile('image1')==null && 
$request->hasFile('image2')==null && $request->hasFile('image3')){

   $image0 = $request->file('banner');
            $destinationPath0= 'public/storage/posts/';
            $filename0 = date('YmdHis') . "." . $image0->getClientOriginalExtension();
            $image0->move($destinationPath0, $filename0);
       
    
             $image = $request->file('image');
            $destinationPath = 'public/storage/posts/';
            $filename = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $filename);
       

          

             $image3 = $request->file('image3');
            $destinationPath3 = 'public/storage/posts/';
            $filename3 = date('YmdHis') . "." . $image3->getClientOriginalExtension();
            $image3->move($destinationPath3, $filename3);
       

  
  Product::create([
    "name" => $request->name,
    "category_id"=>$request->category_id,
    "short_description"=> $request->short_description,
    "description"=>$request->description,
    "banner"=> $filename0,
    "image" => $fielname,
    "image3" => $filename3,
    "quantity"=>$request->quantity,
    "mp"=>$request->mp,
    "sp"=>$request->sp,
    "meta_title"=>$request->meta_title,
    "meta_description"=>$request->meta_description,
    "weight"=>$request->weight,
    "status"=> $request->status,
    "slug"=>preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.str::random(5)

  ]);

  

}

if($request->hasFile('banner') && $request->hasFile('image') && $request->hasFile('image1')==null && 
$request->hasFile('image2')==null && $request->hasFile('image3')==null){


  
   $image0 = $request->file('banner');
            $destinationPath0= 'public/storage/posts/';
            $filename0 = date('YmdHis') . "." . $image0->getClientOriginalExtension();
            $image0->move($destinationPath0, $filename0);
       
    
             $image = $request->file('image');
            $destinationPath = 'public/storage/posts/';
            $filename = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $filename);
       

       



  Product::create([
    "name" => $request->name,
    "category_id"=>$request->category_id,
    "short_description"=> $request->short_description,
    "description"=>$request->description,
    "banner"=> $filename0,
    "image" => $filename,
   
    "quantity"=>$request->quantity,
    "mp"=>$request->mp,
    "sp"=>$request->sp,
    "meta_title"=>$request->meta_title,
    "meta_description"=>$request->meta_description,
    "weight"=>$request->weight,
    "status"=> $request->status,
    "slug"=>preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.str::random(5)

  ]);

}


if($request->hasFile('banner') && $request->hasFile('image') && $request->hasFile('image1') && 
$request->hasFile('image2') && $request->hasFile('image3')){

  
             $image0 = $request->file('banner');
            $destinationPath0= 'public/storage/posts/';
            $filename0 = date('YmdHis') . "." . $image0->getClientOriginalExtension();
            $image0->move($destinationPath0, $filename0);
       
    
             $image = $request->file('image');
            $destinationPath = 'public/storage/posts/';
            $filename = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $filename);
       

             $image1 = $request->file('image1');
            $destinationPath1 = 'public/storage/posts/';
            $filename1 = date('YmdHis') . "." . $image1->getClientOriginalExtension();
            $image1->move($destinationPath1, $filename1);
       

             $image2 = $request->file('image2');
            $destinationPath2 = 'public/storage/posts/';
            $filename2 = date('YmdHis') . "." . $image2->getClientOriginalExtension();
            $image2->move($destinationPath2, $filename2);
       

             $image3 = $request->file('image3');
            $destinationPath3 = 'public/storage/posts/';
            $filename3 = date('YmdHis') . "." . $image3->getClientOriginalExtension();
            $image3->move($destinationPath3, $filename3);
       
       

  Product::create([
    "name" => $request->name,
    "category_id"=>$request->category_id,
    "short_description"=> $request->short_description,
    "description"=>$request->description,
    "banner"=> $filename0,
    "image" => $filename,
    "image1"=>$filename1,
    "image2"=>$filename2,
    "image3" => $filename3,
    "quantity"=>$request->quantity,
    "mp"=>$request->mp,
    "sp"=>$request->sp,
    "meta_title"=>$request->meta_title,
    "meta_description"=>$request->meta_description,
    "weight"=>$request->weight,
    "status"=> $request->status,
    "slug"=>preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.str::random(5)

  ]);



}
 

session()->flash('success','Product sucesfully added');
return redirect( route('product.index') );

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
        
        $product=Product::findorfail($id);
        return view('admin.product.edit',compact('product'));
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
        $product=Product::findorfail($id);
        $this->validate($request,[
                 'slug'=>'required|alpha-dash|unique:products,slug,'.$product->id,
                ]);
    
        $data=$request->only(['name','category_id','subcategory_id','subundercategory_id','short_description','description','quantity','mp',
        'sp','meta_title','meta_description','status','weight']);


        $product->slug=$request->slug;
        $product->save();

        if($request->hasfile('banner')){
             $image0 = $request->file('banner');
            $destinationPath0= 'public/storage/posts/';
            $filename0 = date('YmdHis') . "." . $image0->getClientOriginalExtension();
            $image0->move($destinationPath0, $filename0);
        
            Storage::delete($product->banner);
             $data['banner'] = $filename0;
             }
  
             if($request->hasFile('image')){
             $image = $request->file('image');
            $destinationPath= 'public/storage/posts/';
            $filename = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $filename);
        
              Storage::delete($product->image);
               $data['image'] = $filename;
             }
             if($request->hasFile('image1')){
             $image1 = $request->file('image1');
            $destinationPath1= 'public/storage/posts/';
            $filename1 = date('YmdHis') . "." . $image1->getClientOriginalExtension();
            $image1->move($destinationPath1, $filename1);
        
                Storage::delete($product->image1);
                 $data['image1'] = $filename1;
     
    
               }

               if($request->hasFile('image2')){
             $image1 = $request->file('image2');
            $destinationPath1= 'public/storage/posts/';
            $filename1 = date('YmdHis') . "." . $image1->getClientOriginalExtension();
            $image1->move($destinationPath1, $filename1);
                Storage::delete($product->image2);
                 $data['image2'] = $filename1;
    
               }

               if($request->hasFile('image3')){
             $image1 = $request->file('image3');
            $destinationPath1= 'public/storage/posts/';
            $filename1 = date('YmdHis') . "." . $image1->getClientOriginalExtension();
            $image1->move($destinationPath1, $filename1);
                Storage::delete($product->image3);
                 $data['image3'] = $filename1;
               }
                
  
  
        $product->update($data);
        session()->flash('success','Product  sucesfully updated');
        return redirect( route('product.index') );
          //
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $product=Product::findorfail($id);
        $product->delete();
        session()->flash('error','Product  sucesfully deleted');
        return redirect(route('product.index'));

        //
    }
      public function review_delete($id)
    {
   
        $product=Service_provider::findorfail($id);
        $product->delete();
        session()->flash('error','Review  sucesfully deleted');
         return redirect(url('admin/product/review'));

        //
    }

    public function review_reply($id){
        $reply=Service_provider::findorfail($id);
        return view('admin.product.review_reply',compact('reply'));
        
    }
     
     public function review_show($id){
        dd($id);
    }

     public function status($id){
      
        $product=Product::find($id);  
        if($product->status== 1){
            $product->status = 0;
        }else{
            $product->status =1;
        }
        session()->flash('success','status has been succesfully changed');
        $product->save();
            return redirect(route('product.index'));
      }
        public function review_status($id){
      
        $product=Service_provider::find($id);  
        if($product->status== 1){
            $product->status = 0;
        }else{
            $product->status =1;
        }
        session()->flash('success','status has been succesfully changed');
        $product->save();
            return redirect(url('admin/product/review'));
      }
      

}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\SubUnderCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;


class SubUnderCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
               $i=1;
              $subundercategories=Product::where('category_id','=',null)->get();
             return view('admin.subundercategory.index',compact('subundercategories','i'));
        //
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

     return view('admin.subundercategory.create');
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
             "image"=> "required|mimes:jpeg,png,jpg,gif",
             "banner"=> "required|mimes:jpeg,png,jpg,gif"

           ]); 
             
         
                 $image = $request->file('banner');
                $destinationPath = 'public/storage/posts/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
                


 
                 $image1 = $request->file('image');
                $destinationPath1 = 'public/storage/posts/';
            $profileImage1 = date('YmdHis') . "." . $image1->getClientOriginalExtension();
            $image1->move($destinationPath1, $profileImage1);
                

             
       
             Product::create([
             "name" => $request->name,
             "subcategory_id"=> $request->category_id,
             "subundercategory_id"=> $request->subcategory_id,
             "short_description" => $request->short_description,
             "description" => $request->description,
              "banner" =>  $profileImage,
              "image" =>  $profileImage1, 
              "sp"=>$request->price,
             
             "meta_title"=> $request->meta_title,
             "meta_description" => $request->meta_description,
             "weight"=> $request->weight,
             "status" => $request->status,
             "slug" =>preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.str::random(5)
         ]);


   session()->flash('success','service products  sucesfully added');
  return redirect( route('subundercategory.index') );
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

     
        $subundercategory=Product::findorfail($id);
        return view('admin.subundercategory.edit',compact('subundercategory'));
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

      
        $subundercategory=Product::findorfail($id);
       $this->validate($request,[
                 'slug'=>'required|alpha-dash|unique:products,slug,'.$subundercategory->id,
                ]);

      $data=$request->only(['name','description','short_description','meta_title','meta_description','weight']);
     
          $subundercategory->slug=$request->slug;
          $subundercategory->subcategory_id=$request->category_id;
          $subundercategory->subundercategory_id=$request->subcategory_id;
          $subundercategory->sp=$request->price;
          $subundercategory->save();


           


      if($request->hasfile('banner')){
           
                 $image = $request->file('banner');
                $destinationPath = 'public/storage/posts/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
                
          Storage::delete($subundercategory->banner);
           $data['banner'] = $profileImage;
          

           }

           if($request->hasFile('image' )){
       
                 $image = $request->file('image');
                $destinationPath = 'public/storage/posts/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
                
            Storage::delete($subundercategory->image);
             $data['image'] = $profileImage;
           

           }

      $subundercategory->update($data);
      session()->flash('success','service products  sucesfully updated');
      return redirect( route('subundercategory.index') );
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
          $subundercategory=Product::findorfail($id);

          $subundercategory->delete();
          session()->flash('error','service products  sucesfully deleted');
          return redirect(route('subundercategory.index'));
        
        //
    }

    public function status($id){
      
        $product=SubUnderCategory::find($id);  
        if($product->status== 1){
            $product->status = 0;
        }else{
            $product->status =1;
        }
        session()->flash('success','status has been succesfully changed');
        $product->save();
            return redirect(route('subundercategory.index'));
      }
}

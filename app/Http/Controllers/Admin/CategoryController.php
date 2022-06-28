<?php

namespace App\Http\Controllers\Admin;
use Image;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;



class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $i=1;
         $categories=Category::all();
       return view('admin.category.index',compact('i','categories'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          return view('admin.category.create');
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
             "name"=> "required|min:3"
           ]);
           
       
     
     
          

            if($request->hasFile('banner') && $request->hasFile('thumbnail')==null){
                
                  $image = $request->file('banner');
                $destinationPath = 'public/storage/posts/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
                
          Category::create([
         "name" => $request->name,  
         "banner"=>$profileImage,
         "thumbnail" => $request->thumbnail,
         "description"=> $request->description,
         "status" =>$request->status,
         "position"=> $request->position,
         "weight"=> $request->weight,
          "meta_title" => $request->meta_title,
          "meta_keyword" => $request->meta_keyword,
          "meta_description" => $request->meta_description,
          "slug" =>preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.str::random(5)

      ]);  
          }
          
          if($request->hasFile('banner')==null && $request->hasFile('thumbnail')){
               $image = $request->file('thumbnail');
                $destinationPath = 'public/storage/posts/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
      
            Category::create([
                "name" => $request->name,  
                "banner"=>$request->banner,
                "thumbnail" => $profileImage,
                "description"=> $request->description,
                "status" =>$request->status,
                "position"=> $request->position,
                "weight"=> $request->weight,
                 "meta_title" => $request->meta_title,
                 "meta_keyword" => $request->meta_keyword,
                 "meta_description" => $request->meta_description,
                 "slug" =>preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.str::random(5)
       
             ]);



          }

          

          if($request->hasFile('banner')==null && $request->hasFile('thumbnail')==null){



            Category::create([
                "name" => $request->name,  
                "banner"=>$request->banner,
                "thumbnail" =>$request->thumbnail,
                "description"=> $request->description,
                "status" =>$request->status,
                "position"=> $request->position,
                "weight"=> $request->weight,
                 "meta_title" => $request->meta_title,
                 "meta_keyword" => $request->meta_keyword,
                 "meta_description" => $request->meta_description,
                 "slug" =>preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.str::random(5)
       
             ]);
          }
          

          if($request->hasFile('banner') && $request->hasFile('thumbnail')){
      
        
           $image1 = $request->file('banner');
                $destinationPath1 = 'public/storage/posts/';
            $profileImage1 = date('YmdHis') . "." . $image1->getClientOriginalExtension();
            $image1->move($destinationPath1, $profileImage1);
      
        
        
        
      $image = $request->file('thumbnail');
                $destinationPath = 'public/storage/posts/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
      
         

        Category::create([
         "name" => $request->name,  
         "banner"=>$profileImage1,
         "thumbnail" => $profileImage,
         "description"=> $request->description,
         "status" =>$request->status,
         "position"=> $request->position,
         "weight"=> $request->weight,
          "meta_title" => $request->meta_title,
          "meta_keyword" => $request->meta_keyword,
          "meta_description" => $request->meta_description,
          "slug" =>preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.str::random(5)

      ]);


          }


      session()->flash('success','categories  sucesfully added');
      return redirect( route('category.index') );
     
          
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

        $category=Category::findorfail($id);
        return view('admin.category.edit',compact('category'));
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
         
                $category=Category::findorfail($id);
                
                 $this->validate($request,[
                 'slug'=>'required|alpha-dash|unique:categories,slug,'.$category->id,
         
                ]);
                
                
                 $data=$request->only(['name','status','description',
                 'meta_title','meta_keyword','meta_description','weight']);


                 $category->slug=$request->slug;
                 $category->position=$request->position;
                 $category->status=$request->status;
                 $category->save();
                 
                 if($request->hasFile('banner')){
            $image = $request->file('banner');
            $destinationPath = 'public/storage/posts/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
                
              Storage::delete($category->banner);
            $data['banner'] =$profileImage;
        
            }

            if($request->hasFile('thumbnail')){
                $image1 = $request->file('thumbnail');
                $destinationPath1 = 'public/storage/posts/';
            $profileImage1 = date('YmdHis') . "." . $image1->getClientOriginalExtension();
            $image1->move($destinationPath1, $profileImage1);
    
             Storage::delete($category->thumbnail);
             $data['thumbnail'] =$profileImage1;
          
           }


            $category->update($data);
     session()->flash('success','categorys  sucesfully updated');
      return redirect( route('category.index') );
      

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

        $category=Category::findorfail($id);
            $category->delete();
            session()->flash('error','category data  sucesfully deleted');
            return redirect(route('category.index'));
        //
    }


    public function status($id){
      
        $category=Category::find($id);  
        if($category->status== 1){
            $category->status = 0;
        }else{
            $category->status =1;
        }
        session()->flash('success','status has been succesfully changed');
        $category->save();
            return redirect(route('category.index'));
      }

      
}

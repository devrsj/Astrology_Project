<?php

namespace App\Http\Controllers\Admin;


use App\Models\Blog;
use App\Models\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;


class BlogController extends Controller
{
     // function __construct()
     // {
     //     $this->middleware('permission:blog-index|blog-create|blog-edit|blog-delete', ['only' => ['index','show']]);
     //     $this->middleware('permission:blog-create', ['only' => ['create','store']]);
     //     $this->middleware('permission:blog-edit', ['only' => ['edit','update']]);
     //     $this->middleware('permission:blog-delete', ['only' => ['destroy']]);
     // }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.blog.index');
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog.create');
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

        if($request->hasFile('icon') && $request->hasFile('banner')==null ){
            
             $image = $request->file('icon');
            $destinationPath = 'public/storage/posts/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            
            

                     $blog=Blog::create([
                    "blog_type" => $request->blog_type,
                    "heading" => $request->heading,
                    "short_description" => $request->short_description,
                    "description" => $request->description,
                     "image" =>$profileImage,
                     "published_by" => $request->published_by,
                     "author" => $request->author,
                      "weight" => $request->weight,
                      "category_id"=>$request->category_id,
                      "meta_title" => $request->meta_title,
                      "meta_description"=> $request->meta_description,
                      "meta_keyword"=> $request->meta_keyword,
                      "slug"=> preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->heading)).'-'.str::random(5),
                      "status"=> $request->status,

                    ]);



  }


 if($request->hasFile('banner') && $request->hasFile('icon')==null){

             $image = $request->file('banner');
            $destinationPath = 'public/storage/posts/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            

                     $blog=Blog::create([
                    "blog_type" => $request->blog_type,
                    "heading" => $request->heading,
                    "short_description" => $request->short_description,
                    "description" => $request->description,
                    "banner"=>$profileImage,
                     "image" =>$request->image,
                     "published_by" => $request->published_by,
                     "author" => $request->author,
                      "weight" => $request->weight,
                      "category_id"=>$request->category_id,
                      "meta_title" => $request->meta_title,
                      "meta_description"=> $request->meta_description,
                      "meta_keyword"=> $request->meta_keyword,
                      "slug"=>  preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->heading)).'-'.str::random(5),
                      "status"=> $request->status,
                    ]);



  }

if($request->hasFile('banner') && $request->hasFile('icon') ){
           
             $image1 = $request->file('banner');
            $destinationPath1 = 'public/storage/posts/';
            $profileImage1 = date('YmdHis') . "." . $image1->getClientOriginalExtension();
            $image1->move($destinationPath1, $profileImage1);
            

       
             $image = $request->file('icon');
            $destinationPath = 'public/storage/posts/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            

                     $blog=Blog::create([
                    "blog_type" => $request->blog_type,
                    "heading" => $request->heading,
                    "short_description" => $request->short_description,
                    "description" => $request->description,
                    "banner"=> $profileImage1,
                     "image" =>$profileImage,
                     "published_by" => $request->published_by,
                     "author" => $request->author,
                      "weight" => $request->weight,
                      "category_id"=>$request->category_id,
                      "meta_title" => $request->meta_title,
                      "meta_description"=> $request->meta_description,
                      "meta_keyword"=> $request->meta_keyword,
                      "slug"=>  preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->heading)).'-'.str::random(5),
                      "status"=> $request->status,
                    ]);



  }


if($request->hasFile('banner')==null && $request->hasFile('icon')==null){
            

 $blog=Blog::create([
        "blog_type" => $request->blog_type,
        "heading" => $request->heading,
        "short_description" => $request->short_description,
        "description" => $request->description,
         "image" =>null,
         "published_by" => $request->published_by,
         "author" => $request->author,
          "weight" => $request->weight,
          "category_id"=>$request->category_id,
          "meta_title" => $request->meta_title,
          "meta_description"=> $request->meta_description,
          "meta_keyword"=> $request->meta_keyword,
          "slug"=> preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->heading)).'-'.str::random(5),

          "status"=> $request->status,

        ]);


                    



  }




  if($request->tags){
      $blog->tags()->attach($request->tags);
       }


     session()->flash('success','Blog information sucesfully added');
        return redirect( route('blog.index') );


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
          $blog=Blog::findorfail($id);
        return view('admin.blog.show',compact('blog'));
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
        $blog=Blog::findorfail($id);

        return view('admin.blog.edit',compact('blog'));
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
        $blog=Blog::findorfail($id);
          
          $this->validate($request,[
                 'slug'=>'required|alpha-dash|unique:blogs,slug,'.$blog->id,
                ]);

        $data=$request->only(['blog_type','heading','short_description','description','published_by','category_id','author','weight','meta_title',
        'meta_description','meta_keyword','status']);

     
      $blog->slug=$request->slug;
      $blog->save();
       if($request->hasFile('icon')){
       

             $image1 = $request->file('icon');
            $destinationPath1 = 'public/storage/posts/';
            $profileImage1 = date('YmdHis') . "." . $image1->getClientOriginalExtension();
            $image1->move($destinationPath1, $profileImage1);
            
                 
                   Storage::delete($blog->image);
                      $data['image'] =  $profileImage1;
                     }

if($request->hasFile('banner')){
             $image1 = $request->file('banner');
            $destinationPath1 = 'public/storage/posts/';
            $profileImage1 = date('YmdHis') . "." . $image1->getClientOriginalExtension();
            $image1->move($destinationPath1, $profileImage1);
            
                 
                   Storage::delete($blog->banner);
                      $data['banner'] =  $profileImage1;
                     }





     if($request->tags){
         $blog->tags()->sync($request->tags);
          }

     $blog->update($data);
     session()->flash('success','Blog information sucesfully updated');
         return redirect( route('blog.index') );

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
        $blog=Blog::findorfail($id);
        $blog->delete();
        session()->flash('error','Blog succesfully deleted');
        return redirect()->route('blog.index');
        //
    }
     public function status($id){


           $blog=Blog::find($id);


        if($blog->status== 1){
            $blog->status = 0;
        }else{
            $blog->status =1;
        }
        session()->flash('success','status has been succesfully updated');
        $blog->save();
            return redirect(route('blog.index'));
      }


}

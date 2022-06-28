<?php

namespace App\Http\Controllers\Admin;

use App\Models\BlogCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $i=1;
        $blogcategories=BlogCategory::all();
       return view('admin.blogcategory.index',compact('blogcategories','i'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.blogcategory.create');
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
         $validate=$this->validate(request(),[    
            "name" => "required"
        ]); 

              if($request->hasFile('banner')){
                  $avatar = $request->file('banner');
        $filename = time() . '.' . $avatar->getClientOriginalExtension();
        Image::make($avatar)->resize(500, 300)->save( public_path('storage/posts/' . $filename ) );
                 
                 
         BlogCategory::create([
        "name" => $request->name,
        "banner" => $filename,
        "meta_title"=> $request->meta_title,
         "meta_description" => $request->meta_description,
        "weight" => $request->weight,
         "status" => $request->status,
         "slug" =>preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.str::random(5)
]);
     }else{

    BlogCategory::create([
        "name" => $request->name,
        "banner" => null,
        "meta_title"=> $request->meta_title,
         "meta_description" => $request->meta_description,
        "weight" => $request->weight,
         "status" => $request->status,
         "slug" => preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.str::random(5)
]);

     }

session()->flash('success','blogcategory  sucesfully updated');
return redirect( route('blogcategory.index') );
        //
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
         $blogcategory=BlogCategory::findorfail($id);
          return view('admin.blogcategory.edit',compact('blogcategory'));
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
          $blogcategory=BlogCategory::findorfail($id);
           
           $this->validate($request,[
                 'slug'=>'required|alpha-dash|unique:blog_categories,slug,'. $blogcategory->id,
                ]);
          
        $data=$request->only(['name','weight','meta_title','meta_description']);

       

         $blogcategory->status=$request->status;
        $blogcategory->slug=$request->slug;
        $blogcategory->save();

             if($request->hasfile('banner')){
          $avatar = $request->file('banner');
        $filename = time() . '.' . $avatar->getClientOriginalExtension();
        Image::make($avatar)->resize(500, 300)->save( public_path('storage/posts/' . $filename ) );

            Storage::delete( $blogcategory->banner);
             $data['banner'] = $filename;
              $blogcategory->update($data);
             }


         $blogcategory->update($data);
        session()->flash('success','blogcategory  sucesfully updated');
        return redirect( route('blogcategory.index') );
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
            $blogcategory=BlogCategory::findorfail($id);
            $blogcategory->delete();
            session()->flash('error','blogcategory  sucesfully deleted');
            return redirect(route('blogcategory.index'));
        //
    }

    public function status($id){
      
        $blogcategory=BlogCategory::find($id);  
        if($blogcategory->status== 1){
            $blogcategory->status = 0;
        }else{
            $blogcategory->status =1;
        }
           session()->flash('success','status has been succesfully changed');
            $blogcategory->save();
            return redirect(route('blogcategory.index'));
      }



}

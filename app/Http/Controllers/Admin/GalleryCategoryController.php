<?php

namespace App\Http\Controllers\Admin;

use App\Models\GalleryCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;


class GalleryCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
           $i=1;
        $gallerycategories=GalleryCategory::all();
       return view('admin.gallerycategory.index',compact('gallerycategories','i'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gallerycategory.create');
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
      
            "name" => "required",
            "thumbnail"=> "required|mimes:jpeg,png,jpg,gif",
             "banner"=> "required|mimes:jpeg,png,jpg,gif",

      ]); 
                 $banner=$request->banner->store('posts');
                 $image=Image::make(public_path("storage/{$banner}"))->fit(1350,500);
                 $image->save();

                  $thumbnail=$request->thumbnail->store('posts');
                 $imag=Image::make(public_path("storage/{$thumbnail}"))->fit(463,505);
                 $imag->save();


             
       
         GalleryCategory::create([
        "name" => $request->name,
        "category_id" => $request->category_id,
        "description" => $request->description,
        "banner" => $banner,
        "thumbnail" => $thumbnail,
        "meta_title"=> $request->meta_title,
        "weight" => $request->weight,
         "status" => $request->status,
        "meta_description" => $request->meta_description,
         "slug" => Str::slug($request->name,'-').'.html',
]);

session()->flash('success','GalleryCategory sucesfully updated');
return redirect( route('gallerycategory.index') );
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
        $gallerycategory=GalleryCategory::findorfail($id);
        return view('admin.gallerycategory.edit',compact('gallerycategory'));


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
          $gallerycategory=GalleryCategory::findorfail($id);
        $data=$request->only(['name','description','weight','meta_title','meta_description']);

       

       $gallerycategory->status=$request->status;
      $gallerycategory->slug=$request->slug;
      $gallerycategory->save();

             if($request->hasfile('banner')){
            $banner=$request->banner->store('posts');
              $banner_image=Image::make(public_path("storage/{$banner}"))->fit(1350,500);
                 $banner_image->save();


            Storage::delete($gallerycategory->banner);
             $data['banner'] = $banner;
            
             }


              if($request->hasfile('thumbnail')){
            $thumbnail=$request->thumbnail->store('posts');
            $bimage=Image::make(public_path("storage/{$thumbnail}"))->fit(463,505);
             $bimage->save();
            Storage::delete($gallerycategory->thumbnail);
             $data['thumbnail'] = $thumbnail;
            
             }

         $gallerycategory->update($data);
        session()->flash('success','GalleryCategory  sucesfully updated');
        return redirect( route('gallerycategory.index'));

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
           $gallerycategory=GalleryCategory::findorfail($id);
            $gallerycategory->delete();
            session()->flash('warn','gallerycategory  sucesfully deleted');
            return redirect(route('gallerycategory.index'));


        //
    }

  public function status($id){
      
        $gallerycategory=GalleryCategory::find($id);  
        if($gallerycategory->status== 1){
            $gallerycategory->status = 0;
        }else{
            $gallerycategory->status =1;
        }
        session()->flash('success','status has been succesfully changed');
        $gallerycategory->save();
            return redirect(route('gallerycategory.index'));
      }



}

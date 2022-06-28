<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;
use Image;

class PageController extends Controller
{

 // function __construct()
 //     {
 //         $this->middleware('permission:page-index|page-create|page-edit|page-delete', ['only' => ['index','show']]);
 //         $this->middleware('permission:page-create', ['only' => ['create','store']]);
 //         $this->middleware('permission:page-edit', ['only' => ['edit','update']]);
 //         $this->middleware('permission:page-delete', ['only' => ['destroy']]);
 //     }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.page.index');
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.page.create');
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


         if($request->hasFile('banner') && $request->hasFile('thumbnail')==null){
              $avatar = $request->file('banner');
        $filename = time() . '.' . $avatar->getClientOriginalExtension();
        Image::make($avatar)->resize(1350, 500)->save( public_path('storage/posts/' . $filename ));

         Page::create([
            "name" => $request->name,
            "position"=> $request->position_type,
            "type"=> $request->page_type,
            "short_description" => $request->short_description,
            "description" => $request->description,
            "link" => $request->link,
            "parent_id"=> $request->parent_id,
            "banner" =>$filename,
            "weight"=> $request->weight,
            "status" => $request->status,
            "service"=>$request->service,
            "product"=> $request->product,
            "customer_section"=> $request->customer_section,
            "meta_title"=> $request->meta_title,
            "meta_description" => $request->meta_description,
            "meta_keyword" => $request->meta_keyword,
            'slug' =>preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.str::random(5)


       ]);
       }
       
       if($request->hasFile('thumbnail') && $request->hasFile('banner')==null){
             $image = $request->file('thumbnail');
                $destinationPath = 'public/storage/posts/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
        
        
         Page::create([
            "name" => $request->name,
            "position"=> $request->position_type,
            "type"=> $request->page_type,
            "short_description" => $request->short_description,
            "description" => $request->description,
            "link" => $request->link,
            "parent_id"=> $request->parent_id,
            "thumbnail" =>$profileImage,
            "weight"=> $request->weight,
             "service"=>$request->service,
            "product"=> $request->product,
            "customer_section"=> $request->customer_section,
            "status" => $request->status,
            "meta_title"=> $request->meta_title,
            "meta_description" => $request->meta_description,
            "meta_keyword" => $request->meta_keyword,
            'slug' =>preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.str::random(5)

       ]);
       }
       
       
       
       if($request->hasFile('thumbnail') && $request->hasFile('banner')){
          $image = $request->file('thumbnail');
            $destinationPath = 'public/storage/posts/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
        

             $avatar = $request->file('banner');
        $filename = time() . '.' . $avatar->getClientOriginalExtension();
        Image::make($avatar)->resize(1350, 500)->save( public_path('storage/posts/' . $filename ));

         Page::create([
            "name" => $request->name,
            "position"=> $request->position_type,
            "type"=> $request->page_type,
            "short_description" => $request->short_description,
            "description" => $request->description,
            "link" => $request->link,
            "parent_id"=> $request->parent_id,
            "banner" =>$filename,
            "thumbnail" =>$profileImage,
            "weight"=> $request->weight,
              "service"=>$request->service,
            "product"=> $request->product,
             "customer_section"=> $request->customer_section,
            "status" => $request->status,
            "meta_title"=> $request->meta_title,
            "meta_description" => $request->meta_description,
            "meta_keyword" => $request->meta_keyword,
            'slug' =>preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.str::random(5)


       ]);

       }

if($request->hasFile('thumbnail')==null && $request->hasFile('banner')==null)
{
     Page::create([
        "name" => $request->name,
        "position"=> $request->position_type,
        "type"=> $request->page_type,
        "short_description" => $request->short_description,
        "description" => $request->description,
        "link" => $request->link,
        "parent_id"=> $request->parent_id,
        "banner" =>null,
        "thumbnail"=>null,
        "weight"=> $request->weight,
          "service"=>$request->service,
            "product"=> $request->product,
              "customer_section"=> $request->customer_section,
        "status" => $request->status,
        "meta_title"=> $request->meta_title,
        "meta_description" => $request->meta_description,
        "meta_keyword" => $request->meta_keyword,
        'slug' =>preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.str::random(5)
         ]);

       }



           session()->flash('success','pages created successfully.');
            return redirect( route('page.index') );

        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        return view('admin.page.show',compact('page'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return view('admin.page.edit',compact('page'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Page $page)
    {
      
          $this->validate($request,[
         'slug'=>'required|alpha-dash|unique:pages,slug,'.$page->id,
         
      ]);
        
        $data=$request->only(['name','position','type','short_description','description','service','product','link','parent_id','weight','status',
        'meta_title','meta_description','meta_keyword']);

            $page->customer_section= $request->customer_section;
           $page->service=$request->service;
           $page->product=$request->product;
           $page->slug=$request->slug;
           $page->save();

        if($request->hasfile('thumbnail')){
            $image = $request->file('thumbnail');
                $destinationPath = 'public/storage/posts/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
        
            Storage::delete($page->thumbnail);
             $data['thumbnail'] = $profileImage;
             }



              if($request->hasfile('banner')){
                $image = $request->file('banner');
                $destinationPath = 'public/storage/posts/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
        
            Storage::delete($page->banner);
             $data['banner'] = $profileImage;
             }



             $page->update($data);
             session()->flash('success','page upated successfully.');
               return redirect( route('page.index') );
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        
        $page->delete();
        session()->flash('error','pages deleted successfully.');
               return redirect( route('page.index') );
        //
    }

      public function status($id){

           $page=Page::find($id);
        if($page->status== 1){
            $page->status = 0;
        }else{
            $page->status =1;
        }
        session()->flash('success','status has been succesfully updated');
        $page->save();
            return redirect(route('page.index'));
      }

}

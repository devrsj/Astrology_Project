<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;
use Image;


class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.setting.index');
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
      
      $settings=Setting::all();
      
       $setting=$settings->count();
      
       if($setting >=1){

   session()->flash('error','You cannot create the setting more than one time');
   return redirect()->back();

       }else{
        return view('admin.setting.create');
       }
  
      
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

     

      if($request->hasFile('navbar_image') && $request->hasFile('footer_image')){

                 $navbar_image=$request->navbar_image->store('posts'); 
               
                  $navbar=Image::make(public_path("storage/{$navbar_image}"))->fit(277,85);
                  $navbar->save();

                   $footer_image=$request->footer_image->store('posts'); 
                 $footer=Image::make(public_path("storage/{$footer_image}"))->fit(277,85);
                  $footer->save();

                    Setting::create([
                    "navbar_logo"=> $navbar_image,
                    "navbar_link" =>$request->navbar_link,
                    "footer_logo" => $footer_image,
                    "footer_link" => $request->footer_link,
                    "facebook_link" => $request->facebook_link,
                    "instagram_link" => $request->instagram_link,
                    "twitter_link" => $request->twitter_link,
                    "youtube_link" => $request->youtube_link,
                    "description" => $request->description,
                 
                    ]); 


             }else  if($request->hasFile('navbar_image') && $request->hasFile('footer_image')==null ){ 

               $navbar_image=$request->navbar_image->store('posts'); 
                  $navbarimage=Image::make(public_path("storage/{$navbar_image}"))->fit(277,85);
                  $navbarimage->save();

             $setting=Setting::create([
                "navbar_logo"=> $navbar_image,
                  "navbar_link" =>$request->navbar_link,
                    "footer_logo" => $request->footer_image,
                    "footer_link" => $request->footer_link,
                    "facebook_link" => $request->facebook_link,
                    "instagram_link" => $request->instagram_link,
                    "twitter_link" => $request->twitter_link,
                    "youtube_link" => $request->youtube_link,
                    "description" => $request->description,

                
                    ]); 

             } else if($request->hasFile('footer_image') && $request->hasFile('navbar_image')==null ){

                 $footer_image=$request->footer_image->store('posts'); 
                  $footer=Image::make(public_path("storage/{$footer_image}"))->fit(277,85);
                  $footer->save();

                    $setting=Setting::create([
                "navbar_logo"=> $request->navbar_image,
                  "navbar_link" =>$request->navbar_link,
                    "footer_logo" =>  $footer_image,
                    "footer_link" => $request->footer_link,
                    "facebook_link" => $request->facebook_link,
                    "instagram_link" => $request->instagram_link,
                    "twitter_link" => $request->twitter_link,
                    "youtube_link" => $request->youtube_link,
                    "description" => $request->description,

               
                    ]); 
             }else{
                   $setting=Setting::create([
                "navbar_logo"=> $request->navbar_image,
                  "navbar_link" =>$request->navbar_link,
                    "footer_logo" => $request->footer_image,
                    "footer_link" => $request->footer_link,
                    "facebook_link" => $request->facebook_link,
                    "instagram_link" => $request->instagram_link,
                    "twitter_link" => $request->twitter_link,
                    "youtube_link" => $request->youtube_link,
                    "description" => $request->description,
               
                    ]); 
             }

        session()->flash('success','setting information sucesfully added');
        return redirect( route('setting.index') );
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

        $setting=Setting::find($id);
        return view('admin.setting.show',compact('setting'));
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
        $setting=Setting::find($id);
        return view('admin.setting.edit',compact('setting'));
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
        $setting=Setting::findorfail($id);
       
 $data=$request->only(['navbar_link','footer_link','instagram_link','footer_link','facebook_link',
  'twitter_link','youtube_link','description']);
     
       if($request->hasFile('navbar_image') && $request->hasFile('footer_image')){ 
         $navbar_image=$request->navbar_image->store('posts'); 
                 $navbarimage=Image::make(public_path("storage/{$navbar_image}"))->fit(2777,85);
                 $navbarimage->save();

              $footer_image=$request->footer_image->store('posts'); 
                 $footerimage=Image::make(public_path("storage/{$footer_image}"))->fit(277,85);
                 $footerimage->save();

                   Storage::delete($setting->navbar_logo);
                   Storage::delete($setting->footer_logo);
                      $data['navbar_logo'] =  $navbar_image;
                       $data['footer_logo'] =  $footer_image;
         
         }else if($request->hasFile('navbar_image')){
          $navbar_image=$request->navbar_image->store('posts'); 
          $navbarimage=Image::make(public_path("storage/{$navbar_image}"))->fit(277,85);
          $navbarimage->save();
          Storage::delete($setting->navabar_logo);
          $data['navbar_logo'] =  $navbar_image;
        
        }else if($request->hasFile('footer_image')){
          $footer_image=$request->footer_image->store('posts'); 
          $footerimage=Image::make(public_path("storage/{$footer_image}"))->fit(277,85);
          $footerimage->save();
          Storage::delete($setting->footer_logo);
          $data['footer_logo'] =  $footer_image;

        }
     $setting->update($data);
     session()->flash('success','setting information sucesfully updated');     
         return redirect( route('setting.index') );
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
        $setting=Setting::findorfail($id);
        $setting->delete();
        session()->flash('error','setting succesfully deleted');
        return redirect()->route('setting.index');
        //
    }
}

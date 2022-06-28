<?php

namespace App\Http\Controllers\Admin;


use App\Models\Seo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;

class SeoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.seo.index');
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


         $seos=Seo::all();
        $seoss=$seos->count();
        if($seoss >=1){
    session()->flash('error','You cannot create the seo information more than one time');
    return redirect()->back();
 
        }else{
            return view('admin.seo.create');
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




        if($request->hasFile('favicon') && $request->hasFile('logo')){
        $logo=$request->logo->store('posts'); 
        $image=Image::make(public_path("storage/posts/{$logo}"))->fit(32,32);
        $image->save();

               $favicon=$request->favicon->store('posts'); 
               $fav_icon=Image::make(public_path("storage/posts/{$favicon}"))->fit(32,32);
               $fav_icon->save();
              Seo::create([
              "webmaster" => $request->webmaster,
              "yandex" => $request->yandex,
              "analaytic" => $request->analaytic,
              "geo_tag" => $request->geo_tag,
              "og_tag" => $request->og_tag,
              "favicon" => $favicon,
              "logo" => $logo,
              "meta_title" => $request->meta_title,
              "meta_keyword" => $request->meta_keyword,
              "meta_description" => $request->meta_description 

            ]);

        }else if($request->hasFile('favicon') && $request->hasFile('logo')==null){

             $avatar = $request->file(favicon);
        $filename = time() . '.' . $avatar->getClientOriginalExtension();
        Image::make($avatar)->resize(32,32)->save( public_path('storage/posts/' . $filename ));
               $fav_icon->save();
               Seo::create([
              "webmaster" => $request->webmaster,
              "yandex" => $request->yandex,
              "analaytic" => $request->analaytic,
              "geo_tag" => $request->geo_tag,
              "og_tag" => $request->og_tag,
              "favicon" => $filename,
              "logo" => $request->logo,
              "meta_title" => $request->meta_title,
              "meta_keyword" => $request->meta_keyword,
              "meta_description" => $request->meta_description 

            ]);

        }else if($request->hasFile('logo') && $request->hasFile('favicon')==null){
       
       $logo=$request->logo->store('posts'); 
        $image=Image::make(public_path("storage/{$logo}"))->fit(32,32);
        $image->save();
               Seo::create([
              "webmaster" => $request->webmaster,
              "yandex" => $request->yandex,
              "analaytic" => $request->analaytic,
              "geo_tag" => $request->geo_tag,
              "og_tag" => $request->og_tag,
              "favicon" => $request->favicon,
              "logo" => $logo,
              "meta_title" => $request->meta_title,
              "meta_keyword" => $request->meta_keyword,
              "meta_description" => $request->meta_description 
            ]);
             }else{
               Seo::create([
              "webmaster" => $request->webmaster,
              "yandex" => $request->yandex,
              "analaytic" => $request->analaytic,
              "geo_tag" => $request->geo_tag,
              "og_tag" => $request->og_tag,
              "favicon" => $request->favicon,
              "logo" => $request->logo,
              "meta_title" => $request->meta_title,
              "meta_keyword" => $request->meta_keyword,
              "meta_description" => $request->meta_description 

            ]);
        }

        session()->flash('success','Seo information succesfully added');
        return redirect()->route('seo.index');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Seo $seo)
    {  

      return view('admin.seo.show',compact('seo'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Seo $seo)
    {
        return view('admin.seo.edit',compact('seo'));
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
     
       $seo=Seo::find($id);


$data=$request->only(['webmaster','yandex','analaytic','geo_tag','og_tag','meta_title',
        'meta_description','meta_keyword']);



        if($request->hasFile('favicon')){

                  $avatar = $request->file('favicon');
        $filename = time() . '.' . $avatar->getClientOriginalExtension();
        Image::make($avatar)->resize(32,32)->save( public_path('storage/posts/' . $filename ) );
                
                

                Storage::delete($seo->favicon);
               
                      $data['favicon'] =  $filename;
                      
             

        }
        
    
       
         $seo->update($data);
        session()->flash('success','Media sucesfully updated');
        return redirect( route('seo.index') );


        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seo $seo)
    {
        $seo->delete();
        session()->flash('error','Seo Deleted succesfully');
        return redirect(route('seo.index'));
        
        //
    }
}

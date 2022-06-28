<?php

namespace App\Http\Controllers\Admin;



use App\Models\SubCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;


class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $i=1;
        $subcategories=SubCategory::all();
       return view('admin.subcategory.index',compact('subcategories','i'));
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
        return view('admin.subcategory.create');

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
         "banner"=> "required|mimes:jpeg,png,jpg,gif",
         "thumbnail"=> "required|mimes:jpeg,png,jpg,gif",
                ]); 
                
                
                
                
                        $image1 = $request->file('banner');
                $destinationPath1 = 'public/storage/posts/';
            $profileImage1 = date('YmdHis') . "." . $image1->getClientOriginalExtension();
            $image1->move($destinationPath1, $profileImage1);
                


      
      

                 $image = $request->file('thumbnail');
                $destinationPath = 'public/storage/posts/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
                

             
       
         Subcategory::create([
        "name" => $request->name,
        "category_id" => $request->category_id,
        "short_description" => $request->short_description,
        "description" => $request->description,
        "banner" => $profileImage1,
        "thumbnail" =>$profileImage,
        "meta_title"=> $request->meta_title,
        "weight" => $request->weight,
         "status" => $request->status,
        "meta_description" => $request->meta_description,
         "slug" =>preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.str::random(5)
]);

session()->flash('success','service category   sucesfully added');
return redirect( route('subcategory.index') );
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

          $subcategory=Subcategory::findorfail($id);
       
          return view('admin.subcategory.edit',compact('subcategory'));
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
      

         $subcategory=SubCategory::findorfail($id);
          $this->validate($request,[
                 'slug'=>'required|alpha-dash|unique:sub_categories,slug,'.$subcategory->id,
         
                ]);
        $data=$request->only(['name','category_id','short_description','description','weight','meta_title','meta_description']);

       

        $subcategory->status=$request->status;
       $subcategory->slug=$request->slug;
       $subcategory->save();

             if($request->hasfile('banner')){
     $image = $request->file('banner');
                $destinationPath = 'public/storage/posts/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
      

            Storage::delete($subcategory->banner);
             $data['banner'] = $profileImage;
            
             }

         if($request->hasfile('thumbnail')){
           $image = $request->file('thumbnail');
                $destinationPath = 'public/storage/posts/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);

            Storage::delete($subcategory->thumbnail);
             $data['thumbnail'] = $profileImage;
            
             }
             
        


        $subcategory->update($data);
        session()->flash('success','service category   sucesfully updated');
        return redirect( route('subcategory.index') );
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
            $subcategory=SubCategory::findorfail($id);
            $subcategory->delete();
            session()->flash('error','service category  sucesfully deleted');
            return redirect(route('subcategory.index'));
        //
    }

    public function status($id){
      
        $subcategory=SubCategory::find($id);  
        if($subcategory->status== 1){
            $subcategory->status = 0;
        }else{
            $subcategory->status =1;
        }
        session()->flash('success','status has been succesfully changed');
        $subcategory->save();
            return redirect(route('subcategory.index'));
      }

 public function category_id($category_id){

    $output = "";
    $subcategories=SubCategory::where('category_id',$category_id)->get();
  
    if($subcategories->count() > 0){
        foreach($subcategories as $subcategory){
            $output .= 

'<option value="'.$subcategory->id.'">'.$subcategory->name.'</option>';

        }

        
    }else{

        $output .='<option value="">No subcategory found</option>';
    }


    return Response($output);

 }





}

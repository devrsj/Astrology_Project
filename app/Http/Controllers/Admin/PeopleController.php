<?php

namespace App\Http\Controllers\Admin;

use App\Models\People;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.people.index');
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.people.create');
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
        
                

                if($request->people_type=="text"){
                     if($request->hasFile('image')==null ){
                        People::create([
                        "people_type" => $request->people_type,
                        "name" => $request->name,
                        "post" => $request->post,
                        "description" => $request->description,
                      "status" => $request->status,
                       "image" =>null,
                       "weight" => $request->weight
                      ]);  
                      }else{
                          
                          
                              $avatar = $request->file('image');
        $filename = time() . '.' . $avatar->getClientOriginalExtension();
        Image::make($avatar)->resize(510, 500)->save( public_path('storage/posts/' . $filename ));
      
                      
                     
                       People::create([
                        "people_type" => $request->people_type,
                        "name" => $request->name,
                        "post" => $request->post,
                        "description" => $request->description,
                      "status" => $request->status,
                       "image" => $filename,
                       "weight" => $request->weight
                      ]);  
                      
                          
                      }
                      
               
                      
                }
            


                if($request->people_type=="video"){

                         People::create([
                         "people_type" => $request->people_type,
                         "video_url"=> $request->video_url,
                         "description" => $request->description,
                         "status" => $request->status,  
                         "weight" => $request->weight
                      ]);  
        

                }
                
              

                      
                       session()->flash('success','Testimonials sucesfully added');
                       return redirect(route('people.index'));
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
        $people=People::find($id);
        return view('admin.people.edit',compact('people'));
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
        $people=People::findorfail($id);
        $data=$request->only(['people_type','name','post','description','weight','status']);
     
        $video_url=$request->video_url;
        if($request->hasFile('image')){
            if($request->people_type=="text"){
                
               

  $avatar = $request->file('image');
        $filename = time() . '.' . $avatar->getClientOriginalExtension();
        Image::make($avatar)->resize(510, 500)->save( public_path('storage/posts/' . $filename ));
      
                Storage::delete($people->image);
                $data['image'] = $filename;
                $data['video_url'] =null;
          
            }
        }
            if($request->people_type=="video"){
               
               $data['name']=null;
               $data['post']=null;
               $data['description']=null;
               $data['image']=null;

                $data['video_url'] =$video_url;
    
            }


        $people->update($data);
        session()->flash('success','Testimonials sucesfully updated');
        return redirect(route('people.index'));
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
        
        $people=People::findorfail($id);
        $people->delete();
        session()->flash('error','Testimonials  sucesfully deleted');
        return redirect(route('people.index'));
        //
    }


    public function status($id){
      
        $people=People::find($id);  
        if($people->status== 1){
            $people->status = 0;
        }else{
            $people->status =1;
        }
        session()->flash('success','Status has been succesfully changed');
        $people->save();
            return redirect(route('people.index'));
      }

}

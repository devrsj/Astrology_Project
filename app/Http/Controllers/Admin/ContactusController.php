<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contactus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.contactus.index');
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
 $contactus=Contactus::all();
      
        $contacts=$contactus->count();
       
        if($contacts >=1){
 
    session()->flash('error','You cannot create the contact more than one time');
    return redirect()->back();
 
        }else{
            return view('admin.contactus.create');
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
       Contactus::create([
           "name" => $request->name,
         "address" => $request->address,
         "email" => $request->email,
         "number" => $request->number,
         "telephone_number" => $request->telephone_number,
         "description" => $request->description,
         "google_map" => $request->google_map,
         "facebookpage_link" => $request->facebookpage_link,
       ]); 
       
        session()->flash('success','Contact information sucesfully added');
        return redirect()->route('contactus.index');
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

        $contactus=Contactus::find($id);
        return view('admin.contactus.show',compact('contactus'));
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
        $contactus=Contactus::find($id);
        return view('admin.contactus.edit',compact('contactus'));
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
    
        $contactus=Contactus::findorfail($id);
        $data=$request->only(['name','address','email','number','telephone_number','description','google_map','facebookpage_link']);
         
     
        $contactus->update($data);
          session()->flash('success','Contactus information sucesfully updated');     
         return redirect( route('contactus.index') );
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
        $contactus=Contactus::findorfail($id);
        $contactus->delete();
        session()->flash('warn','Contactus  information succesfully deleted');
        return redirect()->route('contactus.index');
        //
    }
}
 
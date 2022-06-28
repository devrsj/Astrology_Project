<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use App\Models\Blog;
use App\Models\Tag;
use App\Models\People;
use App\Models\Contact;
use App\Models\User;
use App\Models\Address;
use App\Models\Shipment;
use App\Models\ShipmentBooking;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

        $tags=Tag::all();        
        $peoples=People::all();
         $pages=Page::all();
         $blogs=Blog::all();
         $users=User::all();
       
          return view('admin.index',compact('tags','peoples','users','blogs','pages'));
      
         
       
        
    }

      public function show()
    {  
        return view('admin.profile.index')->with('user',auth()->user());
       
        //
    }
    public function changeprofile()
    {  
     return view('admin.profile.edit')->with('user',auth()->user());
       
        //
    }


      public function updateprofile(Request $request,User $user)
       {
           
           
          $this->validate(request(),[
           "name"=> "required|min:2|unique:users,name,".$user->id,
            "email"=> "required|min:7|unique:users,email,".$user->id,
            "city"=> "required",
            "country"=> "required",
            "postal_code"=> "required",
          ]);
          
          

        $user->name=$request->name;
        $user->email=$request->email;
        $user->number=$request->phone;
        $user->company_name=$request->company_name;
        $user->save();

        $address = Address::where('user_id',$user->id)->first();
        $address->city=$request->city;
        $address->street=$request->street;
        $address->country=$request->country;
        $address->postal_code=$request->postal_code;
        $address->save();

        session()->flash('success','User information updated sucesfully updated');
        return redirect()->back();

    }
    
    
    public function  cache(){
        dd('gt');
        
    }


    //
}

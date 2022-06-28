<?php

namespace App\Http\Controllers\Auth;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Address;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    protected function redirectTo()
    {
        if (auth()->user()->is_admin ==1) {
            return '/admin';
        }
        return  '/user/dashboard';
    }

    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    
    public function redirectToGoogle()
    {
    
      
        return Socialite::driver('google')->stateless()->redirect();
   
    }
    
    //Google callBack

    public function handleGoogleCallback(){
      
                 
            $user = Socialite::driver('google')->stateless()->user();


        $this->registerOrLoginUser($user);
       
        session()->flash('success','Succesfully create new account');
        return redirect(route('user.dashboard'));
 
    }
    


    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->stateless()->redirect();
      
        
    }
    
    //facebook callBack

    public function handleFacebookCallback(){

        $user = Socialite::driver('facebook')->stateless()->user();
        $this->registerOrLoginUser($user);
        session()->flash('success','Succesfully create new account');
        return redirect(route('user.dashboard'));
    }
    
 public function registerOrLoginUser($data){

        $user=User::where('email',$data->email)->first();
       
        if(!$user){

            $user=new User();
            $user->name=$data->name;
            $user->email=$data->email;
            $user->password= encrypt('admin@123');
            $user->is_admin=0;
            $user->status=0;
            $user->provider_id=$data->id;
            $user->avatar=$data->avatar;
            $user->save();
 
        
          $address=new Address();
     
          $address->user_id=$user->id;
          $address->save();
          
          

        }

     Auth::login($user);



    }


    public function user_login(){
        return view('front.user.login');
      }
 public function user_register(){
        return view('front.user.register');
      }



     
    
}

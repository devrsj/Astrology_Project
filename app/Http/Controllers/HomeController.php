<?php

namespace App\Http\Controllers;
use Rap2hpoutre\FastExcel\FastExcel as FastExcel;

use App\Models\ShippingCharge;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('front.home.index');
    }
    
    public function appo(Request $request){
        
        dd('hy');
    }


}

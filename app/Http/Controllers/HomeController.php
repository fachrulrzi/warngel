<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
   
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
     public function index()
     {
           if(auth()->user() != null){
            if (auth()->user()->type == 'admin') {
                return redirect()->route('admin.dashboard');
            }else{
                return redirect()->route('home');
            }
           }
        else{
                return view('home',[
                    'title' => 'Home',
                    'categories' => Categories::all(),
                    'carbon' =>  Carbon::now()->format('Y-m-d'),
                    'food' => Food::fillter(request(['search','price','categories', 'new']))->where('stock', '>', 0)->inRandomOrder()->get(),
                ]);
            }
     }
    
   
}
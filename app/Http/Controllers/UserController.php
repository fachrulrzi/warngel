<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Food;
use App\Models\User;
use App\Models\Order;
use App\Models\Courier;
use App\Jobs\SendEmailJob;
use App\Mail\SendingEmail;
use App\Models\Categories;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        return view('user.home',[
            'title' => 'Home',
            'categories' => Categories::all(),
            'carbon' =>  Carbon::now()->format('Y-m-d'),
            'food' => Food::fillter(request(['search','price','categories', 'new']))->where('stock', '>', 0)->inRandomOrder()->get(),
   
        ]);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_user' => 'required',
            'id_food' => 'required',
            'quantity' => 'required',
           ]);
        $cart = cart::all()->where('id_user',  $request->id_user)->where('id_food', $request->id_food);
        $foods = food::all()->where('id', $request->id_food);
        // dd($food);
        $carts = $cart->count(); 
        if($carts > 0) {
           foreach ($foods as $food):
            foreach ($cart as $c) {
                if($c->quantity >= $food->stock){
                    return back()->with('error', 'Kuantitas Maksimal');
                }
                $quantity = $request->quantity + $c->quantity;
                $total = $request->quantity * $request->price + $c->total;

            }
           endforeach;
            cart::where('id_user',  $request->id_user)->where('id_food', $request->id_food)
            ->update([
                'quantity' => $quantity,
                'total' => $total,
            ]);
            return back()->with('success', 'Berhasil Dimasukan Carts');
        }
        else{
            $validatedData['total'] = $request->quantity * $request->price;
            Cart::create($validatedData);
              return redirect("cart/". $request->id_user);
        }
    }
    // Profile
    public function profile(Request $request)
    {
        $user = User::find($request->id);
        return view('user.profile',[
            'title' => $user->name,
            'categories' => Categories::all(),
            'user' => $user,
        ]);
    }
    public function profileupdate(Request $request)
    {
        // dd($request);
        $users = User::all()->find($request->id);
        if ($users->avatar == null) {
            $validate = $request->validate([
                'name' => 'required',
                'receiver' => 'required',
                'address' => 'required',
                'telephone' => 'required',
                'avatar' => 'nullable|image|file|max:1024',
            ]);
            if ($request->file('avatar')) {
                $validate['avatar'] =  $request->file('avatar')->store('image-avatar');
            }
            User::where('id',  $request->id)
            ->update($validate);
        }else {
            $validate = $request->validate([
                'name' => 'required',
                'receiver' => 'required',
                'address' => 'required',
                'telephone' => 'required',
                'avatar' => 'nullable|image|file|max:1024',
            ]);
            if ($request->file('avatar') != null) {
                Storage::delete($users->avatar);
                $validate['avatar'] =  $request->file('avatar')->store('image-avatar');
            }
            User::where('id',  $request->id)
            ->update($validate);
        }
        return back()->with('success', 'Berhasil Update Data');
    }
    public function show(Food $food)
    {
        // $orders = order::withCount('food')->orderByDesc('quantity')->first()->get();
        // foreach ($orders as $order) {
        //     $top= $order->id_food;
        // }
        return view('user.detail',[
            'title' => $food->title,
            'categories' => Categories::all(),
            'food' => $food,
            // 'top' => $top,
            'carbon' =>  Carbon::now()->format('Y-m-d'),
        ]);
    }
    //cart
    public function showcart(Request $request)
    {
        $cart = cart::where('id_user', $request->id)->get();
        return view('user.cart',[
            'title' => 'cart',
            'cart' => $cart,
            'categories' => Categories::all(),
            'id' => $request->id,
            'courier' => Courier::all(),
        ]);
    }
    public function destroycart(Request $request)
    {
        cart::where('id',  $request->id)
        ->delete();
        return back()->with('success', 'Berhasil Hapus Data');
    }
    public function updatecart(Request $request)
    {
        cart::where('id',  $request->id)
        ->update([
            'total' => $request->price * $request->quantity,
            'quantity' => $request->quantity,
        ]);
        return back();
    }
    public function updatecourier(Request $request)
    {
        cart::where('id_user',  $request->id)
        ->update([
            'id_courier' => $request->id_courier,
        ]);
        return back();
    }
    //order
    public function storecart(Request $request)
    {
       if (auth()->user()->address and auth()->user()->telephone and auth()->user()->receiver != null) {
        $order = order::all()->max('id');
        $id = $order + 1;
        $huruf = "P";
        $customid = $huruf . sprintf("%03s", $id);
        $cart = cart::where('id_user', $request->id_user)->get();
        $validatedData = $request->validate([
            'subtotal' => 'required',
            'id_user' => 'required',
            'id_courier' => 'required',
           ]);
           foreach ($cart as $c):
           $validatedData['id_food'] = $c->id_food;
           $validatedData['quantity'] = $c->quantity;
           $validatedData['custom_id'] = $customid;
           Order::create($validatedData);
            $foods = Food::all()->where('id', $c->id_food);
            foreach ($foods as $food):
            $stock = $food->stock - $c->quantity;
            echo $stock;
            food::where('id',  $c->id_food)
            ->update([
                'stock' => $stock,
            ]);
            endforeach;
           cart::where('id',  $c->id)->delete();
           endforeach;
           Transaction::create([
            'custom_id' => $customid,
           ]);
        $data = Order::where('custom_id',  $customid)->get();
        $email = auth()->user()->email;
        SendEmailJob::dispatch($email, $data);
        return redirect("/order/$request->id_user")->with('success', 'Berhasil Buat Pesanan');
       } else {
        return back()->with('error', 'Data Profile Blum Lengkap');
       }
        }
        
    
   
}
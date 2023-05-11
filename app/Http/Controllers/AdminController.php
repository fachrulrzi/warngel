<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Food;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.home',[
            'title' => 'Dahboard',
            'unpaid' => Order::where('status',  'unpaid')->count(),
            'packed' => Order::where('status',  'packed')->count(),
            'shipped' => Order::where('status',  'shipped')->count(),
            'done' => Order::where('status',  'done')->count(),
            'food' => Food::latest()->get(),
            'categories' => Categories::all(),
        ]);
    }
    public function update(Request $request)
    {
        Food::where('slug',  $request->slug)
        ->update([
            'title' => $request->title,
            'body' => $request->body,
            'stock' => $request->stock,
            'id_category' => $request->id_category,
            'price' => $request->price,
            'slug' => $request->slug,
            'excerpt' => Str::limit(strip_tags($request->body), 30),
        ]);
        return back()->with('success', 'Berhasil Update Data');
    }
    public function destroy(Request $request)
    {
        $food = Food::where('slug', $request->slug)->get();
        foreach ($food as $f ):
            Storage::delete($f->image);
        endforeach;
        Food::where('slug',  $request->slug)
        ->delete();
        return back()->with('success', 'Berhasil Hapus Data');
    }

    // Insert makanan
    public function create()
    {
        return view('admin.add',[
            'title' => 'Tambah Data',
            'food' => Food::latest()->get(),
            'categories' => Categories::all(),
        ]);
    }
    public function checkSlug(Request $request)
    {
       $slug = SlugService::createSlug(Food::class, 'slug', $request->title);
       return response()->json(['slug' => $slug]);
    }
    public function store(Request $request)
    {
       $validatedData = $request->validate([
        'title' => 'required|max:255',
        'slug' => 'required|unique:food',
        'id_category' => 'required',
        'body' => 'required',
        'price' => 'required',
        'stock' => 'required',
        'image' => 'required|image|file|max:1024',
       ]);
       if ($request->file('image')) {
        $validatedData['image'] =  $request->file('image')->store('image-food');
    }
       $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 30);
       Food::create($validatedData);
        return redirect('/admin/dashboard')->with('success', 'Berhasil Tambah Data');
        
    }
   

    //Insert Category
    public function createcate()
    {
        return view('admin.categori',[
            'title' => 'Tambah Kategori',
        ]);
    }
    public function storecate(Request $request)
    {
       $validatedData = $request->validate([
        'name' => 'required|max:255|unique:Categories',
        'slug' => 'required|unique:Categories',
       ]);
       Categories::create($validatedData);
        return back()->with('success', 'Berhasil Tambah Kategori');
        
    }
    public function checkSlugCate(Request $request)
    {
        $slug = SlugService::createSlug(Categories::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
     }
     
}
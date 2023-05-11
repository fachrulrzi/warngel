<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Food;
use App\Models\Order;
use App\Jobs\SendEmailJob;
use App\Mail\SendingEmail;
use App\Models\Categories;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    //Order
    public function index(){
        $unpaid = Order::where('status',  'unpaid')->whereHas('transaction', function ($query) {
        $query->where('bukti', null);})->where('updated_at', '<', Carbon::now()->subDays(1))->get();
        if ($unpaid->count()>0) {
            $transaction = Transaction::where('bukti',  null)->where('updated_at', '<', Carbon::now()->subDays(1))->get();
            foreach ($unpaid as $u) {
                $foods = Food::all()->where('id', $u->id_food);
                foreach ($foods as $food):
                $stock = $food->stock + $u->quantity;
                food::where('id',  $u->id_food)
                ->update([
                    'stock' => $stock,
                ]);
            endforeach;
            $u->delete();
            foreach ($transaction as $t) {
               $t->delete();
            }
         }
         return  redirect()->route('admin.order');
        }else{
            return view('admin.order',[
                'title' => 'Order',
                'unpaid' => Order::latest()->where('status',  'unpaid')->get()->groupBy('custom_id'),
                'packed' => Order::latest()->where('status',  'packed')->get()->groupBy('custom_id'),
                'shipped' => Order::latest()->where('status',  'shipped')->get()->groupBy('custom_id'),
                'done' => Order::latest()->where('status',  'done')->get()->groupBy('custom_id'),
            ]);
        }
      
    }
    public function destroy(Request $request)
    {
        $orders = Order::where('custom_id',  $request->custom_id)->get();
        $transaction =  transaction::where('custom_id',  $request->custom_id)->get();
        foreach ($orders as $order) {
            $foods = Food::all()->where('id', $order->id_food);
            foreach ($foods as $food):
            $stock = $food->stock + $order->quantity;
            food::where('id',  $order->id_food)
            ->update([
                'stock' => $stock,
            ]);
            foreach ($transaction as $t):
                if ($t['bukti'] != null) {
                    Storage::delete($t->bukti);
                   }
            endforeach;
            $order->delete();
            transaction::where('custom_id',  $request->custom_id)
            ->delete();
        endforeach;
    }
        return back()->with('success', 'Berhasil Hapus Data');
    }
    public function konfirmasi(Request $request)
    {
        Order::where('custom_id',  $request->custom_id)
        ->update([
            'status' => 'packed',
        ]);
        $data = Order::where('custom_id',  $request->custom_id)->get();
        foreach ($data as $d) {
            $email = $d->user->email;
        }
        SendEmailJob::dispatch($email, $data);
        return back()->with('success', 'Berhasil Konfirmasi');        
    }
    public function update(Request $request)
    {
        Order::where('custom_id',  $request->custom_id)
        ->update([
            'no_kurir' => '62'.$request->no_kurir,
            'status' => 'shipped',
        ]);
        $data = Order::where('custom_id',  $request->custom_id)->get();
        foreach ($data as $d) {
            $email = $d->user->email;
        }
        SendEmailJob::dispatch($email, $data);
        return back()->with('success', 'Berhasil Ngirim Pesanan');        
    }
    public function updates(Request $request)
    {
        $validatedData = $request->validate([
            'bukti' => 'required|image|file|max:1024',
           ]);
        Order::where('custom_id',  $request->custom_id)
        ->update([
            'status' => 'done',
            'bukti' => $validatedData['bukti'] =  $request->file('bukti')->store('image-pengiriman'),
        ]);
        $data = Order::where('custom_id',  $request->custom_id)->get();
        foreach ($data as $d) {
            $email = $d->user->email;
        }
        SendEmailJob::dispatch($email, $data);
        return back()->with('success', 'Pesanan Berhasil Dikirim');        
    }
    //user
    public function showorder()
    {
       $unpaid = Order::where('status',  'unpaid')->whereHas('transaction', function ($query) {
        $query->where('bukti', null);})->where('updated_at', '<', Carbon::now()->subDays(1))->get();
        if ($unpaid->count()>0) {
            $transaction = Transaction::where('bukti',  null)->where('updated_at', '<', Carbon::now()->subDays(1))->get();
            foreach ($unpaid as $u) {
                $foods = Food::all()->where('id', $u->id_food);
                foreach ($foods as $food):
                $stock = $food->stock + $u->quantity;
                food::where('id',  $u->id_food)
                ->update([
                    'stock' => $stock,
                ]);
            endforeach;
            $u->delete();
            foreach ($transaction as $t) {
                // Storage::delete($t->bukti);
               $t->delete();
            }
         }
         return  redirect('order/'.auth()->user()->id);
        }else {
            return view('user.order',[
                'title' => 'Order',
                'categories' => Categories::all(),
                'unpaid' => Order::latest()->where('status',  'unpaid')->where('id_user', auth()->user()->id )->get()->groupBy('custom_id'),
                'packed' => Order::latest()->where('status',  'packed')->where('id_user', auth()->user()->id )->get()->groupBy('custom_id'),
                'shipped' => Order::latest()->where('status',  'shipped')->where('id_user', auth()->user()->id )->get()->groupBy('custom_id'),
                'done' => Order::latest()->where('status',  'done')->where('id_user', auth()->user()->id )->get()->groupBy('custom_id'),
            ]);
        }
    }
    public function transaction(Request $request)
    {
        $validatedData = $request->validate([
            'bukti' => 'required|image|file|max:1024',
           ]);
        Transaction::where('custom_id',  $request->custom_id)
        ->update([
            'bukti' => $validatedData['bukti'] =  $request->file('bukti')->store('image-transaction'),
        ]);
            return back()->with('success', 'Menunggu Konfirmasi Admin');
    }
}
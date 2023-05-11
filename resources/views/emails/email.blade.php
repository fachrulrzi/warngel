
@component('mail::message')
# <h1>Pemesanan Makanan Toko Warngel</h1>

@foreach ($data as $d)
@endforeach
<p>No.Pesanan : {{ $d->custom_id }}</p>
<p>Penerima : {{ $d->user->receiver }}</p>
<p>Alamat : {{ $d->user->address }}</p>
<p>Telepon : {{ $d->user->telephone }}</p>
<p>Pengiriman : {{ $d->courier->ket }}</p>
<hr>
<hr>
@foreach ($data as $d)
<p>Nama Makanan : {{ $d->food->title }}</p>
<p>Jumlah : {{ $d->quantity }}</p>
<p>Harga : Rp {{ number_format($d->food->price,2,',','.')  }}</p>
<hr>
<hr>
@endforeach
<p>Subtotal Produk : Rp {{ number_format($d->subtotal - $d->courier->price ,2,',','.')  }}</p>
<p>Subtotal Pengiriman : Rp {{ number_format($d->courier->price,2,',','.')  }} </p>
<h3>Total Pemesanan : Rp {{ number_format($d->subtotal,2,',','.')  }} </h3>
<hr>
<hr>
<h3>Status Pesanan : 
@if ( $d->status  == 'unpaid')
    Belum Bayar
@elseif( $d->status  == 'packed')
Dikemas
@elseif( $d->status  == 'shipped')
Dikirim
<br>
<a href="https://api.whatsapp.com/send?phone={{ $d->no_kurir }}&text=%2ATracker%20Makanan%20Toko%20Warngel%2A%0A====================================%0A%2ANo.Pesanan%20:%2A%20{{ $d->custom_id }}%0A%2APenerima%20:%2A%20{{ $d->user->receiver }}%0A%2AAlamat%20:%2A%20{{ $d->user->address }}%0A%2ATelepon%20:%2A%20{{ $d->user->telephone }}">Chat Kurir</a>
{{-- @component('mail::button', ['url' => 'https://api.whatsapp.com/send?phone={{ $d->no_kurir }}&text=%2ATracker%20Makanan%20Toko%20Warngel%2A%0A====================================%0A%2ANo.Pesanan%20:%2A%20{{ $d->custom_id }}%0A%2APenerima%20:%2A%20{{ $d->user->receiver }}%0A%2AAlamat%20:%2A%20{{ $d->user->address }}%0A%2ATelepon%20:%2A%20{{ $d->user->telephone }}'])
Chat Kurir
@endcomponent --}}
@elseif( $d->status  == 'done')
Selesai
@endif</h3>
@component('mail::button', ['url' => 'http://127.0.0.1:8000/'])
Visit
@endcomponent

Terimakasi
{{  $d->user->name }}
@endcomponent
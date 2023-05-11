@extends('user.layouts.app')
@section('content')
@include('user.partials.offcanvas')
<div class="container mt-5">
    @include('user.partials.breadcrumb')
    <div class="row justify-content-center">
        <div class="col-8">
         <div class="card">
        <div class="card-header fw-bold">Pembayaran No. Pesanan {{ $order }}</div>
         </div>
        </div>
     </div>
</div>
@endsection

  
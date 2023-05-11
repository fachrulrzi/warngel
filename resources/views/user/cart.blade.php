@extends('user.layouts.app')
@section('content')
@include('user.partials.offcanvas')
<div class="container mt-5 pt-3">
    @if (session()->has('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @if (session()->has('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    @include('user.partials.breadcrumb')
    <section class="h-100 h-custom">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12">
                    <div class="card shadow card-registration card-registration-2" style="border-radius: 15px;">
                        <div class="card-body p-0">
                            <div class="row g-0">
                                <div class="col-lg-8">
                                    <div class="p-5">
                                        <div class="d-flex justify-content-between align-items-center mb-5">
                                            <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
                                            <h6 class="mb-0 text-muted">{{ $cart->count() }} items</h6>
                                        </div>
                                        <hr class="my-4">

                                        @foreach ($cart as $c)
                                        <div class="row mb-4 d-flex justify-content-between align-items-center">
                                            <div class="col-md-2 col-lg-2 col-xl-2">
                                                <img src="{{ asset('storage/'.$c->food->image) }}"
                                                    class="img-fluid rounded-3" alt="Cotton T-shirt">
                                            </div>
                                            <div class="col-md-3 col-lg-3 col-xl-3">
                                                <h6 class="text-muted">{{ $c->food->title }}</h6>
                                                <h6 class="text-black mb-0">{{ $c->food->excerpt }}</h6>
                                            </div>
                                            <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                                <form action="{{ route('home.cart.update') }}" class="d-flex"
                                                    method="post">
                                                    @method('put')
                                                    @csrf
                                                    <button class="btn btn-link px-2" type="submit"
                                                        onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <input id="form1" class="px-2 text-center" min="1" max="{{ $c->food->stock}}" name="quantity"
                                                        value="{{ $c->quantity }}" type="number"
                                                        class="form-control text-center form-control-sm" />
                                                    <input type="hidden" name="id" value="{{ $c->id }}">
                                                    <input type="hidden" name="price" value="{{ $c->food->price }}">
                                                    <button class="btn btn-link px-2" type="submit"
                                                        onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                                @php
                                                    $total = $c->total;
                                                @endphp
                                                <h6 class="mb-0">Rp {{ number_format($total,2,',','.')  }}</h6>
                                            </div>
                                            <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                                <form action="{{ route('home.cart.destroy') }}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $c->id }}">
                                                    <button type="submit" class="btn btn-outline-danger"><i
                                                            class="bi bi-x fw-bold"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                        <hr class="my-4">
                                        @endforeach


                                    </div>
                                </div>
                                <div class="col-lg-4 bg-grey shadow">
                                    <div class="p-5">
                                        <h3 class="fw-bold mb-5 mt-2 pt-1">Checkout</h3>
                                        
                                        <hr class="my-4">
                                       <a href="/profile/{{ auth()->user()->id }}" class="text-black"> <small class="fs-6">
                                        <strong><i class="bi bi-geo-alt fw-bold"></i>Alamat Pengiriman</strong> <br>
                                        {{ auth()->user()->receiver }} | {{ auth()->user()->telephone }} <br>
                                        {{ auth()->user()->address }}</small></a>
                                        <hr class="my-4">
                                        <div class="d-flex justify-content-between mb-4">
                                            <h5 class="text-uppercase">items {{ $cart->count() }}</h5>
                                            <h5> Rp {{ number_format($cart->sum('total'),2,',','.')  }}</h5>
                                        </div>

                                        <h5 class="text-uppercase mb-3">Shipping Grab Express Instant</h5>
                                        <div class="mb-4 pb-2">
                                            
                                            <button type="button"   class="btn btn-light w-100" data-bs-toggle="modal"
                                                data-bs-target="#ongkir">
                                               @if (isset(auth()->user()->cart['id_courier']) != null)
                                               {{ auth()->user()->cart->courier->ket }}
                                                @else
                                                Pilih Jarak Pengiriman
                                               @endif
                                            </button>

                                        </div>
                                        <hr class="my-4">
                                        @php

                                        @endphp
                                        <div class="d-flex justify-content-between mb-5">
                                            <h5 class="text-uppercase">Total price</h5>
                                            @if (isset(auth()->user()->cart['id_courier']) == null)
                                            <h5> Rp 0,00</h5>
                                                @else
                                                @php
                                                $subtotal = auth()->user()->cart->courier->price + $cart->sum('total')
                                             @endphp
                                              <h5> Rp {{ number_format($subtotal,2,',','.')  }}</h5>
                                               @endif
                                         
                                        
                                        </div>
                                        <form action="{{ route('home.cart.storecart') }}" method="post">
                                            @csrf
                                            @if (isset(auth()->user()->cart['id_courier']) != null)
                                            <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                                            <input type="hidden" name="id_courier" value="{{ auth()->user()->cart['id_courier'] }}">
                                            <input type="hidden" name="id_user" value="{{ auth()->user()->id}}">
                                            @endif
                                            <button type="submit" class="btn btn-primary w-100">Order</button>
                                        </form>
                                        

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal -->
<div class="modal fade" id="ongkir" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  ">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-light" id="staticBackdropLabel">Pilih Jarak Pengiriman</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('home.cart.updatecourier') }}" method="post">
                    @method('put')
                    @csrf
                    <input type="hidden" name="id" value="{{ $id }}">
                <select  class="form-control my-4" name="id_courier">
                    @foreach ($courier as $c)
                    <option value="{{ $c->id }}">{{ $c->ket }}</option>
                    @endforeach
                </select>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary me-1 mb-1">
                        Submit
                    </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection

@extends('user.layouts.app')
@section('content')

<div class="container mt-5 pt-3">
    @if (session()->has('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @include('user.partials.offcanvas')
    @include('user.partials.breadcrumb')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body ">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active " aria-current="page" data-bs-toggle="tab" href="#unpaid">Belum
                                Bayar <small><div class="badge badge-pill fw-bold bg-danger rounded-circle me-1">
                                    {{ $unpaid->count() }}
                                  </div></small></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#packed" data-bs-toggle="tab">Kemas <small><div class="badge badge-pill fw-bold bg-danger rounded-circle me-1">
                                {{ $packed->count() }}
                              </div></small></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#shipped" data-bs-toggle="tab">Dikirim <small><div class="badge badge-pill fw-bold bg-danger rounded-circle me-1">
                                {{ $shipped->count() }}
                              </div></small></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#done" data-bs-toggle="tab">Selesai <small><div class="badge badge-pill fw-bold bg-danger rounded-circle me-1">
                                {{ $done->count() }}
                              </div></small></a>
                        </li>
                    </ul>
                    <div class="tab-content py-4">
                        <div role="tabpanel" id="unpaid" class="tab-pane active">
                           @if ($unpaid->count())
                           @foreach ($unpaid as $unpaids)
                           <div class="container h-100">
                               <div class="row d-flex justify-content-center align-items-center h-100">
                                   <div class="col-12">
                                       <div class="card shadow card-registration card-registration-2"
                                           style="border-radius: 15px;">
                                           <div class="card-body p-0">
                                               <div class="row g-0">
                                                   <div class="col-lg-8 p-5">
                                                       <div class="row justify-content-center">
                                                           @foreach ($unpaids as $u)
                                                           <div class="col-12 ">
                                                               <div
                                                                   class="row mb-4 d-flex justify-content-between align-items-center">
                                                                   <div class="col-md-2 col-lg-2 col-xl-2">
                                                                       <img src="{{ asset('storage/'.$u->food->image) }}"
                                                                           class="img-fluid rounded-3" alt="...">
                                                                   </div>
                                                                   <div class="col-md-3 col-lg-3 col-xl-3">
                                                                       <h6 class="text-muted">{{ $u->food->title }}
                                                                       </h6>
                                                                       <h6 class="text-black mb-0">
                                                                           {{ $u->food->excerpt }}</h6>
                                                                   </div>
                                                                   <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                                                       <div class="fw-bold">
                                                                           x{{ $u->quantity }}
                                                                       </div>
                                                                   </div>
                                                                   <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                                                       <h6 class="mb-0 text-danger"> Rp
                                                                           {{ number_format($u->quantity * $u->food->price,2,',','.')  }}
                                                                       </h6>
                                                                   </div>
                                                               </div>
                                                               <hr class="my-4">

                                                           </div>
                                                           @endforeach
                                                       </div>
                                                   </div>
                                                   <div class="col-lg-4 bg-grey shadow p-5">
                                                       <h3 class="fw-bold ">Rincian Pesanan</h3>
                                                       <p class="fw-bold">No. Pesanan {{ $u->custom_id }}</p>
                                                       <hr class="my-4">

                                                       <small class="fs-6 ">
                                                           <strong><i class="bi bi-geo-alt fw-bold"></i>Alamat
                                                               Pengiriman</strong> <br>
                                                           {{ auth()->user()->receiver }} |
                                                           {{ auth()->user()->telephone }} <br>
                                                           {{ auth()->user()->address }} <br>
                                                           Pengiriman : {{ $u->courier->ket }}
                                                       </small>

                                                       <hr class="my-4">
                                                       <p>
                                                           Subtotal Produk : Rp
                                                           {{ number_format($u->subtotal - $u->courier->price ,2,',','.')  }}
                                                           <br>
                                                           Subtotal Pengiriman : Rp
                                                           {{ number_format($u->courier->price,2,',','.')  }} <br>
                                                       </p>
                                                       <hr class="my-4">
                                                       <div class="d-flex justify-content-between mb-4">
                                                           <h5 class="text-uppercase">Total Pesanan</h5>
                                                           <h5>Rp {{ number_format($u->subtotal,2,',','.')  }}</h5>
                                                       </div>
                                                       @if ($u->transaction->bukti == null)
                                                       <button class="btn btn-primary w-100" data-bs-toggle="modal"
                                                       data-bs-target="#bayar{{ $u->custom_id }}">Bayar</button>
                                                       <strong><small class="text-danger">Pesanan Akan Dibatalkan Setelah 24 Jam Waktu Pemesanan</small></strong>
                                                       @else
                                                       <button class="btn btn-primary w-100" disabled >Done</button>
                                                       <strong><small class="text-danger">Menunggu Konfirmasi Admin</small></strong>

                                                       @endif
                                                       <!-- Modal -->
                                                       <div class="modal fade" id="bayar{{ $u->custom_id }}"
                                                           data-bs-backdrop="static" data-bs-keyboard="false"
                                                           tabindex="-1" aria-labelledby="staticBackdropLabel"
                                                           aria-hidden="true">
                                                           <div class="modal-dialog modal-dialog-centered  ">
                                                               <div class="modal-content">
                                                                   <div class="modal-header bg-primary">
                                                                       <h1 class="modal-title fs-5 text-light"
                                                                           id="staticBackdropLabel">Pembayaran</h1>
                                                                       <button type="button" class="btn-close"
                                                                           data-bs-dismiss="modal"
                                                                           aria-label="Close"></button>
                                                                   </div>
                                                                   <div class="modal-body py-3">
                                                                       <p class="fw-bold">No. Rekening(BCA) :
                                                                           8660340352 <br>Nama : Fachrul Rozi<br>
                                                                           Total Pembayaran : Rp
                                                                           {{ number_format($u->subtotal,2,',','.')  }}
                                                                       </p>

                                                                       <p class="mb-0">Upload Bukti Transfer</p>
                                                                       <form action="{{ route('home.transaction') }}" method="post" enctype="multipart/form-data">
                                                                           @csrf
                                                                           <input type="hidden" name="custom_id" value="{{ $u->custom_id }}">
                                                                       <input type="file" class="form-control"
                                                                           name="bukti" id="">
                                                                   </div>
                                                                   <div class="modal-footer">
                                                                       <button type="button" class="btn btn-secondary"
                                                                           data-bs-dismiss="modal">Close</button>
                                                                       <button type="submit"
                                                                           class="btn btn-primary me-1 mb-1">
                                                                           Submit
                                                                       </button>
                                                                       </form>
                                                                   </div>
                                                               </div>
                                                           </div>
                                                       </div>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                           @endforeach
                           @else
                           <hr>
                           <h3 class="text-center">Belum Ada Pesanan</h3>
                           <hr>
                           @endif
                        </div>
                        <div role="tabpanel" id="packed" class="tab-pane py-2">
                            @foreach ($packed as $packeds)
                            <div class="container h-100">
                                <div class="row d-flex justify-content-center align-items-center h-100">
                                    <div class="col-12">
                                        <div class="card shadow card-registration card-registration-2"
                                            style="border-radius: 15px;">
                                            <div class="card-body p-0">
                                                <div class="row g-0">
                                                    <div class="col-lg-8 p-5">
                                                        <div class="row justify-content-center">
                                                            @foreach ($packeds as $u)
                                                            <div class="col-12 ">
                                                                <div
                                                                    class="row mb-4 d-flex justify-content-between align-items-center">
                                                                    <div class="col-md-2 col-lg-2 col-xl-2">
                                                                        <img src="{{ asset('img/9A4BB06B-A734-469B-8051-77FDC5FF2B5D-11970-0000122FDC999616.jpg') }}"
                                                                            class="img-fluid rounded-3" alt="...">
                                                                    </div>
                                                                    <div class="col-md-3 col-lg-3 col-xl-3">
                                                                        <h6 class="text-muted">{{ $u->food->title }}
                                                                        </h6>
                                                                        <h6 class="text-black mb-0">
                                                                            {{ $u->food->excerpt }}</h6>
                                                                    </div>
                                                                    <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                                                        <div class="fw-bold">
                                                                            x{{ $u->quantity }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                                                        <h6 class="mb-0 text-danger"> Rp
                                                                            {{ number_format($u->quantity * $u->food->price,2,',','.')  }}
                                                                        </h6>
                                                                    </div>
                                                                </div>
                                                                <hr class="my-4">

                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 bg-grey shadow p-5">
                                                        <h3 class="fw-bold ">Rincian Pesanan</h3>
                                                        <p class="fw-bold">No. Pesanan {{ $u->custom_id }}</p>
                                                        <hr class="my-4">

                                                        <small class="fs-6 ">
                                                            <strong><i class="bi bi-geo-alt fw-bold"></i>Alamat
                                                                Pengiriman</strong> <br>
                                                            {{ auth()->user()->receiver }} |
                                                            {{ auth()->user()->telephone }} <br>
                                                            {{ auth()->user()->address }} <br>
                                                            Pengiriman : {{ $u->courier->ket }}
                                                        </small>

                                                        <hr class="my-4">
                                                        <p>
                                                            Subtotal Produk : Rp
                                                            {{ number_format($u->subtotal - $u->courier->price ,2,',','.')  }}
                                                            <br>
                                                            Subtotal Pengiriman : Rp
                                                            {{ number_format($u->courier->price,2,',','.')  }} <br>
                                                        </p>
                                                        <hr class="my-4">
                                                        <div class="d-flex justify-content-between mb-4">
                                                            <h5 class="text-uppercase">Total Pesanan</h5>
                                                            <h5>Rp {{ number_format($u->subtotal,2,',','.')  }}</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div role="tabpanel" id="shipped" class="tab-pane  py-2">
                            @foreach ($shipped as $shippeds)
                            <div class="container h-100">
                                <div class="row d-flex justify-content-center align-items-center h-100">
                                    <div class="col-12">
                                        <div class="card shadow card-registration card-registration-2"
                                            style="border-radius: 15px;">
                                            <div class="card-body p-0">
                                                <div class="row g-0">
                                                    <div class="col-lg-8 p-5">
                                                        <div class="row justify-content-center">
                                                            @foreach ($shippeds as $u)
                                                            <div class="col-12 ">
                                                                <div
                                                                    class="row mb-4 d-flex justify-content-between align-items-center">
                                                                    <div class="col-md-2 col-lg-2 col-xl-2">
                                                                        <img src="{{ asset('img/9A4BB06B-A734-469B-8051-77FDC5FF2B5D-11970-0000122FDC999616.jpg') }}"
                                                                            class="img-fluid rounded-3" alt="...">
                                                                    </div>
                                                                    <div class="col-md-3 col-lg-3 col-xl-3">
                                                                        <h6 class="text-muted">{{ $u->food->title }}
                                                                        </h6>
                                                                        <h6 class="text-black mb-0">
                                                                            {{ $u->food->excerpt }}</h6>
                                                                    </div>
                                                                    <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                                                        <div class="fw-bold">
                                                                            x{{ $u->quantity }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                                                        <h6 class="mb-0 text-danger"> Rp
                                                                            {{ number_format($u->quantity * $u->food->price,2,',','.')  }}
                                                                        </h6>
                                                                    </div>
                                                                </div>
                                                                <hr class="my-4">

                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 bg-grey shadow p-5">
                                                        <h3 class="fw-bold ">Rincian Pesanan</h3>
                                                        <p class="fw-bold">No. Pesanan {{ $u->custom_id }}</p>
                                                        <hr class="my-4">

                                                        <small class="fs-6 ">
                                                            <strong><i class="bi bi-geo-alt fw-bold"></i>Alamat
                                                                Pengiriman</strong> <br>
                                                            {{ auth()->user()->receiver }} |
                                                            {{ auth()->user()->telephone }} <br>
                                                            {{ auth()->user()->address }} <br>
                                                            Pengiriman : {{ $u->courier->ket }}
                                                        </small>

                                                        <hr class="my-4">
                                                        <p>
                                                            Subtotal Produk : Rp
                                                            {{ number_format($u->subtotal - $u->courier->price ,2,',','.')  }}
                                                            <br>
                                                            Subtotal Pengiriman : Rp
                                                            {{ number_format($u->courier->price,2,',','.')  }} <br>
                                                        </p>
                                                        <hr class="my-4">
                                                        <div class="d-flex justify-content-between mb-4">
                                                            <h5 class="text-uppercase">Total Pesanan</h5>
                                                            <h5>Rp {{ number_format($u->subtotal,2,',','.')  }}</h5>
                                                        </div>
                                                     
                                                        <a href="https://api.whatsapp.com/send?phone={{ $u->no_kurir }}&text=%2ATracker%20Makanan%20Toko%20Warngel%2A%0A====================================%0A%2ANo.Pesanan%20:%2A%20{{ $u->custom_id }}%0A%2APenerima%20:%2A%20{{ $u->user->receiver }}%0A%2AAlamat%20:%2A%20{{ $u->user->address }}%0A%2ATelepon%20:%2A%20{{ $u->user->telephone }}" class="btn btn-success w-100 fw-bold" > <i class="bi bi-whatsapp"> </i></a>
                                                            <strong><small class="text-danger">Chat Kurir Yang Mengantar Makanan Anda</small></strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div role="tabpanel" id="done" class="tab-pane  py-2">
                            @foreach ($done as $dones)
                            <div class="container h-100">
                                <div class="row d-flex justify-content-center align-items-center h-100">
                                    <div class="col-12">
                                        <div class="card shadow card-registration card-registration-2"
                                            style="border-radius: 15px;">
                                            <div class="card-body p-0">
                                                <div class="row g-0">
                                                    <div class="col-lg-8 p-5">
                                                        <div class="row justify-content-center">
                                                            @foreach ($dones as $u)
                                                            <div class="col-12 ">
                                                                <div
                                                                    class="row mb-4 d-flex justify-content-between align-items-center">
                                                                    <div class="col-md-2 col-lg-2 col-xl-2">
                                                                        <img src="{{ asset('storage/'.$u->food->image) }}"
                                                                            class="img-fluid rounded-3" alt="...">
                                                                    </div>
                                                                    <div class="col-md-3 col-lg-3 col-xl-3">
                                                                        <h6 class="text-muted">{{ $u->food->title }}
                                                                        </h6>
                                                                        <h6 class="text-black mb-0">
                                                                            {{ $u->food->excerpt }}</h6>
                                                                    </div>
                                                                    <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                                                        <div class="fw-bold">
                                                                            x{{ $u->quantity }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                                                        <h6 class="mb-0 text-danger"> Rp
                                                                            {{ number_format($u->quantity * $u->food->price,2,',','.')  }}
                                                                        </h6>
                                                                    </div>
                                                                </div>
                                                                <hr class="my-4">

                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 bg-grey shadow p-5">
                                                        <h3 class="fw-bold ">Rincian Pesanan</h3>
                                                        <p class="fw-bold">No. Pesanan {{ $u->custom_id }}</p>
                                                        <hr class="my-4">

                                                        <small class="fs-6 ">
                                                            <strong><i class="bi bi-geo-alt fw-bold"></i>Alamat
                                                                Pengiriman</strong> <br>
                                                            {{ auth()->user()->receiver }} |
                                                            {{ auth()->user()->telephone }} <br>
                                                            {{ auth()->user()->address }} <br>
                                                            Pengiriman : {{ $u->courier->ket }}
                                                        </small>

                                                        <hr class="my-4">
                                                        <p>
                                                            Subtotal Produk : Rp
                                                            {{ number_format($u->subtotal - $u->courier->price ,2,',','.')  }}
                                                            <br>
                                                            Subtotal Pengiriman : Rp
                                                            {{ number_format($u->courier->price,2,',','.')  }} <br>
                                                        </p>
                                                        <hr class="my-4">
                                                        <div class="d-flex justify-content-between mb-4">
                                                            <h5 class="text-uppercase">Total Pesanan</h5>
                                                            <h5>Rp {{ number_format($u->subtotal,2,',','.')  }}</h5>
                                                        </div>
                                                        <button class="btn btn-primary w-100" data-bs-toggle="modal"
                                                            data-bs-target="#bukti{{ $u->custom_id }}">Bukti Pengiriman</button>
                                                              <!-- Modal -->
                                                        <div class="modal fade" id="bukti{{ $u->custom_id }}"
                                                            data-bs-backdrop="static" data-bs-keyboard="false"
                                                            tabindex="-1" aria-labelledby="staticBackdropLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered  ">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-primary">
                                                                        <h1 class="modal-title fs-5 text-light"
                                                                            id="staticBackdropLabel">Bukti Pengiriman</h1>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body py-3">
                                                                        <img src="{{ asset('storage/'.$u->bukti) }}"
                                                                        class="img-fluid rounded-3" alt="...">
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

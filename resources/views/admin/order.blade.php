@extends('admin.layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        @if (Session::has('message'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        <div class="col-12 mb-2">
            <h2>Data Order Makanan</h2>
        </div>
        <div class="col-12" id="blum-bayar">
            <div class="card">
                <div class="card-header">
                    <h5> Data Belum Bayar</h5>
                </div>
                <div class="card-body ">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Nama Penerima</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                                <th>Nama Makanan</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                                <th>Ongkir</th>
                                <th>Subtotal</th>
                                <th>Tanggal</th>
                                <th>Bukti Pembayaran</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($unpaid as $unpaids)
                            <tr>
                                @foreach ($unpaids as $u)
                                @endforeach
                                <td>{{ $u->custom_id }}</td>
                                <td>{{ $u->user->name }}</td>
                                <td>{{ $u->user->receiver }}</td>
                                <td>{{ $u->user->address }}</td>
                                <td>{{ $u->user->telephone }}</td>
                                <td>
                                    <ul>
                                        @foreach ($unpaids as $u)
                                        <li>{{ $u->food->title }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <ul>
                                        @foreach ($unpaids as $u)
                                        <li>{{ $u->quantity }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td> Rp {{ number_format($u->subtotal - $u->courier->price ,2,',','.')  }}</td>
                                <td>Rp {{ number_format($u->courier->price,2,',','.')  }}</td>
                                <td>Rp {{ number_format($u->subtotal,2,',','.')  }}</td>
                                <td>{{ $u->created_at }}</td>
                                <td>
                                    @if ($u->transaction->bukti != null)
                                    <button class="btn btn-sm btn-primary w-100" data-bs-toggle="modal"
                                        data-bs-target="#bukti{{ $u->custom_id}}">Gambar</button></td>
                                @else
                                Belum Bayar
                                @endif
                                <!-- Modal -->
                                <div class="modal fade" id="bukti{{ $u->custom_id}}" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered  ">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h1 class="modal-title fs-5 text-light" id="staticBackdropLabel">Bukti
                                                    Pengiriman</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body py-3">
                                                <img src="{{ asset('storage/'.$u->transaction->bukti) }}"
                                                    class="img-fluid rounded-3" alt="...">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </td>
                                <td>
                                    @if ($u->transaction->bukti != null)
                                    <form action="{{ route('admin.order.konfir') }}" method="post">
                                        @method('put')
                                        @csrf
                                        <input type="hidden" name="custom_id" value="{{ $u->custom_id }}">
                                        <button type="submit" class="btn btn-primary my-2"><i
                                                class="bi bi-clipboard-check-fill"></i></button>
                                    </form>
                                    @endif
                                    <form action="{{ route('admin.order.destroy') }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <input type="hidden" name="custom_id" value="{{ $u->custom_id }}">
                                        <button type="submit" class="btn btn-danger"><i
                                                class="bi bi-trash my-2"></i></button>
                                    </form>

                                </td>





                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12" id="dikemas">
            <div class="card">
                <div class="card-header">
                    <h5> Data Packing</h5>
                </div>
                <div class="card-body  ">
                    <div class="table-responsive">
                        <table class="table  table-striped" id="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Nama Penerima</th>
                                    <th>Alamat</th>
                                    <th>Telepon</th>
                                    <th>Nama Makanan</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                    <th>Ongkir</th>
                                    <th>Subtotal</th>
                                    <th>Tanggal</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($packed as $packeds)
                                <tr>
                                    @foreach ($packeds as $u)
                                    @endforeach
                                    <td>{{ $u->custom_id }}</td>
                                    <td>{{ $u->user->name }}</td>
                                    <td>{{ $u->user->receiver }}</td>
                                    <td>{{ $u->user->address }}</td>
                                    <td>{{ $u->user->telephone }}</td>
                                    <td>
                                        <ul>
                                            @foreach ($packeds as $u)
                                            <li>{{ $u->food->title }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach ($packeds as $u)
                                            <li>{{ $u->quantity }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td> Rp {{ number_format($u->subtotal - $u->courier->price ,2,',','.')  }}</td>
                                    <td>Rp {{ number_format($u->courier->price,2,',','.')  }}</td>
                                    <td>Rp {{ number_format($u->subtotal,2,',','.')  }}</td>
                                    <td>{{ $u->created_at }}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#data{{ $u->custom_id }}">
                                            <i class="bi bi-truck"></i>
                                        </button>
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="data{{ $u->custom_id }}" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered ">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h1 class="modal-title fs-5 text-light" id="staticBackdropLabel">Pesanan :
                                                    {{ $u->user->name }}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form" action="{{ route('admin.order.update') }}" method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="custom_id" value="{{ $u->custom_id }}">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <label for="first-name-column">No. Kurir </label>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text" id="basic-addon1">+62</span>
                                                                <input type="number"
                                                                    class="form-control @error('no_kurir') is-invalid @enderror"
                                                                    name="no_kurir" aria-label="Username"
                                                                    aria-describedby="basic-addon1">
                                                            </div>
                                                            @error('no_kurir')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
    
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary me-1 mb-1">
                                                    Submit
                                                </button>
                                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">
                                                    Reset
                                                </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-12" id="dikirim">
            <div class="card">
                <div class="card-header">
                    <h5> Data Pengiriman</h5>
                </div>
                <div class="card-body ">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Nama Penerima</th>
                                    <th>Alamat</th>
                                    <th>Telepon</th>
                                    <th>Nama Makanan</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                    <th>Ongkir</th>
                                    <th>Subtotal</th>
                                    <th>Tanggal</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($shipped as $shippeds)
                                <tr>
                                    @foreach ($shippeds as $u)
                                    @endforeach
                                    <td>{{ $u->custom_id }}</td>
                                    <td>{{ $u->user->name }}</td>
                                    <td>{{ $u->user->receiver }}</td>
                                    <td>{{ $u->user->address }}</td>
                                    <td>{{ $u->user->telephone }}</td>
                                    <td>
                                        <ul>
                                            @foreach ($shippeds as $u)
                                            <li>{{ $u->food->title }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach ($shippeds as $u)
                                            <li>{{ $u->quantity }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td> Rp {{ number_format($u->subtotal - $u->courier->price ,2,',','.')  }}</td>
                                    <td>Rp {{ number_format($u->courier->price,2,',','.')  }}</td>
                                    <td>Rp {{ number_format($u->subtotal,2,',','.')  }}</td>
                                    <td>{{ $u->created_at }}</td>
                                    <td>
                                        <div class="row">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#data{{ $u->custom_id }}">
                                                <i class="bi bi-check-lg"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="data{{ $u->custom_id }}" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered ">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h1 class="modal-title fs-5 text-light" id="staticBackdropLabel">Pesanan :
                                                    {{ $u->custom_id }}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form" action="{{ route('admin.order.updates') }}" method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="custom_id" value="{{ $u->custom_id }}">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="first-name-column">Bukti Pengiriman </label>
                                                                <input type="file" id="bukti"
                                                                    class="form-control mt-2 @error('bukti') is-invalid @enderror"
                                                                    placeholder="" name="bukti">
                                                                @error('bukti')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary me-1 mb-1">
                                                    Submit
                                                </button>
                                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">
                                                    Reset
                                                </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-12" id="selesai">
            <div class="card">
                <div class="card-header">
                    <h5> Data Selesai</h5>
                </div>
                <div class="card-body ">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Nama Penerima</th>
                                    <th>Alamat</th>
                                    <th>Telepon</th>
                                    <th>Nama Makanan</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                    <th>Ongkir</th>
                                    <th>Subtotal</th>
                                    <th>Tanggal</th>
                                    <th>Bukti Pengiriman</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($done as $dones)
                                <tr>
                                    @foreach ($dones as $u)
                                    @endforeach
                                    <td>{{ $u->custom_id }}</td>
                                    <td>{{ $u->user->name }}</td>
                                    <td>{{ $u->user->receiver }}</td>
                                    <td>{{ $u->user->address }}</td>
                                    <td>{{ $u->user->telephone }}</td>
                                    <td>
                                        <ul>
                                            @foreach ($dones as $u)
                                            <li>{{ $u->food->title }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach ($dones as $u)
                                            <li>{{ $u->quantity }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td> Rp {{ number_format($u->subtotal - $u->courier->price ,2,',','.')  }}</td>
                                    <td>Rp {{ number_format($u->courier->price,2,',','.')  }}</td>
                                    <td>Rp {{ number_format($u->subtotal,2,',','.')  }}</td>
                                    <td>{{ $u->created_at }}</td>
                                    <td>
                                        <button class="btn btn-primary w-100" data-bs-toggle="modal"
                                            data-bs-target="#bukti{{ $u->custom_id }}">Lihat</button>
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="bukti{{ $u->custom_id }}" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered  ">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h1 class="modal-title fs-5 text-light" id="staticBackdropLabel">Bukti
                                                    Pengiriman</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body py-3">
                                                <img src="{{ asset('storage/'.$u->bukti) }}" class="img-fluid rounded-3"
                                                    alt="...">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                   
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

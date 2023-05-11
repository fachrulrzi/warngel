@extends('admin.layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-12 mb-2">
                    <h2>Status Makanan</h2>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                   
                   <a href="/admin/dashboard/order?#belum-bayar">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                    <div class="stats-icon red ">
                                        <i
                                            class="bi bi-credit-card-2-front-fill d-flex align-items-center justify-content-center"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">
                                        Belum Bayar
                                    </h6>
                                    <h6 class="font-extrabold mb-0">{{ $unpaid }} Makanan</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                   </a>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <a href="/admin/dashboard/order?#dikemas">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon bg-warning ">
                                            <i class="bi bi-box-seam d-flex align-items-center justify-content-center"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Dikemas</h6>
                                        <h6 class="font-extrabold mb-0">{{ $packed }} Makanan</h6>
                                    </div>
                                </div>
                            </div>
                        </div></a>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <a href="/admin/dashboard/order?#dikirim">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon green">
                                            <i class="bi bi-truck d-flex align-items-center justify-content-center"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Pengiriman</h6>
                                        <h6 class="font-extrabold mb-0">{{ $shipped }} Makanan</h6>
                                    </div>
                                </div>
                            </div>
                        </div></a>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <a href="/admin/dashboard/order?#selesai">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon blue ">
                                            <i class="bi bi-check-lg d-flex align-items-center justify-content-center"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Selesai</h6>
                                        <h6 class="font-extrabold mb-0">{{ $done }} Makanan</h6>
                                    </div>
                                </div>
                            </div>
                        </div></a>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="row">
                <div class="col-12 mb-2">
                    <h2>Data Makanan</h2>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Deskripsi</th>
                                        <th>Kategori</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Gambar</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($food as $f)
                                    <tr>
                                        <td>{{ $f->title }}</td>
                                        <td>{{ $f->excerpt }}</td>
                                        <td>{{ $f->categories->name }}</td>
                                        <td>{{ $f->price }}</td>
                                        <td>{{ $f->stock }}</td>
                                        <td><button class="btn btn-sm btn-primary w-100" data-bs-toggle="modal"
                                            data-bs-target="#bukti{{ $f->slug }}">Gambar</button></td>
                                                              <!-- Modal -->
                                                        <div class="modal fade" id="bukti{{ $f->slug }}"
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
                                                                        <img src="{{ asset('storage/'.$f->image) }}"
                                                                        class="img-fluid rounded-3" alt="...">
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-6 col-12">
                                                    <form action="{{ route('admin.dashboard.destroy') }}" method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <input type="hidden" name="slug" value="{{ $f->slug }}">
                                                        <button type="submit" class="btn btn-danger"><i
                                                                class="bi bi-trash"></i></button>
                                                    </form>
                                                </div>
                                                <div class="col-md-6 col-12"><button type="button"
                                                        class="btn btn-success" data-bs-toggle="modal"
                                                        data-bs-target="#data{{ $f->slug }}">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </button></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="data{{ $f->slug }}" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered   modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary">
                                                    <h1 class="modal-title fs-5 text-light" id="staticBackdropLabel">Edit {{ $f->title }}</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form" action="{{ route('admin.dashboard.update') }}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('put')
                                                        <input type="hidden" name="slug" value="{{ $f->slug }}">
                                                        <div class="row">
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-group">
                                                                    <label for="first-name-column">Title</label>
                                                                    <input type="text" id="title" value="{{ $f->title }}"
                                                                        class="form-control"
                                                                        placeholder="Title" name="title">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-group">
                                                                    <label for="first-name-column">Slug</label>
                                                                    <input type="text" id="slug" value="{{ $f->slug}}"
                                                                        class="form-control" readonly
                                                                        name="slug">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-group">
                                                                    <label for="first-name-column">Kategori</label>
                                                                    <select name="id_category" class="form-select" id="basicSelect">
                                                                        @foreach ($categories as $c)
                                                                        @if ($f->id_category == $c->id)
                                                                        <option value="{{ $c->id }}" selected>{{ $c->name }}</option>
                                                                        @else
                                                                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                                                                        @endif
                            
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-group">
                                                                    <label for="first-name-column">Harga</label>
                                                                    <input type="number" id="title" value="{{ $f->price }}"
                                                                        class="form-control" name="price">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-group">
                                                                    <label for="first-name-column">Stok</label>
                                                                    <input type="number"  value="{{ $f->stock}}"
                                                                        class="form-control" name="stock">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 col-12">
                                                                <div class="form-group">
                                                                    {{ $f->body }}
                                                                    <label for="first-name-column">Body</label>
                                                                    <input id="body" type="hidden" name="body" value="{{ $f->body }}">
                                                                    <trix-editor input="body"></trix-editor>
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
        </div>
    </div>
</div>
<script>
     const title = document.querySelector('#title');
    const slug = document.querySelector('#slug');

    title.addEventListener('change', function () {
        fetch('/admin/dashboard/create/checkSlug?title=' + title.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
    });

</script>

@endsection

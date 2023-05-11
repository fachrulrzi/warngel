@extends('user.layouts.app')
@section('content')
@include('user.partials.offcanvas')
<div class="container mt-5 pt-3">
    @if (session()->has('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @include('user.partials.breadcrumb')
    <div class="row">
        <div class="col-lg-4">
            <form action="{{ route('home.profile.update') }}" enctype="multipart/form-data" method="post">
                @method('put')
                @csrf
                <input type="hidden" name="id" value="{{ $user->id }}">
                <div class="card mb-4 shadow">
                    <div class="card-body text-center">
                        <div class="img">
                            @if ($user->avatar == null)
                            <img src="{{ asset('dist/assets/images/faces/1.jpg') }}"
                            alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                            @else
                            <img src="{{ asset('storage/'.$user->avatar) }}"
                            alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                            @endif
                           
                        </div>
                        <h5 class="my-3">{{ $user->name }}</h5>
                        <br>
                        <button class="btn btn-primary" type="submit">Update</button>
                        <button class="btn btn-danger" type="reset">Reset</button>
                        <br>
                        <br>
                    </div>
                </div>
        </div>
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Nama Lengkap</p>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" value="{{ $user->name }}" id="">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Foto Profile</p>
                        </div>
                        <div class="col-sm-9">
                            <input type="file" class="form-control" name="avatar" accept="image/png, image/jpeg"  id="">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Nama Penerima</p>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="receiver" value="{{ $user->receiver }}" id="">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Email</p>
                        </div>
                        <div class="col-sm-9">
                            <input type="email" readonly class="form-control" name="email" value="{{ $user->email }}"
                                id="">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Telepon</p>
                        </div>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="telephone" value="{{ $user->telephone }}"
                                id="">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Alamat</p>
                        </div>
                        <div class="col-sm-9">
                            <textarea name="address" class="form-control" id="" rows="1">{{ $user->address }}</textarea>
                            <small class="text-danger">Tolong diisi dengan alamat lengkap !!</small>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

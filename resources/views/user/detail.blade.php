@extends('user.layouts.app')
@section('content')
@include('user.partials.offcanvas')
<div class="container mt-5 pt-4">
    @if (session()->has('success'))
    <div class="alert  alert-success">
        {{ session('success') }}
    </div>
    @endif
    @if (session()->has('error'))
    <div class="alert  alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <div class="row">
        <!--Grid column-->
      
        <div class="col-md-6 mb-4 justify-content-center d-flex">
               
            <img src="{{ asset('storage/'.$food->image) }}" width="500" height="500" class="img-fluid" alt="" />
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-6 mb-4 ">
            <!--Content-->
            <div class="p-4">
                <div class="title">
                    <h3 class="fw-bold">{{ $food->title }}</h3>
                </div>
                <div class="mb-3">
                    <a href="/home?categories={{ $food->categories->slug}}">
                        <span class="badge bg-primary me-1">{{ $food->categories->name }}</span>
                    </a>
                    @if ($food->created_at->format('Y-m-d') >= $carbon )
                    <a href="/home?new={{  $carbon }}">
                        <span class="badge bg-info me-1">New</span>
                    </a> 
                    @endif
                    {{-- @if ($food->id == $top)
                    <a href="">
                        <span class="badge bg-danger me-1">Bestseller</span>
                    </a>
                    @endif --}}
                
                </div>

                <p class="lead">
                    {{-- <span class="me-1">
                        <del>$200</del>
                    </span> --}}
                    <span>Rp {{ number_format($food->price,2,',','.')  }}</span>
                </p>

                <strong><p style="font-size: 20px;">Stok : {{ $food->stock }}</p></strong>
                <strong><p style="font-size: 20px;">Description</p></strong>

                <p>{!! $food->body !!}</p>

                <form action="{{ route('home.detail.store') }}" method="POST" class="d-flex justify-content-left">
                    @csrf
                    <!-- Default input -->
                    <div class="form-outline me-1" style="width: 100px;">
                        <input type="hidden" name="id_user" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="id_food" value="{{ $food->id }}">
                        <input type="hidden" name="price" value="{{ $food->price }}">
                        <input type="number" value="1" name="quantity" max="{{ $food->stock }}" maxlength="{{ $food->stock }}" class="form-control" />
                    </div>
  
                    <button class="btn btn-primary ms-1" type="submit">
                        Add to cart
                        <i class="fas fa-shopping-cart ms-1"></i>
                    </button>
                </form>
            
            </div>
            <!--Content-->
        </div>
        <!--Grid column-->
    </div>
    <!--Grid row-->

    <hr />
</div>
@endsection

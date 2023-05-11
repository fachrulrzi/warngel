@extends('layouts.app')
@section('content')
<style>
    .card {
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    }

    .footer-cta {
        box-shadow: rgba(0, 0, 0, 0.15) 0px 5px 15px;
    }

    .price {
        color: #263238;
        font-size: 24px;
    }

    .card-title {
        color: #263238
    }

    .img {
        border-radius: 4%
    }

</style>
@include('user.partials.carousel')
<svg class="position-absolute" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#435EBE" fill-opacity="1" d="M0,224L60,192C120,160,240,96,360,90.7C480,85,600,139,720,154.7C840,171,960,149,1080,144C1200,139,1320,149,1380,154.7L1440,160L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"></path></svg>
<div class="container" style="margin-top: 18%">
      @if ($food->count())
      <h3 class="text-center mb-4">
        @if (request('search'))
        All Makanan : {{ request('search')}}
        @elseif(request('categories'))
        All Makanan : {{  request('categories') }}
        @elseif(request('price'))
        All Makanan : {{ request('price') }}
      @else
      All Makanan
      @endif</h3>
      <section>
        <div class="text-center">
            <div class="row justify-content-center">
                @foreach ($food as $f)
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card">
                        <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light"
                            data-mdb-ripple-color="light">
                            @if ($f->created_at->format('Y-m-d') >= $carbon)
                            <h5 class="position-absolute"><span class="badge bg-primary">NEW</span></h5>
                            @endif
                            {{-- @if ($f->id == $top)
                    <h5 class="position-absolute"><span class="badge bg-danger">Bestseller</span></h5>
                    @endif --}}
                            <img src="{{ asset('storage/'.$f->image) }}" class="w-100 img" />
                            <a href="#!">
                                <div class="mask">
                                    <div class="d-flex justify-content-start align-items-end h-100">
                                        {{-- <h5><span class="badge bg-dark ms-2">NEW</span></h5> --}}
                                    </div>
                                </div>
                                <div class="hover-overlay">
                                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                                </div>
                            </a>
                        </div>
                        <div class="card-body">
                            <a href="/home/{{ $f->slug }}" class="text-reset">
                                <h5 class="card-title mb-2">{{ $f->title }}</h5>
                            </a>
                            <a href="/home/{{ $f->slug }}" class="text-reset ">
                                <p>{{ $f->excerpt }}</p>
                            </a>
                            <h6 class="mb-3 price">Rp {{ number_format($f->price,2,',','.')  }}</h6>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
      @else
      <hr>
          <h3 class="text-center">Makanan Tidak Ditemukan</h3>
          <hr>
      @endif
</div>
@endsection

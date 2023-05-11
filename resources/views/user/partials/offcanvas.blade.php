
<div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
  <div class="offcanvas-header border-bottom">
        <h3 class="offcanvas-title" id="offcanvasScrollingLabel"><a class="navbar-brand text-primary me-4 fw-bold" href="{{ route('home') }}" style="font-family: 'Shrikhand', cursive;">Warngel</a>    </h3>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
      <div class="row">
        <div class="col-12 mb-2 pt-0 d-block d-lg-none border-bottom p-2">
            <div class="dropdown  justify-content-start d-flex">
                <a href="/profile/{{ auth()->user()->id }}" class="d-flex">
                    <div class="user-img d-flex align-items-center">
                        <div class="avatar avatar-lg">
                          @if (auth()->user()->avatar == null)
                          <img src="{{ asset('dist/assets/images/faces/1.jpg') }}" />
                          @else
                          <img src="{{ asset('storage/'.auth()->user()->avatar) }}" alt="">
                          @endif
                        </div>
                      </div>
                  <div class="user-menu d-flex">
                    <div class="user-name text-start me-3">
                      <h6 class="mb-0 fs-5 text-primary">{{ auth()->user()->name }}</h6>
                      <p class="mb-0 text-sm fs-6 text-gray-600">Customer</p>
                    </div>
                 
                  </div>
                </a>
              </div>
        </div>
        <div class="col-12 p-2 mb-2 d-block d-lg-none border-bottom">
            <form action="{{ route('home') }}" class="w-100" method="get">
                <div class="input-group">
                    <input type="text" class="form-control rounded-5 me-3" name="search" placeholder="Yuk Ngemil" aria-label="Username" aria-describedby="basic-addon1">
                    <button type="submit" class="btn btn-primary rounded-5"><i class="bi bi-search-heart-fill fs-4"></i></button>
                  </form>
                  </div>
        </div>
        <div class="col-12">
            <h5 class="text-primary">Menu</h5>
        </div>
        <div class="col-12 p-2 mb-2 border-bottom">
            <a class="btn btn-primary w-100" href="/order/{{ auth()->user()->id  }}"><i class="bi bi-bag-check-fill"></i> Pesanan</a>
        </div>
        <div class="col-12 p-2 mb-2 border-bottom">
            <a class="btn btn-primary w-100" href="/cart/{{ auth()->user()->id }}"><i class="bi bi-bag-heart me-2"></i> My Cart</a>
        </div>
        <div class="col-12 p-2 mb-2 border-bottom">
            <div class="dropdown ">
                <button class="btn btn-primary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Kategori
                </button>
                <ul class="dropdown-menu bg-dark w-100">
                    @foreach ($categories as $c)
                  <li class="border-bottom"><a class="dropdown-item" href="/home?categories={{ $c->slug }}">{{ $c->name }}</a></li>
                  @endforeach 
                </ul>
            </div>
        </div>
        <div class="col-12 p-2 mb-2 border-bottom">
            <div class="dropdown ">
                <button class="btn btn-primary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Filter Harga <i class="bi bi-bar-chart-steps"></i>
                </button>
                <ul class="dropdown-menu bg-dark w-100">
                  <li class="border-bottom"><a class="dropdown-item" href="/home?price=up"><i class="bi bi-sort-up"></i></a></li>
                  <li class="border-bottom"><a class="dropdown-item" href="/home?price=down"><i class="bi bi-sort-down-alt"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="col-12 p-2 mb-2 border-bottom">
            <a class="btn btn-danger w-100" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                            <i class="icon-mid bi bi-box-arrow-left me-2"></i>
             {{ __('Logout') }}
         </a>        </div>
    </div>
  </div>
</div>
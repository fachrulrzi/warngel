<nav class="navbar navbar-expand-lg  navbar-light fixed-top bg-light " style=" border-bottom: 4px solid #435EBE">
    <div class="container-fluid">
      <button class="btn me-4 d-none d-lg-block" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"> <span class="navbar-toggler-icon"></span></button>
        <a class="navbar-brand me-4 fw-bold fs-1 text-primary" href="{{ route('home') }}" style="font-family: 'Shrikhand', cursive;">Warngel</a>
      <button class="navbar-toggler"  type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-center" id="navbarNavAltMarkup">
        <div class="navbar-nav  w-75">
          <form action="{{ route('home') }}" class="w-100" method="get">
            <div class="input-group">
                <input type="text" class="form-control rounded-5 me-3" style="border: 3px solid #435EBE" name="search" value="{{ request('search') }}" placeholder="Yuk Ngemil" aria-label="Username" aria-describedby="basic-addon1">
                <button type="submit" class="btn btn-primary rounded-5"><i class="bi bi-search-heart-fill fs-4"></i></button>
              </form>
              </div>
        </div>
      </div>

    <div class="d-none d-lg-block">
      <div class="dropdown d-flex">
        <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
          <div class="user-menu d-flex">
            <div class="user-name text-end me-3">
              <h6 class="mb-0 text-primary">{{ auth()->user()->name }}</h6>
              <p class="mb-0 text-sm text-gray-600">Customer</p>
            </div>
            <div class="user-img d-flex align-items-center">
              <div class="avatar avatar-md">
                @if (auth()->user()->avatar == null)
                <img src="{{ asset('dist/assets/images/faces/1.jpg') }}" />
                @else
                <img src="{{ asset('storage/'.auth()->user()->avatar) }}" alt="">
                @endif
              </div>
            </div>
          </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton" style="min-width: 11rem">
          <li>
            <h6 class="dropdown-header">Hello, {{ auth()->user()->name }}!</h6>
          </li>
          <li>
            <a class="dropdown-item" href="/profile/{{ auth()->user()->id }}"><i class="icon-mid bi bi-person me-2"></i> My Profile</a>
          </li>
          <li>
            <a class="dropdown-item" href="/cart/{{ auth()->user()->id }}"><i class="bi bi-bag-heart me-2"></i> My Cart</a>
          </li>
          <li>
            <hr class="dropdown-divider" />
          </li>
          <li>
            <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                            <i class="icon-mid bi bi-box-arrow-left me-2"></i>
             {{ __('Logout') }}
         </a>

         <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
             @csrf
         </form>
          </li>
        </ul>
      </div>
    </div>
      </div>
    </div>
  </nav>
<nav class="navbar navbar-expand-lg  navbar-light fixed-top bg-light " style=" border-bottom: 4px solid #435EBE">
    <div class="container-fluid">
      <button class="btn me-4 d-none d-lg-block" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"> <span class="navbar-toggler-icon"></span></button>
        <a class="navbar-brand me-4 fw-bold fs-1 text-primary" href="/" style="font-family: 'Shrikhand', cursive;">Warngel</a>
      <button class="navbar-toggler"  type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-center" id="navbarNavAltMarkup">
        <div class="navbar-nav  w-75">
          <form action="/" class="w-100" method="get">
            <div class="input-group">
                <input type="text" class="form-control rounded-5 me-3" style="border: 3px solid #435EBE" name="search" value="{{ request('search') }}" placeholder="Yuk Ngemil" aria-label="Username" aria-describedby="basic-addon1">
                <button type="submit" class="btn btn-primary rounded-5"><i class="bi bi-search-heart-fill fs-4"></i></button>
              </form>
              </div>
        </div>
      </div>

    <div class="d-none d-lg-block mx-5 px-5">
        <a href="{{ route('login') }}" class="btn btn-primary w-100">Login</a>
    </div>
      </div>
    </div>
  </nav>
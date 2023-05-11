
<div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
  <div class="offcanvas-header border-bottom">
        <h3 class="offcanvas-title" id="offcanvasScrollingLabel"><a class="navbar-brand text-primary me-4 fw-bold" href="{{ route('home') }}" style="font-family: 'Shrikhand', cursive;">Warngel</a>    </h3>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
      <div class="row">
        <div class="col-12 p-2 mb-2 d-block d-lg-none border-bottom">
            <form action="/" class="w-100" method="get">
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
            <div class="dropdown ">
                <button class="btn btn-primary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Kategori
                </button>
                <ul class="dropdown-menu bg-dark w-100">
                    @foreach ($categories as $c)
                  <li class="border-bottom"><a class="dropdown-item" href="/?categories={{ $c->slug }}">{{ $c->name }}</a></li>
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
                  <li class="border-bottom"><a class="dropdown-item" href="/?price=up"><i class="bi bi-sort-up"></i></a></li>
                  <li class="border-bottom"><a class="dropdown-item" href="/?price=down"><i class="bi bi-sort-down-alt"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="col-12 p-2 mb-2 border-bottom">
          <a href="{{ route('login') }}" class="btn btn-primary w-100">Login</a>
        </div>
    </div>
  </div>
</div>
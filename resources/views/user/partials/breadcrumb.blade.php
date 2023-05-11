<div class="row">
  <div class="col">
    <nav aria-label="breadcrumb" class="card shadow p-3 mb-4">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item "><a class=" text-secondary" href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item "><a class=" text-secondary" href="/cart/{{ auth()->user()->id  }}">Cart</a></li>
        <li class="breadcrumb-item "><a class=" text-secondary" href="/order/{{ auth()->user()->id  }}">Pesanan</a></li>
        <li class="breadcrumb-item  active" aria-current="page"><a class=" text-secondary"class="" href="/profile/{{ auth()->user()->id }}"> User Profile</a> </li>
      </ol>
    </nav>
  </div>
</div>
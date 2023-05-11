@extends('auth.layouts.app')

@section('content')
 <div id="auth">
      <div class="row h-100">
        <div class="col-lg-5 col-12">
          <div id="auth-left">
           
            <h1 class="auth-title text-primary" style="font-family: 'Shrikhand', cursive;"><a href="/">Warngel</a></h1>
            <p class="auth-subtitle mb-4">
              Log in with your data that you entered during registration.
            </p>
            @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
            <form action="{{ route('login') }}" method="POST">
                @csrf
              <div class="form-group position-relative has-icon-left mb-4">
                <input
                id="email" type="email" placeholder="Email" class="form-control form-control-xl @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                />
                <div class="form-control-icon">
                  <i class="bi bi-envelope"></i>
                </div>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
              </div>

              <div class="form-group position-relative has-icon-left mb-4">
                <input
                  type="password"
                  class="form-control form-control-xl @error('password') is-invalid @enderror"
                  placeholder="Password" name="password" required autocomplete="current-password"
                />
                <div class="form-control-icon">
                  <i class="bi bi-shield-lock"></i>
                </div>
              </div>
              <div class="form-check form-check-lg d-flex align-items-end">
                <input
                  class="form-check-input me-2"
                  type="checkbox"
                   name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}
                />
                <label
                  class="form-check-label text-gray-600"
                  for="flexCheckDefault"
                >
                  Keep me logged in
                </label>
              </div>
              <button class="btn btn-primary btn-block btn-lg shadow-lg mt-4">
                Log in
              </button>
            </form>
            <div class="text-center mt-4 text-lg fs-4">
              <p class="text-gray-600">
                Don't have an account?
                <a href="{{ route('register') }}" class="font-bold">Sign up</a>.
              </p>
              <p>
                <a class="font-bold" href="{{ route('password.request') }}"
                  >Forgot password?</a
                >.
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-7 d-none d-lg-block">
          <div id="auth-right"></div>
        </div>
      </div>
    </div>
@endsection

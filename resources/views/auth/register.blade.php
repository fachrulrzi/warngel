@extends('auth.layouts.app')

@section('content')
 <div id="auth">
    <div class="row h-100">
        <div class="col-lg-5 col-12">
          <div id="auth-left">
            <h1 class="auth-title text-primary" style="font-family: 'Shrikhand', cursive;"><a href="/">Warngel</a></h1>
            <p class="auth-subtitle mb-4">
              Input your data to register to our website.
            </p>
    
            <form method="POST" action="{{ route('register') }}">
                @csrf
              <div class="form-group position-relative has-icon-left mb-4">
                <input
                  type="text"
                  class="form-control form-control-xl @error('email') is-invalid @enderror "
                  placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email"
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
                  type="text"
                  class="form-control form-control-xl @error('name') is-invalid @enderror""
                  placeholder="Name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                />
                <div class="form-control-icon">
                  <i class="bi bi-person"></i>
                </div>
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
              </div>
              <div class="form-group position-relative has-icon-left mb-4">
                <input
                  type="password"
                  class="form-control form-control-xl @error('password') is-invalid @enderror"
                  placeholder="Password"  name="password" required autocomplete="new-password"
                />
                <div class="form-control-icon">
                  <i class="bi bi-shield-lock"></i>
                </div>
                
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
              </div>
              <div class="form-group position-relative has-icon-left mb-4">
                <input
                id="password-confirm" type="password" 
                  class="form-control form-control-xl"
                  placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password"
                />
                <div class="form-control-icon">
                  <i class="bi bi-shield-lock"></i>
                </div>
              </div>
              <button class="btn btn-primary btn-block btn-lg shadow-lg mt-4">
                Sign Up
              </button>
            </form>
            <div class="text-center mt-4 text-lg fs-4">
              <p class="text-gray-600">
                Already have an account?
                <a href="{{ route('login') }}" class="font-bold">Log in</a>.
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


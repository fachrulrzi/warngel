@extends('auth.layouts.app')

@section('content')
 <div id="auth">
    <div class="row h-100">
        <div class="col-lg-5 col-12">
          <div id="auth-left">
            <h1 class="auth-title text-primary" style="font-family: 'Shrikhand', cursive;"><a href="/">Warngel</a></h1>
            <p class="auth-subtitle mb-5">
              Input your email and we will send you reset password link.
            </p>
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
            <form  method="POST" action="{{ route('password.email') }}">
                @csrf
              <div class="form-group position-relative has-icon-left mb-4">
                <input
                  type="email"
                  class="form-control form-control-xl @error('email') is-invalid @enderror"
                  placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
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
              <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
                Send
              </button>
            </form>
            <div class="text-center mt-5 text-lg fs-4">
              <p class="text-gray-600">
                Remember your account?
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

@extends('layouts.master')

@section('title')

Reset Password

@endsection

@section('content')

<main class="container-fluid px-0">
    
        <div class="container py-4 py-lg-5 my-4">
        <div class="row">
          <div class="col-6 offset-3">
            <div class="card border-0 shadow">
              <div class="card-body">
                <h2 class="h4 mb-1">Reset Password</h2>
                @if(session('danger'))
                    <div class="alert alert-danger">
                        <span> {{ session('danger') }}</span>
                    </div>
                @endif
                <form novalidate class="needs-validation" method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                        <div class="input-group mb-2">
                            <i class="ci-mail position-absolute top-50 translate-middle-y text-muted fs-base ms-3"></i>
                            <input class="form-control rounded-start @error('email') is-invalid @enderror" name="email" type="email" required value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                        
                        </div>
                        @error('email')
                            <span class="invalid-feedback mb-2" style="display:block;" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="input-group mb-2">
                            <i class="ci-locked position-absolute top-50 translate-middle-y text-muted fs-base ms-3"></i>
                            <div class="password-toggle w-100">
                              <input class="form-control" type="password" name="password" placeholder="Enter your password" required autocomplete="new-password">
                              <label class="password-toggle-btn" aria-label="Show/hide password">
                                <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                              </label>
                            </div>
                        </div>
                        @error('password')
                            <span class="invalid-feedback mb-2" style="display:block;" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="input-group mb-3">
                            <i class="ci-locked position-absolute top-50 translate-middle-y text-muted fs-base ms-3"></i>
                            <div class="password-toggle w-100">
                              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                              <label class="password-toggle-btn" aria-label="Show/hide password">
                                <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                              </label>
                            </div>
                        </div>
                  <div class="d-flex flex-wrap justify-content-between">
                    <a class="nav-link-inline fs-sm" href="{{ url('login') }}">
                        Back to Login
                    </a>
                  </div>
                  <hr class="mt-4">
                  <div class="text-end pt-4">
                    <button class="btn btn-primary" type="submit"><i class="ci-sign-in me-2 ms-n21"></i>Reset Password</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

    </main>


@endsection

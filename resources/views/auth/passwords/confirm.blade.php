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
                <h2 class="h4 mb-1">Confirm Password</h2>
                <p>Please confirm your password before continuing.</p>
                <form novalidate class="needs-validation" method="POST" action="{{ route('password.confirm') }}">
                    @csrf
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
                        @if (Route::has('password.request'))
                          <div class="d-flex flex-wrap justify-content-between">
                            <a class="nav-link-inline fs-sm" href="{{ route('password.request') }}">
                                Forgot Your Password?
                            </a>
                          </div>
                          @endif
                  <hr class="mt-4">
                  <div class="text-end pt-4">
                    <button class="btn btn-primary" type="submit"><i class="ci-sign-in me-2 ms-n21"></i>Confirm Password</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

    </main>


@endsection

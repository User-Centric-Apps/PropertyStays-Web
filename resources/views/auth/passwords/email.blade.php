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
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <form novalidate class="needs-validation" method="POST" action="{{ route('password.email') }}">
                    @csrf
                        <div class="input-group mb-2">
                            <i class="ci-mail position-absolute top-50 translate-middle-y text-muted fs-base ms-3"></i>
                            <input class="form-control rounded-start @error('email') is-invalid @enderror" name="email" type="email" required value="{{ old('email') }}" required autocomplete="email" autofocus>

                        </div>
                            @error('email')
                                <span class="invalid-feedback mb-2" style="display:block;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        
                  <div class="d-flex flex-wrap justify-content-between">
                    <a class="nav-link-inline fs-sm" href="{{ url('login') }}">
                        Back to Login
                    </a>
                  </div>
                  <hr class="mt-4">
                  <div class="text-end pt-4">
                    <button class="btn btn-primary" type="submit"><i class="ci-sign-in me-2 ms-n21"></i>Send Password Reset Link</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

    </main>
    

@endsection

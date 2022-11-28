@extends('layouts.master')

@section('title')

Sign in/Sign up

@endsection


@section('script')

@endsection

@section('content')

    <main class="container-fluid px-0">
    
        <div class="container py-4 py-lg-5 my-4">
        <div class="row">
          <div class="col-md-6">
            <div class="card border-0 shadow">
              <div class="card-body">
                <h2 class="h4 mb-1">Sign in</h2>
                <div class="py-3">
                  <h3 class="d-inline-block align-middle fs-base fw-medium mb-2 me-2">With social account:</h3>
                  <div class="d-inline-block align-middle">
                    <a class="btn-social bs-google me-2 mb-2" href="{{ url('auth/google') }}" data-bs-toggle="tooltip" title="Sign in with Google">
                      <i class="ci-google"></i>
                    </a>
                    <a class="btn-social bs-facebook me-2 mb-2" href="{{ url('auth/facebook') }}" data-bs-toggle="tooltip" title="Sign in with Facebook">
                      <i class="ci-facebook"></i>
                    </a>
                  </div>
                </div>
                <hr>
                <h3 class="fs-base pt-4 pb-2">Or using form below</h3>
                @if(session('danger'))
                    <div class="alert alert-danger">
                        <span> {{ session('danger') }}</span>
                    </div>
                @endif
                <form novalidate class="needs-validation" method="POST" action="{{ url('post-login') }}">
                    @csrf
                  <div class="input-group mb-3">
                    <i class="ci-mail position-absolute top-50 translate-middle-y text-muted fs-base ms-3"></i>
                    <input class="form-control rounded-start" name="email" type="email" placeholder="Enter your email" required>
                    
                  </div>

                  <div class="input-group mb-3"><i class="ci-locked position-absolute top-50 translate-middle-y text-muted fs-base ms-3"></i>
                    <div class="password-toggle w-100">
                      <input class="form-control" type="password" name="password" placeholder="Enter your password" required>
                      <label class="password-toggle-btn" aria-label="Show/hide password">
                        <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                      </label>
                    </div>
                  </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                  <div class="d-flex flex-wrap justify-content-between">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="remember_me" checked id="remember_me" <?php echo old("remember_me") ? "checked" : "" ?>>
                      <label class="form-check-label" for="remember_me">Remember me</label>
                    </div>
                    <a class="nav-link-inline fs-sm" href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                  </div>
                  <hr class="mt-4">
                  <div class="text-end pt-4">
                    <button class="btn btn-primary" type="submit"><i class="ci-sign-in me-2 ms-n21"></i>Sign In</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-6 pt-4 mt-3 mt-md-0">
            <h2 class="h4 mb-3">No account? Sign up</h2>
            <p class="fs-sm text-muted mb-4">
                Registration takes less than a minute but gives you full control over your orders.
            </p>
            @if ($errors->any())

                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>

            @endif

            @if(session('dangers'))
                <div class="alert alert-danger">
                    {{ session('dangers') }}
                </div>
            @endif
            @if(session('danger-reg'))
                <div class="alert alert-danger">
                    {{ session('danger-reg') }}
                </div>
            @endif
            <form class="needs-validation" id="my-form"  method="POST" action="{{ route('newregister') }}">
              @csrf
              <div class="row gx-4 gy-3">
                <div class="col-sm-6">
                  <label class="form-label" for="name">Full Name</label>
                  <input id="name" class="form-control @error('name') is-invalid @enderror" type="text" required name="name" value="{{ old('name') }}" placeholder="Enter your name" required autocomplete="name" autofocus>
                  <div class="invalid-feedback">Please enter your full name!</div>
                  @error('name')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-sm-6">
                  <label class="form-label" for="mobile">Mobile</label>
                  <input class="form-control" type="text" id="mobile" class="form-control @error('mobile') is-invalid @enderror" name="mobile" placeholder="(44 7911 123456)" value="{{ old('mobile') }}" required autocomplete="mobile">
                  <div class="invalid-feedback">Please enter your phone number!</div>
                  @error('mobile')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-sm-12">
                  <label class="form-label" for="email">E-mail Address</label>
                  <input required id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter your email" value="{{ old('email') }}" required autocomplete="email">
                  <div class="invalid-feedback">Please enter valid email address!</div>
                  @error('email')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-sm-6">
                  <label class="form-label" for="password">Password</label>
                  
                  <div class="password-toggle">
                    <input class="form-control" id="password" type="password" class="form-control" name="password" required placeholder="Enter your password" autocomplete="new-password">
                    <label class="password-toggle-btn" aria-label="Show/hide password">
                      <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                    </label>
                  </div>
                  <div class="invalid-feedback">Please enter password!</div>
                  @error('password')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
                </div>
                <div class="col-sm-6">
                  <label class="form-label" for="reg-password-confirm">Confirm Password</label>
                  
                  <div class="password-toggle">
                    <input class="form-control" id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Re-enter your password" required autocomplete="new-password">
                    <label class="password-toggle-btn" aria-label="Show/hide password">
                      <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                    </label>
                  </div>
                  <div class="invalid-feedback">Passwords do not match!</div>
                </div>
                <div class="col-sm-6">
                  <div class="form-check form-check-inline" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="hover" title="Host" data-bs-content="You can upload the property">
                    <input class="form-check-input" type="radio" id="host" value="1" name="type" >
                    <label class="form-check-label" for="host">Host</label>
                  </div>
                  <div class="form-check form-check-inline" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="hover" title="Traveller User" data-bs-content="You can just book the property!">
                    <input class="form-check-input" type="radio" id="normal" name="type" value="2" checked>
                    <label class="form-check-label" for="normal">Traveller</label>
                  </div>
                  <div class="form-check form-check-inline" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="hover" title="Host" data-bs-content="You can rent th property and book it.">
                    <input class="form-check-input" type="radio" id="both" value="3" name="type" >
                    <label class="form-check-label" for="both">Both</label>
                  </div>

                </div>
                    <div class="col-12">
                            <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                            @if ($errors->has('g-recaptcha-response'))
                                <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                            @endif
                    </div>

                <div class="col-12 text-end">
                  <button class="btn btn-primary" type="submit"><i class="ci-user me-2 ms-n1"></i>Sign Up</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

    </main>

@endsection

@section('script_last')
<script src='https://www.google.com/recaptcha/api.js'></script>
@endsection
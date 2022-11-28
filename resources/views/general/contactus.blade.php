@extends('layouts.master')

@section('title')

{{ $item->title }}

@endsection


@section('script')

@endsection



@section('content')

<div id='loader' style='display: none;'>
  <img src="{{ URL::asset('resources/assets/layouts/layout/img/ajax-loading.gif') }}" >
</div>

    <section class="bg-primary bg-position-top-center bg-repeat-0 py-5 syed-bg" style="background-image: url({{ URL::to('/') }}/storage/app/public/uploads/pages/{{ $item->image }});">
      <div class="pb-lg-5 mb-lg-3">
        <div class="container py-lg-5 my-lg-5">
          <div class="row mb-4 mb-sm-5">
            <div class="col-lg-7 col-md-9 text-center text-sm-start">
              <h1 class="lh-base" style="color: #00bdbc !important; text-shadow: 2px 2px 2px rgb(0 0 0);">
                {{ $item->title }}
              </h1>
              <h2 class="h5 text-green fw-dark"  style="color: #00bdbc !important; text-shadow: 2px 2px 2px rgb(0 0 0);">
                {{ $item->sub_title }}
              </h2>
            </div>
          </div>
          
        </div>
      </div>
    </section>

    <section class="container position-relative pt-3 pt-lg-0 pb-5 mt-lg-n10" style="z-index: 10;">
      <div class="card px-lg-2 border-0 shadow-lg">
          <div class="row">
            <div class="col-12">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-end py-2">
                  <li class="breadcrumb-item">
                    <a class="text-nowrap" href="{{ url('/') }}">
                      <i class="ci-home"></i>Home</a>
                  </li>
                  <li class="breadcrumb-item text-nowrap active" aria-current="page">
                    {{ $item->title }}
                  </li>
                </ol>
              </nav>
            </div>
          </div>
          <div class="card-body">

            <div class="row g-0">
              <div class="col-6 px-4 px-xl-4 py-4">
                {!! $item->description !!}
              </div>
              <div class="col-6 px-4 px-xl-4 py-4">
                <h3 class="mb-4">Drop us a line</h3>
                <form class="needs-validation mb-3" id="my-form" novalidate action="javascript:void(0)" method="post">
                  @csrf
                  <div class="row g-3">
                    <div class="col-sm-6">
                      <label class="form-label" for="cf-name">Your name:&nbsp;<span class="text-danger">*</span></label>
                      <input class="form-control" type="text" id="cf-name" placeholder="John Doe" required>
                      <div class="invalid-feedback">Please fill in you name!</div>
                    </div>
                    <div class="col-sm-6">
                      <label class="form-label" for="cf-email">Email address:&nbsp;<span class="text-danger">*</span></label>
                      <input class="form-control" type="email" id="cf-email" placeholder="johndoe@email.com" required>
                      <div class="invalid-feedback">Please provide valid email address!</div>
                    </div>
                    <div class="col-sm-6">
                      <label class="form-label" for="cf-phone">Your phone:&nbsp;<span class="text-danger">*</span></label>
                      <input class="form-control" type="text" id="cf-phone" placeholder="+1 (212) 00 000 000" required>
                      <div class="invalid-feedback">Please provide valid phone number!</div>
                    </div>
                    <div class="col-sm-6">
                      <label class="form-label" for="cf-subject">Subject:</label>
                      <input class="form-control" type="text" id="cf-subject" placeholder="Provide short title of your request">
                    </div>
                    <div class="col-12">
                      <label class="form-label" for="cf-message">Message:&nbsp;<span class="text-danger">*</span></label>
                      <textarea class="form-control" id="cf-message" rows="6" placeholder="Please describe in detail your request" required></textarea>
                      <div class="invalid-feedback">Please write a message!</div>
                    </div>
                    <input type="text" name="_gotcha" style="display: none;">
                    <div class="col-12">
                      <button class="btn btn-primary mt-4" type="submit" id="register-submit-btn">
                        Send message
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
      </div>
    </section>

@endsection

@section('script_last')

<script src="https://www.google.com/recaptcha/api.js?render=6Ld7r7odAAAAAN30Tg1KORDJLtP-CbKJWO6pi_KH
"></script>
<script>
  var submitted = false;
  var tokenCreated = false;
  var formEl = document.getElementById('my-form');

  formEl.addEventListener("submit", function (event) {

    // Check if the recaptcha exists
    if (!tokenCreated) {

      // Prevent submission
      event.preventDefault();

      // Prevent more than one submission
      if (!submitted) {
        submitted = true;
        // needs for recaptacha ready
        grecaptcha.ready(function() {
          // do request for recaptcha token
          // response is promise with passed token
          grecaptcha.execute('6Ld7r7odAAAAAN30Tg1KORDJLtP-CbKJWO6pi_KH', {action: 'create_comment'}).then(function (token) {
            // add token to form
            var input = document.createElement("input");
            input.type = "hidden";
            input.name = "g-recaptcha-response";
            input.value = token;
            formEl.appendChild(input);

            // resubmit the form
            tokenCreated = true;
            formEl.submit();
          });
        });
      }
    }
  });
</script>


@endsection
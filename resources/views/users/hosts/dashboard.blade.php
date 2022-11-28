@extends('layouts.master')

@section('title')

Your earnings

@endsection


@section('script')

<link rel="stylesheet" media="screen" href="{{ URL::asset('resources/assets/front-end/vendor/simplebar/dist/simplebar.min.css') }}"/>
<link rel="stylesheet" media="screen" href="{{ URL::asset('resources/assets/front-end/vendor/tiny-slider/dist/tiny-slider.css') }}"/>
<link rel="stylesheet" media="screen" href="{{ URL::asset('resources/assets/front-end/vendor/chartist/dist/chartist.min.css') }}"/>
@endsection



@section('content')

      <div class="page-title-overlap bg-primary pt-4">
        
        @include('layouts.user-breadcrums')

      </div>
      <div class="container mb-5 pb-3">
        <div class="bg-light shadow-lg rounded-3 overflow-hidden">
          <div class="row">
            <!-- Sidebar-->
            <aside class="col-lg-4 pe-xl-5">

              @include('layouts.user-sidebar')

            </aside>
            <!-- Content-->
            <section class="col-lg-8 pt-lg-4 pb-4 mb-3">

              @if(session('success'))

                <div class="alert alert-success">
                    <button class="close" data-close="alert"></button>
                    {{ session('success') }}
                </div>

              @endif

              <div class="pt-2 px-4 ps-lg-0 pe-xl-5">

                <div class="d-sm-flex flex-wrap justify-content-between align-items-center border-bottom">
                  <h2 class="h3 py-2 me-2 text-center text-sm-start">
                    Your earnings
                  </h2>
                  <div class="py-2">
                    <div class="d-flex flex-nowrap align-items-center pb-3">
                      <a class="btn btn-primary btn-shadow d-block w-100" href="{{ url('host/manage-bank-detail') }}">
                        <i class="ci-add fs-lg me-2"></i> Manage Bank
                      </a>
                    </div>
                  </div>
                </div>

                <h2 class="h3 py-2 text-center text-sm-start"></h2>
                <div class="row mx-n2 pt-2">
                  <div class="col-md-4 col-sm-4 px-2 mb-4">
                    <div class="bg-secondary h-100 rounded-3 p-4 text-center">
                      <h3 class="fs-sm text-muted">Total Earnings </h3>
                      <p class="h2 mb-2">£ {{ number_format($totalPayment, 2) }}</p>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 px-2 mb-4">
                    <div class="bg-secondary h-100 rounded-3 p-4 text-center">
                      <h3 class="fs-sm text-muted">Paid</h3>
                      <p class="h2 mb-2">£ {{ number_format($paid, 2) }}</p>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 px-2 mb-4">
                    <div class="bg-secondary h-100 rounded-3 p-4 text-center">
                      <h3 class="fs-sm text-muted">Your balance</h3>
                      <p class="h2 mb-2">£ {{ number_format($unpaid, 2) }}</p>
                    </div>
                  </div>
                </div>
                <!--<div class="row mx-n2">
                  <div class="col-lg-12 px-2">
                    <div class="card mb-4">
                      <div class="card-body">
                        <h3 class="fs-sm pb-3 mb-3 border-bottom">Sales value, £ <span class="fw-normal fs-xs text-muted">(Past 2 weeks)</span></h3>
                        <div class="ct-chart ct-perfect-fourth" data-line-chart="{&quot;labels&quot;: [&quot;22 Jul&quot;, &quot;&quot;, &quot;24 Jul&quot;, &quot;&quot;, &quot;26 Jul&quot;, &quot;&quot;, &quot;28 Jul&quot;, &quot;&quot;, &quot;30 Jul&quot;, &quot;&quot;, &quot;01 Aug&quot;, &quot;&quot;, &quot;03 Aug&quot;, &quot;&quot;, &quot;05 Aug&quot;], &quot;series&quot;: [[0, 100, 200, 150, 50, 0, 0, 50, 0, 50, 50, 50, 0, 100, 0]]}"></div>
                      </div>
                    </div>
                    <div class="card mb-4 mb-lg-2">
                      <div class="card-body">
                        <h3 class="fs-sm pb-3 mb-3 border-bottom">Order count <span class="fw-normal fs-xs text-muted">(Past 2 weeks)</span></h3>
                        <div class="ct-chart ct-perfect-fourth" data-line-chart="{&quot;labels&quot;: [&quot;22 Jul&quot;, &quot;&quot;, &quot;24 Jul&quot;, &quot;&quot;, &quot;26 Jul&quot;, &quot;&quot;, &quot;28 Jul&quot;, &quot;&quot;, &quot;30 Jul&quot;, &quot;&quot;, &quot;01 Aug&quot;, &quot;&quot;, &quot;03 Aug&quot;, &quot;&quot;, &quot;05 Aug&quot;], &quot;series&quot;: [[0, 2, 4, 3, 1, 0, 0, 1, 0, 1, 1, 1, 0, 2, 0]]}" data-options="{&quot;axisY&quot;: {&quot;onlyInteger&quot;: true}}"></div>
                      </div>
                    </div>
                  </div>
                </div>-->
              </div>
                 
            </section>
          </div>
        </div>
      </div>

@endsection

@section('script_last')
    <script src="{{ URL::asset('resources/assets/front-end/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>
    <script src="{{ URL::asset('resources/assets/front-end/vendor/chartist/dist/chartist.min.js') }}"></script>

@endsection
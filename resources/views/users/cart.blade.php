@extends('layouts.master')

@section('title')

Upcoming Rentals

@endsection


@section('script')

@endsection



@section('content')

<!-- Page Title-->
      <div class="page-title-overlap bg-primary pt-4">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
          <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
                <li class="breadcrumb-item">
                  <a class="text-nowrap" href="{{ url('/') }}">
                    <i class="ci-home"></i>Home
                  </a>
                </li>
                <li class="breadcrumb-item text-nowrap active" aria-current="page">
                  Upcoming Rentals
                </li>
              </ol>
            </nav>
          </div>
          <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
            <h1 class="h3 text-light mb-0">Upcoming Rentals</h1>
          </div>
        </div>
      </div>
      <div class="container mb-5 pb-3">
        <div class="bg-light shadow-lg rounded-3 overflow-hidden">
          <div class="row">
            <!-- Content-->
            <section class="col-lg-8 pt-2 pt-lg-4 pb-4 mb-3">
              <div class="pt-2 px-4 pe-lg-0 ps-xl-5">
                <!-- Header-->
                <div class="d-flex flex-wrap justify-content-between align-items-center border-bottom pb-3">
                  <div class="py-1">
                    <a class="btn btn-outline-primary btn-sm" href="{{ url('all-destinations') }}">
                      <i class="ci-arrow-left me-1 ms-n1"></i>Back to search
                    </a>
                  </div>
                  <div class="d-none d-sm-block py-1 fs-sm">
                    You have {{ Cart::count() }} properties/tours in your cart
                  </div>
                  <div class="py-1">
                    <a class="btn btn-outline-danger btn-sm" href="{{ url('empty') }}">
                      <i class="ci-close fs-xs me-1 ms-n1"></i>Clear Rentals
                    </a>
                  </div>
                </div>
                <!-- Product-->
                @if(Cart::count() > 0)
                  @foreach(Cart::content() as $cartItem)
                    <div class="d-block d-sm-flex align-items-center py-4 border-bottom">
                      <a class="d-block position-relative mb-3 mb-sm-0 me-sm-4 ms-sm-0 mx-auto" href="{{ url('remove', [ $cartItem->rowId ]) }}" style="width: 12.5rem;">
                        @if($cartItem->options->type == 1)
                          <img class="rounded-3" src="{{ URL::asset('storage/app/public/uploads/properties/'.$cartItem->options->image) }}" alt="Property">
                        @else
                          <img class="rounded-3" src="{{ URL::asset('storage/app/public/uploads/tours/'.$cartItem->options->image) }}" alt="Tour">
                        @endif
                        <span class="btn btn-icon btn-danger position-absolute top-0 end-0 py-0 px-1 m-2" data-bs-toggle="tooltip" title="Remove from Favorites">
                          <i class="ci-trash"></i>
                        </span>
                      </a>
                      <div class="text-center text-sm-start">
                        <h3 class="h6 product-title mb-2">
                          <a href="#">{{ $cartItem->name }}</a>
                        </h3>
                        @if($cartItem->options->type == 1)
                          <div class="d-inline-block text-primary">
                            {{ ($cartItem->options->has('adultsprice') ? $cartItem->options->adultsprice : '') }} x {{ ($cartItem->options->has('adults') ? $cartItem->options->adults : '') }}
                          </div>
                          <a class="d-inline-block text-primary fs-ms border-start ms-2 ps-2" href="#">
                            {{ ($cartItem->options->has('total_nights') ? $cartItem->options->total_nights : '') }} Nights
                          </a>
                        @else
                          <div class="d-inline-block text-primary">
                            
                            {{ ($cartItem->options->has('check_in') ? $cartItem->options->check_in : '') }}
                          </div>
                          <a class="d-inline-block text-primary fs-ms border-start ms-2 ps-2" href="#">
                            {{ ($cartItem->options->has('adults') ? $cartItem->options->adults : '') }} Adults
                          </a>
                          <a class="d-inline-block text-primary fs-ms border-start ms-2 ps-2" href="#">
                            {{ ($cartItem->options->has('childrens') ? $cartItem->options->childrens : '') }} Childrens
                          </a>
                          <a class="d-inline-block text-primary fs-ms border-start ms-2 ps-2" href="#">
                            {{ ($cartItem->options->has('infants') ? $cartItem->options->infants : '') }} Infants
                          </a>
                          <div class="fs-lg text-primary">{{ Session::get('currency') === 'gbp' ? '£' : '€' }} {{ $cartItem->price }} </div>
                        @endif

                        
                      </div>
                    </div>
                  @endforeach
                @endif
                <!-- Product-->
              </div>
            </section>
            <!-- Sidebar-->
            <aside class="col-lg-4 ps-xl-5">
              <hr class="d-lg-none">
              <div class="p-4 h-100 ms-auto border-start">
                <div class="px-lg-2">
                  <div class="text-center mb-4 py-3 border-bottom">
                    <h2 class="h6 mb-3 pb-1">Cart total</h2>
                    <h3 class="fw-normal">{{ Session::get('currency') === 'gbp' ? '£' : '€' }} {{ Cart::subtotal() }}</h3>
                  </div>
                  <a class="btn btn-primary btn-shadow d-block w-100 mt-4" href="{{ url('checkout') }}"><i class="ci-locked fs-lg me-2"></i>Secure Checkout</a>
                  <div class="text-center pt-2 pb-3"><small class="text-form text-muted">100% money back guarantee</small></div>
                </div>
              </div>
            </aside>
          </div>
        </div>
      </div>

@endsection

@section('script_last')

@endsection
@extends('layouts.master')

@section('title')

My Wishlist

@endsection


@section('script')

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

                <div class="pt-2 px-4 ps-lg-0 pe-xl-5">
                  @if (session('success'))
                    <div class="bg-success rounded-3 p-4 mb-4">
                      <p class="fs-sm text-white mb-0">
                        {{ session('success') }}
                      </p>
                    </div>
                  @elseif(session('danger'))
                    <div class="bg-danger rounded-3 p-4 mb-4">
                      <p class="fs-sm text-white mb-0">
                        {{ session('danger') }}
                      </p>
                  </div>
                  @endif
                  <h2 class="h3 pt-2 pb-4 mb-0 text-center text-sm-start border-bottom">
                    My Wishlist
                    <span class="badge bg-faded-accent fs-sm text-body align-middle ms-2">{{ count($wishlists) }}</span>
                  </h2>
                <!-- Product-->
                @if(count($wishlists) > 0)
                  @foreach($wishlists as $item)
                  <div class="d-sm-flex justify-content-between my-4 pb-3 pb-sm-2 border-bottom">
                    <div class="d-block d-sm-flex align-items-start text-center text-sm-start">
                        <a class="d-block flex-shrink-0 mx-auto me-sm-4" href="shop-single-v1.html" style="width: 10rem;">
                          <img src="{{ URL::asset('storage/app/public/uploads/properties/'.$item->image) }}" alt="{{ $item->title }}">
                        </a>
                      <div class="pt-2">
                        <h3 class="product-title fs-base mb-2">
                          <a href="shop-single-v1.html">
                            {{ $item->title }}
                          </a>
                        </h3>
                        <div class="fs-sm">
                          <span class="text-muted me-2">by</span> admin
                        </div>
                        <div class="fs-lg text-accent pt-2">
                          AED {{ $item->original_price }}
                        </div>
                      </div>
                    </div>
                    <div class="pt-2 ps-sm-3 mx-auto mx-sm-0 text-center">
                      <a class="btn btn-outline-danger btn-sm" href="{{ url('wishlist/destroy/'.$item->id) }}">
                        <i class="ci-trash me-2"></i>Remove
                      </a>
                    </div>
                  </div>
                  @endforeach
                  <nav class="woocommerce-pagination">
                      {!! $wishlists->render() !!}
                  </nav>
                @else 
                <div class="bg-secondary rounded-3 p-4 mb-4">
                  <p class="fs-sm text-muted mb-0">No record found!</p>
                </div>
                @endif  
                <!-- Product-->
              </div>
            </section>
          </div>
        </div>
      </div>

@endsection

@section('script_last')

@endsection
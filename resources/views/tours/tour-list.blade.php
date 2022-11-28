@extends('layouts.master')

@section('title')

Search Tour

@endsection


@section('script')

@endsection



@section('content')


<div class="page-title-overlap bg-primary pt-4">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
          <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
                <li class="breadcrumb-item">
                  <a class="text-nowrap" href="#">
                    <i class="ci-home"></i>Home
                  </a>
                </li>
                <li class="breadcrumb-item text-nowrap">
                  <a href="#">Search</a>
                </li>
              </ol>
            </nav>
          </div>
          <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
            <h1 class="h3 text-light mb-0">Search</h1>
          </div>
        </div>
      </div>
      <div class="container pb-5 mb-2 mb-md-4">
        <div class="row">
          <!-- Sidebar-->
          <aside class="col-lg-4">
            <!-- Sidebar-->
            <div class="offcanvas offcanvas-collapse bg-white w-100 rounded-3 shadow-lg py-1" id="shop-sidebar" style="max-width: 22rem;">
              <div class="offcanvas-header align-items-center shadow-sm">
                <h2 class="h5 mb-0">Filters</h2>
                <button class="btn-close ms-auto" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
              <div class="offcanvas-body py-grid-gutter px-lg-grid-gutter">
                <form action="{{ url('all-tours') }}" method="get" novalidate>
                <!-- Filter by Brand-->
                <?php $category = allPropertiesCount(); ?>
                <div class="widget widget-filter mb-4 pb-4 border-bottom">
                  <h3 class="widget-title">Cities</h3>
                  <ul class="widget-list widget-filter-list list-unstyled pt-1" style="max-height: 11rem;" data-simplebar data-simplebar-auto-hide="false">
                    @foreach($category as $item)
                      <li class="widget-filter-item d-flex justify-content-between align-items-center mb-1">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="location[]" value="{{ $item->id }}" id="{{ $item->id }}" 
                          @if(request()->input('location'))
                              @if(in_array($item->id, request()->input('location')))
                                  checked
                              @endif
                          @endif
                          >
                          <label class="form-check-label widget-filter-item-text" for="{{ $item->id }}">
                            {{ $item->cityname }}
                          </label>
                        </div>
                      </li>
                    @endforeach
                  </ul>
                </div>
                <!-- Price range-->
                <div class="widget mb-4 pb-4 border-bottom">
                  <h3 class="widget-title">By Price</h3>
                  <div class="range-slider" data-start-min="250" data-start-max="680" data-min="0" data-max="1000" data-step="1">
                    <div class="d-flex pb-1">
                      <div class="w-50 pe-2 me-2">
                        <div class="input-group input-group-sm">
                          <span class="input-group-text">{{ Session::get('currency') === 'gbp' ? '£' : '€' }}</span>
                          <input class="form-control range-slider-value-min" class="min_price" type="text">
                        </div>
                      </div>
                      <div class="w-50 ps-2">
                        <div class="input-group input-group-sm">
                          <span class="input-group-text">{{ Session::get('currency') === 'gbp' ? '£' : '€' }}</span>
                          <input class="form-control range-slider-value-max" name="max_price" type="text">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="widget mb-4 pb-4 border-bottom">
                  <h3 class="widget-title">By Keywords</h3>
                  <input class="form-control range-slider-value-min" type="text" name="keywords">
                </div>
                <div class="widget mb-4 pb-4 border-bottom">

                  <button class="btn btn-primary d-block w-100 btn-shadow" type="submit">
                    Search
                  </button>

                </div>

              </div>
            </div>
          </aside>
          <!-- Content  -->
          <section class="col-lg-8">
            <!-- Toolbar-->
            <div class="d-flex justify-content-center justify-content-sm-between align-items-center pt-2 pb-4 pb-sm-5">
              <div class="d-flex flex-wrap">
                <div class="d-flex align-items-center flex-nowrap me-3 me-sm-4 pb-3">
                  <label class="text-light fs-sm opacity-75 text-nowrap me-2 d-none d-sm-block" for="sorting">Sort by:</label>
                  <select class="form-select" id="orderby" name="orderby" onchange="window.location = '{{ URL::to('all-tours?sortit=')}}'+this.value">
                    <option value="">Default sorting</option>
                    <option value="old" <?php if(Request::get('sortit')=='old')  echo "selected" ; ?>>Sort by old</option>
                    <option value="added_date" <?php if(Request::get('sortit')=='added_date')  echo "selected" ; ?>>Sort by newness</option>
                    <option value="low_p" <?php if(Request::get('sortit')=='low_p')  echo "selected" ; ?>>Sort by price: low to high</option>
                    <option value="high_p" <?php if(Request::get('sortit')=='high_p')  echo "selected" ; ?>>Sort by price: high to low</option>
                  </select>
                  <span class="fs-sm text-light opacity-75 text-nowrap ms-2 d-none d-md-block">
                    of {{ count($tours) }} properties
                  </span>
                </div>
              </div>
              <div class="d-none d-sm-flex pb-3">
                
              </div>
            </div>
            <!-- Products list-->
            <!-- Product-->
            @foreach($tours as $item)
            <div class="card product-card product-list">
              <!--<a href="{{ url('property/wishlist/'.$item->id.'/2') }}" class="btn-wishlist btn-sm" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist">
                <i class="ci-heart"></i>
              </a>-->
              <div class="d-sm-flex align-items-center">
                <a class="product-list-thumb" href="{{ url('tour/'.$item->slug) }}">
                  <img src="{{ URL::to('/') }}/storage/app/public/uploads/tours/{{ $item->image }}" alt="{{ $item->title }}">
                </a>
                <div class="card-body py-2">
                  <a class="product-meta d-block fs-xs pb-2" href="#">
                    {{ $item->cityname }}
                  </a>
                  <h3 class="product-title fs-base mb-0 pb-2">
                    <a href="{{ url('rental/'.$item->slug) }}">
                      {{ $item->title }}
                    </a>
                  </h3>
                  <div class="d-flex justify-start-between pb-2">
                        @if($item->tour_duration)
                          <div style="margin-right: 5px;">
                              <i class="text-body ci-time"></i>
                              <span>{{ $item->tour_duration }}</span>
                          </div>
                        @endif
                        @if($item->sqft)
                          <div style="margin-left: 5px;">
                            <i class="text-body ci-user"></i>
                              <span>{{ $item->sqft }}</span>
                          </div>
                        @endif
                  </div>
                  <?php $pri = $item->adults; ?>
                  @if($item->children)
                    <?php $pri = $item->children; ?>
                  @endif
                  <div class="d-flex justify-content-between">
                    <div class="product-price">
                      <span class="text-dark">
                              Starting from {{ Session::get('currency') === 'gbp' ? '£' : '€' }} {{ number_format($pri*Session::get('value'), 2) }}
                          </span>
                    </div>
                    <div class="star-rating">
                      <i class="star-rating-icon ci-star"></i>
                      <i class="star-rating-icon ci-star"></i>
                      <i class="star-rating-icon ci-star"></i>
                      <i class="star-rating-icon ci-star"></i>
                      <i class="star-rating-icon ci-star"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="border-top pt-3 mt-3"></div>
            @endforeach
            <!-- Pagination-->
            <div class="row">
              <div class="col-12">
                <div class="d-flex justify-content-center"> 
                  {!! $tours->links('vendor.pagination.custom') !!}
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>



@endsection

@section('script_last')

@endsection
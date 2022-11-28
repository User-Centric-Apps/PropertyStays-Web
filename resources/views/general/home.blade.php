@extends('layouts.master')

@section('title')

Home

@endsection


@section('script')

<link href="{{ URL::asset('resources/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('resources/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('resources/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('resources/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('resources/assets/global/plugins/clockface/css/clockface.css') }}" rel="stylesheet" type="text/css" />

<style type="text/css">
  .nactive
  {
    background: #00bdbc;
    color: white;
  }
  .select
  {
    padding: 0.2rem;
    border: 0;
    background: transparent;
    color: #000;
  }
  .date-picker
  {
    color: #000;
  }
  /*search box css start here*/
.search-slt{
    display: block;
    width: 100%;
    font-size: 0.875rem;
    line-height: 1.5;
    color: #55595c;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    height: calc(3rem + 2px) !important;
    border-radius:0;
}
.wrn-btn{
    width: 100%;
    font-size: 16px;
    font-weight: 400;
    text-transform: capitalize;
    height: calc(3rem + 2px) !important;
    border-radius:0;
}
.ppl, .bed
  {
    width: 20%!important;
  }
  .plotsize
  {
    width: 30%!important;
  }
@media (min-width: 992px){
.search-sec{
    padding: 2rem;
}
    .search-sec{
        position: relative;
        top: -210px;
        margin: 0 auto;
    }
}

@media (min-width: 767.98px) and (max-width: 991.98px){
    .search-sec {
        position: relative;
        top: -210px;
        margin: 0 auto;
    }
}
</style>

@endsection



@section('content')

<!-- Hero slider-->
<section class="tns-carousel tns-controls-lg mb-4 mb-lg-5">
  <div class="tns-carousel-inner" data-carousel-options="{&quot;loop&quot;: &quot;true&quot;, &quot;autoplay&quot;: &quot;true&quot;, &quot;speed&quot;: &quot;1000&quot;, &quot;mode&quot;: &quot;gallery&quot;, &quot;responsive&quot;: {&quot;0&quot;:{&quot;nav&quot;:true, &quot;controls&quot;: true},&quot;992&quot;:{&quot;nav&quot;:true, &quot;controls&quot;: true}}}">
    <!-- Item-->
    <div class="px-lg-5 search-holder search-img1">
      <div class="d-lg-flex justify-content-between align-items-center ps-lg-4">
        
      </div>
    </div>
    <div class="px-lg-5 search-holder search-img2">
      <div class="d-lg-flex justify-content-between align-items-center ps-lg-4">
        
      </div>
    </div>
    <div class="px-lg-5 search-holder search-img3">
      <div class="d-lg-flex justify-content-between align-items-center ps-lg-4">
        
      </div>
    </div>

  </div>
    <div class="search-sec">
      <div class="container">
          <div class="search-area">
            <form action="{{ url('search') }}" method="get" novalidate>
              <div class="search-box">
                <div class="dest">
                  <label>Destination</label>
                  {{ Form::select('location[]', $locations, old('location'), ['class' => 'select form-control', 'id' => 'location', 'required' => 'required', 'placeholder' => 'All Location']) }}
                </div>
                <div class="checkin">
                  <label>Check in</label>
                  <input class="date-picker" placeholder="Add dates" name="checkin" value="" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
                </div>
                <div class="checkout">
                  <label>Check Out</label>
                  <input class="date-picker" placeholder="Add dates" name="checkout" value="" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
                </div>
                <div class="travellers">
                  <label>Adult</label>
                  {{ Form::select('adults', array(1 => '1 Adult', 2 => '2 Adults', 3 => '3 Adults', 4 => '4 Adults', 5 => '5 Adults'), old('adults'), ['class' => 'select form-control', 'id' => 'location', 'required' => 'required', 'placeholder' => 'All']) }}
                </div>
                <div class="travellers">
                  <label>Children</label>
                  {{ Form::select('childrens', array(1 => '1 Children', 2 => '2 Childrens', 3 => '3 Childrens', 4 => '4 Childrens', 5 => '5 Childrens'), old('children'), ['class' => 'select form-control', 'id' => 'childrens', 'required' => 'required', 'placeholder' => 'All']) }}
                </div>
                <div class="travellers">
                  <label>Infant</label>
                  {{ Form::select('infants', array(1 => '1 Infant', 2 => '2 Infants', 3 => '3 Infants', 4 => '4 Infants', 5 => '5 Infants'), old('infants'), ['class' => 'select form-control', 'id' => 'infants', 'required' => 'required', 'placeholder' => 'All']) }}
                </div>
                <div class="search-Btn">
                  <button class="btn btn-primary ci-search" type="submit">
                    <span>Search</span>
                  </button>
                </div>
              </div>
            </form>
          </div>
      </div>
  </div>
</section>

<!-- Rental Offers (Top)-->
<section class="container pt-lg-3 mb-4 mb-sm-5">
  <div class="row">
    <!-- Banner with controls-->
    <div class="col-md-5">
      <div class="d-flex flex-column h-100 overflow-hidden rounded-3" style="background-color: #f6f8fb;">
        <div class="d-flex justify-content-between px-grid-gutter py-grid-gutter">
          <div>
            <h3 class="mb-1">Available for Rent</h3><a class="fs-md" href="{{ url('search') }}">Great rental offers<i class="ci-arrow-right fs-xs align-middle ms-1"></i></a>
          </div>
          <div class="tns-carousel-controls" id="for-women">
            <button type="button"><i class="ci-arrow-left"></i></button>
            <button type="button"><i class="ci-arrow-right"></i></button>
          </div>
        </div><a class="d-none d-md-block mt-auto" href="{{ url('search') }}"><img class="d-block w-100" src="{{ URL::asset('resources/assets/front-end/img/top-rentals.png') }}" alt="Available for Rent"></a>
      </div>
    </div>
    <!-- Product grid (carousel)-->
    <div class="col-md-7 pt-4 pt-md-0">
      @if(count($properties) > 0)
      <div class="tns-carousel">
        <div class="tns-carousel-inner" data-carousel-options="{&quot;nav&quot;: false, &quot;controlsContainer&quot;: &quot;#for-women&quot;}">
          <!-- Carousel item-->
          <div>
            <div class="row ">
              @foreach($properties as $item)
                @if($loop->iteration % 2 == 0)
                  <?php 
                  if(Auth::check())
                  {
                    $checkWish = checkWishList($item->id, Auth::user()->id); 
                  }
                  else
                  {
                    $checkWish = 0;
                  }
                  ?>
                <div class="col-lg-6 col-12 mb-2">
                  <div class="card product-card card-static pb-0">
                      @if($item->featured == 1)
                        <div class="featured">Featured</div>
                      @endif
                      @if($checkWish > 0)
                        <a href="#" class="btn-wishlist btn-sm nactive" data-bs-toggle="tooltip" data-bs-placement="left" title="Added to your list">
                          <i class="ci-heart"></i>
                        </a>
                      @else
                        <a href="{{ url('property/wishlist/'.$item->id.'/1') }}" class="btn-wishlist btn-sm" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist">
                          <i class="ci-heart"></i>
                        </a>
                      @endif
                    <div class="img-holder">
                        
                        <a class="card-img-top d-block overflow-hidden" href="{{ url('rental/'.$item->slug) }}">
                          <img src="{{ URL::to('/') }}/storage/app/public/uploads/properties/{{ $item->image }}" alt="{{ $item->featured }}">
                        </a>
                        <div class="host-pic">
                            <a href="#" target="_blank" title="Ashley Bailey" class="service-avatar">
                              <img alt="Lets plan your trip" src="{{ URL::asset('resources/assets/front-end/img/home/PropertyStays-icon.png') }}" height="35" width="35" loading="lazy">
                            </a>
                        </div>
                        <div class="product-price">
                          <span class="text-light">
                              {{ Session::get('currency') === 'gbp' ? '£' : '€' }}
                              {{ number_format($item->original_price*Session::get('value'), 2) }}
                              <small>/ per night</small>
                          </span>
                        </div>

                    </div>
                    <div class="card-body py-2 px-2">
                        <a class="product-meta d-block fs-xs pb-1" href="#">Rental</a>
                        <h3 class="product-title fs-sm">
                            <a href="{{ url('rental/'.$item->slug) }}">
                              {{ $item->title }}
                            </a>
                        </h3>
                          <div class="d-flex justify-content-between">
                            
                            <div class="star-rating">
                                <i class="star-rating-icon ci-star"></i>
                                <i class="star-rating-icon ci-star"></i>
                                <i class="star-rating-icon ci-star"></i>
                                <i class="star-rating-icon ci-star"></i>
                                <i class="star-rating-icon ci-star"></i>
                            </div>

                          </div>
                            <div class="amenities">
                                @if($item->adults)
                                  <div class="ppl" data-toggle="tooltip" title="" data-original-title="No. People">
                                      <i>&nbsp</i>
                                      <span>{{ $item->adults }}</span>
                                  </div>
                                @endif
                                @if($item->bed)
                                  <div class="bed" data-toggle="tooltip" title="" data-original-title="No. Beds">
                                      <i>&nbsp</i>
                                      <span>{{ $item->bed }}</span>
                                  </div>
                                @endif
                                @if($item->bath)
                                  <div class="bath" data-toggle="tooltip" title="" data-original-title="No. Bathrooms">
                                      <i>&nbsp</i>
                                      <span>{{ $item->bath }}</span>
                                  </div>
                                @endif
                                @if($item->sqft)
                                  <div class="plotsize" data-toggle="tooltip" title="" data-original-title="Plot size">
                                      <i>&nbsp</i>
                                      <span>0{{ $item->sqft }}</span> <sup>2</sup>
                                  </div>
                                @endif
                            </div>
                    </div>
                  </div>
                </div>
                @endif
              @endforeach                             
            </div>
          </div>
          <!-- Carousel item-->
          <div>
            <div class="row ">
              @foreach($properties as $item)
              @if($loop->iteration % 2 == 1)
                <?php 
                  if(Auth::check())
                  {
                    $checkWish = checkWishList($item->id, Auth::user()->id); 
                  }
                  else
                  {
                    $checkWish = 0;
                  }
                ?>
                <div class="col-lg-6 col-12 mb-2 ">
                  <div class="card product-card card-static pb-0">
                      @if($item->featured == 1)
                        <div class="featured">Featured</div>
                      @endif  
                      @if($checkWish > 0)
                        <a href="#" class="btn-wishlist btn-sm nactive" data-bs-toggle="tooltip" data-bs-placement="left" title="Added to your list">
                          <i class="ci-heart"></i>
                        </a>
                      @else
                        <a href="{{ url('property/wishlist/'.$item->id.'/1') }}" class="btn-wishlist btn-sm" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist">
                          <i class="ci-heart"></i>
                        </a>
                      @endif
                    <div class="img-holder">
                        
                        <a class="card-img-top d-block overflow-hidden" href="{{ url('rental/'.$item->slug) }}">
                          <img src="{{ URL::to('/') }}/storage/app/public/uploads/properties/{{ $item->image }}" alt="{{ $item->featured }}">
                        </a>
                        <div class="host-pic">
                            <a href="#" target="_blank" title="Ashley Bailey" class="service-avatar">
                              <img alt="Lets plan your trip" src="{{ URL::asset('resources/assets/front-end/img/home/PropertyStays-icon.png') }}" height="35" width="35" loading="lazy">
                            </a>
                        </div>
                        <div class="product-price">
                          <span class="text-light">
                              {{ Session::get('currency') === 'gbp' ? '£' : '€' }}
                              {{ number_format($item->original_price*Session::get('value'), 2) }}
                              <small>/ per night</small>
                          </span>
                        </div>

                    </div>
                    <div class="card-body py-2 px-2">
                        <a class="product-meta d-block fs-xs pb-1" href="#">Rental</a>
                        <h3 class="product-title fs-sm">
                            <a href="{{ url('rental/'.$item->slug) }}">
                              {{ $item->title }}
                            </a>
                        </h3>
                          <div class="d-flex justify-content-between">
                            
                            <div class="star-rating">
                                <i class="star-rating-icon ci-star"></i>
                                <i class="star-rating-icon ci-star"></i>
                                <i class="star-rating-icon ci-star"></i>
                                <i class="star-rating-icon ci-star"></i>
                                <i class="star-rating-icon ci-star"></i>
                            </div>

                          </div>
                            <div class="amenities">
                                @if($item->adults)
                                  <div class="ppl" data-toggle="tooltip" title="" data-original-title="No. People">
                                      <i>&nbsp</i>
                                      <span>{{ $item->adults }}</span>
                                  </div>
                                @endif
                                @if($item->bed)
                                  <div class="bed" data-toggle="tooltip" title="" data-original-title="No. Beds">
                                      <i>&nbsp</i>
                                      <span>{{ $item->bed }}</span>
                                  </div>
                                @endif
                                @if($item->bath)
                                  <div class="bath" data-toggle="tooltip" title="" data-original-title="No. Bathrooms">
                                      <i>&nbsp</i>
                                      <span>{{ $item->bath }}</span>
                                  </div>
                                @endif
                                @if($item->sqft)
                                  <div class="plotsize" data-toggle="tooltip" title="" data-original-title="Plot size">
                                      <i>&nbsp</i>
                                      <span>0{{ $item->sqft }}</span> <sup>2</sup>
                                  </div>
                                @endif
                            </div>
                    </div>
                  </div>
                </div>
                @endif
              @endforeach
            </div>
          </div>
        </div>
      </div>
      @endif
    </div>
  </div>
</section>
<!-- destination (All)-->
<section class="container pt-lg-4 mb-4 mb-sm-5">
  <div class="row">
    <!-- Banner with controls-->
    <div class="col-md-5 order-md-2">
      <div class="d-flex flex-column h-100 overflow-hidden rounded-3" style="background-color: #f6f8fb;">
        <div class="d-flex justify-content-between px-grid-gutter py-grid-gutter">
          <div class="order-md-2">
            <h3 class="mb-1">Top Destinations</h3><a class="fs-md" href="{{ url('all-destinations/more') }}">View all destinations<i class="ci-arrow-right fs-xs align-middle ms-1"></i></a>
          </div>
          <div class="tns-carousel-controls order-md-1" id="for-men">
            <button type="button"><i class="ci-arrow-left"></i></button>
            <button type="button"><i class="ci-arrow-right"></i></button>
          </div>
        </div><a class="d-none d-md-block mt-auto" href="{{ url('all-destinations/more') }}"><img class="d-block w-100" src="{{ URL::asset('resources/assets/front-end/img/travel.png') }}" alt="Top Destinations"></a>
      </div>
    </div>
    <!-- Product grid (carousel)-->
    <div class="col-md-7 pt-4 pt-md-0 order-md-1">
      @if(count($topcities) > 0)
      <div class="tns-carousel">
        <div class="tns-carousel-inner" data-carousel-options="{&quot;nav&quot;: false, &quot;controlsContainer&quot;: &quot;#for-men&quot;}">
          <!-- Carousel item-->
          <div>
            <div class="row ">
              @foreach($topcities as $city)
                @if($loop->iteration % 2 == 0)
                  <div class="col-lg-6 col-12 mb-2">
                    <div class="card product-card card-static city-destinations pb-0">
                      <div class="img-holder" style="background: url({{ URL::asset('storage/app/public/uploads/cities/'.$city->image) }});">
                          <a class="card-img-top d-block overflow-hidden" href="{{ url('location/'.$city->slug) }}">
                              <div class="cityname">
                              <span class="text-light">{{ $city->cityname }}</span>
                              <small class="text-light">{{ $city->properties->count() }} properties</small>
                          </div>
                          </a>
                      </div>
                    </div>
                  </div>
                @endif  
              @endforeach
            </div>
          </div>
          <!-- Carousel item-->
          <div>
            <div class="row ">
                @foreach($topcities as $city)
                  @if($loop->iteration % 2 == 1)
                    <div class="col-lg-6 col-12 mb-2">
                      <div class="card product-card card-static city-destinations pb-0">
                          <div class="img-holder" style="background: url({{ URL::asset('storage/app/public/uploads/cities/'.$city->image) }});">
                              <a class="card-img-top d-block overflow-hidden" href="{{ url('location/'.$city->slug) }}">
                                  <div class="cityname">
                                  <span class="text-light">{{ $city->cityname }}</span>
                                  <small class="text-light">{{ $city->properties->count() }} properties</small>
                              </div>
                              </a>
                          </div>
                        </div>
                    </div>
                  @endif  
                @endforeach
            </div>
          </div>
        </div>
      </div>
      @endif
    </div>
  </div>
</section>

<!-- be a host-->
<section class="container pt-lg-4 mb-4 mb-md-5">
  <div class="advert1">
    <div class="mb-3">
      <h2>Try being a host</h2>
      <h3 class="text-light">Earn up to&nbsp;<strong>£1,226</strong>/month</h3>
      <h4 class="text-light">by hosting guests in your home</h4>
      <a class="btn btn-outline-light mb-2 me-1" href="{{ url('listing-properties') }}">Read more about hosting</a>
    </div>
  </div>
</section>

<!-- Tours (top)-->
<section class="container pt-lg-4 mb-4 mb-md-5">
  <div class="row">
    <!-- Banner with controls-->
    <div class="col-md-5">
      <div class="d-flex flex-column h-100 overflow-hidden rounded-3" style="background-color: #f6f8fb;">
        <div class="d-flex justify-content-between px-grid-gutter py-grid-gutter">
          <div>
            <h3 class="mb-1">Top Tours</h3><a class="fs-md" href="{{ url('all-tours') }}">View all tours<i class="ci-arrow-right fs-xs align-middle ms-1"></i></a>
          </div>
          <div class="tns-carousel-controls" id="for-kids">
            <button type="button"><i class="ci-arrow-left"></i></button>
            <button type="button"><i class="ci-arrow-right"></i></button>
          </div>
        </div><a class="d-none d-md-block mt-auto" href="shop-grid-ls.html"><img class="d-block w-100" src="{{ URL::asset('resources/assets/front-end/img/tour.png') }}" alt="Top Tours"></a>
      </div>
    </div>
    <!-- Product grid (carousel)-->
    <div class="col-md-7 pt-4 pt-md-0">
      @if(count($tours) > 0)
      <div class="tns-carousel">
        <div class="tns-carousel-inner" data-carousel-options="{&quot;nav&quot;: false, &quot;controlsContainer&quot;: &quot;#for-kids&quot;}">
          <!-- Carousel item-->
          <div>
            <div class="row ">
              @foreach($tours as $item)
                  @if($loop->iteration % 2 == 0)
                  <div class="col-lg-6 col-12 mb-2 ">
                  <div class="card product-card card-static pb-0">
                      @if($item->featured == 1)
                        <div class="featured">Featured</div>
                      @endif  
                      
                    <div class="img-holder">
                        
                        <a class="card-img-top d-block overflow-hidden" href="{{ url('tour/'.$item->slug)}}">
                          <img src="{{ URL::to('/') }}/storage/app/public/uploads/tours/{{ $item->image }}" alt="{{ $item->featured }}">
                        </a>
                        <div class="host-pic">
                            <a href="#" target="_blank" title="Ashley Bailey" class="service-avatar">
                              <img alt="Lets plan your trip" src="{{ URL::asset('resources/assets/front-end/img/home/PropertyStays-icon.png') }}" height="35" width="35" loading="lazy">
                            </a>
                        </div>
                        <div class="product-price">
                          <span class="text-light">
                              <small>Starting from </small>
                              <?php $pri = $item->adults; ?>
                              @if($item->children)
                                <?php $pri = $item->children; ?>
                              @endif
                              {{ Session::get('currency') === 'gbp' ? '£' : '€' }} {{ number_format($pri*Session::get('value'), 2) }}
                          </span>
                        </div>

                    </div>
                    <div class="card-body py-2 px-2">
                        <h3 class="product-title fs-sm">
                            <a href="{{ url('rental/'.$item->slug) }}">
                              {{ $item->title }}
                            </a>
                        </h3>
                          <div class="d-flex justify-content-between">
                            
                            <div class="star-rating">
                                <i class="star-rating-icon ci-star"></i>
                                <i class="star-rating-icon ci-star"></i>
                                <i class="star-rating-icon ci-star"></i>
                                <i class="star-rating-icon ci-star"></i>
                                <i class="star-rating-icon ci-star"></i>
                            </div>

                          </div>
                            <div class="amenities">
                                @if($item->tour_duration)
                                  <div style="width:50%">
                                      <i class="text-body ci-time"></i>
                                      <span>{{ $item->tour_duration }}</span>
                                  </div>
                                @endif
                                @if($item->sqft)
                                  <div style="width:50%">
                                      <i class="text-body ci-user"></i>
                                      <span>{{ $item->sqft }}</span>
                                  </div>
                                @endif
                            </div>
                    </div>
                  </div>
                </div>
                @endif

              @endforeach                              
            </div>
          </div>
          <!-- Carousel item-->
          <div>
            <div class="row ">
              @foreach($tours as $item)
                  @if($loop->iteration % 2 == 1)
                <div class="col-lg-6 col-12 mb-2 ">
                  <div class="card product-card card-static pb-0">
                      @if($item->featured == 1)
                        <div class="featured">Featured</div>
                      @endif  
                      
                    <div class="img-holder">
                        
                        <a class="card-img-top d-block overflow-hidden" href="{{ url('tour/'.$item->slug)}}">
                          <img src="{{ URL::to('/') }}/storage/app/public/uploads/tours/{{ $item->image }}" alt="{{ $item->featured }}">
                        </a>
                        <div class="host-pic">
                            <a href="#" target="_blank" title="Ashley Bailey" class="service-avatar">
                              <img alt="Lets plan your trip" src="{{ URL::asset('resources/assets/front-end/img/home/PropertyStays-icon.png') }}" height="35" width="35" loading="lazy">
                            </a>
                        </div>
                        <div class="product-price">
                          <span class="text-light">
                              <small>Starting from </small>
                              <?php $pri = $item->adults; ?>
                              @if($item->children)
                                <?php $pri = $item->children; ?>
                              @endif
                              {{ Session::get('currency') === 'gbp' ? '£' : '€' }} {{ number_format($pri*Session::get('value'), 2) }}
                          </span>
                        </div>

                    </div>
                    <div class="card-body py-2 px-2">
                        <h3 class="product-title fs-sm">
                            <a href="{{ url('rental/'.$item->slug) }}">
                              {{ $item->title }}
                            </a>
                        </h3>
                          <div class="d-flex justify-content-between">
                            
                            <div class="star-rating">
                                <i class="star-rating-icon ci-star"></i>
                                <i class="star-rating-icon ci-star"></i>
                                <i class="star-rating-icon ci-star"></i>
                                <i class="star-rating-icon ci-star"></i>
                                <i class="star-rating-icon ci-star"></i>
                            </div>

                          </div>
                            <div class="amenities">
                                @if($item->tour_duration)
                                  <div style="width:50%">
                                      <i class="text-body ci-time"></i>
                                      <span>{{ $item->tour_duration }}</span>
                                  </div>
                                @endif
                                @if($item->sqft)
                                  <div style="width:50%">
                                      <i class="text-body ci-user"></i>
                                      <span>{{ $item->sqft }}</span>
                                  </div>
                                @endif
                            </div>
                    </div>
                  </div>
                </div>

                @endif

              @endforeach

            </div>
          </div>
        </div>
      </div>
      @endif
    </div>
  </div>
</section>

<!-- did you know?-->
<section class="container pt-md-3 pb-4 pb-md-5 mb-lg-2 did-u-know">
  <div class="row">
    <div class="col-lg-6 col-md-6 mb-2 py-3">
      <div class="item special-offer">
        <p class="featured-text">Host Special</p>
        <h3 class="text-light">Become a host, its so easy!</h3>
        <p class="">Listing your home has never been more simple . Within a few simple steps you can reach lots of travellers to earn extra money.</p>
        <a href="{{ url('host-setup') }}" class="btn btn-light btn-shadow mb-2 me-1">Learn more</a>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-2 py-3">
      <div class="item host-insurance">
        <i class="bi ci-mail fs-2"></i>
        <h3 class="item-title text-light">Our Insurance</h3>
        <p class="item-sub-title">All our properies within the UK are covered</p>
        <a href="{{ url('host-insurance') }}" class="btn btn-light btn-shadow mb-2 me-1">Read more</a>    
      </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-2 py-3">
      <div class="item host-tips">
        <i class="bi bi-award fs-2"></i>
        <h3 class="item-title text-light">Host Packages. See offers available now!</h3>
        <p class="item-sub-title">Get the latest tips to help you get the best yield from your property rentals.</p>
        <a href="{{ url('host-safety') }}" class="btn btn-light btn-shadow mb-2 me-1">Find out more</a>    
      </div>
    </div>
    </div>
  </div>
</section>



@endsection

@section('script_last')

<script src="{{ URL::asset('resources/assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('resources/assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('resources/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('resources/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('resources/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('resources/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('resources/assets/global/plugins/clockface/js/clockface.js') }}" type="text/javascript"></script>

<script type="text/javascript">
  $('.date-picker').datepicker({
      orientation: "left",
      autoclose: true
  });
</script>

@endsection
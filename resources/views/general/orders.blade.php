@extends('layouts.master')

@section('title')

Home

@endsection


@section('script')

@endsection



@section('content')

<!-- Hero slider-->
<section class="tns-carousel tns-controls-lg mb-4 mb-lg-5">
  <div class="tns-carousel-inner" data-carousel-options="{&quot;loop&quot;: &quot;true&quot;, &quot;autoplay&quot;: &quot;true&quot;, &quot;speed&quot;: &quot;1000&quot;, &quot;mode&quot;: &quot;gallery&quot;, &quot;responsive&quot;: {&quot;0&quot;:{&quot;nav&quot;:true, &quot;controls&quot;: true},&quot;992&quot;:{&quot;nav&quot;:true, &quot;controls&quot;: true}}}">
    <!-- Item-->
    <div class="px-lg-5 search-holder search-img1">
      <div class="d-lg-flex justify-content-between align-items-center ps-lg-4">
        <div class="search-area">
          <div class="search-box">
            <div class="dest">
              <label>Destination</label>
              <input class="" placeholder="Where are you going?" value="">
            </div>
            <div class="checkin">
              <label>Check in</label>
              <input class="" id="" placeholder="Add dates" value="">
            </div>
            <div class="checkout">
              <label>Check Out</label>
              <input class="" id="" placeholder="Add dates" value="">
            </div>
            <div class="travellers">
              <label>Guests</label>
              <input class="" id="" placeholder="Add guests" value="">
            </div>
            <div class="search-Btn">
              <button class="btn btn-primary ci-search" type="submit">
                <span>Search</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Item-->
    <div class="px-lg-5 search-holder search-img2">
      <div class="d-lg-flex justify-content-between align-items-center ps-lg-4">
        <div class="search-area">
          <div class="search-box">
            <div class="col-md-3 dest">
              <label>Destination</label>
              <input class="" placeholder="Where are you going?" value="">
            </div>
            <div class="col-md-4 checkin">
              <label>Check in</label>
              <input class="" id="" placeholder="Add dates" value="">
            </div>
            <div class="col-md-2 checkout">
              <label>Check Out</label>
              <input class="" id="" placeholder="Add dates" value="">
            </div>
            <div class="col-md-2 travellers">
              <label>Guests</label>
              <input class="" id="" placeholder="Add guests" value="">
            </div>
            <div class="col-md-1 search-Btn">
              <button class="btn btn-primary ci-search" type="submit">
                <span>Search</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Item-->
    <div class="px-lg-5 search-holder search-img3">
      <div class="d-lg-flex justify-content-between align-items-center ps-lg-4">
        <div class="search-area">
          <div class="search-box">
            <div class="col-md-3 dest">
              <label>Destination</label>
              <input class="" placeholder="Where are you going?" value="">
            </div>
            <div class="col-md-4 checkin">
              <label>Check in</label>
              <input class="" id="" placeholder="Add dates" value="">
            </div>
            <div class="col-md-2 checkout">
              <label>Check Out</label>
              <input class="" id="" placeholder="Add dates" value="">
            </div>
            <div class="col-md-2 travellers">
              <label>Guests</label>
              <input class="" id="" placeholder="Add guests" value="">
            </div>
            <div class="col-md-1 search-Btn">
              <button class="btn btn-primary ci-search" type="submit">
                <span>Search</span>
              </button>
            </div>
          </div>
        </div>
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
            <h3 class="mb-1">Available for Rent!</h3><a class="fs-md" href="shop-grid-ls.html">Great rental offers!<i class="ci-arrow-right fs-xs align-middle ms-1"></i></a>
          </div>
          <div class="tns-carousel-controls" id="for-women">
            <button type="button"><i class="ci-arrow-left"></i></button>
            <button type="button"><i class="ci-arrow-right"></i></button>
          </div>
        </div><a class="d-none d-md-block mt-auto" href="shop-grid-ls.html"><img class="d-block w-100" src="{{ URL::asset('resources/assets/front-end/img/top-rentals.png') }}" alt="Available for Rent!"></a>
      </div>
    </div>
    <!-- Product grid (carousel)-->
    <div class="col-md-7 pt-4 pt-md-0">
      <div class="tns-carousel">
        <div class="tns-carousel-inner" data-carousel-options="{&quot;nav&quot;: false, &quot;controlsContainer&quot;: &quot;#for-women&quot;}">
          <!-- Carousel item-->
          <div>
            <div class="row mx-n2">
              <div class="col-lg-6 col-6 px-0 px-sm-2 mb-sm-4">
                <div class="card product-card card-static">
                  <div class="featured">Featured</div>
                  <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="ci-heart"></i></button>
                  <div class="img-holder">
                      
                      <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img src="{{ URL::asset('resources/assets/front-end/img/shop/catalog/property1.png') }}" alt="Product"></a>
                      <div class="host-pic">
                          <a href="https://propertystays.com/author/ashleybailey/" target="_blank" title="Ashley Bailey" class="service-avatar"><img alt="Lets plan your trip" src="{{ URL::asset('resources/assets/front-end/img/host-person.jpeg') }}" height="35" width="35" loading="lazy"></a>
                      </div>
                      <div class="product-price"><span class="text-light">£80<small>/ per night</small></span></div>

                  </div>
                  <div class="card-body py-2 px-2">
                      <a class="product-meta d-block fs-xs pb-1" href="#">Rental</a>
                      <h3 class="product-title fs-sm">
                          <a href="shop-single-v1.html">Spacious 3 Bedroom House Share Near Hammersmith City</a>
                      </h3>
                        <div class="d-flex justify-content-between">
                          
                          <div class="star-rating">
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-half active"></i>
                              <i class="star-rating-icon ci-star"></i>
                          </div>

                        </div>
                          <div class="amenities">
                              <div class="ppl" data-toggle="tooltip" title="" data-original-title="No. People">
                                  <i>&nbsp</i>
                                  <span>7</span>
                              </div>
                              <div class="bed" data-toggle="tooltip" title="" data-original-title="No. Beds">
                                  <i>&nbsp</i>
                                  <span>7</span>
                              </div>
                              <div class="bath" data-toggle="tooltip" title="" data-original-title="No. Bathrooms">
                                  <i>&nbsp</i>
                                  <span>1</span>
                              </div>
                              <div class="plotsize" data-toggle="tooltip" title="" data-original-title="Plot size">
                                  <i>&nbsp</i>
                                  <span>0m</span> <sup>2</sup>
                              </div>
                          </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-6 px-0 px-sm-2 mb-sm-4">
                <div class="card product-card card-static">
                  <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="ci-heart"></i></button>
                  <div class="img-holder">
                      
                      <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img src="{{ URL::asset('resources/assets/front-end/img/shop/catalog/property1.png') }}" alt="Product"></a>
                      <div class="host-pic">
                          <a href="https://propertystays.com/author/ashleybailey/" target="_blank" title="Ashley Bailey" class="service-avatar"><img alt="Lets plan your trip" src="{{ URL::asset('resources/assets/front-end/img/host-person.jpeg') }}" height="35" width="35" loading="lazy"></a>
                      </div>
                      <div class="product-price"><span class="text-light">£80<small>/ per night</small></span></div>

                  </div>
                  <div class="card-body py-2 px-2">
                      <a class="product-meta d-block fs-xs pb-1" href="#">Rental</a>
                      <h3 class="product-title fs-sm">
                          <a href="shop-single-v1.html">Spacious 3 Bedroom House Share Near Hammersmith City</a>
                      </h3>
                        <div class="d-flex justify-content-between">
                          
                          <div class="star-rating">
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-half active"></i>
                              <i class="star-rating-icon ci-star"></i>
                          </div>

                        </div>
                          <div class="amenities">
                              <div class="ppl" data-toggle="tooltip" title="" data-original-title="No. People">
                                  <i>&nbsp</i>
                                  <span>7</span>
                              </div>
                              <div class="bed" data-toggle="tooltip" title="" data-original-title="No. Beds">
                                  <i>&nbsp</i>
                                  <span>7</span>
                              </div>
                              <div class="bath" data-toggle="tooltip" title="" data-original-title="No. Bathrooms">
                                  <i>&nbsp</i>
                                  <span>1</span>
                              </div>
                              <div class="plotsize" data-toggle="tooltip" title="" data-original-title="Plot size">
                                  <i>&nbsp</i>
                                  <span>0m</span> <sup>2</sup>
                              </div>
                          </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-6 px-0 px-sm-2 mb-sm-4">
                <div class="card product-card card-static">
                  <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="ci-heart"></i></button>
                  <div class="img-holder">
                      
                      <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img src="{{ URL::asset('resources/assets/front-end/img/shop/catalog/property1.png') }}" alt="Product"></a>
                      <div class="host-pic">
                          <a href="https://propertystays.com/author/ashleybailey/" target="_blank" title="Ashley Bailey" class="service-avatar"><img alt="Lets plan your trip" src="{{ URL::asset('resources/assets/front-end/img/host-person.jpeg') }}" height="35" width="35" loading="lazy"></a>
                      </div>
                      <div class="product-price"><span class="text-light">£80<small>/ per night</small></span></div>

                  </div>
                  <div class="card-body py-2 px-2">
                      <a class="product-meta d-block fs-xs pb-1" href="#">Rental</a>
                      <h3 class="product-title fs-sm">
                          <a href="shop-single-v1.html">Spacious 3 Bedroom House Share Near Hammersmith City</a>
                      </h3>
                        <div class="d-flex justify-content-between">
                          
                          <div class="star-rating">
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-half active"></i>
                              <i class="star-rating-icon ci-star"></i>
                          </div>

                        </div>
                          <div class="amenities">
                              <div class="ppl" data-toggle="tooltip" title="" data-original-title="No. People">
                                  <i>&nbsp</i>
                                  <span>7</span>
                              </div>
                              <div class="bed" data-toggle="tooltip" title="" data-original-title="No. Beds">
                                  <i>&nbsp</i>
                                  <span>7</span>
                              </div>
                              <div class="bath" data-toggle="tooltip" title="" data-original-title="No. Bathrooms">
                                  <i>&nbsp</i>
                                  <span>1</span>
                              </div>
                              <div class="plotsize" data-toggle="tooltip" title="" data-original-title="Plot size">
                                  <i>&nbsp</i>
                                  <span>0m</span> <sup>2</sup>
                              </div>
                          </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-6 px-0 px-sm-2 mb-sm-4">
                <div class="card product-card card-static">
                  <div class="featured">Featured</div>
                  <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="ci-heart"></i></button>
                  <div class="img-holder">
                      
                      <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img src="{{ URL::asset('resources/assets/front-end/img/shop/catalog/property1.png') }}" alt="Product"></a>
                      <div class="host-pic">
                          <a href="https://propertystays.com/author/ashleybailey/" target="_blank" title="Ashley Bailey" class="service-avatar"><img alt="Lets plan your trip" src="{{ URL::asset('resources/assets/front-end/img/host-person.jpeg') }}" height="35" width="35" loading="lazy"></a>
                      </div>
                      <div class="product-price"><span class="text-light">£80<small>/ per night</small></span></div>

                  </div>
                  <div class="card-body py-2 px-2">
                      <a class="product-meta d-block fs-xs pb-1" href="#">Rental</a>
                      <h3 class="product-title fs-sm">
                          <a href="shop-single-v1.html">Spacious 3 Bedroom House Share Near Hammersmith City</a>
                      </h3>
                        <div class="d-flex justify-content-between">
                          
                          <div class="star-rating">
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-half active"></i>
                              <i class="star-rating-icon ci-star"></i>
                          </div>

                        </div>
                          <div class="amenities">
                              <div class="ppl" data-toggle="tooltip" title="" data-original-title="No. People">
                                  <i>&nbsp</i>
                                  <span>7</span>
                              </div>
                              <div class="bed" data-toggle="tooltip" title="" data-original-title="No. Beds">
                                  <i>&nbsp</i>
                                  <span>7</span>
                              </div>
                              <div class="bath" data-toggle="tooltip" title="" data-original-title="No. Bathrooms">
                                  <i>&nbsp</i>
                                  <span>1</span>
                              </div>
                              <div class="plotsize" data-toggle="tooltip" title="" data-original-title="Plot size">
                                  <i>&nbsp</i>
                                  <span>0m</span> <sup>2</sup>
                              </div>
                          </div>
                  </div>
                </div>
              </div>                               
            </div>
          </div>
          <!-- Carousel item-->
          <div>
            <div class="row mx-n2">
              <div class="col-lg-6 col-6 px-0 px-sm-2 mb-sm-4">
                <div class="card product-card card-static">
                  <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="ci-heart"></i></button>
                  <div class="img-holder">
                      
                      <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img src="{{ URL::asset('resources/assets/front-end/img/shop/catalog/property1.png') }}" alt="Product"></a>
                      <div class="host-pic">
                          <a href="https://propertystays.com/author/ashleybailey/" target="_blank" title="Ashley Bailey" class="service-avatar"><img alt="Lets plan your trip" src="{{ URL::asset('resources/assets/front-end/img/host-person.jpeg') }}" height="35" width="35" loading="lazy"></a>
                      </div>
                      <div class="product-price"><span class="text-light">£80<small>/ per night</small></span></div>

                  </div>
                  <div class="card-body py-2 px-2">
                      <a class="product-meta d-block fs-xs pb-1" href="#">Rental</a>
                      <h3 class="product-title fs-sm">
                          <a href="shop-single-v1.html">Spacious 3 Bedroom House Share Near Hammersmith City</a>
                      </h3>
                        <div class="d-flex justify-content-between">
                          
                          <div class="star-rating">
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-half active"></i>
                              <i class="star-rating-icon ci-star"></i>
                          </div>

                        </div>
                          <div class="amenities">
                              <div class="ppl" data-toggle="tooltip" title="" data-original-title="No. People">
                                  <i>&nbsp</i>
                                  <span>7</span>
                              </div>
                              <div class="bed" data-toggle="tooltip" title="" data-original-title="No. Beds">
                                  <i>&nbsp</i>
                                  <span>7</span>
                              </div>
                              <div class="bath" data-toggle="tooltip" title="" data-original-title="No. Bathrooms">
                                  <i>&nbsp</i>
                                  <span>1</span>
                              </div>
                              <div class="plotsize" data-toggle="tooltip" title="" data-original-title="Plot size">
                                  <i>&nbsp</i>
                                  <span>0m</span> <sup>2</sup>
                              </div>
                          </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-6 px-0 px-sm-2 mb-sm-4">
                <div class="card product-card card-static">
                  <div class="featured">Featured</div>
                  <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="ci-heart"></i></button>
                  <div class="img-holder">
                      
                      <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img src="{{ URL::asset('resources/assets/front-end/img/shop/catalog/property1.png') }}" alt="Product"></a>
                      <div class="host-pic">
                          <a href="https://propertystays.com/author/ashleybailey/" target="_blank" title="Ashley Bailey" class="service-avatar"><img alt="Lets plan your trip" src="{{ URL::asset('resources/assets/front-end/img/host-person.jpeg') }}" height="35" width="35" loading="lazy"></a>
                      </div>
                      <div class="product-price"><span class="text-light">£80<small>/ per night</small></span></div>

                  </div>
                  <div class="card-body py-2 px-2">
                      <a class="product-meta d-block fs-xs pb-1" href="#">Rental</a>
                      <h3 class="product-title fs-sm">
                          <a href="shop-single-v1.html">Spacious 3 Bedroom House Share Near Hammersmith City</a>
                      </h3>
                        <div class="d-flex justify-content-between">
                          
                          <div class="star-rating">
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-half active"></i>
                              <i class="star-rating-icon ci-star"></i>
                          </div>

                        </div>
                          <div class="amenities">
                              <div class="ppl" data-toggle="tooltip" title="" data-original-title="No. People">
                                  <i>&nbsp</i>
                                  <span>7</span>
                              </div>
                              <div class="bed" data-toggle="tooltip" title="" data-original-title="No. Beds">
                                  <i>&nbsp</i>
                                  <span>7</span>
                              </div>
                              <div class="bath" data-toggle="tooltip" title="" data-original-title="No. Bathrooms">
                                  <i>&nbsp</i>
                                  <span>1</span>
                              </div>
                              <div class="plotsize" data-toggle="tooltip" title="" data-original-title="Plot size">
                                  <i>&nbsp</i>
                                  <span>0m</span> <sup>2</sup>
                              </div>
                          </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-6 px-0 px-sm-2 mb-sm-4">
                <div class="card product-card card-static">
                  <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="ci-heart"></i></button>
                  <div class="img-holder">
                      
                      <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img src="{{ URL::asset('resources/assets/front-end/img/shop/catalog/property1.png') }}" alt="Product"></a>
                      <div class="host-pic">
                          <a href="https://propertystays.com/author/ashleybailey/" target="_blank" title="Ashley Bailey" class="service-avatar"><img alt="Lets plan your trip" src="{{ URL::asset('resources/assets/front-end/img/host-person.jpeg') }}" height="35" width="35" loading="lazy"></a>
                      </div>
                      <div class="product-price"><span class="text-light">£80<small>/ per night</small></span></div>

                  </div>
                  <div class="card-body py-2 px-2">
                      <a class="product-meta d-block fs-xs pb-1" href="#">Rental</a>
                      <h3 class="product-title fs-sm">
                          <a href="shop-single-v1.html">Spacious 3 Bedroom House Share Near Hammersmith City</a>
                      </h3>
                        <div class="d-flex justify-content-between">
                          
                          <div class="star-rating">
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-half active"></i>
                              <i class="star-rating-icon ci-star"></i>
                          </div>

                        </div>
                          <div class="amenities">
                              <div class="ppl" data-toggle="tooltip" title="" data-original-title="No. People">
                                  <i>&nbsp</i>
                                  <span>7</span>
                              </div>
                              <div class="bed" data-toggle="tooltip" title="" data-original-title="No. Beds">
                                  <i>&nbsp</i>
                                  <span>7</span>
                              </div>
                              <div class="bath" data-toggle="tooltip" title="" data-original-title="No. Bathrooms">
                                  <i>&nbsp</i>
                                  <span>1</span>
                              </div>
                              <div class="plotsize" data-toggle="tooltip" title="" data-original-title="Plot size">
                                  <i>&nbsp</i>
                                  <span>0m</span> <sup>2</sup>
                              </div>
                          </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-6 px-0 px-sm-2 mb-sm-4">
                <div class="card product-card card-static">
                  <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="ci-heart"></i></button>
                  <div class="img-holder">
                      
                      <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img src="{{ URL::asset('resources/assets/front-end/img/shop/catalog/property1.png') }}" alt="Product"></a>
                      <div class="host-pic">
                          <a href="https://propertystays.com/author/ashleybailey/" target="_blank" title="Ashley Bailey" class="service-avatar"><img alt="Lets plan your trip" src="{{ URL::asset('resources/assets/front-end/img/host-person.jpeg') }}" height="35" width="35" loading="lazy"></a>
                      </div>
                      <div class="product-price"><span class="text-light">£80<small>/ per night</small></span></div>

                  </div>
                  <div class="card-body py-2 px-2">
                      <a class="product-meta d-block fs-xs pb-1" href="#">Rental</a>
                      <h3 class="product-title fs-sm">
                          <a href="shop-single-v1.html">Spacious 3 Bedroom House Share Near Hammersmith City</a>
                      </h3>
                        <div class="d-flex justify-content-between">
                          
                          <div class="star-rating">
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-half active"></i>
                              <i class="star-rating-icon ci-star"></i>
                          </div>

                        </div>
                          <div class="amenities">
                              <div class="ppl" data-toggle="tooltip" title="" data-original-title="No. People">
                                  <i>&nbsp</i>
                                  <span>7</span>
                              </div>
                              <div class="bed" data-toggle="tooltip" title="" data-original-title="No. Beds">
                                  <i>&nbsp</i>
                                  <span>7</span>
                              </div>
                              <div class="bath" data-toggle="tooltip" title="" data-original-title="No. Bathrooms">
                                  <i>&nbsp</i>
                                  <span>1</span>
                              </div>
                              <div class="plotsize" data-toggle="tooltip" title="" data-original-title="Plot size">
                                  <i>&nbsp</i>
                                  <span>0m</span> <sup>2</sup>
                              </div>
                          </div>
                  </div>
                </div>
              </div>                               
            </div>
          </div>
        </div>
      </div>
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
            <h3 class="mb-1">Top Destinations</h3><a class="fs-md" href="all-destinations.html">View all destinations<i class="ci-arrow-right fs-xs align-middle ms-1"></i></a>
          </div>
          <div class="tns-carousel-controls order-md-1" id="for-men">
            <button type="button"><i class="ci-arrow-left"></i></button>
            <button type="button"><i class="ci-arrow-right"></i></button>
          </div>
        </div><a class="d-none d-md-block mt-auto" href="shop-grid-ls.html"><img class="d-block w-100" src="{{ URL::asset('resources/assets/front-end/img/travel.png') }}" alt="Top Destinations"></a>
      </div>
    </div>
    <!-- Product grid (carousel)-->
    <div class="col-md-7 pt-4 pt-md-0 order-md-1">
      <div class="tns-carousel">
        <div class="tns-carousel-inner" data-carousel-options="{&quot;nav&quot;: false, &quot;controlsContainer&quot;: &quot;#for-men&quot;}">
          <!-- Carousel item-->
          <div>
            <div class="row mx-n2">
              <div class="col-lg-6 col-6 px-0 px-sm-2 mb-sm-4">
                <div class="card product-card card-static city-destinations">
                  <div class="img-holder london">
                      <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html">
                          <div class="cityname">
                          <span class="text-light">London</span>
                          <small class="text-light">27 properties</small>
                      </div>
                      </a>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-6 px-0 px-sm-2 mb-sm-4">
                <div class="card product-card card-static city-destinations">
                  <div class="img-holder manchester">
                      <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html">
                          <div class="cityname">
                          <span class="text-light">Manchester</span>
                          <small class="text-light">13 properties</small>
                      </div>
                      </a>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-6 px-0 px-sm-2 mb-sm-4">
                <div class="card product-card card-static city-destinations">
                  <div class="img-holder blackpool">
                      <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html">
                          <div class="cityname">
                          <span class="text-light">Blackpool</span>
                          <small class="text-light">11 properties</small>
                      </div>
                      </a>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-6 px-0 px-sm-2 mb-sm-4">
                <div class="card product-card card-static city-destinations">
                  <div class="img-holder birmingham">
                      <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html">
                          <div class="cityname">
                          <span class="text-light">Birmingham</span>
                          <small class="text-light">3 properties</small>
                      </div>
                      </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Carousel item-->
          <div>
            <div class="row mx-n2">
              <div class="col-lg-6 col-6 px-0 px-sm-2 mb-sm-4">
                <div class="card product-card card-static city-destinations">
                  <div class="img-holder london">
                      <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html">
                          <div class="cityname">
                          <span class="text-light">London</span>
                          <small class="text-light">27 properties</small>
                      </div>
                      </a>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-6 px-0 px-sm-2 mb-sm-4">
                <div class="card product-card card-static city-destinations">
                  <div class="img-holder manchester">
                      <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html">
                          <div class="cityname">
                          <span class="text-light">Manchester</span>
                          <small class="text-light">13 properties</small>
                      </div>
                      </a>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-6 px-0 px-sm-2 mb-sm-4">
                <div class="card product-card card-static city-destinations">
                  <div class="img-holder blackpool">
                      <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html">
                          <div class="cityname">
                          <span class="text-light">Blackpool</span>
                          <small class="text-light">11 properties</small>
                      </div>
                      </a>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-6 px-0 px-sm-2 mb-sm-4">
                <div class="card product-card card-static city-destinations">
                  <div class="img-holder birmingham">
                      <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html">
                          <div class="cityname">
                          <span class="text-light">Birmingham</span>
                          <small class="text-light">3 properties</small>
                      </div>
                      </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
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
      <a class="btn btn-outline-light mb-2 me-1" href="https://propertystays.com/list-your-property/">Read more about hosting</a>
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
            <h3 class="mb-1">Top Tours</h3><a class="fs-md" href="shop-grid-ls.html">View all tours<i class="ci-arrow-right fs-xs align-middle ms-1"></i></a>
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
      <div class="tns-carousel">
        <div class="tns-carousel-inner" data-carousel-options="{&quot;nav&quot;: false, &quot;controlsContainer&quot;: &quot;#for-kids&quot;}">
          <!-- Carousel item-->
          <div>
            <div class="row mx-n2">
              <div class="col-lg-6 col-6 px-0 px-sm-2 mb-sm-4">
                <div class="card product-card card-static">
                  <div class="featured">Featured</div>
                  <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="ci-heart"></i></button>
                  <div class="img-holder">
                      
                      <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img src="{{ URL::asset('resources/assets/front-end/img/shop/catalog/property1.png') }}" alt="Product"></a>
                      <div class="host-pic">
                          <a href="https://propertystays.com/author/ashleybailey/" target="_blank" title="Ashley Bailey" class="service-avatar"><img alt="Lets plan your trip" src="{{ URL::asset('resources/assets/front-end/img/host-person.jpeg') }}" height="35" width="35" loading="lazy"></a>
                      </div>
                      <div class="product-price"><span class="text-light">£80<small>/ per night</small></span></div>

                  </div>
                  <div class="card-body py-2 px-2">
                      <a class="product-meta d-block fs-xs pb-1" href="#">Rental</a>
                      <h3 class="product-title fs-sm">
                          <a href="shop-single-v1.html">Spacious 3 Bedroom House Share Near Hammersmith City</a>
                      </h3>
                        <div class="d-flex justify-content-between">
                          
                          <div class="star-rating">
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-half active"></i>
                              <i class="star-rating-icon ci-star"></i>
                          </div>

                        </div>
                          <div class="amenities">
                              <div class="ppl" data-toggle="tooltip" title="" data-original-title="No. People">
                                  <i>&nbsp</i>
                                  <span>7</span>
                              </div>
                              <div class="bed" data-toggle="tooltip" title="" data-original-title="No. Beds">
                                  <i>&nbsp</i>
                                  <span>7</span>
                              </div>
                              <div class="bath" data-toggle="tooltip" title="" data-original-title="No. Bathrooms">
                                  <i>&nbsp</i>
                                  <span>1</span>
                              </div>
                              <div class="plotsize" data-toggle="tooltip" title="" data-original-title="Plot size">
                                  <i>&nbsp</i>
                                  <span>0m</span> <sup>2</sup>
                              </div>
                          </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-6 px-0 px-sm-2 mb-sm-4">
                <div class="card product-card card-static">
                  <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="ci-heart"></i></button>
                  <div class="img-holder">
                      
                      <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img src="{{ URL::asset('resources/assets/front-end/img/shop/catalog/property1.png') }}" alt="Product"></a>
                      <div class="host-pic">
                          <a href="https://propertystays.com/author/ashleybailey/" target="_blank" title="Ashley Bailey" class="service-avatar"><img alt="Lets plan your trip" src="{{ URL::asset('resources/assets/front-end/img/host-person.jpeg') }}" height="35" width="35" loading="lazy"></a>
                      </div>
                      <div class="product-price"><span class="text-light">£80<small>/ per night</small></span></div>

                  </div>
                  <div class="card-body py-2 px-2">
                      <a class="product-meta d-block fs-xs pb-1" href="#">Rental</a>
                      <h3 class="product-title fs-sm">
                          <a href="shop-single-v1.html">Spacious 3 Bedroom House Share Near Hammersmith City</a>
                      </h3>
                        <div class="d-flex justify-content-between">
                          
                          <div class="star-rating">
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-half active"></i>
                              <i class="star-rating-icon ci-star"></i>
                          </div>

                        </div>
                          <div class="amenities">
                              <div class="ppl" data-toggle="tooltip" title="" data-original-title="No. People">
                                  <i>&nbsp</i>
                                  <span>7</span>
                              </div>
                              <div class="bed" data-toggle="tooltip" title="" data-original-title="No. Beds">
                                  <i>&nbsp</i>
                                  <span>7</span>
                              </div>
                              <div class="bath" data-toggle="tooltip" title="" data-original-title="No. Bathrooms">
                                  <i>&nbsp</i>
                                  <span>1</span>
                              </div>
                              <div class="plotsize" data-toggle="tooltip" title="" data-original-title="Plot size">
                                  <i>&nbsp</i>
                                  <span>0m</span> <sup>2</sup>
                              </div>
                          </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-6 px-0 px-sm-2 mb-sm-4">
                <div class="card product-card card-static">
                  <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="ci-heart"></i></button>
                  <div class="img-holder">
                      
                      <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img src="{{ URL::asset('resources/assets/front-end/img/shop/catalog/property1.png') }}" alt="Product"></a>
                      <div class="host-pic">
                          <a href="https://propertystays.com/author/ashleybailey/" target="_blank" title="Ashley Bailey" class="service-avatar"><img alt="Lets plan your trip" src="{{ URL::asset('resources/assets/front-end/img/host-person.jpeg') }}" height="35" width="35" loading="lazy"></a>
                      </div>
                      <div class="product-price"><span class="text-light">£80<small>/ per night</small></span></div>

                  </div>
                  <div class="card-body py-2 px-2">
                      <a class="product-meta d-block fs-xs pb-1" href="#">Rental</a>
                      <h3 class="product-title fs-sm">
                          <a href="shop-single-v1.html">Spacious 3 Bedroom House Share Near Hammersmith City</a>
                      </h3>
                        <div class="d-flex justify-content-between">
                          
                          <div class="star-rating">
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-half active"></i>
                              <i class="star-rating-icon ci-star"></i>
                          </div>

                        </div>
                          <div class="amenities">
                              <div class="ppl" data-toggle="tooltip" title="" data-original-title="No. People">
                                  <i>&nbsp</i>
                                  <span>7</span>
                              </div>
                              <div class="bed" data-toggle="tooltip" title="" data-original-title="No. Beds">
                                  <i>&nbsp</i>
                                  <span>7</span>
                              </div>
                              <div class="bath" data-toggle="tooltip" title="" data-original-title="No. Bathrooms">
                                  <i>&nbsp</i>
                                  <span>1</span>
                              </div>
                              <div class="plotsize" data-toggle="tooltip" title="" data-original-title="Plot size">
                                  <i>&nbsp</i>
                                  <span>0m</span> <sup>2</sup>
                              </div>
                          </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-6 px-0 px-sm-2 mb-sm-4">
                <div class="card product-card card-static">
                  <div class="featured">Featured</div>
                  <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="ci-heart"></i></button>
                  <div class="img-holder">
                      
                      <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img src="{{ URL::asset('resources/assets/front-end/img/shop/catalog/property1.png') }}" alt="Product"></a>
                      <div class="host-pic">
                          <a href="https://propertystays.com/author/ashleybailey/" target="_blank" title="Ashley Bailey" class="service-avatar"><img alt="Lets plan your trip" src="{{ URL::asset('resources/assets/front-end/img/host-person.jpeg') }}" height="35" width="35" loading="lazy"></a>
                      </div>
                      <div class="product-price"><span class="text-light">£80<small>/ per night</small></span></div>

                  </div>
                  <div class="card-body py-2 px-2">
                      <a class="product-meta d-block fs-xs pb-1" href="#">Rental</a>
                      <h3 class="product-title fs-sm">
                          <a href="shop-single-v1.html">Spacious 3 Bedroom House Share Near Hammersmith City</a>
                      </h3>
                        <div class="d-flex justify-content-between">
                          
                          <div class="star-rating">
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-half active"></i>
                              <i class="star-rating-icon ci-star"></i>
                          </div>

                        </div>
                          <div class="amenities">
                              <div class="ppl" data-toggle="tooltip" title="" data-original-title="No. People">
                                  <i>&nbsp</i>
                                  <span>7</span>
                              </div>
                              <div class="bed" data-toggle="tooltip" title="" data-original-title="No. Beds">
                                  <i>&nbsp</i>
                                  <span>7</span>
                              </div>
                              <div class="bath" data-toggle="tooltip" title="" data-original-title="No. Bathrooms">
                                  <i>&nbsp</i>
                                  <span>1</span>
                              </div>
                              <div class="plotsize" data-toggle="tooltip" title="" data-original-title="Plot size">
                                  <i>&nbsp</i>
                                  <span>0m</span> <sup>2</sup>
                              </div>
                          </div>
                  </div>
                </div>
              </div>                               
            </div>
          </div>
          <!-- Carousel item-->
          <div>
            <div class="row mx-n2">
              <div class="col-lg-6 col-6 px-0 px-sm-2 mb-sm-4">
                <div class="card product-card card-static">
                  <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="ci-heart"></i></button>
                  <div class="img-holder">
                      
                      <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img src="{{ URL::asset('resources/assets/front-end/img/shop/catalog/property1.png') }}" alt="Product"></a>
                      <div class="host-pic">
                          <a href="https://propertystays.com/author/ashleybailey/" target="_blank" title="Ashley Bailey" class="service-avatar"><img alt="Lets plan your trip" src="{{ URL::asset('resources/assets/front-end/img/host-person.jpeg') }}" height="35" width="35" loading="lazy"></a>
                      </div>
                      <div class="product-price"><span class="text-light">£80<small>/ per night</small></span></div>

                  </div>
                  <div class="card-body py-2 px-2">
                      <a class="product-meta d-block fs-xs pb-1" href="#">Rental</a>
                      <h3 class="product-title fs-sm">
                          <a href="shop-single-v1.html">Spacious 3 Bedroom House Share Near Hammersmith City</a>
                      </h3>
                        <div class="d-flex justify-content-between">
                          
                          <div class="star-rating">
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-half active"></i>
                              <i class="star-rating-icon ci-star"></i>
                          </div>

                        </div>
                          <div class="amenities">
                              <div class="ppl" data-toggle="tooltip" title="" data-original-title="No. People">
                                  <i>&nbsp</i>
                                  <span>7</span>
                              </div>
                              <div class="bed" data-toggle="tooltip" title="" data-original-title="No. Beds">
                                  <i>&nbsp</i>
                                  <span>7</span>
                              </div>
                              <div class="bath" data-toggle="tooltip" title="" data-original-title="No. Bathrooms">
                                  <i>&nbsp</i>
                                  <span>1</span>
                              </div>
                              <div class="plotsize" data-toggle="tooltip" title="" data-original-title="Plot size">
                                  <i>&nbsp</i>
                                  <span>0m</span> <sup>2</sup>
                              </div>
                          </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-6 px-0 px-sm-2 mb-sm-4">
                <div class="card product-card card-static">
                  <div class="featured">Featured</div>
                  <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="ci-heart"></i></button>
                  <div class="img-holder">
                      
                      <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img src="{{ URL::asset('resources/assets/front-end/img/shop/catalog/property1.png') }}" alt="Product"></a>
                      <div class="host-pic">
                          <a href="https://propertystays.com/author/ashleybailey/" target="_blank" title="Ashley Bailey" class="service-avatar"><img alt="Lets plan your trip" src="{{ URL::asset('resources/assets/front-end/img/host-person.jpeg') }}" height="35" width="35" loading="lazy"></a>
                      </div>
                      <div class="product-price"><span class="text-light">£80<small>/ per night</small></span></div>

                  </div>
                  <div class="card-body py-2 px-2">
                      <a class="product-meta d-block fs-xs pb-1" href="#">Rental</a>
                      <h3 class="product-title fs-sm">
                          <a href="shop-single-v1.html">Spacious 3 Bedroom House Share Near Hammersmith City</a>
                      </h3>
                        <div class="d-flex justify-content-between">
                          
                          <div class="star-rating">
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-half active"></i>
                              <i class="star-rating-icon ci-star"></i>
                          </div>

                        </div>
                          <div class="amenities">
                              <div class="ppl" data-toggle="tooltip" title="" data-original-title="No. People">
                                  <i>&nbsp</i>
                                  <span>7</span>
                              </div>
                              <div class="bed" data-toggle="tooltip" title="" data-original-title="No. Beds">
                                  <i>&nbsp</i>
                                  <span>7</span>
                              </div>
                              <div class="bath" data-toggle="tooltip" title="" data-original-title="No. Bathrooms">
                                  <i>&nbsp</i>
                                  <span>1</span>
                              </div>
                              <div class="plotsize" data-toggle="tooltip" title="" data-original-title="Plot size">
                                  <i>&nbsp</i>
                                  <span>0m</span> <sup>2</sup>
                              </div>
                          </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-6 px-0 px-sm-2 mb-sm-4">
                <div class="card product-card card-static">
                  <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="ci-heart"></i></button>
                  <div class="img-holder">
                      
                      <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img src="{{ URL::asset('resources/assets/front-end/img/shop/catalog/property1.png') }}" alt="Product"></a>
                      <div class="host-pic">
                          <a href="https://propertystays.com/author/ashleybailey/" target="_blank" title="Ashley Bailey" class="service-avatar"><img alt="Lets plan your trip" src="{{ URL::asset('resources/assets/front-end/img/host-person.jpeg') }}" height="35" width="35" loading="lazy"></a>
                      </div>
                      <div class="product-price"><span class="text-light">£80<small>/ per night</small></span></div>

                  </div>
                  <div class="card-body py-2 px-2">
                      <a class="product-meta d-block fs-xs pb-1" href="#">Rental</a>
                      <h3 class="product-title fs-sm">
                          <a href="shop-single-v1.html">Spacious 3 Bedroom House Share Near Hammersmith City</a>
                      </h3>
                        <div class="d-flex justify-content-between">
                          
                          <div class="star-rating">
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-half active"></i>
                              <i class="star-rating-icon ci-star"></i>
                          </div>

                        </div>
                          <div class="amenities">
                              <div class="ppl" data-toggle="tooltip" title="" data-original-title="No. People">
                                  <i>&nbsp</i>
                                  <span>7</span>
                              </div>
                              <div class="bed" data-toggle="tooltip" title="" data-original-title="No. Beds">
                                  <i>&nbsp</i>
                                  <span>7</span>
                              </div>
                              <div class="bath" data-toggle="tooltip" title="" data-original-title="No. Bathrooms">
                                  <i>&nbsp</i>
                                  <span>1</span>
                              </div>
                              <div class="plotsize" data-toggle="tooltip" title="" data-original-title="Plot size">
                                  <i>&nbsp</i>
                                  <span>0m</span> <sup>2</sup>
                              </div>
                          </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-6 px-0 px-sm-2 mb-sm-4">
                <div class="card product-card card-static">
                  <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="ci-heart"></i></button>
                  <div class="img-holder">
                      
                      <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img src="{{ URL::asset('resources/assets/front-end/img/shop/catalog/property1.png') }}" alt="Product"></a>
                      <div class="host-pic">
                          <a href="https://propertystays.com/author/ashleybailey/" target="_blank" title="Ashley Bailey" class="service-avatar"><img alt="Lets plan your trip" src="{{ URL::asset('resources/assets/front-end/img/host-person.jpeg') }}" height="35" width="35" loading="lazy"></a>
                      </div>
                      <div class="product-price"><span class="text-light">£80<small>/ per night</small></span></div>

                  </div>
                  <div class="card-body py-2 px-2">
                      <a class="product-meta d-block fs-xs pb-1" href="#">Rental</a>
                      <h3 class="product-title fs-sm">
                          <a href="shop-single-v1.html">Spacious 3 Bedroom House Share Near Hammersmith City</a>
                      </h3>
                        <div class="d-flex justify-content-between">
                          
                          <div class="star-rating">
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-filled active"></i>
                              <i class="star-rating-icon ci-star-half active"></i>
                              <i class="star-rating-icon ci-star"></i>
                          </div>

                        </div>
                          <div class="amenities">
                              <div class="ppl" data-toggle="tooltip" title="" data-original-title="No. People">
                                  <i>&nbsp</i>
                                  <span>7</span>
                              </div>
                              <div class="bed" data-toggle="tooltip" title="" data-original-title="No. Beds">
                                  <i>&nbsp</i>
                                  <span>7</span>
                              </div>
                              <div class="bath" data-toggle="tooltip" title="" data-original-title="No. Bathrooms">
                                  <i>&nbsp</i>
                                  <span>1</span>
                              </div>
                              <div class="plotsize" data-toggle="tooltip" title="" data-original-title="Plot size">
                                  <i>&nbsp</i>
                                  <span>0m</span> <sup>2</sup>
                              </div>
                          </div>
                  </div>
                </div>
              </div>                               
            </div>
          </div>
        </div>
      </div>
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
        <a href="https://propertystays.com/host-setup/" class="btn btn-light btn-shadow mb-2 me-1">Learn more</a>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-2 py-3">
      <div class="item host-insurance">
        <i class="bi ci-mail fs-2"></i>
        <h3 class="item-title text-light">Our Insurance</h3>
        <p class="item-sub-title">All our properies within the UK are covered</p>
        <a href="https://propertystays.com/our-insurance/" class="btn btn-light btn-shadow mb-2 me-1">Read more</a>    
      </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-2 py-3">
      <div class="item host-tips">
        <i class="bi bi-award fs-2"></i>
        <h3 class="item-title text-light">Host Packages. See offers available now!</h3>
        <p class="item-sub-title">Get the latest tips to help you get the best yield from your property rentals.</p>
        <a href="https://propertystays.com/host-tips/" class="btn btn-light btn-shadow mb-2 me-1">Find out more</a>    
      </div>
    </div>
    </div>
  </div>
</section>

<!-- Blog posts carousel-->
<section class="py-5">
  <div class="container py-lg-3">
    <h2 class="h3 text-center">From the blog</h2>
    <p class="text-muted text-center mb-3 pb-4">Latest marketplace news, success stories and tutorials</p>
    <div class="tns-carousel">
      <div class="tns-carousel-inner" data-carousel-options="{&quot;items&quot;: 2, &quot;gutter&quot;: 15, &quot;controls&quot;: false, &quot;nav&quot;: true, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;500&quot;:{&quot;items&quot;:2},&quot;768&quot;:{&quot;items&quot;:3}, &quot;992&quot;:{&quot;items&quot;:3, &quot;gutter&quot;: 30}}}">
        <div>
          <div class="card"><a class="blog-entry-thumb" href="blog-single.html"><img class="card-img-top" src="{{ URL::asset('resources/assets/front-end/img/blog/05.jpg') }}" alt="Post"></a>
            <div class="card-body">
              <h2 class="h6 blog-entry-title"><a href="blog-single.html">We start selling WordPress themes soon</a></h2>
              <p class="fs-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua enim ad minim...</p>
              <div class="fs-xs text-nowrap"><a class="blog-entry-meta-link text-nowrap" href="#">Nov 23</a><span class="blog-entry-meta-divider mx-2"></span><a class="blog-entry-meta-link text-nowrap" href="blog-single.html#comments"><i class="ci-message"></i>19</a></div>
            </div>
          </div>
        </div>
        <div>
          <div class="card"><a class="blog-entry-thumb" href="blog-single.html"><img class="card-img-top" src="{{ URL::asset('resources/assets/front-end/img/blog/06.jpg') }}" alt="Post"></a>
            <div class="card-body">
              <h2 class="h6 blog-entry-title"><a href="blog-single.html">Shoot like a pro. Tips &amp; tricks</a></h2>
              <p class="fs-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua enim ad minim...</p>
              <div class="fs-xs text-nowrap"><a class="blog-entry-meta-link text-nowrap" href="#">Oct 10</a><span class="blog-entry-meta-divider mx-2"></span><a class="blog-entry-meta-link text-nowrap" href="blog-single.html#comments"><i class="ci-message"></i>28</a></div>
            </div>
          </div>
        </div>
        <div>
          <div class="card"><a class="blog-entry-thumb" href="blog-single.html"><img class="card-img-top" src="{{ URL::asset('resources/assets/front-end/img/blog/07.jpg') }}" alt="Post"></a>
            <div class="card-body">
              <h2 class="h6 blog-entry-title"><a href="blog-single.html">Designing engaging mobile experiences</a></h2>
              <p class="fs-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua enim ad minim...</p>
              <div class="fs-xs text-nowrap"><a class="blog-entry-meta-link text-nowrap" href="#">Sep 15</a><span class="blog-entry-meta-divider mx-2"></span><a class="blog-entry-meta-link text-nowrap" href="blog-single.html#comments"><i class="ci-message"></i>46</a></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- More button-->
    <div class="text-center pt-4 mt-md-2"><a class="btn btn-outline-accent" href="blog-grid-sidebar.html">Ream more posts<i class="ci-arrow-right fs-ms ms-1"></i></a></div>
  </div>
</section>

@endsection

@section('script_last')

@endsection
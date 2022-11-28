@extends('layouts.master')

@section('title')

All Destination

@endsection


@section('script')

@endsection



@section('content')




<!-- Hero section-->
      <section class="bg-primary bg-position-top-center bg-repeat-0 py-5 syed-bg" style="background-image: url({{ URL::to('/') }}/storage/app/public/uploads/pages/{{ $item->image }});">
        <div class="pb-lg-5 mb-lg-3">
          <div class="container py-lg-5 my-lg-5">
            <div class="row mb-4 mb-sm-5">
              <div class="col-lg-7 col-md-9 text-center text-sm-start">
                <h1 class="lh-base" style="color: #00bdbc !important; text-shadow: 2px 2px 2px rgb(0 0 0);">
                  <span >Over</span> 1,500 <span >curated</span> Rentals <span >&amp;</span> Tours <span >at your finger tips!</span></h1>
                <h2 class="h5 text-green fw-dark"  style="color: #00bdbc !important; text-shadow: 2px 2px 2px rgb(0 0 0);">High quality rental created by our global team</h2>
              </div>
            </div>
            
          </div>
        </div>
      </section>
		
      <!-- Featured locations (Carousel)-->
      @if(count($tops) > 0)
      <section class="container position-relative pt-3 pt-lg-0 pb-5 mt-lg-n10" style="z-index: 10;">
        <div class="card px-lg-2 border-0 shadow-lg">
          <div class="card-body px-4 pt-5 pb-4">
            {!! $item->description !!}
            <!-- Carousel-->
            <div class="tns-carousel pt-4">
              <div class="tns-carousel-inner" data-carousel-options="{&quot;items&quot;: 2, &quot;gutter&quot;: 15, &quot;controls&quot;: true, &quot;nav&quot;: true, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;500&quot;:{&quot;items&quot;:2},&quot;768&quot;:{&quot;items&quot;:3}, &quot;992&quot;:{&quot;items&quot;:3, &quot;gutter&quot;: 30}}}">
                <!-- Product-->
                @foreach($tops as $item)
               		<div class="col-lg-6 col-6 px-0 px-sm-2 mb-sm-4">
                      <div class="card product-card card-static city-destinations">
                        <div class="img-holder" style="background: url({{ URL::asset('storage/app/public/uploads/cities/'.$item->image) }});">
                            <a class="card-img-top d-block overflow-hidden" href="{{ url('location/'.$item->slug) }}">
                                <div class="cityname">
                                <span class="text-light">{{ $item->cityname }}</span>
                                <small class="text-light">{{ $item->properties->count() }} properties</small>
                            </div>
                            </a>
                        </div>
                      </div>
                  </div>
                @endforeach  
                </div>
            </div>
          </div>
        </div>
      </section>
      @endif
			@if(count($others) > 0)
      <!-- uk grid-->
      <section class="container pb-5 mb-lg-3">
        <!-- Heading-->
        <div class="d-flex flex-wrap justify-content-between align-items-center pt-1 border-bottom pb-4 mb-4">
          <h2 class="h3 mb-0 pt-3 me-2">Rental locations within UK</h2>
          
        </div>
        <!-- Grid-->
        <div class="row pt-2 mx-n2">

        	@foreach($others as $item)
			
						<div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-grid-gutter">
					  	
					  	<div class="card product-card card-static city-destinations">
								
								<div class="img-holder" style="background: url({{ URL::asset('storage/app/public/uploads/cities/'.$item->image) }});">

									<a class="card-img-top d-block overflow-hidden" href="{{ url('location/'.$item->slug) }}">
										<div class="cityname">
											<span class="text-light">{{ $item->cityname }}</span>
											<small class="text-light">{{ $item->properties->count() }} properties</small>
										</div>
									</a>

								</div>

					  	</div>

						</div>

					@endforeach 
			
        </div>
        <!-- More button-->
	        <div class="text-center">
	        	<a class="btn btn-outline-primary" href="{{ url('all-destinations/more') }}">
        			View more locations <i class="ci-arrow-right fs-ms ms-1"></i>
        		</a>
        	</div>
      </section>
	
	  	@endif
			@if(count($worldwide) > 0)
	  	<!-- wordwide grid--> 
     	<section class="container pb-5 mb-lg-3">
        <!-- Heading-->
        <div class="d-flex flex-wrap justify-content-between align-items-center pt-1 border-bottom pb-4 mb-4">
          <h2 class="h3 mb-0 pt-3 me-2">Worldwide destinations</h2>
        </div>
        <!-- Grid-->
        <div class="row pt-2 mx-n2">

        	@foreach($worldwide as $item)

							<div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-grid-gutter">

							  <div class="card product-card card-static city-destinations">

									<div class="img-holder" style="background: url({{ URL::asset('storage/app/public/uploads/cities/'.$item->image) }});">

										<a class="card-img-top d-block overflow-hidden" href="{{ url('location/'.$item->slug) }}">

											<div class="cityname">

											<span class="text-light">{{ $item->cityname }}</span>

											<small class="text-light">{{ $item->properties->count() }} properties</small>

										</div>

										</a>

									</div>

							  </div>

							</div>

					@endforeach		
			
        </div>
        <!-- More button-->
        <div class="text-center"><a class="btn btn-outline-primary" href="{{ url('all-destinations/more') }}">View more locations<i class="ci-arrow-right fs-ms ms-1"></i></a></div>
      </section>

      @endif
		
      <!-- Marketplace features-->
      <section class="bg-primary bg-size-cover bg-position-center pt-5 pb-4 pb-lg-5" style="background-image: url(img/marketplace/features/features-bg.jpg);">
        <div class="container pt-lg-3">
          <h2 class="h3 mb-3 pb-4 text-light text-center">Why our marketplace?</h2>
          <div class="row pt-lg-2 text-center">
            <div class="col-lg-3 col-sm-6 mb-grid-gutter">
              <div class="d-inline-flex align-items-center text-start"><img src="{{ URL::asset('resources/assets/front-end/img/marketplace/features/quality.png') }}" width="52" alt="Quality Guarantee">
                <div class="ps-3">
                  <h6 class="text-light fs-base mb-1">Quality Guarantee</h6>
                  <p class="text-light fs-ms opacity-70 mb-0">Quality checked by our team</p>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-grid-gutter">
              <div class="d-inline-flex align-items-center text-start"><img src="{{ URL::asset('resources/assets/front-end/img/marketplace/features/support.png') }}" width="52" alt="Customer Support">
                <div class="ps-3">
                  <h6 class="text-light fs-base mb-1">Customer Support</h6>
                  <p class="text-light fs-ms opacity-70 mb-0">Friendly 24/7 customer support</p>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-grid-gutter">
              <div class="d-inline-flex align-items-center text-start"><img src="{{ URL::asset('resources/assets/front-end/img/marketplace/features/updates.png') }}" width="52" alt="Free Updates">
                <div class="ps-3">
                  <h6 class="text-light fs-base mb-1">Lifetime Free Updates</h6>
                  <p class="text-light fs-ms opacity-70 mb-0">Never pay for an update</p>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-grid-gutter">
              <div class="d-inline-flex align-items-center text-start"><img src="{{ URL::asset('resources/assets/front-end/img/marketplace/features/secure.png') }}" width="52" alt="Secure Payments">
                <div class="ps-3">
                  <h6 class="text-light fs-base mb-1">Secure Payments</h6>
                  <p class="text-light fs-ms opacity-70 mb-0">We posess SSL / Secure сertificate</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>


@endsection

@section('script_last')

@endsection
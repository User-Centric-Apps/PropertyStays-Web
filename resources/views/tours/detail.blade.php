@extends('layouts.master')

@section('title')

{{ $item->title }}

@endsection


@section('script')
<link href="{{ URL::asset('resources/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('resources/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('resources/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('resources/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('resources/assets/global/plugins/clockface/css/clockface.css') }}" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" type="text/css" href="http://lopezb.com/hoteldatepicker/css/hotel-datepicker.css">

        <link rel="stylesheet" media="screen" href="{{ URL::asset('resources/assets/front-end/vendor/lightgallery.js/dist/css/lightgallery.min.css') }}"/>

        <link href="{{ URL::asset('resources/assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.css') }}" rel="stylesheet" type="text/css" />

        <style type="text/css">
          .nactive
          {
            background: #00bdbc;
            color: white;
          }
          .btn-default
          {
            background: #009493;
            border-radius: 0;
            color: white;
          }
          .btn-default:hover
          {
            color: white;
          }
          #mapCanvas {
              width: 100%;
              height: 400px;
          }
          div i
          {
            width: auto !important;
            margin-right: 5px;
            margin-top: -1px;
            font-size: 22px;
          }
          
        </style>

@endsection



@section('content')

      <div class="page-title-overlap bg-primary pt-4">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
          <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
                <li class="breadcrumb-item"><a class="text-nowrap" href="{{ url('/') }}">
                	<i class="ci-home"></i>Home
	                </a>
	            </li>
                <li class="breadcrumb-item text-nowrap">
                	<a href="{{ url('tours') }}">Tours</a>
                </li>
              </ol>
            </nav>
          </div>
          <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
            <h1 class="h3 text-light mb-0">{{ $item->title }}</h1>
          </div>
        </div>
      </div>


      <div class="container">
        <!-- Gallery + details-->
        <div class="bg-light shadow-lg rounded-3 px-4 py-3 mb-5">
          <div class="px-lg-3">
            <div class="row">
              <!-- Product gallery-->
              <div class="col-lg-8 pe-lg-0 pt-lg-2">

                <div class="product-details product-card pb-3 px-2" style="max-width: 100%;">
                  <?php $pri = $item->adults; ?>
                  @if($item->children)
                    <?php $pri = $item->children; ?>
                  @endif
                  <div class="m-2 mb-3 ">
                    <span class="h3 fw-normal text-primary me-1">
                      Starting from {{ Session::get('currency') === 'gbp' ? '£' : '€' }} {{ number_format($pri*Session::get('value'), 2) }}
                    </span>
                  </div>

                  <div class="fs-sm m-2">
                    <h6 class="fs-base mb-3">Ideal for:</h6>
                    <div class="amenities">
                      @if($item->tour_duration)
                        <div>
                          <i class="text-body ci-time"></i>
                          <span class="pt-0">Duration : {{ $item->tour_duration }}</span>
                        </div>
                      @endif
                      @if($item->sqft)
                        <div >
                          <i class="text-body ci-user"></i>
                          <span class="pt-0">Group Size : {{ $item->sqft }}</span>
                        </div>
                      @endif
                      @if($item->cityname)
                        <div >
                          <i class="text-body ci-location"></i>
                          <span class="pt-0">City : {{ $item->cityname }}</span>
                        </div>
                      @endif
                </div>

              </div>

                <div class="product-gallery m-2">
                  <?php $isFirst = true; ?>
                  <div class="product-gallery-preview order-sm-2">
                    
                    @foreach($item_images as $image)
                      <div class="product-gallery-preview-item {{ $isFirst ? ' active' : '' }} gallery" id="a_{{ $image->id }}">
                        <a href="{{ URL::to('/') }}/storage/app/public/uploads/tours/{{ $image->image }}" class="gallery-item" >
                            <img src="{{ URL::to('/') }}/storage/app/public/uploads/tours/{{ $image->image }}" alt="{{ $item->title }}">
                        </a>
                        <div class="image-zoom-pane"></div>
                      </div>

                    <?php $isFirst = false; ?> 
                    @endforeach 
                    
                  </div>
                  <div class="product-gallery-thumblist order-sm-1">
                    @foreach($item_images as $image)
                      <a class="product-gallery-thumblist-item {{ $isFirst ? ' active' : '' }}" href="#a_{{ $image->id }}">
                        <img src="{{ URL::to('/') }}/storage/app/public/uploads/tours/{{ $image->image }}" alt="{{ $item->title }}">
                      </a>
                    @endforeach
                  </div>
                  
                </div>
              </div>
              </div>
              <!-- Product details-->
              <div class="col-lg-4 pt-4 pt-lg-2">

                <div class="product-details product-card ms-auto pb-3 px-2 ">
           
                    <div class="d-flex justify-content-between align-items-center mb-2 p-2">
                      <a href="#reviews" data-scroll>
                        <div class="star-rating">
                          @if(count($feedback) > 0)
                            <i class="star-rating-icon ci-star-filled active"></i>
                            <i class="star-rating-icon ci-star-filled active"></i>
                            <i class="star-rating-icon ci-star-filled active"></i>
                            <i class="star-rating-icon ci-star-filled active"></i>
                            <i class="star-rating-icon ci-star-filled active"></i>
                          @else
                            <i class="star-rating-icon ci-star"></i>
                            <i class="star-rating-icon ci-star"></i>
                            <i class="star-rating-icon ci-star"></i>
                            <i class="star-rating-icon ci-star"></i>
                            <i class="star-rating-icon ci-star"></i>
                          @endif
                        </div>
                        <span class="d-inline-block fs-sm text-body align-middle mt-1 ms-1">
                          {{ count($feedback) }} Reviews
                        </span>
                      </a>
                      
                    </div>
                    
                    <div id="chunti"></div>

                    @if($item->ready_to_pay)
                  <form class="p-2" novalidate method="POST" action="{{ url('add-cart') }}">
                    @csrf
                    <input type="hidden" name="property_id" value="{{ $item->id }}">
                    <input type="hidden" name="type" value="2">
                    <div class="mb-3">
                        <h3>Ready to book?</h3>
                      </div>
                    <div class="mb-3">
                      <label for="help-text-input" class="form-label">Adults <small>(age 12 +)</small></label>
                      <input id="adults" class="form-control" type="text" name="adults">
                    </div>

                    @if($item->children)
                    <div class="mb-3">
                      <label for="help-text-input" class="form-label">Children <small>(age 2 to 12)</small></label>
                      <input id="childrens" class="form-control" type="text" name="childrens">
                    </div>
                    @else
                      <input type="hidden" name="childrens">
                    @endif
                    @if($item->infant)
                    <div class="mb-3">
                      <label for="help-text-input" class="form-label">infant <small>(age 0 to 2)</small></label>
                      <input id="infants" class="form-control" type="text" name="infants">
                    </div>
                    @else
                      <input type="hidden" name="infants">
                    @endif

                    <div class="mb-3">
                      <label for="help-text-input" class="form-label">Date </label>
                          <input type="text" class="form-control date-picker" name="check_in" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
                    </div>
                    <div class="mb-3">
                                    <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                                    @if ($errors->has('g-recaptcha-response'))
                                        <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                    @endif
                              </div>
                    <div class="mb-3 d-flex align-items-center">
                      
                      <button class="btn btn-primary btn-shadow d-block w-100" type="submit">
                        <i class="ci-cart fs-lg me-2"></i>Book Now
                      </button>
                    </div>
                  </form>

                  @else
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(session('success_msg'))
                      <div class="alert alert-success">
                          <span> {{ session('success_msg') }}</span>
                      </div>
                    @elseif(session('danger_msg'))
                      <div class="alert alert-danger">
                          <span> {{ session('danger_msg') }}</span>
                      </div>    
                    @endif
                    <form class="p-2"  method="POST" action="{{ url('enquiry/place/save') }}">
                      @csrf
                      <input type="hidden" name="property_id" value="{{ $item->id }}">
                      <input type="hidden" name="enquiry_type" value="2">

                      <div class="mb-3">
                        <h3>Send enquiry</h3>
                      </div>

                      <div class="mb-3">
                        <label for="name" class="form-label">Name </label>
                        <input id="name" class="form-control" type="text" name="name">
                      </div>

                      <div class="mb-3">
                        <label for="email" class="form-label">Email </label>
                        <input id="email" class="form-control" type="text" name="email">
                      </div>

                      <div class="mb-3">
                        <label for="mobile" class="form-label">Mobile </label>
                        <input id="mobile" class="form-control" type="text" name="mobile">
                      </div>

                      <div class="mb-3">
                        <label for="help-text-input" class="form-label">Date </label>
                          <input type="text" class="form-control date-picker" name="date" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
                      </div>

                      <div class="mb-3">
                        <label for="traveller" class="form-label">Traveller </label>
                        <input id="traveller" class="form-control" type="text" name="traveller">
                      </div>

                      <div class="mb-3">
                        <label for="help-text-input" class="form-label">Enquiry </label>
                        <textarea class="form-control" name="description" rows="5"></textarea>
                      </div>
                      <div class="mb-3">
                                    <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                                    @if ($errors->has('g-recaptcha-response'))
                                        <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                    @endif
                              </div>
                      <div class="mb-3 d-flex align-items-center">
                        
                        <button class="btn btn-primary btn-shadow d-block w-100" type="submit">
                          Send
                        </button>
                      </div>
                    </form>

                  @endif
                  
                  <!-- Sharing-->
                    <label class="form-label d-inline-block align-middle m-2 p-2">Share:</label>
                    <a class="btn-share btn-twitter me-2 my-2" href="#" id="shareWithTwitter">
                      <i class="ci-twitter"></i>
                    </a>
                    <a class="btn-share btn-instagram me-2 my-2" href="mailto:?subject=Find the best property&body={{ url('rental/'.$item->slug) }}" >
                      <i class="ci-mail"></i>
                    </a>
                    <a class="btn-share btn-facebook my-2" href="#" id="shareWithFb">
                      <i class="ci-facebook"></i>
                    </a>

                </div>

                <div class="product-details product-card mt-2 p-3">
          
                  <div class="fs-sm mb-3 mt-3 img-holder ">
                    <h3 class="fs-base mb-2 m-2 text-dark">
                      Hosted by {{ $item->name }}<br />
                      <small>Member Since @if($item->joined) {{ date("F j, Y", strtotime($item->joined)) }} @endif</small>
                    </h3>
                    <div class="host-pic ">
                        <a href="#" title="{{ $item->name }}" class="service-avatar pimple">
                          @if($item->profile_pic)
                            <img alt="Lets plan your trip" src="{{ URL::to('/') }}/storage/app/public/uploads/customers/{{ isset($item->profile_pic)?$item->profile_pic:'no-image.png' }}" height="35" width="35" loading="lazy">
                          @else
                            <img alt="Lets plan your trip" src="{{ URL::asset('resources/assets/front-end/img/home/PropertyStays-icon.png') }}" height="35" width="35" loading="lazy">
                          @endif
                        </a>
                    </div>
                  </div>

                  @if ($errors->any())
                              <div class="alert alert-danger">
                                  <ul style="margin-bottom: 0;">
                                      @foreach ($errors->all() as $error)
                                          <li>{{ $error }}</li>
                                      @endforeach
                                  </ul>
                              </div>
                            @endif
                            @if(session('success_msg'))
                              <div class="alert alert-success">
                                  <span> {{ session('success_msg') }}</span>
                              </div>
                            @elseif(session('danger_msg'))
                              <div class="alert alert-danger">
                                  <span> {{ session('danger_msg') }}</span>
                              </div>    
                            @endif
                
                  <div class="accordion m-2" id="accordionQuestion">

                    <!-- Item -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOneQ">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOneQ" aria-expanded="true" aria-controls="collapseOneQ" style="font-size: 15px; font-weight: normal; padding-left: 15px; color:#5191FA; ">
                              ASK A QUESTION
                            </button>
                        </h2>
                        <div class="accordion-collapse collapse" id="collapseOneQ" aria-labelledby="headingOneQ" data-bs-parent="#accordionQuestion">

                          <div class="accordion-body">

                            
                            <form class="mb-grid-gutter needs-validation" id="my-form" method="POST" action="{{ url('enquiry/place/save') }}">
                              @csrf
                              <input type="hidden" name="property_id" value="{{ $item->id }}">
                              <input type="hidden" name="enquiry_type" value="1">

                              <div class="mb-3">
                                <label for="help-text-input" class="form-label">Name </label>
                                <input class="form-control" type="text" id="n" name="name" required='required'>
                              </div>

                              <div class="mb-3">
                                <label for="help-text-input" class="form-label">Email </label>
                                <input class="form-control" type="email" id="e" name="email" required='required'>
                              </div>

                              <div class="mb-3">
                                <label for="help-text-input" class="form-label">Mobile </label>
                                <input class="form-control" type="text" name="mobile" required='required'>
                              </div>

                              <div class="mb-3">
                                <label for="help-text-input" class="form-label">Enquiry </label>
                                <textarea class="form-control" name="description" rows="5" required='required'></textarea>
                              </div>
                              <div class="mb-3">
                                    <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                                    @if ($errors->has('g-recaptcha-response'))
                                        <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                    @endif
                              </div>
                              <div class="mb-3 d-flex align-items-center">
                                
                                <button class="btn btn-primary btn-shadow d-block w-100" type="submit">
                                  Send
                                </button>
                              </div>
                            </form>


                          </div>

                        </div>

                    </div>

                  </div>
                  
                </div>

              </div>

            </div>

          </div>

        </div>

        <!-- Product description section 1-->
        <div class="row align-items-center py-md-3">
      <!-- Product panels-->
                  <div class="accordion mb-4" id="productPanels">
                    <div class="accordion-item">
                      <h3 class="accordion-header">
                        <a class="accordion-button" href="#productInfo" role="button" data-bs-toggle="collapse" aria-expanded="true" aria-controls="productInfo"> Tour Detail
                        </a>
                      </h3>
                      <div class="accordion-collapse collapse show" id="productInfo" data-bs-parent="#productPanels">
                        <div class="accordion-body">
                          {!! $item->description !!}
                        </div>
                      </div>
                    </div>

                    <div class="accordion-item">
                      <h3 class="accordion-header">
                        <a class="accordion-button collapsed" href="#Amenities" role="button" data-bs-toggle="collapse" aria-expanded="true" aria-controls="Amenities">   Included/Excluded
                        </a>
                      </h3>
                      <div class="accordion-collapse collapse" id="Amenities" data-bs-parent="#productPanels">
                        <div class="accordion-body fs-sm">
                            <div class="row">
                              <div class="col-6">
                                <h5>Included</h5>
                                {!! $item->tour_included !!}
                              </div>
                              <div class="col-6">
                                <h5>Excluded</h5>
                                {!! $item->tour_excluded !!}
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>

                    <div class="accordion-item">
                      <h3 class="accordion-header">
                        <a class="accordion-button collapsed" href="#Amenities" role="button" data-bs-toggle="collapse" aria-expanded="true" aria-controls="Amenities">   Tour Highlight
                        </a>
                      </h3>
                      <div class="accordion-collapse collapse" id="Amenities" data-bs-parent="#productPanels">
                        <div class="accordion-body fs-sm">
                            <div class="row">
                              <div class="col-12">
                                {!! $item->tour_highlight !!}
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>

                  </div>
          
        </div>
        
        <!-- Product description section 2-->
        <div class="row align-items-center pb-1">
          @if($item->latitude)
          <div class="col-md-12">
            <div id="mapCanvas"></div>
          </div>
          @endif
          <!--<div class="col-md-4">
            <div class="position-relative bg-size-cover bg-position-center py-5" style="background-image: url({{ URL::asset('resources/assets/front-end/img/shop/single/prod-map.png') }});">
              <span class="position-absolute top-0 start-0 w-100 h-100 bg-black opacity-50"></span>
              <div class="position-relative px-3 py-5 my-sm-5 text-center zindex-5">
                <a href="link-to-youtube/vimeo-video" class="btn-video my-2" data-bs-toggle="video"></a>
                <br>
                <span class="fs-sm text-light text-shadow">Click me to watch video!</span>
              </div>
            </div>
          </div>-->
        </div>
      </div>


      <!-- Reviews-->
      <div class="border-top border-bottom my-lg-3 py-2">
        <div class="container pt-md-2" id="reviews">
          
          @if(session('success'))
            <div class="alert alert-success">
                <span> {{ session('success') }}</span>
            </div>
          @elseif(session('danger'))
            <div class="alert alert-danger">
                <span> {{ session('danger') }}</span>
            </div>    
          @endif
          <div class="row pt-4" id="reviews">
            <!-- Reviews list-->
            <div class="col-md-7">
              @if(count($feedback) > 0)
              <div class="d-flex justify-content-end pb-4">
                <div class="d-flex align-items-center flex-nowrap">
                  <label class="fs-sm text-muted text-nowrap me-2 d-none d-sm-block" for="sort-reviews">Sort by:</label>
                  <select class="form-select form-select-sm" id="sort-reviews">
                    <option>Newest</option>
                    <option>Oldest</option>
                    <option>Popular</option>
                    <option>High rating</option>
                    <option>Low rating</option>
                  </select>
                </div>
              </div>

              <!-- Review-->
              @foreach($feedback as $itm)
                <div class="product-review pb-4 mb-4 border-bottom">
                  <div class="d-flex mb-3">
                    <div class="d-flex align-items-center me-4 pe-2">
                      <div>
                        <h6 class="fs-sm mb-0">
                          {{ $itm->name }}
                        </h6>
                        <span class="fs-ms text-muted">
                          {{ $itm->created_at }}
                        </span>
                      </div>
                    </div>
                    <div>
                      <div class="star-rating">
                        @if($itm->rating == 1)
                          <i class="star-rating-icon ci-star-filled active"></i>
                          <i class="star-rating-icon ci-star"></i>
                          <i class="star-rating-icon ci-star"></i>
                          <i class="star-rating-icon ci-star"></i>
                          <i class="star-rating-icon ci-star"></i>
                        @elseif($itm->rating == 2)
                          <i class="star-rating-icon ci-star-filled active"></i>
                          <i class="star-rating-icon ci-star-filled active"></i>
                          <i class="star-rating-icon ci-star"></i>
                          <i class="star-rating-icon ci-star"></i>
                          <i class="star-rating-icon ci-star"></i>

                        @elseif($itm->rating == 3)
                          <i class="star-rating-icon ci-star-filled active"></i>
                          <i class="star-rating-icon ci-star-filled active"></i>
                          <i class="star-rating-icon ci-star-filled active"></i>
                          <i class="star-rating-icon ci-star"></i>
                          <i class="star-rating-icon ci-star"></i>
                        @elseif($itm->rating == 4)
                          <i class="star-rating-icon ci-star-filled active"></i>
                          <i class="star-rating-icon ci-star-filled active"></i>
                          <i class="star-rating-icon ci-star-filled active"></i>
                          <i class="star-rating-icon ci-star-filled active"></i>
                          <i class="star-rating-icon ci-star"></i>
                        @elseif($itm->rating == 5)
                          <i class="star-rating-icon ci-star-filled active"></i>
                          <i class="star-rating-icon ci-star-filled active"></i>
                          <i class="star-rating-icon ci-star-filled active"></i>
                          <i class="star-rating-icon ci-star-filled active"></i>
                          <i class="star-rating-icon ci-star-filled active"></i>
                        @endif  
                      </div>
                    </div>
                  </div>
                  <p class="fs-md mb-2">{{ $itm->comment }}</p>
                </div>
              @endforeach
              <!-- Review-->

              <!--<div class="text-center">
                <button class="btn btn-outline-accent" type="button"><i class="ci-reload me-2"></i>Load more reviews</button>
              </div>-->
              @else
                <div class="bg-danger rounded-3 p-4 mb-4">
                    <p class="fs-sm text-white mb-0">
                      No record found yet!
                    </p>
                </div>
              @endif
            </div>
            <!-- Leave review form-->
            <div class="col-md-5 mt-2 pt-4 mt-md-0 pt-md-0">
              @if(Auth::check())
              <div class="bg-secondary py-grid-gutter px-grid-gutter rounded-3">
                <h3 class="h4 pb-2">Write a review</h3>
                <form class="needs-validation" novalidate method="POST" action="{{ url('user/feedback') }}">
                  @csrf
                  <input type="hidden" name="property_id" value="{{ $item->id }}">
                  
                  
                  <div class="mb-3">
                    <label class="form-label" for="review-rating">Rating<span class="text-danger">*</span></label>
                    <select class="form-select" required id="review-rating" name="rating">
                      <option value="">Choose rating</option>
                      <option value="5">5 stars</option>
                      <option value="4">4 stars</option>
                      <option value="3">3 stars</option>
                      <option value="2">2 stars</option>
                      <option value="1">1 star</option>
                    </select>
                    <div class="invalid-feedback">Please choose rating!</div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="review-text">Review<span class="text-danger">*</span></label>
                    <textarea class="form-control" rows="6" required id="review-text" name="comment"></textarea>
                    <div class="invalid-feedback">Please write a review!</div>
                  </div>
                  <div class="mb-3">
                                    <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                                    @if ($errors->has('g-recaptcha-response'))
                                        <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                    @endif
                              </div>
                  <button class="btn btn-primary btn-shadow d-block w-100" type="submit">Submit a Review</button>
                </form>
              </div>
              @else
                <a class="btn btn-primary btn-shadow d-block w-100" href="{{ url('login') }}">
                  Login first for review!
                </a>
              @endif
            </div>
          </div>
        </div>
      </div>


@endsection

@section('script_last')

<script src="{{ URL::asset('resources/assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('resources/assets/global/plugins/fuelux/js/spinner.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('resources/assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('resources/assets/pages/scripts/components-bootstrap-touchspin.min.js') }}" type="text/javascript"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYCz8d29qK8u6uqETS6JAk5NSJeVPL390">
  
</script>
<script src="{{ URL::asset('resources/assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('resources/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('resources/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('resources/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('resources/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('resources/assets/global/plugins/clockface/js/clockface.js') }}" type="text/javascript"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script src="{{ URL::asset('resources/assets/front-end/vendor/lightgallery.js/dist/js/lightgallery.min.js') }}"></script>
    <script src="{{ URL::asset('resources/assets/front-end/vendor/lg-fullscreen.js/dist/lg-fullscreen.min.js') }}"></script>
    <script src="{{ URL::asset('resources/assets/front-end/vendor/lg-zoom.js/dist/lg-zoom.min.js') }}"></script>

<script type="text/javascript">
            var copiedLink = "{{ url('rental/'.$item->slug) }}";
            jQuery(document).ready(function() 
            {
              $('.date-picker').datepicker({
                  orientation: "bottom",
                  autoclose: true
              });
              $('#shareWithTwitter').click(function () {
                window.open("https://twitter.com/intent/tweet?url=" + copiedLink);
              });
              $('#shareWithFb').click(function () {
                  window.open("https://www.facebook.com/sharer/sharer.php?u=" + copiedLink, 'facebook-share-dialog', "width=626, height=436");
              });
              $('#shareWithMail').click(function () {
                  var formattedBody = "This is cause link: " + (copiedLink);
                  var mailToLink = "mailto:?subject= " + user + " wants you to donate to this noble cause&body=" + encodeURIComponent(formattedBody);
                  window.location.href = mailToLink;
              });
              $('#shareWithWhatsapp').click(function () {
                  var win = window.open('https://api.whatsapp.com/send?text=' + copiedLink, '_blank');
                  win.focus();
              });

              $("#adults").TouchSpin({
                  min: 1,
                  max: 10,
                  stepinterval: 1,
              });
              $("#childrens").TouchSpin({
                  min: 1,
                  max: 10,
                  stepinterval: 1,
              });
              $("#infants").TouchSpin({
                  min: 1,
                  max: 10,
                  stepinterval: 1,
              });
               $('#defaultrange').daterangepicker({
                opens: 'left',
                format: 'DD-MM-YYYY',
                separator: ' to ',
                dateLimit: {
                    days: 60
                },
                startDate: moment(),
                minDate: '01-12-2021',
              },
              function (start, end) {
                  $('#defaultrange input').val(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                  $('#check_in').val(start.format('YYYY-MM-DD'));
                  $('#check_out').val(end.format('YYYY-MM-DD'));
                  var totalDays = end.diff(start, "days")
                  $('#total_nights').val(totalDays);
              }); 
            });

            function initMap() {
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap'
    };
                    
    /* Display a map on the web page */
    map = new google.maps.Map(document.getElementById("mapCanvas"), mapOptions);
    map.setTilt(100);
        
    /* Multiple markers location, latitude, and longitude */
    var markers = [
        <?php if($item->latitude)
        {
                echo '["'.$item->title.'", '.$item->latitude.', '.$item->longitude.'],'; 
        } 
        ?>
    ];
        
     /* Add multiple markers to map */
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    
     /* Place each marker on the map  */
    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
      icon: markers[i][3],
            title: markers[i][0]
        });
        
         /* Add info window to marker   */
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.open(map, marker);
            }
        })(marker, i));

       /* Center the map to fit all markers on the screen */
        map.fitBounds(bounds);
    }

   /* Set zoom level */
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(14);
        google.maps.event.removeListener(boundsListener);
    });
}

/* Load initialize function */
google.maps.event.addDomListener(window, 'load', initMap);
            
        </script>
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